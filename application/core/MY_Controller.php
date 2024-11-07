<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$CI = & get_instance();
		$CI->load->library('session');
		$CI->load->helper('url');
		if ( !$this->session->userdata('logged_in'))
		{
			redirect(base_url() . 'auth/login');
		}
		
		/*
		else
        {
            // Check the user's role
            $role = $this->session->userdata('operator');
            
            // Redirect to the operator page if the role is 1 and the current controller is not 'operator'
            if (($role == '1' || $role == 1) && $this->router->fetch_class() != 'operators') 
            {
                redirect(base_url() . 'operator');
            }
        }
		*/

	}
}