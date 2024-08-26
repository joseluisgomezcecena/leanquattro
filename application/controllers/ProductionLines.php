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

        $this->form_validation->set_rules('line_name', 'Nombre de línea de producción', 'required');
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
                'line_name' => $this->input->post('line_name'),
                'plant_id' => $this->input->post('plant_id'),
            );

            $this->ProductionLines_model->create_productionline($data);
            $this->session->set_flashdata('success', 'Línea de producción creada correctamente');
            redirect('productionlines');
        }
    }




    public function update($id)
    {
        $data['active'] = 'productionlines';
        $data['title'] = ucfirst("Actualizar línea de producción"); // Capitalize the first letter
        $data['line'] = $this->ProductionLines_model->get_productionline($id);
        $data['plants'] = $this->Plants_model->get_plants();

        $this->form_validation->set_rules('line_name', 'Nombre de línea de producción', 'required');
        $this->form_validation->set_rules('plant_id', 'Planta', 'required');
        

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('productionlines/update', $data);
            $this->load->view('_templates/footer');
        } 
        else 
        {

            $data = array(
                'line_name' => $this->input->post('line_name'),
                'plant_id' => $this->input->post('plant_id'),
            );

            $this->ProductionLines_model->update_productionline($id, $data);
            $this->session->set_flashdata('success', 'Línea de producción actualizada correctamente');
            redirect('productionlines');
        }
    }



    public function delete($id)
    {
        $data['active'] = 'productionlines';
        $data['title'] = ucfirst("Actualizar línea de producción"); // Capitalize the first letter
        $data['line'] = $this->ProductionLines_model->get_productionline($id);
        $data['plants'] = $this->Plants_model->get_plants();


        if (!isset($_POST['delete']))
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('productionlines/delete', $data);
            $this->load->view('_templates/footer');
        } 
        else 
        {

            $this->ProductionLines_model->delete_productionline($id);
            $this->session->set_flashdata('success', 'Línea de producción ha sido eliminada correctamente');
            redirect('productionlines');
        }
    }





    //ajax function to get production lines by plant id
    public function get_lines_by_plant_id()
    {
        $plant_id = $this->input->post('plant_id');
        $data = $this->ProductionLines_model->get_lines_by_plant($plant_id);
        echo json_encode($data);
    }


}