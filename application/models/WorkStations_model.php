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


    public function get_plant_id($id)
    {
        $this->db->select('ws_line_id');
        $query = $this->db->get_where('work_stations', array('work_station_id' => $id));
        

        $this->db->select('plant_id');
        $query = $this->db->get_where('production_lines', array('line_id' => $query->row_array()['ws_line_id']));
        return $query->row_array()['plant_id'];
    }


    public function get_workstation($id)
    {
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $query = $this->db->get_where('work_stations', array('work_station_id' => $id));
        return $query->row_array();
    }


    public function get_workstations_by_line($line_id)
    {
        $this->db->where('ws_line_id', $line_id);
        $query = $this->db->get('work_stations');
        return $query->result_array();
    }


    public function get_workstations_by_line_ids($line_ids)
    {
        $this->db->where_in('ws_line_id', $line_ids);
        $query = $this->db->get('work_stations');
        return $query->result_array();
    }

    


    public function create_workstation($data){
        $this->db->insert('work_stations', $data);
        return $this->db->insert_id();
    }


    public function update_workstation($data, $id){
        $this->db->where('work_station_id', $id);
        return $this->db->update('work_stations', $data);
    }

    
    public function delete_workstation($id){
        $this->db->where('work_station_id', $id);
        return $this->db->delete('work_stations');
    }


    public function get_planned_products(){
        $this->db->select('*');
        $this->db->from('work_order');
        $this->db->join('hour_by_hour', 'hour_by_hour.h_wo_id = work_order.wo_id', 'left');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_workstation', 'left');
        $this->db->where('work_order.start_date >=', date('Y-m-d'));
        return $this->db->get()->result_array();
    }


    /*

    public function get_workstations_with_workorders() {
        $this->db->select('work_stations.work_station_id, work_stations.work_station_name,work_stations.work_station_number, plants.plant_name, production_lines.line_name, SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h +hour_by_hour.05h +hour_by_hour.06h +hour_by_hour.07h +hour_by_hour.08h +hour_by_hour.09h +hour_by_hour.10h +hour_by_hour.11h +hour_by_hour.12h +hour_by_hour.13h +hour_by_hour.14h +hour_by_hour.15h +hour_by_hour.16h +hour_by_hour.17h +hour_by_hour.18h +hour_by_hour.19h +hour_by_hour.20h +hour_by_hour.21h +hour_by_hour.22h +hour_by_hour.23h ) as total_pieces');
        $this->db->from('work_stations');
        
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');

        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->group_by('work_stations.work_station_id, work_stations.work_station_name');

        $this->db->where('work_order.start_date >=', date('Y-m-d'));

        $query = $this->db->get();
        return $query->result_array();
    }


*/

    public function get_workstations_with_workorders() {
        $this->db->select('work_stations.work_station_id, work_stations.work_station_name, work_stations.work_station_number, plants.plant_name, production_lines.line_name, work_order.wo_id, SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h +hour_by_hour.05h +hour_by_hour.06h +hour_by_hour.07h +hour_by_hour.08h +hour_by_hour.09h +hour_by_hour.10h +hour_by_hour.11h +hour_by_hour.12h +hour_by_hour.13h +hour_by_hour.14h +hour_by_hour.15h +hour_by_hour.16h +hour_by_hour.17h +hour_by_hour.18h +hour_by_hour.19h +hour_by_hour.20h +hour_by_hour.21h +hour_by_hour.22h +hour_by_hour.23h ) as total_pieces');
        $this->db->from('work_stations');
        
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');

        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->group_by('work_stations.work_station_id, work_stations.work_station_name, work_order.wo_id');

        $this->db->where('work_order.start_date >=', date('Y-m-d'));

        $query = $this->db->get();
        return $query->result_array();
    }




    public function get_workstations_with_workorders_all() {
        $this->db->select('work_stations.work_station_id, work_stations.work_station_name, work_stations.work_station_number, plants.plant_name, production_lines.line_name, work_order.wo_id, work_order.status, work_order.start_date, SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h +hour_by_hour.05h +hour_by_hour.06h +hour_by_hour.07h +hour_by_hour.08h +hour_by_hour.09h +hour_by_hour.10h +hour_by_hour.11h +hour_by_hour.12h +hour_by_hour.13h +hour_by_hour.14h +hour_by_hour.15h +hour_by_hour.16h +hour_by_hour.17h +hour_by_hour.18h +hour_by_hour.19h +hour_by_hour.20h +hour_by_hour.21h +hour_by_hour.22h +hour_by_hour.23h ) as total_pieces');
        $this->db->from('work_stations');
        
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');

        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->group_by('work_stations.work_station_id, work_stations.work_station_name, work_order.wo_id');

        //$this->db->where('work_order.start_date >=', date('Y-m-d'));

        $query = $this->db->get();
        return $query->result_array();
    }



}