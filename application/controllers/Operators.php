<?php

class operators extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('elephant_io_helper'); // Load the elephant_io_helper
        $this->load->helper('send_email_helper'); // Load the send_email_helper.
        $this->load->helper('time_calculator_helper');
    }


    public function index()
    {
        $data['active'] = 'Aplicaciones Disponibles';
        $data['title'] = ucfirst("Andon"); // Capitalize the first letter
        
        //data validation
        $this->form_validation->set_rules('work_order_number', 'Orden de trabajo', 'required');

        if ($this->form_validation->run() ===  FALSE)
        {
            $this->load->view('_templates/operator/header', $data);
            $this->load->view('operators/index', $data);
            $this->load->view('_templates/operator/footer');
        }
        else
        {
            $work_order = $this->input->post('work_order_number');
            $work_order = $this->HourbyHour_model->get_workorder_tracking($work_order);

            if($work_order)
            {
                redirect(base_url('operator/hourbyhour/'.$work_order['wo_id']));
            }
            else
            {
                $this->session->set_flashdata('error', 'Orden de trabajo no encontrada');
                redirect(base_url('operator'));
            }
        }

    }


    public function andon()
    {
        $data['active'] = 'Andon';
        $data['title'] = ucfirst("Andon"); // Capitalize the first letter
        $data['alerts'] = $this->Alert_model->get_alerts();  

        $this->load->view('_templates/operator/header', $data);
        $this->load->view('operators/andon', $data);
        $this->load->view('_templates/operator/footer');
    }


    public function andon_single($id)
    {
        $data['active'] = 'Andon';
        $data['title'] = ucfirst("Andon"); // Capitalize the first letter
        $data['alert'] = $this->Alert_model->get_alert($id);
        $data['plants'] = $this->Plants_model->get_plants();   
        $data['subalerts'] = $this->Alert_model->get_sub_alerts($id);
        $data['parts'] = $this->Parts_model->get_parts();


        $this->form_validation->set_rules('plant_id', 'Planta', 'required');
        $this->form_validation->set_rules('line_id', 'Linea de producción', 'required');
        $this->form_validation->set_rules('work_station_id', 'Estación de trabajo', 'required');
        $this->form_validation->set_rules('subalert', 'Sub Alerta', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('_templates/operator/header', $data);
            $this->load->view('operators/single', $data);
            $this->load->view('_templates/operator/footer');
        }
        else
        {
            $data = array(
                'plant_id' => $this->input->post('plant_id'),
                'line_id' => $this->input->post('line_id'),
                'work_station_id' => $this->input->post('work_station_id'),
                'alert_id' => $id,
                'subalert_id' => $this->input->post('subalert'),
                'report_user' => $this->session->userdata('user_id'),
                'part_number' => $this->input->post('part'),
            );
            
            $event_id = $this->Andon_model->create_andon($data);//andon created.


            $andon_message_data = $this->Andon_model->get_andon_message_for_email($event_id);
            //get team by alert.
            $teams = $this->Teams_model->get_team_by_alert($id);
            //print_r($teams);

            
            $recipients = array();
            foreach ($teams as $team) 
            {
                //get team members for each team.
                $team_members = $this->Teams_model->get_team_members($team['team_id']);
                //$recipients = array_merge($recipients, $team_members);
                foreach ($team_members as $member) {
                    $recipients[] = $member['email'];
                }
            }
            
            //print_r($andon_message_data);
            
            //use elephant.io to send message to andon display.
            send_alert($event_id, date('H:i:s'));


            //send email to team members.
            send_andon_email($recipients, $andon_message_data, 'assets/images/default_images/leanquattro_logo.png');


            $this->session->set_flashdata('success', 'Su reporte de Andon ha sido enviado correctamente.');
            redirect(base_url('operator/andon'));
        }


    }



    public function operator_update_order($work_order_id)
    {

        $data['active'] = 'hourbyhour_clients';
        $data['title'] = 'Captura de Producción';

        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;


        if (!isset($_POST['save'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/operator/header', $data);
            $this->load->view('operators/single_order_update', $data);
            $this->load->view('_templates/operator/footer');
        } 
        else
        {
            $hoursData = array();
            $hours = 24;
            for($i = 0; $i < $hours; $i++)
            {
                $single_number = $i < 10 ? "0".$i : $i;
                $hoursData[$single_number."r"] = $this->input->post("done_".$single_number);
            }
        
            // Insert the data into the database
            $this->HourbyHour_model->update_hourbyhour_data($hoursData , $work_order_id);

            if($data['work_order']['work_order_in'] == NULL || $data['work_order']['work_order_in'] == '')
            {
                $data=array(
                    'work_order_in'=>date('Y-m-d H:i:s'),
                    'status'=>2,
                    'worker_user'=>$this->session->userdata('user_id')
                );
            }
            else
            {
                $data=array(
                    'worker_user'=>$this->session->userdata('user_id'),
                    'status'=>2
                );
            }
            //update workorder worker.
            $this->HourbyHour_model->update_hourbyhour_order($data, $work_order_id);

            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo actualizada correctamente.');

            //send_alert($work_order_id, date('H:i:s'));
            
            redirect(base_url() . 'operator/hourbyhour/'.$work_order_id);
        }
    }



    public function operator_end_order($work_order_id)
    {
        $data['active'] = 'hourbyhour_clients';
        $data['title'] = 'Captura de Producción';

        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

        $this->form_validation->set_rules('order_number', 'Numero de orden de trabajo.', 'required');


         //if form validation fails. $this->form_validation->run() == FALSE
         if ($this->form_validation->run() == FALSE) 
         {
            // Display registration form with validation errors
            $this->load->view('_templates/operator/header', $data);
            $this->load->view('operators/end_order', $data);
            $this->load->view('_templates/operator/footer');
         } 
         else
         {
                
             $order_end = $this->HourbyHour_model->end_hourbyhour_order($work_order_id, $this->input->post('order_number'), date('Y-m-d H:i:s'));
             if(!$order_end)
             {
                $this->session->set_flashdata('error', 'Numero de orden de trabajo incorrecto');
                redirect(base_url().'operator/hourbyhour/end/' . $work_order_id);
             }
             else
             {
                // Set flash data
                $this->session->set_flashdata('success', 'Orden de trabajo actualizada correctamente');
                redirect(base_url().'operator');
            }
         }
    }



    public function config()
    {
        $data['active'] = 'hourbyhour_clients';
        $data['title'] = 'Configuración';
        $data['devices'] = $this->Devices_model->get_devices();

        $this->form_validation->set_rules('device_id', 'Dispositivo de captura.', 'required');
        

        //if form validation fails. $this->form_validation->run() == FALSE
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/operator/header', $data);
            $this->load->view('operators/config', $data);
            $this->load->view('_templates/operator/footer');
        } 
        else
        {
            $device_id = $this->input->post('device_id');

            // Set localStorage data
            echo "<script>
            localStorage.setItem('device_id', '$device_id');
          </script>";


           //to remove
           // Remove specific items from local storage
           // localStorage.removeItem('workstation_id');

           //to retrieve
           //Retrieve the data from local storage
           //document.getElementById('workstation_id').value = localStorage.getItem('workstation_id');

           /*
            function addWorkstationId() 
            {
                var workstation_id = localStorage.getItem('workstation_id');
                document.getElementById('workstation_id').value = workstation_id;
            }
           */


           //Set session data.
           $this->session->set_userdata('device_id', $device_id);

           //to retrieve.
           //$workstation_id = $this->session->userdata('workstation_id');



            // Set flash data
            $this->session->set_flashdata('success', 'Dispositivo de captura configurado correctamente. ');
            redirect(base_url().'operator/config');

        }
    }



}