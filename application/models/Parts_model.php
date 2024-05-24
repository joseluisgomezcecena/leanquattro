<?php

class Parts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_parts()
    {
        $query = $this->db->get('part_numbers');
        return $query->result_array();
    }


    public function create_part($data)
    {
        return $this->db->insert('part_numbers', $data);
    }

}