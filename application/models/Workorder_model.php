<?php

class Workorder_model extends CI_Model
{
    public function get_active_workorders()
    {
        $this->db->select('work_order.*, work_stations.work_station_name, operations.operation_name');
        $this->db->from('work_order');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('operations', 'operations.operation_id = work_order.odoo_operation', 'left');
        $this->db->where('work_order.status', '2');
        $this->db->order_by('work_order.created_at', 'ASC');
        $query = $this->db->get();

        #$last_query = $this->db->last_query();
        //print_r($last_query);

        return $query->result_array();
    }


    public function get_registered_workorders()
    {
        $this->db->select('workorders.*, work_stations.work_station_name');
        $this->db->from('work_order');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_id');
        $this->db->where('work_order.status', '1');
        $this->db->order_by('workorders.created_at', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_done_workorders()
    {
        $this->db->select('workorders.*, work_stations.work_station_name');
        $this->db->from('work_order');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_id');
        $this->db->where('work_order.status', '3');
        $this->db->order_by('workorders.created_at', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_hourbyhour_data($work_order_id)
    {
        $this->db->select('hour_by_hour.*, work_stations.*, work_order.*,
            SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h + hour_by_hour.05h + hour_by_hour.06h + hour_by_hour.07h + hour_by_hour.08h + hour_by_hour.09h + hour_by_hour.10h + hour_by_hour.11h + hour_by_hour.12h + hour_by_hour.13h + hour_by_hour.14h + hour_by_hour.15h + hour_by_hour.16h + hour_by_hour.17h + hour_by_hour.18h + hour_by_hour.19h + hour_by_hour.20h + hour_by_hour.21h + hour_by_hour.22h + hour_by_hour.23h) as planned, 
            SUM(hour_by_hour.00r + hour_by_hour.01r + hour_by_hour.02r + hour_by_hour.03r + hour_by_hour.04r + hour_by_hour.05r + hour_by_hour.06r + hour_by_hour.07r + hour_by_hour.08r + hour_by_hour.09r + hour_by_hour.10r + hour_by_hour.11r + hour_by_hour.12r + hour_by_hour.13r + hour_by_hour.14r + hour_by_hour.15r + hour_by_hour.16r + hour_by_hour.17r + hour_by_hour.18r + hour_by_hour.19r + hour_by_hour.20r + hour_by_hour.21r + hour_by_hour.22r + hour_by_hour.23r) as done');
        $this->db->from('work_order');
        $this->db->join('hour_by_hour', 'hour_by_hour.h_wo_id = work_order.wo_id');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->where('work_order.wo_id', $work_order_id);
        $this->db->group_by('hour_by_hour.h_wo_id');
        $query = $this->db->get();
        return $query->row_array();
    }



}