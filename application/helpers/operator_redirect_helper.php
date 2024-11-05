<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('operator_redirect')) 
{
    //when user logs in as operator redirect to operator dashboard.
    function operator_redirect()
    {
        $CI = &get_instance();
        if($CI->session->userdata('operator') == '1' || $CI->session->userdata('operator') == 1)
        {
            redirect(base_url('operator'));
        }
    }
}
