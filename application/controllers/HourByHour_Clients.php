<?php
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;


class HourByHour_Clients extends MY_Controller
{
    public function index()
    {

        $data['active'] = 'hourbyhour_clients';
        $data['title'] = 'Hora por Hora - Clientes';
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();
        #$data['lines'] = $this->ProductionLine->get_all();
        #$data['workstations'] = $this->Workstation->get_all();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('hourbyhour/client_index', $data);
        $this->load->view('_templates/footer');

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


        $this->form_validation->set_rules('work_order', 'Orden de trabajo', 'required');
       

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('hourbyhour/client_update', $data);
            $this->load->view('_templates/footer');
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

            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo actualizada correctamente');

            $time = date('H:i:s');
            $this->send($work_order_id, $time); // Corrected here

            // Redirect to the client index page
            redirect('hourbyhour_clients/update/'.$work_order_id);

        }
    }






    //realtime data with socket.io and elephant.io
    
    //Elephant IO real time data.
    public function send($alert_id, $time)
	{
		//$company_id = 77;
		//$alert_id = $this->input->post('alert_id');

		//$company_id = $this->session->userdata('data')['company_id'];

        $company_id = 77;

		$version = new Version2X('http://localhost:3001');
        //$version = new Version2X('http://192.168.1.65:3001');
		$client = new Client($version);
		$client->initialize();
		$client->emit(
			'newOrder',
			[
				'message' => 'Quattro Alert',
				'work_station_id' => $alert_id,
				'company_id' => $company_id,
                'time'=> date('H:i:s')
			]
		);
		$client->close();
	}

    

	public function receive()
	{
		$version = new Version2X('http://192.168.1.65:3001');
		$client = new Client($version);
		$client->initialize();
		$client->on('newOrder', function($data) {
			echo $data['message'];
		});
		$client->close();
	}






}