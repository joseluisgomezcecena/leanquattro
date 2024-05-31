<?php

class Chart_model extends CI_Model
{
   
    //fetch projects by month
    function fetch_data_monthly()
    {
        $this->db->select("MONTH(created_at) as month, count(project_id) as total");
        $this->db->from("projects");
        $this->db->group_by("MONTH(created_at)");
        $query = $this->db->get();
        
        $chart_data = [];
        foreach ($query->result() as $row) {
            $chart_data['label'][] = $row->month;
            $chart_data['data'][] = (int) $row->total;
        }

        return json_encode($chart_data);

    }

  
    function fetch_data_for_screens()
    {

        $this->db->select('work_stations.work_station_name as workstation, work_order.part_number as part, SUM(hour_by_hour.00h + hour_by_hour.01h + hour_by_hour.02h + hour_by_hour.03h + hour_by_hour.04h +hour_by_hour.05h +hour_by_hour.06h +hour_by_hour.07h +hour_by_hour.08h +hour_by_hour.09h +hour_by_hour.10h +hour_by_hour.11h +hour_by_hour.12h +hour_by_hour.13h +hour_by_hour.14h +hour_by_hour.15h +hour_by_hour.16h +hour_by_hour.17h +hour_by_hour.18h +hour_by_hour.19h +hour_by_hour.20h +hour_by_hour.21h +hour_by_hour.22h +hour_by_hour.23h ) as planned, SUM(hour_by_hour.00r + hour_by_hour.01r + hour_by_hour.02r + hour_by_hour.03r + hour_by_hour.04r +hour_by_hour.05r +hour_by_hour.06r +hour_by_hour.07r +hour_by_hour.08r +hour_by_hour.09r +hour_by_hour.10r +hour_by_hour.11r +hour_by_hour.12r +hour_by_hour.13r +hour_by_hour.14r +hour_by_hour.15r +hour_by_hour.16r +hour_by_hour.17r +hour_by_hour.18r +hour_by_hour.19r +hour_by_hour.20r +hour_by_hour.21r +hour_by_hour.22r +hour_by_hour.23r ) as done');
        $this->db->from('work_stations');
        $this->db->join('production_lines', 'production_lines.line_id = work_stations.ws_line_id', 'left');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id', 'left');
        $this->db->join('work_order', 'work_stations.work_station_id = work_order.wo_workstation');
        $this->db->join('hour_by_hour', 'work_order.wo_id = hour_by_hour.h_wo_id');
        $this->db->group_by('work_stations.work_station_name, work_order.part_number');
        $this->db->where('work_order.start_date >=', date('Y-m-d'));
        $query = $this->db->get();
        $result = $query->result_array();

         // Prepare the data for the chart
        $chart_data = [
            'labels' => [],
            'data_planned' => [],
            'data_done' => [],
        ];

        foreach ($result as $row) {
            $chart_data['labels'][] = $row['workstation'];
            $chart_data['data_planned'][] = $row['planned'];
            $chart_data['data_done'][] = $row['done'];
        }

        return $chart_data;

    }



    function fetch_data()
    {
        // Create an array with all the months
        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $chart_data = array_fill_keys($months, array('m' => 0, 't' => 0));

        // Fetch data for project type 'm'
        $this->db->select("MONTHNAME(MIN(created_at)) as month, count(project_id) as total");
        $this->db->from("projects");
        $this->db->where('project_type', 'm');
        $this->db->group_by("MONTH(created_at)");
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $chart_data[$row->month]['m'] = (int) $row->total;
        }

        // Fetch data for project type 't'
        $this->db->select("MONTHNAME(MIN(created_at)) as month, count(project_id) as total");
        $this->db->from("projects");
        $this->db->where('project_type', 't');
        $this->db->group_by("MONTH(created_at)");
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $chart_data[$row->month]['t'] = (int) $row->total;
        }

        // Format the data for the chart
        $chart_data = [
            'label' => array_keys($chart_data),
            'data_m' => array_column(array_values($chart_data), 'm'),
            'data_t' => array_column(array_values($chart_data), 't'),
        ];

        return json_encode($chart_data);
    }









    //info for panels.
    public function count_projects()
    {
        return $this->db->count_all('projects');
    }


    public function count_projects_by_type($type)
    {
        $this->db->where('project_type', $type);
        return $this->db->count_all_results('projects');
    }


    public function count_projects_by_status($status)
    {
        $this->db->where('project_status', $status);
        return $this->db->count_all_results('projects');
    }


    public function count_clients()
    {
        return $this->db->count_all('clients');
    }
    

}