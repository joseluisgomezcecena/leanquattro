<?php 

class Andons extends MY_Controller
{

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


    public function create($id)
    {
        //form validation.
     
        $this->form_validation->set_rules('alert_id', 'Alerta', 'required');
        $this->form_validation->set_rules('alert_description', 'Descripción de la alerta', 'required');
        $this->form_validation->set_rules('alert_date', 'Fecha de la alerta', 'required');
        $this->form_validation->set_rules('alert_time', 'Hora de la alerta', 'required');
        $this->form_validation->set_rules('alert_shift', 'Turno de la alerta', 'required');
        $this->form_validation->set_rules('alert_plant', 'Planta de la alerta', 'required');
        $this->form_validation->set_rules('alert_line', 'Línea de la alerta', 'required');
        $this->form_validation->set_rules('alert_station', 'Estación de trabajo de la alerta', 'required');
        $this->form_validation->set_rules('alert_subalert', 'Sub alerta', 'required');
        $this->form_validation->set_rules('alert_part', 'Número de parte', 'required');

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->single($id);
        } 
        else
        {
            $data = array(
                'alert_id' => $this->input->post('alert_id'),
                'alert_description' => $this->input->post('alert_description'),
                'alert_date' => $this->input->post('alert_date'),
                'alert_time' => $this->input->post('alert_time'),
                'alert_shift' => $this->input->post('alert_shift'),
                'alert_plant' => $this->input->post('alert_plant'),
                'alert_line' => $this->input->post('alert_line'),
                'alert_station' => $this->input->post('alert_station'),
                'alert_subalert' => $this->input->post('alert_subalert'),
                'alert_part' => $this->input->post('alert_part'),
            );

            $this->Andons_model->create_andon($data);


            //get team by alert.
            $teams = $this->Teams_model->get_team_by_alert($this->input->post('alert_id'));

            foreach ($teams as $team) {
                //get team members for each team.
                $team_members = $this->Teams_model->get_team_members($team['team_id']);
            }
            
            //send email to team members.
            $this->send_andon_email($team_members, $data);

            $this->session->set_flashdata('success', 'Andon creado correctamente');

        }
     
    }




    public function send_andon_email($team_members, $data)
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


}








