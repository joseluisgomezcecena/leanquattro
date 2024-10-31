<?php 
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;


class Andons extends MY_Controller
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
        $data['active'] = 'andon';
        $data['title'] = ucfirst("Andon"); // Capitalize the first letter
        

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('andons/index', $data);
        $this->load->view('_templates/footer');
    }



    public function client()
    {
        $data['active'] = 'andon_client';
        $data['title'] = ucfirst("Reportes de Andon"); // Capitalize the first letter
        $data['alerts'] = $this->Alert_model->get_alerts();      

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('andons/client', $data);
        $this->load->view('_templates/footer');
    }



    public function single($id)
    {
        $data['active'] = 'andon_client';
        $data['title'] = ucfirst("Reporte de Andon"); // Capitalize the first letter
        $data['alert'] = $this->Alert_model->get_alert($id);
        $data['plants'] = $this->Plants_model->get_plants();   
        $data['subalerts'] = $this->Alert_model->get_sub_alerts($id);
        $data['parts'] = $this->Parts_model->get_parts();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('andons/single', $data);
        $this->load->view('_templates/footer');
    }



    public function support()
    {
        $data['active'] = 'andon_support';
        $data['title'] = ucfirst("Soporte de Andon"); // Capitalize the first letter
        $data['andons'] = $this->Andon_model->get_andons();      

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('andons/support', $data);
        $this->load->view('_templates/footer');
    }


    public function respond($event_id)
    {
        $data['active'] = 'andon_support';
        $data['title'] = ucfirst("Responder a Andon"); // Capitalize the first letter
        $data['andon'] = $this->Andon_model->get_andon($event_id);

        if ($data['andon']['service_status'] == 1) 
        {
            $this->session->set_flashdata('error', 'Esta alerta ya ha sido atendida, ahora se debe solucionar.');
            redirect(base_url('andons/support'));
        }

        if(!isset($_POST['respond']))
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('andons/respond', $data);
            $this->load->view('_templates/footer');
        }
        else
        {
            //get logged in user.
            $user = $this->session->userdata('user_id');
            $service_at = date('Y-m-d H:i:s');

            //wait for service time.
            $wait_time = calculateTime($data['andon']['created_at']);


            $data = array(
                'service_at' => $service_at,
                'service_user' => $user,
                'service_comment' => $this->input->post('service_comment'),
                'service_status' => 1,
                'wait_time' => $wait_time,
            );

            $this->Andon_model->respond_andon($event_id, $data);
            send_alert($event_id, date('H:i:s'));

            $this->session->set_flashdata('success', 'Se ha respondido a la alerta de Andon.');
            redirect(base_url('andons/support'));
        }
    }



    public function solve($event_id)
    {
        $data['active'] = 'andon_support';
        $data['title'] = ucfirst("Responder a Andon"); // Capitalize the first letter
        $data['andon'] = $this->Andon_model->get_andon($event_id);

        if ($data['andon']['service_status'] != 1) 
        {
            $this->session->set_flashdata('error', 'Esta alerta no ha sido atendida, primero debe atenderla.');
            redirect(base_url('andons/support'));
        }

        if(!isset($_POST['solve']))
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('andons/solve', $data);
            $this->load->view('_templates/footer');
        }
        else
        {
            //get logged in user.
            $user = $this->session->userdata('user_id');
            $closed_at = date('Y-m-d H:i:s');

            //offline time is the total time for the outage.
            $offline_time = calculateTime($data['andon']['created_at']);


            $data = array(
                'closed_at' => $service_at,
                'closed_user' => $user,
                'solution_comment' => $this->input->post('service_comment'),
                'service_status' => 2,
                'offline_time' => $wait_time,
            );

            $this->Andon_model->respond_andon($event_id, $data);
            send_alert($event_id, date('H:i:s'));

            $this->session->set_flashdata('success', 'Se ha solucionado la alerta Andon.');
            redirect(base_url('andons/support'));
        }
    }




    public function create($id)
    {
        //form validation.
     
        $this->form_validation->set_rules('plant_id', 'Planta', 'required');
        $this->form_validation->set_rules('line_id', 'Linea de producción', 'required');
        $this->form_validation->set_rules('work_station_id', 'Estación de trabajo', 'required');
        $this->form_validation->set_rules('subalert', 'Sub Alerta', 'required');
        #$this->form_validation->set_rules('part', 'Numero de parte', 'required');

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->single($id);
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
            
            print_r($andon_message_data);
            #echo "<br>";
            #print_r($team_members);
            

            //use elephant.io to send message to andon display.
            //$this->send($event_id, date('H:i:s'));
            //send_alert($event_id, date('H:i:s'));


            //send email to team members.
            //$this->send_andon_email();
            send_andon_email($recipients, $andon_message_data, 'assets/images/default_images/leanquattro_logo.png');


            $this->session->set_flashdata('success', 'Su reporte de Andon ha sido enviado correctamente.');
            redirect(base_url('andons/client'));
           
        }
     
    }



    public function send_andon_email()
    {
         // Load the email configuration
         $this->load->config('email', TRUE);
         $config = $this->config->item('email');
 
         // Make sure $config is not null
         if ($config === NULL) {
             log_message('error', 'Email configuration is not loaded correctly.');
             return; // Stop execution if configuration is not loaded
         }
 
         // Load the email library with the configuration
         $this->load->library('email', $config);
         
         // Set email data
         $this->email->from('jose.gomez@avantimanufacturing.com', 'Andon System');

         /*
         foreach ($team_members as $member) {
            $this->email->to($member['email']);
         }
        */
         
         $this->email->to('joseluisgomezcecegna@gmail.com'); // Set the recipient email address
         
         
         $this->email->subject('Nueva alerta de Andon');
         
         // Set the email message
         
         // Specify the absolute path to your image
         $image_path = FCPATH . 'assets/images/default_images/leanquattro_logo.png'; // Adjust FCPATH as needed
 
         // Attach the image for inline display
         $this->email->attach($image_path, 'inline', null, '', true);
         $htmlContent = 'Se ha creado una nueva alerta de Andon. Por favor revisa el sistema para más detalles.<br>';
         $htmlContent .= '<img src="' . $image_path . '" alt="Image">'; // Direct path usage might not work as expected for email clients
 
         $this->email->message($htmlContent);
 
 
         // Send the email
         if (!$this->email->send()) {
             // Email not sent
             log_message('error', 'Email not sent. ' . $this->email->print_debugger());
             // Debugging: Print the loaded configuration
         print_r($config);
         } else {
             // Email sent successfully
             $this->session->set_flashdata('success', 'Andon creado correctamente');
             echo 'Email sent successfully.';
         }
 
    }









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
}








