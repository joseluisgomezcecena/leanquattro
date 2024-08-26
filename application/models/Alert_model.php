<?php

class Alert_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_alerts()
    {
        $query = $this->db->get('alerts');
        return $query->result_array();
    }


    public function get_alert($id)
    {
        $query = $this->db->get_where('alerts', array('alert_id' => $id));
        return $query->row_array();
    }


    public function create_alert($alert_data)
    {
        $this->db->insert('alerts', $alert_data);
        return $this->db->insert_id();
    }


    public function update_alert($alert_id, $alert_data)
    {
        $this->db->where('alert_id', $alert_id);
        return $this->db->update('alerts', $alert_data);
    }


    public function delete_alert($id)
    {
        $this->db->where('alert_id', $id);
        return $this->db->delete('alerts');
    }


    public function get_sub_alerts($alert_id)
    {
        $query = $this->db->get_where('alert_child', array('c_alert_id' => $alert_id));
        return $query->result_array();
    }


    public function create_sub_alert($sub_alert_data)
    {
        //sub_alerts
        $this->db->insert('alert_child', $sub_alert_data);
        return $this->db->insert_id();
    }


    public function update_sub_alert($sub_alert_data)
    {
        $this->db->where('c_alert_id', $sub_alert_data['c_alert_id']);
        return $this->db->update('alert_child', $sub_alert_data);
    }


    public function delete_sub_alert($id)
    {
        $this->db->where('child_id', $id);
        return $this->db->delete('alert_child');
    }
    

}