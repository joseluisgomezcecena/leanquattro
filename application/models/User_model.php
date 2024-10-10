<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_users()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    }


    public function get_user($id)
    {
        $query = $this->db->get_where('users', array('user_id' => $id));
        return $query->row_array();
    }


    public function create_user($data)
    {
        return $this->db->insert('users', $data);
    }


    public function create_operator($data)
    {
        return $this->db->insert('users', $data);
    }


    public function update_user($id, $data)
    {
       
        $this->db->where('user_id', $id);
        return $this->db->update('users', $data);
    }


    public function update_operator($id, $data)
    {
       
        $this->db->where('user_id', $id);
        return $this->db->update('users', $data);
    }


    public function delete_user($id)
    {
        $this->db->where('user_id', $id);
        return $this->db->delete('users');
    }


    public function update_signature($id, $file_path)
    {

        $data = array(
            'signature' => $file_path
        );

        $this->db->where('user_id', $id);
        return $this->db->update('users', $data);
        
    }


    public function check_user_signature($username, $password) {
        // Fetch the user with the given username
        $this->db->where('username', $username);
        $this->db->where('signature IS NOT NULL');
        $query = $this->db->get('users');
    
        if ($query->num_rows() == 1) {
            
            $user = $query->row();
    
            if (password_verify($password, $user->password)) {
                // Password is correct, return true
                return true;

                //return the user object
                //return $user;

            }
        }
        // User doesn't exist or password is incorrect, return false
        return false;
    }



    public function get_user_signature($username) {
        // Fetch the user with the given username
        $this->db->where('username', $username);
        $this->db->where('signature IS NOT NULL');
        $query = $this->db->get('users');
    
        if ($query->num_rows() == 1) {
            
           //return as array
           return $query->row_array();
        }
        // User doesn't exist or password is incorrect, return false
        return false;
    }


    //check if username exists.
    public function username_exists($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }


    //check if username exists for update.
    public function username_exists_for_update($username, $id)
    {
        $query = $this->db->get_where('users', array('username' => $username, 'user_id !=' => $id));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }


    //check if email exists.
    public function email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }

    //check if email exists for update.
    public function email_exists_for_update($email, $id)
    {
        $query = $this->db->get_where('users', array('email' => $email, 'user_id !=' => $id));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }


    //check if phone exists.
    public function phone_exists($phone)
    {
        //check if phone is empty.
        if (empty($phone)) {
            return false;
        }

        $query = $this->db->get_where('users', array('phone' => $phone));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }


    //check if phone exists for update.
    public function phone_exists_for_update($phone, $id)
    {
        //check if phone is empty.
        if (empty($phone)) {
            return false;
        }

        $query = $this->db->get_where('users', array('phone' => $phone, 'user_id !=' => $id));
        if (empty($query->row_array())) {
            return false;
        } else {
            return true;
        }
    }


}