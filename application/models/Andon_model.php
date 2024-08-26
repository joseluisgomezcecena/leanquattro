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

    public function get_andon_message($event){
        $this->db->select('a.*, b.*, d.*');
        $this->db->from('andon_events a');
        $this->db->join('alerts b', 'a.alert_id = b.alert_id');
        $this->db->join('alert_child d', 'b.alert_id = d.c_alert_id'); // Join with alert_child table
        $this->db->where('a.id_andon', $event);
        $query = $this->db->get();
        return $query->row_array();
    }

}