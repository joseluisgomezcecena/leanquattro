<?php 

class HourbyHour_model extends CI_Model
{

    public function create_hourbyhour_order($data){
        $query = $this->db->insert('work_order', $data);
        if ($query) {
            return $this->db->insert_id();
        } else {
            $last_query = $this->db->last_query();
            print_r($last_query);
        }
    }


    public function create_hourbyhour_data($data) {
        // Insert the data into the 'hourbyhour' table
        $query = $this->db->insert('hour_by_hour', $data);
        $last_query = $this->db->last_query();
        print_r($last_query);
        
        /*
        if ($query) {
            return true;
        } else {
             $last_query = $this->db->last_query();
             print_r($last_query);
        }
             */

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


    public function get_hourbyhour_all()
    {
        $this->db->select('*');
        $this->db->from('hour_by_hour');
        //$this->db->where('h_wo_id', $work_order_id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Remove unnecessary fields
        unset($result['h_id'], $result['h_wo_id'], $result['created_at'], $result['updated_at']);

        return $result;
    }



    public function get_workorder($work_order_id){
        $this->db->select('*');
        $this->db->from('work_order');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('operations', 'operations.operation_id = work_order.odoo_operation');
        $this->db->where('wo_id', $work_order_id);
        $query = $this->db->get();
        return $query->row_array();
    }


    

    public function get_workorder_tracking($work_order)
    {
        $this->db->select('*');
        $this->db->from('work_order');
        $this->db->join('work_stations', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->where('odoo_workorder', $work_order);
        $query = $this->db->get();
        return $query->row_array();
    }



    public function get_workorder_all(){
        $this->db->select('*');
        $this->db->from('work_order');
        //$this->db->where('wo_id', $work_order_id);
        $query = $this->db->get();
        return $query->row_array();
    }
   

    public function get_hourbyhour_order($work_order_id){
        $this->db->select('*');
        $this->db->from('work_order');
        $this->db->where('work_order_id', $work_order_id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function update_hourbyhour_order($data, $work_order_id){
        $this->db->where('wo_id', $work_order_id);
        $this->db->update('work_order', $data);
        return true;
    }


    public function end_hourbyhour_order($work_order_id, $order_number){
        $this->db->where('wo_id', $work_order_id);
        $this->db->where('odoo_workorder', $order_number);
        $this->db->update('work_order', ['status' => 3]);
        
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }

    }


    public function update_hourbyhour_data($data, $work_order_id){
        $this->db->where('h_wo_id', $work_order_id);
        $this->db->update('hour_by_hour', $data);
        return true;
    }


    public function cancel_hourbyhour_order($work_order_id)
    {
        $this->db->where('wo_id', $work_order_id);
        $this->db->update('work_order', ['status' => 5]);
        return true;
    }


    public function activate_hourbyhour_order($work_order_id)
    {
        $this->db->where('wo_id', $work_order_id);
        $this->db->update('work_order', ['status' => 1]);
        return true;
    }


    public function delete_hourbyhour_order($work_order_id)
    {
        $this->db->where('work_order_id', $wo_id);
        $this->db->delete('work_order');
        return true;
    }


   public function finish_previous_workorder($work_order_id, $work_station_id)
   {
        $this->db->where('wo_workstation', $work_station_id);
        $this->db->where('wo_id !=', $work_order_id);
        $this->db->where('status !=', 3);
        $this->db->update('work_order', ['status' => 3]);
        return true;
   }
   

   



    public function get_work_orders_screens() {
        $this->db->select('work_stations.work_station_name as workstation, work_order.part_number as part, SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h +hour_by_hour.05h +hour_by_hour.06h +hour_by_hour.07h +hour_by_hour.08h +hour_by_hour.09h +hour_by_hour.10h +hour_by_hour.11h +hour_by_hour.12h +hour_by_hour.13h +hour_by_hour.14h +hour_by_hour.15h +hour_by_hour.16h +hour_by_hour.17h +hour_by_hour.18h +hour_by_hour.19h +hour_by_hour.20h +hour_by_hour.21h +hour_by_hour.22h +hour_by_hour.23h ) as planned, SUM(hour_by_hour.00r + hour_by_hour.01r + hour_by_hour.02r + hour_by_hour.03r + hour_by_hour.04r +hour_by_hour.05r +hour_by_hour.06r +hour_by_hour.07r +hour_by_hour.08r +hour_by_hour.09r +hour_by_hour.10r +hour_by_hour.11r +hour_by_hour.12r +hour_by_hour.13r +hour_by_hour.14r +hour_by_hour.15r +hour_by_hour.16r +hour_by_hour.17r +hour_by_hour.18r +hour_by_hour.19r +hour_by_hour.20r +hour_by_hour.21r +hour_by_hour.22r +hour_by_hour.23r ) as done');
        $this->db->from('work_stations');
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->group_by('work_stations.work_station_name, work_order.part_number');
        $this->db->where('work_order.start_date >=', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result_array();
    }


   
    public function get_work_orders_by_screens($screen_id) 
    {
        $this->db->select('work_stations.work_station_name as workstation, work_stations.work_station_id, hour_by_hour.h_wo_id as workorder,
            SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h + hour_by_hour.05h + hour_by_hour.06h + hour_by_hour.07h + hour_by_hour.08h + hour_by_hour.09h + hour_by_hour.10h + hour_by_hour.11h + hour_by_hour.12h + hour_by_hour.13h + hour_by_hour.14h + hour_by_hour.15h + hour_by_hour.16h + hour_by_hour.17h + hour_by_hour.18h + hour_by_hour.19h + hour_by_hour.20h + hour_by_hour.21h + hour_by_hour.22h + hour_by_hour.23h) as planned, 
            SUM(hour_by_hour.00r + hour_by_hour.01r + hour_by_hour.02r + hour_by_hour.03r + hour_by_hour.04r + hour_by_hour.05r + hour_by_hour.06r + hour_by_hour.07r + hour_by_hour.08r + hour_by_hour.09r + hour_by_hour.10r + hour_by_hour.11r + hour_by_hour.12r + hour_by_hour.13r + hour_by_hour.14r + hour_by_hour.15r + hour_by_hour.16r + hour_by_hour.17r + hour_by_hour.18r + hour_by_hour.19r + hour_by_hour.20r + hour_by_hour.21r + hour_by_hour.22r + hour_by_hour.23r) as done');
        $this->db->from('work_stations');
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->join('screen_work_station', 'screen_work_station.screen_wss_id = work_stations.work_station_id');
        $this->db->join('screens', 'screens.screen_id = screen_work_station.screens_sc_id');
        $this->db->where('screens.screen_id', $screen_id);
        $this->db->where('work_order.start_date >=', date('Y-m-d'));
        $this->db->group_by('work_stations.work_station_name, work_stations.work_station_id, hour_by_hour.h_wo_id');
        $query = $this->db->get();
        
        
        
       return $query->result_array();
    }




    public function get_screen_data($screen_id) 
    {
        $this->db->select('
            work_stations.work_station_name as workstation, 
            work_stations.work_station_id, 
            hour_by_hour.h_wo_id as workorder,
            SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h + hour_by_hour.05h + hour_by_hour.06h + hour_by_hour.07h + hour_by_hour.08h + hour_by_hour.09h + hour_by_hour.10h + hour_by_hour.11h + hour_by_hour.12h + hour_by_hour.13h + hour_by_hour.14h + hour_by_hour.15h + hour_by_hour.16h + hour_by_hour.17h + hour_by_hour.18h + hour_by_hour.19h + hour_by_hour.20h + hour_by_hour.21h + hour_by_hour.22h + hour_by_hour.23h) as planned, 
            SUM(hour_by_hour.00r + hour_by_hour.01r + hour_by_hour.02r + hour_by_hour.03r + hour_by_hour.04r + hour_by_hour.05r + hour_by_hour.06r + hour_by_hour.07r + hour_by_hour.08r + hour_by_hour.09r + hour_by_hour.10r + hour_by_hour.11r + hour_by_hour.12r + hour_by_hour.13r + hour_by_hour.14r + hour_by_hour.15r + hour_by_hour.16r + hour_by_hour.17r + hour_by_hour.18r + hour_by_hour.19r + hour_by_hour.20r + hour_by_hour.21r + hour_by_hour.22r + hour_by_hour.23r) as done,
            COUNT(andon_events.id_andon) as andon_events_count,
            GROUP_CONCAT(andon_events.alert_id) as alert_ids,
            GROUP_CONCAT(andon_events.subalert_id) as subalert_ids,
            GROUP_CONCAT(andon_events.created_at) as andon_created_at
        ');
        $this->db->from('work_stations');
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation', 'left');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id', 'left');
        $this->db->join('screen_work_station', 'screen_work_station.screen_wss_id = work_stations.work_station_id');
        $this->db->join('screens', 'screens.screen_id = screen_work_station.screens_sc_id');
        $this->db->join('andon_events', 'andon_events.work_station_id = work_stations.work_station_id AND (andon_events.work_order = work_order.wo_id OR andon_events.work_order IS NULL)', 'left');
        $this->db->where('screens.screen_id', $screen_id);
        $this->db->where('work_order.start_date >=', date('Y-m-d'));
        $this->db->group_by('work_stations.work_station_name, work_stations.work_station_id, hour_by_hour.h_wo_id');
        $query = $this->db->get();
        
        return $query->result_array();
    }




    public function get_part_for_screen($workorder, $hour)
    {
        $this->db->select("{$hour}p");
        $this->db->from('hour_by_hour');
        $this->db->where('h_wo_id', $workorder);
        $query = $this->db->get();

        #$last_query = $this->db->last_query();
        //print_r($last_query);

        return $query->row_array();
    }

    
    public function get_part_by_hour_and_workstation($work_station_id)
    {
        $hour = date('H');
        if ($hour < 10) {
            $hour = '0' . $hour;
        }

        $this->db->select("{$hour}p");
        $this->db->from('hour_by_hour');
        $this->db->where('h_wo_id', $work_station_id);
        
        $query = $this->db->get();
        //$last_query = $this->db->last_query();
        //print_r($last_query);
        return $query->row_array();
    }


    public function get_parts_by_work_orders_ids($work_order_ids){
        $this->db->select('part_number');
        $this->db->from('work_order');
        $this->db->where_in('wo_id', $work_order_ids);
        $query = $this->db->get();
        return $query->result_array();
    }


    

    public function delete_hourbyhour_data($work_order_id){
        $this->db->where('work_order_id', $work_order_id);
        $this->db->delete('hour_by_hour');
        return true;
   }

   
   public function update_hourbyhour_client($data , $work_order_id)
   {
         $this->db->where('h_wo_id', $work_order_id);
         $this->db->update('hour_by_hour', $data);
         return true;
   }

}