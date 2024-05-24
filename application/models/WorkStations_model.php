<?php 

class WorkStations_model extends CI_Model
{

    public function get_workstations()
    {
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $query = $this->db->get('work_stations');
        return $query->result_array();
    }


    public function get_workstation($id)
    {
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $query = $this->db->get_where('work_stations', array('id' => $id));
        return $query->row_array();
    }


    public function create_workstation($data){
        $this->db->insert('work_stations', $data);
        return $this->db->insert_id();
    }


    public function update_workstation($data, $id){
        $this->db->where('id', $id);
        return $this->db->update('work_stations', $data);
    }

    
    public function delete_workstation($id){
        $this->db->where('id', $id);
        return $this->db->delete('work_stations');
    }

}