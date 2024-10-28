<?php

class Dashboards extends MY_Controller
{

    public function index()
    {
        $data['active'] = 'dashboard';
        $data['title'] = 'Panel de Control.';


        $get_active_workorders = $this->Workorders_model->get_active_workorders();

        $this->load->view('_templates/header', $data);
        $this->load->view('_templates/topnav');
        $this->load->view('_templates/sidebar');
        $this->load->view('dashboards/index');
        $this->load->view('_templates/footer');
    }


}