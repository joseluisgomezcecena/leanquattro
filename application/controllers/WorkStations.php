<?php 

class WorkStations extends MY_Controller
{
    public function index(){
        $data['active'] = 'workstations';
        $data['title'] = ucfirst("Estaciones de trabajo"); // Capitalize the first letter
        $data['work_stations'] = $this->WorkStations_model->get_workstations();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('workstations/index', $data);
        $this->load->view('_templates/footer');
    }


    public function create()
    {

        $data['active'] = 'workstations';
        $data['title'] = ucfirst("Estaciones de trabajo"); // Capitalize the first letter
        $data['workstations'] = $this->WorkStations_model->get_workstations();

        //form validation.
        $this->form_validation->set_rules('work_station_name', 'Work Station Name', 'required');
        $this->form_validation->set_rules('work_station_number', 'Work Station Number', 'required');
        

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('workstations/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            //upload the image
            $config['upload_path'] = './uploads/workstations/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 20048;
            $config['max_width'] = 10024;
            $config['max_height'] = 7680;
            $config['file_name'] = 'workstation_' . time() . '_' . rand(1000, 9999);
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('work_station_image')) 
            {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                $image = 'noimage.jpg';
            } 
            else 
            {
                $data = array('upload_data' => $this->upload->data());
                $image = $this->upload->data('file_name');
            }
                
            $data = array(
                'work_station_name' => $this->input->post('work_station_name'),
                'work_station_number' => $this->input->post('work_station_number'),
                'work_station_description' => $this->input->post('work_station_description'),
                'work_station_image' => $image
            );

            $this->WorkStations_model->create_workstation($data);
            
            
            $this->session->set_flashdata('success', 'Work Station created successfully');
            redirect('workstations');
        }
    }



}