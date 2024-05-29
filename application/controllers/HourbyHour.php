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
        $this->form_validation->set_rules('wo_workstation', 'Estación de trabajo', 'required');
        $this->form_validation->set_rules('start_date', 'Hora de inicio de orden de trabajo', 'required');
       

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
            
            //insert the data into the database.
            $data = array(
                'wo_workstation' => $this->input->post('wo_workstation'),
                'notes' => $this->input->post('notes'),
                'start_date' => $this->input->post('start_date'),
                'status' => 1,
            );    

            $work_order_id = $this->HourbyHour_model->create_hourbyhour_order($data);



            // Get the part numbers and quantities from the form
            $data = array();
            $hours = 24;
            for($i = 0; $i < $hours; $i++)
            {
                $single_number = $i < 10 ? "0".$i : $i;
                $data[$single_number."p"] = $this->input->post("part_number_".$single_number);
                $data[$single_number."h"] = $this->input->post("quantity_".$single_number);
            }

            $data["h_wo_id"] = $work_order_id;

            // Insert the data into the database
            $this->HourbyHour_model->create_hourbyhour_data($data);

            // Set flash data
            $this->session->set_flashdata('success', 'Orden de trabajo por hora creada correctamente para la estación de trabajo seleccionada.');
            return redirect(base_url() . 'workorders/hourbyhour/update/'.$work_order_id);
        }
    }



    public function update($work_order_id)
    {
        $data['active'] = 'hourbyhour';
        $data['title'] = ucfirst("Ordenes de trabajo por hora"); // Capitalize the first letter
        $data['parts'] = $this->Parts_model->get_parts();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['hourbyhour'] = $this->HourbyHour_model->get_hourbyhour($work_order_id);
        $data['work_order'] = $this->HourbyHour_model->get_workorder($work_order_id);
        $data['work_order_id'] = $work_order_id;

        //form validation.
        $this->form_validation->set_rules('wo_workstation', 'Estación de trabajo', 'required');
        $this->form_validation->set_rules('start_date', 'Hora de inicio de orden de trabajo', 'required');
       

        //if form validation fails.
        if ($this->form_validation->run() == FALSE) 
        {
            // Display registration form with validation errors
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('hourbyhour/update', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            
            //insert the data into the database.
            $data = array(
                'wo_workstation' => $this->input->post('wo_workstation'),
                'notes' => $this->input->post('notes'),
                'start_date' => $this->input->post('start_date'),
                
            );    

            $update_work_order = $this->HourbyHour_model->update_hourbyhour_order($data);

            if($update_work_order){
                // Get the part numbers and quantities from the form
                $data = array();
                $hours = 24;
                for($i = 0; $i < $hours; $i++)
                {
                    $single_number = $i < 10 ? "0".$i : $i;
                    $data[$single_number."p"] = $this->input->post("part_number_".$single_number);
                    $data[$single_number."h"] = $this->input->post("quantity_".$single_number);
                }

                $data["h_wo_id"] = $work_order_id;

                // Insert the data into the database
                $this->HourbyHour_model->update_hourbyhour_data($data);
            }else{
                $this->session->set_flashdata('error', 'Error al actualizar la orden de trabajo por hora.');
                return redirect('hourbyhour/update/'.$work_order_id);
            }

        }
    }

}
