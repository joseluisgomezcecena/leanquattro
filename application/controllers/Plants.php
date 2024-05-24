<?php

class Plants extends MY_Controller
{

    public function index()
    {
        $data['active'] = 'plants';
        $data['title'] = ucfirst("Plantas"); // Capitalize the first letter
        $data['plants'] = $this->Plants_model->get_plants();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('plants/index', $data);
        $this->load->view('_templates/footer');
    }


    public function create()
    {
        $data['active'] = 'plants';
        $data['title'] = ucfirst("Registro de plantas"); // Capitalize the first letter

        $this->form_validation->set_rules('plant_name', 'Nombre de planta', 'required');
        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('plants/create', $data);
            $this->load->view('_templates/footer');
        } else {


            $data = array(
                'plant_name' => $this->input->post('plant_name'),
            );


            $this->Plants_model->create_plant($data);
            $this->session->set_flashdata('success', 'Planta creada correctamente');
            redirect('plants');
        }
    }







}