<?php

class Mobile extends CI_Controller
{
    public function index(){
        $this->load->view('mobile/index');
    }

    public function login(){
        $this->load->view('mobile/mobile_login');
    }
}