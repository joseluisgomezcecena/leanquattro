<?php

class HourbyHour extends MY_Controller
{
    public function index(){
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour();

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
        

        //form validation.
        $this->form_validation->set_rules('part_number', 'Número de parte', 'required');
        $this->form_validation->set_rules('wo_quantity', 'Cantidad a producir', 'required');
        $this->form_validation->set_rules('start_date', 'Hora de inicio de orden de trabajo', 'required');
        $this->form_validation->set_rules('end_date', 'Hora de finalización de orden de trabajo', 'required');


        
        

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
            //upload the image
            $config['upload_path'] = './uploads/products/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 20048;
            $config['max_width'] = 10024;
            $config['max_height'] = 7680;
            $config['file_name'] = 'product_' . time() . '_' . rand(1000, 9999);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('workorder_image')) 
            {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                $this->load->view('_templates/header', $data);
                $this->load->view('_templates/topnav');
                $this->load->view('_templates/sidebar');
                $this->load->view('hourbyhour/create', $data);
                $this->load->view('_templates/footer');
                //return;
                $image = 'noimage.jpg';
            } 
            else 
            {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            }

            //insert the data into the database.
            $data = array(
                'workorder_number' => $this->input->post('workorder_number'),
                'workorder_description' => $this->input->post('workorder_description'),
                'workorder_date' => $this->input->post('workorder_date'),
                'workorder_start_time' => $this->input->post('workorder_start_time'),
                'workorder_end_time' => $this->input->post('workorder_end_time'),
                'workorder_status' => $this->input->post('workorder_status'),
            );    

        }


    }


}