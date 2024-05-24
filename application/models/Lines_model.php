<?php 

class Lines_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_lines()
    {
        $query = $this->db->get('production_lines');
        return $query->result_array();
    }

    public function create_line($data)
    {
        $this->db->insert('production_lines', $data);
    }

    public function get_line($id)
    {
        $query = $this->db->get_where('production_lines', array('id' => $id));
        return $query->row_array();
    }

    public function update_line($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('production_lines', $data);
    }

    public function delete_line($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('production_lines');
    }

}