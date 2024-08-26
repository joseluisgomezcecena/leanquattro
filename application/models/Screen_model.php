<?php

class Screen_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_screens()
    {
        $query = $this->db->get('screens');
        return $query->result_array();
    }


    public function get_screen($id)
    {
        $query = $this->db->get_where('screens', array('screen_id' => $id));
        return $query->row_array();
    }


    public function create_screen($screen_data)
    {
        $this->db->insert('screens', $screen_data);
        return $this->db->insert_id();
    }


}