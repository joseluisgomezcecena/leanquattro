<?php 

class HourbyHour_model extends CI_Model
{

    public function create_hourbyhour_order($data){
        $this->db->insert('workorder', $data);
        //return $this->db->insert_id();
        $last_query = $this->db->last_query();
        print_r($last_query);
    }

    public function create_hourbyhour_data($data) {
        // Insert the data into the 'hourbyhour' table
        $this->db->insert('hour_by_hour', $data);
        $last_query = $this->db->last_query();
        print_r($last_query);
    }



}