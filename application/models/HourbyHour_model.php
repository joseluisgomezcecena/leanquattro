<?php 

class HourbyHour_model extends CI_Model
{

    public function create_hourbyhour_order($data){
        $this->db->insert('work_order', $data);
        return $this->db->insert_id();
        #$last_query = $this->db->last_query();
        #print_r($last_query);
    }

    public function create_hourbyhour_data($data) {
        // Insert the data into the 'hourbyhour' table
        $query = $this->db->insert('hour_by_hour', $data);
        if ($query) {
            return true;
        } else {
             $last_query = $this->db->last_query();
             print_r($last_query);
        }
    }

    
    public function get_hourbyhour($work_order_id){
        $this->db->select('*');
        $this->db->from('hour_by_hour');
        $this->db->where('h_wo_id', $work_order_id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Remove unnecessary fields
        unset($result['h_id'], $result['h_wo_id'], $result['created_at'], $result['updated_at']);

        return $result;
    }

    
   
    /*
   public function get_hourbyhour($work_order_id){
        $this->db->select('*');
        $this->db->from('hour_by_hour');
        $this->db->where('h_wo_id', $work_order_id);
        $query = $this->db->get();
        
        #$last_query = $this->db->last_query();
        #print_r($last_query);

        return $query->result_array();
    }
    */

    public function get_hourbyhour_order($work_order_id){
        $this->db->select('*');
        $this->db->from('work_order');
        $this->db->where('work_order_id', $work_order_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_hourbyhour_order($data, $work_order_id){
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order', $data);
        return true;
    }

    public function update_hourbyhour_data($data, $work_order_id){
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('hour_by_hour', $data);
        return true;
    }

    public function delete_hourbyhour_order($work_order_id){
        $this->db->where('work_order_id', $work_order_id);
        $this->db->delete('work_order');
        return true;
    }

    public function delete_hourbyhour_data($work_order_id){
        $this->db->where('work_order_id', $work_order_id);
        $this->db->delete('hour_by_hour');
        return true;
   }


}