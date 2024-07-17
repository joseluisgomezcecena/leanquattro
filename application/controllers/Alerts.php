<?php 

class Alerts extends MY_Controller
{

    public function index(){
        $data['active'] = 'alerts';
        $data['title'] = ucfirst("Alertas de Soporte Andon"); // Capitalize the first letter
        $data['alerts'] = $this->Alert_model->get_alerts();
        

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('alerts/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create()
    {

        $data['active'] = 'alerts';
        $data['title'] = ucfirst("Alertas de Soporte Andon"); // Capitalize the first letter
        $data['alerts'] = $this->Alert_model->get_alerts();

        //form validation.
        $this->form_validation->set_rules('alert_name', 'Nombre de la alerta', 'required');
        $this->form_validation->set_rules('alert_description', 'Descripción de la alerta', 'required');
       

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $data['plants'] = $this->Plants_model->get_plants();
            $data['lines'] = $this->ProductionLines_model->get_productionlines();
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('alerts/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $alert_name = $this->input->post('alert_name');
            $alert_description = $this->input->post('alert_description');
            //$sub_alerts = $this->input->post('sub_alerts[]');
            $alert_counter = $this->input->post('alert_counter');


            $alert_data = array(
                'alert_name' => $alert_name,
                'alert_description' => $alert_description,
            );

            $alert_id = $this->Alert_model->create_alert($alert_data);

            //if alert created successfully create sub alerts.
            if($alert_id)
            {
                for($i = 1; $i <= $alert_counter; $i++)
                {
                    $sub_alert_name = $this->input->post('sub_alert_name_'.$i);
                    $sub_alert_description = $this->input->post('sub_alert_description_'.$i);

                    $sub_alert_data = array(
                        'alert_id' => $alert_id,
                        'sub_alert_name' => $sub_alert_name,
                        'sub_alert_description' => $sub_alert_description,
                    );

                    $this->Alert_model->create_sub_alert($sub_alert_data);
                }
            }



            $this->session->set_flashdata('success', 'Alerta creada correctamente');

        }
            
    }
}