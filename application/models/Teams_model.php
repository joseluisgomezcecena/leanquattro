<?php

class Teams_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_teams()
    {
        $query = $this->db->get('teams');
        return $query->result_array();
    }


    public function get_team($id)
    {
        $query = $this->db->get_where('teams', array('team_id' => $id));
        return $query->row_array();
    }


    public function create_team($data)
    {
        $this->db->insert('teams', $data);
        return $this->db->insert_id();
    }


    public function create_team_leader($data)
    {
        $this->db->insert('team_user', $data);
        return $this->db->insert_id();
    }


    public function create_team_members($data)
    {
        // Initialize an array to hold unique team members.
        $unique_team_members = array();

        // Search for repeated team members in the data array and remove duplicates.
        foreach ($data as $member) {
            // Generate a unique key to identify duplicate members.
            $key = $member['tu_team_id'] . '-' . $member['tu_user_id'];
            if (!array_key_exists($key, $unique_team_members)) {
                $unique_team_members[$key] = $member;
            }
        }

        // Use array_values to reset the keys of the array, as insert_batch expects a 0-indexed array.
        $unique_team_members = array_values($unique_team_members);

        // Insert the unique team members into the database.
        if (!empty($unique_team_members)) {
            $this->db->insert_batch('team_user', $unique_team_members);
        }
    }


    
    public function create_team_alerts($data)
    {
        $unique_alerts = array();

        foreach ($data as $alert) {
            $key = $alert['ta_team_id'] . '-' . $alert['ta_alert_id'];
            if (!array_key_exists($key, $unique_alerts)) {
                $unique_alerts[$key] = $alert;
            }
        }

        $unique_alerts = array_values($unique_alerts);

        if (!empty($unique_alerts)) {
            $this->db->insert_batch('team_alert', $unique_alerts);
        }
    }



    public function create_team_location($team_line_data)
    {
        $this->db->insert('team_location', $team_line_data);
        return $this->db->insert_id();
    }


    public function update_team($id, $data)
    {
       
        $this->db->where('team_id', $id);
        return $this->db->update('teams', $data);
    }


    public function delete_team($id)
    {
        $this->db->where('team_id', $id);
        return $this->db->delete('teams');
    }


    public function get_team_by_alert($alert_id)
    {
        $this->db->select('team_id, team_name');
        $this->db->from('teams');
        $this->db->join('team_alert', 'team_alert.ta_team_id = teams.team_id');
        $this->db->where('team_alert.ta_alert_id', $alert_id);
        $query = $this->db->get();
        return $query->result_array();
    }


   // Get the team members.
    public function get_team_members($team_id)
    {
        $this->db->select('team_user.team_user_id, team_user.tu_team_id, team_user.tu_user_id, users.user_id, users.username, users.email, users.phone, users.first_name, users.last_name');
        $this->db->from('team_user');
        $this->db->join('users', 'users.user_id = team_user.tu_user_id'); // Corrected join condition
        $this->db->where('team_user.tu_team_id', $team_id);
        $query = $this->db->get();
        
        // Uncomment the following line to return the result as an array
        return $query->result_array();
        
        // For debugging purposes, print the last query
        //$last_query = $this->db->last_query();
        //print_r($last_query);
    }


    public function get_team_leader($team_id)
    {
        $this->db->select('team_user.team_user_id, team_user.tu_team_id, team_user.tu_user_id, users.user_id, users.username, users.email, users.phone, users.first_name, users.last_name');
        $this->db->from('team_user');
        $this->db->join('users', 'users.user_id = team_user.tu_user_id');
        $this->db->where('team_user.tu_team_id', $team_id);
        $this->db->where('team_user.team_leader', 1);
        $query = $this->db->get();
        return $query->row_array();
    }



    public function get_team_location($team_id)
    {
        $this->db->select('team_location.tl_id, team_location.tl_team_id, team_location.tl_line_id, production_lines.line_id, production_lines.line_name, plants.plant_id, plants.plant_name');
        $this->db->from('team_location');
        $this->db->join('production_lines', 'production_lines.line_id = team_location.tl_line_id');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id');
        $this->db->where('team_location.tl_team_id', $team_id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_team_alerts($team_id)
    {
        $this->db->select('team_alert.team_alert_id, team_alert.ta_team_id, team_alert.ta_alert_id, alerts.alert_id, alerts.alert_name');
        $this->db->from('team_alert');
        $this->db->join('alerts', 'alerts.alert_id = team_alert.ta_alert_id');
        $this->db->where('team_alert.ta_team_id', $team_id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_team_plant($team_id)
    {
        $this->db->select('team_location.tl_id, team_location.tl_team_id, team_location.tl_line_id, production_lines.line_id, production_lines.line_name, plants.plant_id, plants.plant_name');
        $this->db->from('team_location');
        $this->db->join('production_lines', 'production_lines.line_id = team_location.tl_line_id');
        $this->db->join('plants', 'plants.plant_id = production_lines.plant_id');
        $this->db->where('team_location.tl_team_id', $team_id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function get_team_lines($team_id)
    {
        $this->db->select('team_location.tl_id, team_location.tl_team_id, team_location.tl_line_id, production_lines.line_id, production_lines.line_name');
        $this->db->from('team_location');
        $this->db->join('production_lines', 'production_lines.line_id = team_location.tl_line_id');
        $this->db->where('team_location.tl_team_id', $team_id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function update_team_leader($team_id, $user_id)
    {
        $this->db->set('team_leader', 0);
        $this->db->where('tu_team_id', $team_id);
        $this->db->update('team_user');

        $this->db->set('team_leader', 1);
        $this->db->where('tu_team_id', $team_id);
        $this->db->where('tu_user_id', $user_id);
        return $this->db->update('team_user');
    }



    public function update_team_members($team_id, $data, $team_leader)
    {
        // Start a transaction
        $this->db->trans_start();

        // Update the existing team leader (set team_leader to 0)
        $this->db->set('team_leader', 0);
        $this->db->where('tu_team_id', $team_id);
        $this->db->where('team_leader', 1);
        $this->db->update('team_user');

        // Delete all team members except the new team leader
        $this->db->where('tu_team_id', $team_id);
        $this->db->where('tu_user_id !=', $team_leader);
        $this->db->delete('team_user');

        // Insert new team members
        if (!empty($data)) {
            $this->db->insert_batch('team_user', $data);
        }

        // Insert or update the new team leader
        $leader_data = array(
            'tu_team_id' => $team_id,
            'tu_user_id' => $team_leader,
            'team_leader' => 1
        );
        $this->db->replace('team_user', $leader_data);

        // Complete the transaction
        $this->db->trans_complete();

        return $this->db->trans_status();
    }


    public function update_team_location($team_id, $data)
    {
        $this->db->where('tl_team_id', $team_id);
        if (!$this->db->delete('team_location')) {
            log_message('error', 'Failed to delete team_location for team_id: ' . $team_id);
        }

        if (!$this->db->insert_batch('team_location', $data)) {
            log_message('error', 'Failed to insert_batch into team_location for team_id: ' . $team_id);
        }
    }


    public function update_team_alerts($team_id, $data)
    {
        $this->db->where('ta_team_id', $team_id);
        if (!$this->db->delete('team_alert')) {
            log_message('error', 'Failed to delete team_alert for team_id: ' . $team_id);
        }

        if (!$this->db->insert_batch('team_alert', $data)) {
            log_message('error', 'Failed to insert_batch into team_alert for team_id: ' . $team_id);
        }
    }


    public function delete_team_location($team_id)
    {
        $this->db->where('tl_team_id', $team_id);
        $this->db->delete('team_location');
    }

    
    public function delete_team_alerts($team_id)
    {
        $this->db->where('ta_team_id', $team_id);
        $this->db->delete('team_alert');
    }


    public function delete_team_complete($team_id){
        $this->db->where('tu_team_id', $team_id);
        $this->db->delete('team_user');
        $this->db->where('ta_team_id', $team_id);
        $this->db->delete('team_alert');
        $this->db->where('tl_team_id', $team_id);
        $this->db->delete('team_location');
        $this->db->where('team_id', $team_id);
        $this->db->delete('teams');
    }

}