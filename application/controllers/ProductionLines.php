<?php

class ProductionLines extends MY_Controller
{

    public function index()
    {
        $data['active'] = 'productionlines';
        $data['title'] = ucfirst("Líneas de producción"); // Capitalize the first letter
        $data['lines'] = $this->ProductionLines_model->get_productionlines();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('productionlines/index', $data);
        $this->load->view('_templates/footer');
    }



    public function create()
    {
        $data['active'] = 'productionlines';
        $data['title'] = ucfirst("Registro de líneas de producción"); // Capitalize the first letter
        $data['plants'] = $this->Plants_model->get_plants();

        $this->form_validation->set_rules('productionline_name', 'Nombre de línea de producción', 'required');
        $this->form_validation->set_rules('plant_id', 'Planta', 'required');
        

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('productionlines/create', $data);
            $this->load->view('_templates/footer');
        } 
        else 
        {

            $data = array(
                'productionline_name' => $this->input->post('productionline_name'),
                'plant_id' => $this->input->post('plant_id'),
            );

            $this->ProductionLines_model->create_productionline($data);
            $this->session->set_flashdata('success', 'Línea de producción creada correctamente');
            redirect('productionlines');
        }
    }



}