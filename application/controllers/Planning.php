<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;


class Planning extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('integration_helper'); // Load the integration helper
        $this->load->helper('elephant_io_helper'); // Load the elephant_io_helper
    }



    public function index()
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders_all_2();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('planning/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create(){
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['operations'] = $this->Operations_model->get_all_operations();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        

         // Fetch Odoo work orders using the helper function
        $odoo_data = fetch_odoo_workorders();
        $data['odoo_work_orders'] = $odoo_data['work_orders'];

        //form validation.
        $this->form_validation->set_rules('wo_workstation', 'Estación de trabajo', 'required');
        $this->form_validation->set_rules('start_date', 'Hora de inicio de orden de trabajo', 'required');
       

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('planning/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            
            //insert the data into the database.
            $data = array(
                'wo_workstation' => $this->input->post('wo_workstation'),
                'notes' => $this->input->post('notes'),
                'start_date' => $this->input->post('start_date'),
                'odoo_workorder' => $this->input->post('oddo_workorder'),
                'odoo_operation'=> $this->input->post('odoo_operation'),
                'part_number' => $this->input->post('part_number'),
                'status' => 1,
                'planner_user' => $this->session->userdata('user_id')
            );    

            $work_order_id = $this->HourbyHour_model->create_hourbyhour_order($data);


            // Get the part numbers and quantities from the form
            $data = array();
            $hours = 24;
            for($i = 0; $i < $hours; $i++)
            {
                $single_number = $i < 10 ? "0".$i : $i;
                
                /*
                if($this->input->post("part_number") == "" || $this->input->post("part_number")=="")
                {
                    $data[$single_number."p"] = 0;
                }
                else
                {
                    $data[$single_number."p"] = $this->input->post("part_number");
                }                
                */

                $data[$single_number."wop"] = $this->input->post("work_order");
                $data[$single_number."h"] = $this->input->post("quantity_".$single_number);
                
                if($data[$single_number."h"]== "0" || $data[$single_number."h"]== "" || $data[$single_number."h"]== 0)
                {
                    $data[$single_number."p"] = "";
                }else{
                    $data[$single_number."p"] = $this->input->post("part_number");
                }
            }

            $data["h_wo_id"] = $work_order_id;
            $data['h_ws_id'] = $this->input->post('wo_workstation'); //added 9/14/2024.

            // Insert the data into the database
            $this->HourbyHour_model->create_hourbyhour_data($data);


            //finish previous work orders of the same workstation.
            //$this->HourbyHour_model->finish_previous_work_orders($work_order_id, $this->input->post('wo_workstation'));

            //send alert to the client.
            send_alert($work_order_id, date('H:i:s'));

            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo por hora creada correctamente para la estación de trabajo seleccionada.');
            //return redirect(base_url() . 'workorders/hourbyhour/update/'.$work_order_id);
            return redirect(base_url() . 'planning/create');
        }
    }





}