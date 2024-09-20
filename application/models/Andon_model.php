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


    
    public function get_andons_by_screen($screen_id)
    {
        $this->db->select('andon_events.*, alerts.alert_name, alerts.alert_description, alert_child.child_alert_name, alert_child.child_alert_description');
        $this->db->from('andon_events');
        $this->db->join('alerts', 'andon_events.alert_id = alerts.alert_id', 'left');
        $this->db->join('alert_child', 'andon_events.subalert_id = alert_child.child_id', 'left');
        $this->db->join('screen_work_station', 'andon_events.work_station_id = screen_work_station.screen_wss_id', 'left');
        $this->db->join('screens', 'screen_work_station.screens_sc_id = screens.screen_id', 'left');
        $this->db->where('screens.screen_id', $screen_id);

        $query = $this->db->get();


        return $query->result_array();
    }


    public function get_andons_by_workstation($work_station_id)
    {
        $this->db->select('andon_events.*, alerts.alert_name, alerts.alert_description, alert_child.child_alert_name, alert_child.child_alert_description');
        $this->db->from('andon_events');
        $this->db->join('alerts', 'andon_events.alert_id = alerts.alert_id', 'left');
        $this->db->join('alert_child', 'andon_events.subalert_id = alert_child.child_id', 'left');
        $this->db->where('andon_events.work_station_id', $work_station_id);



        $query = $this->db->get();
        
        #$last_query = $this->db->last_query();
        //print_r($last_query);
        
        return $query->result_array();

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