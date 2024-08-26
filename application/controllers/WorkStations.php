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
        $data['plants'] = $this->Plants_model->get_plants();

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
                'ws_line_id' => $this->input->post('line_id'),
                'work_station_name' => $this->input->post('work_station_name'),
                'work_station_number' => $this->input->post('work_station_number'),
                'work_station_description' => $this->input->post('work_station_description'),
                'work_station_image' => $image
            );

            $this->WorkStations_model->create_workstation($data);
            
            
            $this->session->set_flashdata('success', 'Estación de trabajo creada exitosamente.');
            redirect(base_url() . 'workstations');
        }
    }





    public function update($id)
    {
        $data['active'] = 'workstations';
        $data['title'] = ucfirst("Estaciones de trabajo"); // Capitalize the first letter
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['plants'] = $this->Plants_model->get_plants();
        $data['work_station'] = $this->WorkStations_model->get_workstation($id);
        $data['plant_id'] = $this->WorkStations_model->get_plant_id($id);

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
            $this->load->view('workstations/update', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {

            //if image is not updated.
            if ($_FILES['work_station_image']['name'] == '') 
            {
                $image = 0;
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
            }

            if ($image == 0) 
            {
                $data = array(
                    'ws_line_id' => $this->input->post('line_id'),
                    'work_station_name' => $this->input->post('work_station_name'),
                    'work_station_number' => $this->input->post('work_station_number'),
                    'work_station_description' => $this->input->post('work_station_description'),
                );
            }
            else{
                $data = array(
                    'ws_line_id' => $this->input->post('line_id'),
                    'work_station_name' => $this->input->post('work_station_name'),
                    'work_station_number' => $this->input->post('work_station_number'),
                    'work_station_description' => $this->input->post('work_station_description'),
                    'work_station_image' => $image
                );
            }
                
            

            $this->WorkStations_model->update_workstation($data, $id);

            $this->session->set_flashdata('success', 'Estación de trabajo actualizada exitosamente.');
            redirect(base_url() . 'workstations');
        }
    }



    public function delete($id)
    {
        $data['active'] = 'workstations';
        $data['title'] = ucfirst("Estaciones de trabajo"); // Capitalize the first letter
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['plants'] = $this->Plants_model->get_plants();
        $data['work_station'] = $this->WorkStations_model->get_workstation($id);

        if (!isset($_POST['delete'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('workstations/delete', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $this->WorkStations_model->delete_workstation($id);
            $this->session->set_flashdata('success', 'Estación de trabajo eliminada exitosamente.');
            redirect(base_url() . 'workstations');
        }

    }






    //ajax function to get workstations by line id.
    public function get_workstations_by_line_id()
    {
        $line_id = $this->input->post('line_id');
        $data = $this->WorkStations_model->get_workstations_by_line($line_id);
        echo json_encode($data);
    }


}