<?php

class Alert_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_alerts()
    {
        $query = $this->db->get('alerts');
        return $query->result_array();
    }

    

}