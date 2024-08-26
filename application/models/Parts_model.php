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


    public function get_part($id)
    {
        $query = $this->db->get_where('part_numbers', array('pn_id' => $id));
        return $query->row_array();
    }


    public function create_part($data)
    {
        return $this->db->insert('part_numbers', $data);
    }


    public function update_part($id, $data)
    {
        $this->db->where('pn_id', $id);
        return $this->db->update('part_numbers', $data);
    }


    public function delete_part($id)
    {
        $this->db->where('pn_id', $id);
        return $this->db->delete('part_numbers');
    }

}