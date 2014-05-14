<?php

class Users_model extends CI_Model {

    /**
     * Validate the login's data with the database
     * @param string $user_name
     * @param string $password
     * @return void
     */
    function validate($user_name, $password) {
        $this->db->where('user_name', $user_name);
        $this->db->where('pass_word', $password);
        $query = $this->db->get('membership');

        if ($query->num_rows == 1) {
            $resutl = $query->result();
            $data = array(
                'is_admin' => $resutl[0]->is_admin,
                'lg_id' => $resutl[0]->id,
                
                
            );
            $this->session->set_userdata($data);
            
            return true;
        }
    }

    /**
     * Serialize the session data stored in the database, 
     * store it in a new array and return it to the controller 
     * @return array
     */
    function get_db_session_data() {
        $query = $this->db->select('user_data')->get('ci_sessions');
        $user = array(); /* array to store the user data we fetch */
        foreach ($query->result() as $row) {
            $udata = unserialize($row->user_data);
            /* put data in array using username as key */
            $user['user_name'] = $udata['user_name'];
            $user['is_logged_in'] = $udata['is_logged_in'];
        }
        return $user;
    }

    /**
     * Store the new user's data into the database
     * @return boolean - check the insert
     */
    function create_member() {

        $this->db->where('user_name', $this->input->post('username'));
        $query = $this->db->get('membership');

        if ($query->num_rows > 0) {
            echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
            echo "Username already taken";
            echo '</strong></div>';
        } else {

            $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_addres' => $this->input->post('email_address'),
                'user_name' => $this->input->post('username'),
                'pass_word' => md5($this->input->post('password')),
                'pass_orginal' => $this->input->post('password'),
                'date' => date('Y-m-d'),
                'is_admin' => "2",
                
            );
            $insert = $this->db->insert('membership', $new_member_insert_data);
            return $insert;
        }
    }//create_member
    
    function update_member($data) {

        $this->db->where('id', $data['id']);
        $query = $this->db->get('membership');
        
        $condition = array('id'=>$data['id']);
        
        if ($query->num_rows > 0) {
            unset($data['id']);
            $update = $this->db->update('membership', $data,$condition);
            
        } else {

            $new_member_insert_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_addres' => $this->input->post('email_address'),
                'user_name' => $this->input->post('username'),
                'pass_word' => md5($this->input->post('password')),
                'pass_orginal' => $this->input->post('password'),
                'date' => date('Y-m-d'),
                
            );
            $insert = $this->db->insert('membership', $new_member_insert_data);
            return $insert;
        }
    }//create_member
    //for listing all users
    
    public function get_all_users($search_string = null, $order = null, $order_type = 'Asc', $limit_start= 0, $limit_end= 0) {

        $this->db->select('*');
        $this->db->from('membership');
        
        
        if($search_string){
                $this->db->like('membership.user_name', $search_string);
        }
        

        if ($order) {
            $this->db->order_by($order, $order_type);
        } else {
            $this->db->order_by('membership.id', $order_type);
        }
        
        if($limit_start!=0)
            $this->db->limit($limit_start, $limit_end);
        
        
        //$this->db->limit('4', '4');


        $query = $this->db->get();
//echo $this->db->last_query();//exit;
        return $query->result_array();
    }
    
    
     function count_users($search_string = null, $order = null) {
        $this->db->select('*');
        $this->db->from('membership');
        if ($order) {
            $this->db->order_by($order, 'Asc');
        } else {
            $this->db->order_by('id', 'Asc');
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function get_user_by_id($id) {
        $this->db->select('*');
        $this->db->from('membership');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0];
    }
    
    /**
     * Update membership
     * @param array $data - associative array with data to store
     * @return boolean
     */
    function update_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('membership', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if ($report !== 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete membership
     * @param int $id - membership id
     * @return boolean
     */
    function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('membership');
    }

}

