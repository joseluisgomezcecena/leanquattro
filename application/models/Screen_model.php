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


    public function get_workstations_by_screen_id($id)
    {
        $this->db->select('*');
        $this->db->join('work_stations', 'work_stations.work_station_id = screen_work_station.screen_wss_id');
        $this->db->from('screen_work_station');
        $this->db->where('screens_sc_id', $id);
        $query = $this->db->get();
        
        //$last_query = $this->db->last_query();
        //print_r($last_query);
        
        return $query->result_array();
    }


    public function get_plant_and_line_by_screen_id($id)
    {
        $this->db->select('plants.plant_id, production_lines.line_id');
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $this->db->from('work_stations');
        $this->db->join('screen_work_station', 'screen_work_station.screen_wss_id = work_stations.work_station_id');
        $this->db->where('screens_sc_id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }



    public function create_screen($data) {
        $this->db->insert('screens', $data);
        return $this->db->insert_id(); // Return the inserted screen ID
    }

    public function create_screen_workstation($data) {
        $this->db->insert('screen_work_station', $data);
    }

  
    

    public function update_screen($screen_id, $data) {
        $this->db->where('screen_id', $screen_id);
        $this->db->update('screens', $data);
    }

    
    public function delete_workstations_by_screen_id($screen_id) {
        $this->db->where('screens_sc_id', $screen_id);
        $this->db->delete('screen_work_station');
    }


    public function delete_workstation($work_station_id) {
        $this->db->where('screen_wss_id', $work_station_id);
        return $this->db->delete('screen_work_station');
    }
}