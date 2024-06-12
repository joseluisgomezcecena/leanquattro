<?php

class Plants_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_plants()
    {
        $query = $this->db->get('plants');
        return $query->result_array();
    }

    public function create_plant($data)
    {
        $this->db->insert('plants', $data);
    }

    public function get_plant($id)
    {
        $query = $this->db->get_where('plants', array('plant_id' => $id));
        return $query->row_array();
    }

    public function update_plant($id, $data)
    {
        $this->db->where('plant_id', $id);
        $this->db->update('plants', $data);
    }

    public function delete_plant($id)
    {
        $this->db->where('plant_id', $id);
        $this->db->delete('plants');
    }


}