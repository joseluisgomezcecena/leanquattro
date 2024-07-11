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



    public function create_team_location($team_line_data)
    {
        if (!empty($team_line_data)) {
            $this->db->insert_batch('team_location', $team_line_data);
        }
        // Note: insert_batch does not return a single insert ID.
        // Adjust return value as needed.
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



}