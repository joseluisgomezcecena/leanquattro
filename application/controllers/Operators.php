<?php

class operators extends MY_Controller
{
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
        

        $this->load->view('_templates/operator/header', $data);
        $this->load->view('_templates/operator/topnav');
        $this->load->view('_templates/operator/sidebar');
        $this->load->view('operators/andon/single', $data);
        $this->load->view('_templates/operators/footer');
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


            //update workorder worker.
            $data=array(
                'worker_user'=>$this->session->userdata('user_id'),
                'status'=>2
            );
            $this->HourbyHour_model->update_hourbyhour_order($data, $work_order_id);

            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo actualizada correctamente.');

            //send_alert($work_order_id, date('H:i:s'));
            
            redirect(base_url() . 'operator/hourbyhour/'.$work_order_id);
        }
    }


}