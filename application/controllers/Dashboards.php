<?php

class Dashboards extends MY_Controller
{

    public function index()
    {
        $data['active'] = 'dashboard';
        $data['title'] = 'Panel de Control.';

        //this controller
        $data['controller'] = $this;



        $data['active_workorders'] = $this->Workorder_model->get_active_workorders();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('dashboards/index');
        $this->load->view('_templates/footer');
    }



    public function get_part_number($workorder)
    {
        $hour = date('H');
        $workorder = $this->Workorder_model->get_hourbyhour_data($workorder);
        $part_number = $workorder['planned'] - $workorder['done'];
        echo $part_number;
    }



    public function get_hourbyhour_data($workorder)
    {
        $workorder = $this->Workorder_model->get_hourbyhour_data($workorder);
        //echo json_encode($workorder);
        return $workorder;
    }
    
    
    public function get_andon_event($work_station_id)
    {
        $andon = $this->Andon_model->get_andons_by_workstation($work_station_id);
        return $andon;
    }


}