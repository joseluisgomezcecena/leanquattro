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


    public function update($plant_id)
    {
        $data['active'] = 'plants';
        $data['title'] = ucfirst("Actualizar planta"); // Capitalize the first letter
        $data['plant'] = $this->Plants_model->get_plant($plant_id);

        $this->form_validation->set_rules('plant_name', 'Nombre de planta', 'required');
        

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('plants/update', $data);
            $this->load->view('_templates/footer');
        } else {

            $data = array(
                'plant_name' => $this->input->post('plant_name'),
            );

            $this->Plants_model->update_plant($plant_id, $data);
            $this->session->set_flashdata('success', 'Planta actualizada correctamente.');
            redirect(base_url() .'plants');
        }
    }


    public function delete($plant_id)
    {
        $data['active'] = 'plants';
        $data['title'] = ucfirst("Eliminar planta"); // Capitalize the first letter
        $data['plant'] = $this->Plants_model->get_plant($plant_id);

        if (empty($data['plant'])) {
            show_404();
        }

        if (isset($_POST['delete'])){
            $this->Plants_model->delete_plant($plant_id);
            $this->session->set_flashdata('success', 'Planta eliminada correctamente');
            redirect('plants');
        }else{
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('plants/delete', $data);
            $this->load->view('_templates/footer');
        }
    }






}