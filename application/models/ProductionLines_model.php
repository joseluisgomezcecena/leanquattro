<?php

class ProductionLines_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_productionlines()
    {
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $query = $this->db->get('production_lines');
        return $query->result_array();
    }



    public function get_lines_by_plant($plant_id)
    {
        $query = $this->db->get_where('production_lines', array('plant_id' => $plant_id));
        return $query->result_array();
    }



    public function create_productionline($data)
    {
        $this->db->insert('production_lines', $data);
    }


    public function get_productionline($id)
    {
        $query = $this->db->get_where('production_lines', array('line_id' => $id));
        return $query->row_array();
    }


    public function update_productionline($id, $data)
    {
        $this->db->where('line_id', $id);
        $this->db->update('production_lines', $data);
    }

    
    public function delete_productionline($id)
    {
        $this->db->where('line_id', $id);
        $this->db->delete('production_lines');
    }
}