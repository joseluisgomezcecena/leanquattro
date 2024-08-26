<?php 

class Parts extends MY_Controller
{
    public function index()
    {
        $data['active'] = 'parts';
        $data['title'] = ucfirst("Partes"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('parts/index', $data);
        $this->load->view('_templates/footer');
    }


    public function create() {
        $data['active'] = 'parts';
        // Validate form data
        $this->form_validation->set_rules('part_number', 'Número de parte', 'required');
        $this->form_validation->set_rules('part_description', 'Descripción de parte', 'required');

        $data['title'] = ucfirst("Registro de partes"); // Capitalize the first letter

        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('parts/create', $data);
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

            if (!$this->upload->do_upload('part_image')) 
            {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                $this->load->view('_templates/header', $data);
                $this->load->view('_templates/topnav');
                $this->load->view('_templates/sidebar');
                $this->load->view('parts/create', $data);
                $this->load->view('_templates/footer');
                //return;
                $image = 'noimage.jpg';
            } 
            else 
            {
                $data = array('upload_data' => $this->upload->data());
                $image = $this->upload->data('file_name');
            }



            // Process registration data
            $data = array(
                'part_number' => $this->input->post('part_number'),
                'part_description' => $this->input->post('part_description'),
                'part_image' => $image
            );

            if ($this->Parts_model->create_part($data))
            {
                // Registration successful set flash message.
                $this->session->set_flashdata('success', 'Se ha registrado la parte '.$this->input->post('part_name').'.');
                redirect('parts');
            }
            else
            {
                // Registration failed set flash message
                $this->session->set_flashdata('error', 'No se ha podido registrar la parte.');
                redirect('parts/create');
            }
        }
    }


    public function update($id) {
        $data['active'] = 'parts';
        $data['title'] = ucfirst("Actualizar parte"); // Capitalize the first letter
        $data['part'] = $this->Parts_model->get_part($id);

        // Validate form data
        $this->form_validation->set_rules('part_number', 'Número de parte', 'required');
        $this->form_validation->set_rules('part_description', 'Descripción de parte', 'required');

        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('parts/update', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            //if image is not updated.
            if ($_FILES['part_image']['name'] == '') 
            {
                $image = 0;
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

                if (!$this->upload->do_upload('part_image')) 
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
                    'part_number' => $this->input->post('part_number'),
                    'part_description' => $this->input->post('part_description')
                );
            }
            else
            {
                $data = array(
                    'part_number' => $this->input->post('part_number'),
                    'part_description' => $this->input->post('part_description'),
                    'part_image' => $image
                );
            }

            if ($this->Parts_model->update_part($id, $data))
            {
                // Registration successful set flash message.
                $this->session->set_flashdata('success', 'Se ha actualizado la parte '.$this->input->post('part_name').'.');
                redirect(base_url() . 'parts');
            }
            else
            {
                // Registration failed set flash message
                $this->session->set_flashdata('error', 'No se ha podido actualizar la parte.');
                redirect(base_url() . 'parts/update/'.$id);
            }
        }
    }



    public function delete($id) {
        $data['active'] = 'parts';
        $data['title'] = ucfirst("Actualizar parte"); // Capitalize the first letter
        $data['part'] = $this->Parts_model->get_part($id);

       
        if (!isset($_POST['delete'])) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('parts/delete', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $this->Parts_model->delete_part($id);
            $this->session->set_flashdata('success', 'Se ha eliminado la parte '.$this->input->post('part_name').'.');
            redirect(base_url() . 'parts');
        }
    }




}