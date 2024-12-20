<?php

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class HourbyHour extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('integration_helper'); // Load the integration helper
        $this->load->helper('elephant_io_helper'); // Load the elephant_io_helper
    }


    public function menu(){
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('hourbyhour/menu', $data);
        $this->load->view('_templates/footer');
    }



    public function index(){
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['plants'] = $this->Plants_model->get_plants();
        //$data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders_all();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('hourbyhour/index', $data);
        $this->load->view('_templates/footer');
    }


    
    public function create(){
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
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
            $this->load->view('hourbyhour/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            
            //insert the data into the database.
            $data = array(
                'wo_workstation' => $this->input->post('wo_workstation'),
                'notes' => $this->input->post('notes'),
                'start_date' => $this->input->post('start_date'),
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
                $data[$single_number."p"] = $this->input->post("part_number_".$single_number);
                $data[$single_number."h"] = $this->input->post("quantity_".$single_number);
                $data[$single_number."wop"] = $this->input->post("workorder_".$single_number);
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
            return redirect(base_url() . 'workorders/hourbyhour/');
        }
    }



    public function update($work_order_id)
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

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
            $this->load->view('hourbyhour/update', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            //insert the data into the database.
            $data = array(
                'wo_workstation' => $this->input->post('wo_workstation'),
                'notes' => $this->input->post('notes'),
                'start_date' => $this->input->post('start_date'),
                
            );    

            $update_work_order = $this->HourbyHour_model->update_hourbyhour_order($data, $work_order_id);

            if($update_work_order){
                // Get the part numbers and quantities from the form
                $data = array();
                $hours = 24;
                for($i = 0; $i < $hours; $i++)
                {
                    $single_number = $i < 10 ? "0".$i : $i;
                    $data[$single_number."p"] = $this->input->post("part_number_".$single_number);
                    $data[$single_number."h"] = $this->input->post("quantity_".$single_number);
                    $data[$single_number."wop"] = $this->input->post("workorder_".$single_number);

                }

                $data["h_wo_id"] = $work_order_id;

                // Insert the data into the database
                $this->HourbyHour_model->update_hourbyhour_data($data, $work_order_id);
                send_alert($work_order_id, date('H:i:s'));
                return redirect('hourbyhour/update/'.$work_order_id);
            }
            else
            {
                $this->session->set_flashdata('error', 'Error al actualizar la orden de trabajo por hora.');
                return redirect('hourbyhour/update/'.$work_order_id);
            }

        }
    }


    public function get_product_name()
    {
        $work_order_name = $this->input->post('work_order_name');

        // Fetch Odoo work orders using the helper function
        $odoo_data = fetch_odoo_workorders();
        $work_orders = $odoo_data['work_orders'];

        // Find the work order with the given name
        $product_name = '';
        foreach ($work_orders as $order) {
            if ($order['name'] == $work_order_name) {
                $product_name = $order['product_name'];
                break;
            }
        }

        // Return the product name as JSON
        echo json_encode(['product_name' => $product_name]);
    }



    public function cancel($work_order_id)
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

        

        //if form validation fails.
        if (!isset($_POST['cancel'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('hourbyhour/cancel', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $cancel_work_order = $this->HourbyHour_model->cancel_hourbyhour_order($work_order_id);
            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo por hora cancelada correctamente.');
            //redirect to index page.
            return redirect(base_url() . 'workorders/hourbyhour/');

        }
    }



    public function activate($work_order_id)
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

        

        //if form validation fails.
        if (!isset($_POST['activate'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('hourbyhour/activate', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $cancel_work_order = $this->HourbyHour_model->activate_hourbyhour_order($work_order_id);
            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo por hora activada correctamente.');
            //redirect to index page.
            return redirect(base_url() . 'workorders/hourbyhour/');

        }
    }




    public function delete($work_order_id)
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

        

        //if form validation fails.
        if (!isset($_POST['delete'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('hourbyhour/delete', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $cancel_work_order = $this->HourbyHour_model->delete_hourbyhour_order($work_order_id);
            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo por hora eliminada correctamente.');
            //redirect to index page.
            return redirect(base_url() . 'workorders/hourbyhour/');

        }
    }






    //Elephant IO real time data.
    public function send($alert_id)
	{
		//$company_id = 77;
		//$alert_id = $this->input->post('alert_id');

		$company_id = $this->session->userdata('data')['company_id'];

		$version = new Version2X('http://localhost:3001');
		$client = new Client($version);
		$client->initialize();
		$client->emit(
			'newOrder',
			[
				'message' => 'Quattro Alert',
				'work_station_id' => $alert_id,
				//'company_id' => $company_id
			]
		);
		$client->close();
	}

    

	public function receive()
	{
		$version = new Version2X('http://localhost:3001');
		$client = new Client($version);
		$client->initialize();
		$client->on('newOrder', function($data) {
			echo $data['message'];
		});
		$client->close();
	}




}
