<?php

class Andon_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function create_andon($data)
    {
        $this->db->insert('andon_events', $data);
        return $this->db->insert_id();
    }

}