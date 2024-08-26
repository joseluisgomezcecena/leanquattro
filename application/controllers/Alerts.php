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

        //dynamically validate sub alerts.
        if($this->input->post('alert_counter') > 0)
        {
            for($i = 1; $i <= $this->input->post('alert_counter'); $i++)
            {
                $this->form_validation->set_rules('input_'.$i, 'Nombre de la sub alerta', 'required');
            }
        }
       

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
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
                    $sub_alert_name = $this->input->post('input_'.$i);
                   

                    $sub_alert_data = array(
                        'c_alert_id' => $alert_id,
                        'child_alert_name' => $sub_alert_name,
                    );

                    $this->Alert_model->create_sub_alert($sub_alert_data);
                }
            }

            $this->session->set_flashdata('success', 'Alerta creada correctamente');
            redirect(base_url('alerts/create'));
        }    
    }



    public function update($alert_id)
    {
        $data['active'] = 'alerts';
        $data['title'] = ucfirst("Alertas de Soporte Andon"); // Capitalize the first letter
        $data['alert'] = $this->Alert_model->get_alert($alert_id);
        $data['sub_alerts'] = $this->Alert_model->get_sub_alerts($alert_id);

        // Form validation
        $this->form_validation->set_rules('alert_name', 'Nombre de la alerta', 'required');
        $this->form_validation->set_rules('alert_description', 'Descripción de la alerta', 'required');

        // Dynamically validate sub alerts
        if ($this->input->post('alert_counter') > 0) {
            for ($i = 1; $i <= $this->input->post('alert_counter'); $i++) {
                $this->form_validation->set_rules('input_' . $i, 'Nombre de la sub alerta', 'required');
            }
        }

        // If form validation fails
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('alerts/update', $data);
            $this->load->view('_templates/footer');
        } else {
            $alert_name = $this->input->post('alert_name');
            $alert_description = $this->input->post('alert_description');
            $alert_counter = $this->input->post('alert_counter');

            $alert_data = array(
                'alert_name' => $alert_name,
                'alert_description' => $alert_description,
            );

            // Update the main alert
            $this->Alert_model->update_alert($alert_id, $alert_data);

            // Update sub alerts
            $existing_sub_alerts = $this->Alert_model->get_sub_alerts($alert_id);
            $existing_sub_alert_ids = array_column($existing_sub_alerts, 'id');

            for ($i = 1; $i <= $alert_counter; $i++) {
                $sub_alert_name = $this->input->post('input_' . $i);
                $sub_alert_id = $this->input->post('sub_alert_id_' . $i);

                $sub_alert_data = array(
                    'c_alert_id' => $alert_id,
                    'child_alert_name' => $sub_alert_name,
                );

                if (in_array($sub_alert_id, $existing_sub_alert_ids)) {
                    // Update existing sub alert
                    $this->Alert_model->update_sub_alert($sub_alert_id, $sub_alert_data);
                } else {
                    // Create new sub alert
                    $this->Alert_model->create_sub_alert($sub_alert_data);
                }
            }

            $this->session->set_flashdata('success', 'Alerta actualizada correctamente');
            redirect(base_url('alerts'));
        }
    }



    public function delete_subalert($sub_alert_id)
    {

        if(isset($_POST['delete_subalert']))
        {
            $alert_id = $this->input->post('c_alert_id');
            $this->Alert_model->delete_sub_alert($sub_alert_id);
            $this->session->set_flashdata('success', 'Sub alerta eliminada correctamente!!!');
            redirect(base_url('alerts/update/' . $alert_id));
        }
    }


 
    
    public function delete($alert_id)
    {
        $data['active'] = 'alerts';
        $data['title'] = ucfirst("Alertas de Soporte Andon"); // Capitalize the first letter
        $data['alert'] = $this->Alert_model->get_alert($alert_id);
        $data['sub_alerts'] = $this->Alert_model->get_sub_alerts($alert_id);

        // Form validation
        $this->form_validation->set_rules('alert_name', 'Nombre de la alerta', 'required');
        $this->form_validation->set_rules('alert_description', 'Descripción de la alerta', 'required');

        // Dynamically validate sub alerts
        if ($this->input->post('alert_counter') > 0) {
            for ($i = 1; $i <= $this->input->post('alert_counter'); $i++) {
                $this->form_validation->set_rules('input_' . $i, 'Nombre de la sub alerta', 'required');
            }
        }

        // If form validation fails
        if (!isset($_POST['delete_alert'])) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('alerts/update', $data);
            $this->load->view('_templates/footer');
        } else {
            $this->Alert_model->delete_alert_complete($alert_id);
            $this->session->set_flashdata('success', 'Alerta eliminada correctamente.');
            redirect(base_url('alerts'));
        }
    }




}