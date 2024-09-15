<?php 

class Screens extends MY_Controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Screen_model');
        $this->load->model('Plants_model');
        $this->load->model('WorkStations_model');
        $this->load->model('Lines_model'); // Load the Lines_model
    }

    public function index()
    {

        $data['active'] = 'screens';
        $data['title'] = 'Pantallas';
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();
        $data['screens'] = $this->Screen_model->get_screens();
        #$data['lines'] = $this->ProductionLine->get_all();
        #$data['workstations'] = $this->Workstation->get_all();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('screens/index', $data);
        $this->load->view('_templates/footer');

    }


    public function show($screen_id)
    {
        
        $data['active'] = 'screens';
        $data['title'] = ucfirst("Pantallas"); // Capitalize the first letter

        $data['controller'] = $this;

        $data['work_orders'] = $this->HourbyHour_model->get_work_orders_by_screens($screen_id);
            
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('screens/chart_screen', $data);
        $this->load->view('_templates/footer');

    }


    public function get_part_number($workorder)
    {
        $hour = date('H');
        if ($hour < 10) {
            $hour = '0' . $hour;
        }

        $part = $this->HourbyHour_model->get_part_for_screen($workorder, $hour);
        return $part[$hour . 'p'];
    }




    public function create()
    {
        $data['active'] = 'screens';
        $data['title'] = 'Pantallas';
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();


        //form validation.
        $this->form_validation->set_rules('screen_name', 'Nombre de la pantalla', 'required');
        $this->form_validation->set_rules('screen_description', 'Descripción de la pantalla', 'required');
        //$this->form_validation->set_rules('screen_workstation', 'Estación de trabajo', 'required');

        //if form validation fails.

        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('screens/create', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $screen_name = $this->input->post('screen_name');
            $screen_description = $this->input->post('screen_description');
            $screen_workstations = $this->input->post('screen_workstation');

            $screen_data = array(
                'screen_name' => $screen_name,
                'screen_description' => $screen_description,
            );

            // Save screen data and get the inserted screen ID
            $screen_id = $this->Screen_model->create_screen($screen_data);

            // Save associated workstations
            foreach ($screen_workstations as $workstation_id) {
                $screen_workstation_data = array(
                    'screen_wss_id' => $workstation_id,
                    'screens_sc_id' => $screen_id,
                );
                $this->Screen_model->create_screen_workstation($screen_workstation_data);
            }

            //set message.
            $this->session->set_flashdata('success', 'Pantalla creada exitosamente.');

            redirect(base_url() . 'screens');
        }
    }



    public function update($screen_id)
    {
        $data['active'] = 'screens';
        $data['title'] = 'Actualizar Pantalla';
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations();
        $data['screen'] = $this->Screen_model->get_screen($screen_id);
        $data['locations'] = $this->Screen_model->get_plant_and_line_by_screen_id($screen_id);
        $data['workstations_by_screen_id'] = $this->Screen_model->get_workstations_by_screen_id($screen_id);
        

        // Form validation
        $this->form_validation->set_rules('screen_name', 'Nombre de la pantalla', 'required');
        $this->form_validation->set_rules('screen_description', 'Descripción de la pantalla', 'required');

        if(!empty($this->input->post('screen_workstation'))) {
            $this->form_validation->set_rules('screen_workstation[]', 'Estación de trabajo', 'required');
        }

        //$this->form_validation->set_rules('screen_workstation[]', 'Estación de trabajo', 'required');


        // If form validation fails
        if ($this->form_validation->run() == FALSE) 
        {
            $this->load->view('_templates/header', $data);
            $this->load->view('_templates/topnav');
            $this->load->view('_templates/sidebar');
            $this->load->view('screens/update', $data);
            $this->load->view('_templates/footer');
        } 
        else
        {
            $screen_name = $this->input->post('screen_name');
            $screen_description = $this->input->post('screen_description');
            $screen_workstations = $this->input->post('screen_workstation');

            $screen_data = array(
                'screen_name' => $screen_name,
                'screen_description' => $screen_description,
                //'plant_id' => $this->input->post('screen_plant'), // Ensure plant_id is included
            );

            // Update screen data
            $this->Screen_model->update_screen($screen_id, $screen_data);

            // Delete existing workstations for the screen
            //$this->Screen_model->delete_workstations_by_screen_id($screen_id);

            // Save associated workstations
            foreach ($screen_workstations as $workstation_id) {
                $screen_workstation_data = array(
                    'screen_wss_id' => $workstation_id,
                    'screens_sc_id' => $screen_id,
                );
                $this->Screen_model->create_screen_workstation($screen_workstation_data);
            }

            //set message.
            $this->session->set_flashdata('success', 'Pantalla actualizada exitosamente.');

            redirect(base_url() . 'screens');
        }
    }
    


    public function test_screen()
    {
        $data['active'] = 'screens';
        $data['title'] = ucfirst("Pantallas"); // Capitalize the first letter
        
        
        $data['work_orders'] = $this->HourbyHour_model->get_work_orders_screens();
        
        foreach ($data['work_orders'] as &$work_order) {
            $data['part'] = $work_order['part_by_hour_and_workstation'] = $this->HourbyHour_model->get_part_by_hour_and_workstation($work_order['workstation']);
        }
        
        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('screens/test_screen', $data);
        $this->load->view('_templates/footer');

    }


    public function chart_screen()
    {
        $data['active'] = 'screens';
        $data['title'] = ucfirst("Pantallas"); // Capitalize the first letter
        
        $data['work_orders'] = $this->HourbyHour_model->get_work_orders_screens();
        
        foreach ($data['work_orders'] as &$work_order) {
            $data['part'] = $work_order['part_by_hour_and_workstation'] = $this->HourbyHour_model->get_part_by_hour_and_workstation($work_order['workstation']);
        }
        

        //$data['chart_data'] = $this->Chart_model->fetch_data();
        //$data['chart_data'] = json_encode($this->Chart_model->fetch_data_for_screens());


        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('screens/chart_screen', $data);
        $this->load->view('_templates/footer');

    }


    public function fetch_data_for_screens()
    {
        $data = $this->Chart_model->fetch_data_for_screens();
        echo json_encode($data);
    }


    public function delete_workstation()
    {
        $work_station_id = $this->input->post('work_station_id');

        if ($this->Screen_model->delete_workstation($work_station_id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }


}
