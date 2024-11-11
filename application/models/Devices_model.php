<?php

class Devices_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_devices()
    {
        $query = $this->db->get('devices');
        return $query->result_array();
    }
}