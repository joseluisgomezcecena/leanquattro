<?php 

class Screens extends MY_Controller
{

    public function index()
    {

        $data['active'] = 'screens';
        $data['title'] = 'Pantallas';
        $data['plants'] = $this->Plants_model->get_plants();
        $data['workstations'] = $this->WorkStations_model->get_workstations_with_workorders();
        #$data['lines'] = $this->ProductionLine->get_all();
        #$data['workstations'] = $this->Workstation->get_all();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('screens/index', $data);
        $this->load->view('_templates/footer');

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


}