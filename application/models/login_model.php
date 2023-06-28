<?php
class Login_model extends CI_Model
{

    public function can_login($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            $row = $query->row();

            $store_password = $row->password; // Assuming password is already stored securely
            if ($password == $store_password) {

                if ($row->user_role == 'superadmin') { // Assuming the column name for user type is 'user_type'
                    // echo '<pre>'; print_r($this->session->all_userdata());exit;
                    $this->session->set_userdata('id', $row->id);
                    return 'Success';
                } else {
                    return 'Access Denied: Only Superadmin can login';
                }
            } else {
                return 'Wrong Password';
            }
        } else {
            return 'Wrong User Name';
        }
    }

    public function get_users_Data($conditions = array()) {
        $this->db->select('users.*, config.*, mcx_features.*, equity_features.*, trader_funds.*');
        $this->db->from('users');
        $this->db->join('config', 'config.user_id = users.id', 'left');
        $this->db->join('mcx_features', 'mcx_features.user_id = users.id', 'left');
        $this->db->join('equity_features', 'equity_features.user_id = users.id', 'left');
        $this->db->join('trader_funds', 'trader_funds.userid = users.id', 'left');
        $this->db->where('users.user_role', 'user');

        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getUsersData()
    {
        $this->db->select('users.id as user_id, users.*, permissions.*, equity_features.*, mcx_features.*, config.*');
        $this->db->from('users');
        $this->db->join('permissions', 'users.id = permissions.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.user_role', 'superadmin');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getclientsData()
    {
        $this->db->select('users.id as user_id, users.*, option_config.*, others.*, equity_features.*, mcx_features.*, config.*');
        $this->db->from('users');
        $this->db->join('option_config', 'users.id = option_config.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('others', 'users.id = others.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        // $this->db->join('trader_funds', 'users.id = trader_funds.userid', 'left');

        $this->db->join('config', 'users.id = config.user_id', 'left');

        $query = $this->db->get();
        $results = $query->result();

        return $query->result_array();
    }

    public function get_clients_data($id)
    {
        if (empty($id)) {
            // Handle the case when ID is empty or not provided
            return null;
        }

        $this->db->select('users.id as user_id, users.*, option_config.*, equity_features.*, others.*, mcx_features.*, config.*,');
        $this->db->from('users');
        $this->db->join('option_config', 'users.id = option_config.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('others', 'users.id = others.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $userData = $query->row_array();
            return $userData;
        } else {
            // Handle the case when no data is found for the provided ID
            error_log('No user data found for ID: ' . $id);
            return null;
        }
    }

    public function get_clients_data_by_dates($id, $from_date, $to_date)
    {
        if (empty($id)) {
            return null;
        }
    
        $this->db->select('users.id as user_id, users.*, option_config.*, equity_features.*, others.*, mcx_features.*, config.*');
        $this->db->from('users');
        $this->db->join('option_config', 'users.id = option_config.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('others', 'users.id = others.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.id', $id);
    
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->where('users.created_at >=', $from_date . ' 00:00:00');
            $this->db->where('users.created_at <=', $to_date . ' 23:59:59');
        }
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $userData = $query->row_array();
            return $userData;
        } else {
            error_log('No user data found for ID: ' . $id);
            return null;
        }
    }
    

    public function get_funds_data_by_dates($id, $from_date, $to_date)
    {
        if (empty($id)) {
            return null;
        }
    
        $this->db->select('users.id as user_id, users.*, option_config.*, equity_features.*, others.*, mcx_features.*, config.*,transaction_history.*');
        $this->db->from('users');
        $this->db->join('option_config', 'users.id = option_config.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('others', 'users.id = others.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.id', $id);
    
        // Add date filtering
        if (!empty($from_date) && !empty($to_date)) {
            $this->db->join('transaction_history', 'users.id = transaction_history.user_id', 'left');
            $this->db->where('transaction_history.transaction_date >=', $from_date . ' 00:00:00');
            $this->db->where('transaction_history.transaction_date <=', $to_date . ' 23:59:59');
        }
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $userData = $query->result_array();
            return $userData;
        } else {
            // Handle the case when no data is found for the provided ID
            error_log('No user data found for ID: ' . $id);
            return null;
        }
    }
    
    


    public function save_funds($user_id)
    {
        $submittedPassword = $this->input->post('transaction_password');
        $user = $this->db
            ->select('users.*, others.*')
            ->from('users')
            ->join('others', 'users.id = others.user_id', 'left')
            ->where('users.id', $user_id)
            ->get()
            ->row();

        $storedPassword = $user->transaction_password;

        if ($submittedPassword === $storedPassword) {
            $data = $this->input->post();
            $this->db->insert('trader_funds', $data);
            return true;
        } else {
            return false;
        }
    }


    public function get_user_data($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('permissions', 'users.id = permissions.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            // Handle the case when no data is found for the provided ID
            return null;
        }
    }
    public function edit_user_data($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('permissions', 'users.id = permissions.user_id', 'left');
        $this->db->join('equity_features', 'users.id = equity_features.user_id', 'left');
        $this->db->join('mcx_features', 'users.id = mcx_features.user_id', 'left');
        $this->db->join('config', 'users.id = config.user_id', 'left');
        $this->db->where('users.id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            // Handle the case when no data is found for the provided ID
            return null;
        }
    }

    public function delete($user_id)
    {
        // Delete from 'users' table
        $this->db->where('id', $user_id);
        $this->db->delete('users');

        // Delete from 'config' table
        $this->db->where('user_id', $user_id);
        $this->db->delete('config');

        // Delete from 'permissions' table
        $this->db->where('user_id', $user_id);
        $this->db->delete('permissions');

        // Delete from 'mcx_features' table
        $this->db->where('user_id', $user_id);
        $this->db->delete('mcx_features');

        redirect('User');
    }
    public function search_user($search)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('config', 'config.user_id = users.id', 'left');
        $this->db->join('permissions', 'permissions.user_id = users.id', 'left');
        $this->db->join('mcx_features', 'mcx_features.user_id = users.id', 'left');

        $this->db->like('users.username', $search);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function softDelete($id)
    {
        // echo'<pre>';print_r($data);die;
        $this->db->where('id', $id);
        $this->db->delete('buy_sell_trades');
    }

    public function get_trades_data($user_id) {
        $this->db->select('*');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id');
        $this->db->where('buy_sell_trades.user_id', $user_id);
        return $this->db->get()->result_array();
    }
    public function getAll()
    {
        $this->db->where('deleted_at', null);
        return $this->db->get('create_trades')->result();
    }
    public function getDeletedTrades()
    {
        $this->db->where('deleted_at IS NOT NULL');
        return $this->db->get('create_trades')->result_array();
    }
    public function insert_funds($data)
    {
        $this->db->insert('trader_funds', $data);
    }

    function checkCurrentPassword($currentPassword)
    {

        $userid = $this->session->userdata('username');
        // echo "SELECT * from users WHERE username='$userid' AND password='$currentPassword'";die;
        $query = $this->db->query("SELECT * from users WHERE username='$userid' AND password='$currentPassword'");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function get_user_transaction_password($user_id) {
        return $this->db->select('transaction_password')
            ->from('users')
            ->where('id', $user_id)
            ->get()
            ->row();
    }

    public function update_user_password($user_id, $new_password) {
        $data = array(
            'password' => $new_password
        );
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);
    }
    function updatePassword($password)
    {
        $userid = $this->session->userdata('username');
        $query = $this->db->query("update  users set password='$password' WHERE username='$userid' ");
    }
    function checkCurrent_t_Password($currentPassword)
    {
        $userid = $this->session->userdata('username');
        $query = $this->db->query("SELECT * from users WHERE username='$userid' AND transaction_password='$currentPassword'");
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function update_t_Password($password)
    {
        $userid = $this->session->userdata('username');
        $query = $this->db->query("UPDATE users SET transaction_password='$password' WHERE username='$userid'");
    }
    public function searchClients($username, $accountStatus)
    {
        $this->db->select('users.id, config.*, users.*, mcx_features.*');
        $this->db->from('users');
        $this->db->join('config', 'config.user_id = users.id');
        $this->db->join('mcx_features', 'mcx_features.user_id = users.id');
        $this->db->join('option_config', 'option_config.user_id = users.id');
        $this->db->join('others', 'others.user_id = users.id');

        if (!empty($username)) {
            $this->db->where('users.username', $username);
        }

        if (!empty($accountStatus)) {
            $this->db->where('config.account_status', $accountStatus);
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function save_pending_orders($data)
    {
        // echo'<pre>';print_r($data);die;
        $query = $this->db->insert('buy_sell_trades', $data);
        return $query;
    }

    public function get_all_pending_data()
    {
        $query = $this->db->get('pending_orders')->result_array();
        return $query;
    }

    public function delete_pending_data($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('buy_sell_trades');
        return $query;
    }

    public function get_user_by_id($user_id)
    {

        $query = $this->db->get_where('users', array('user_id' => $user_id));
        return $query->row();
    }

    public function reset_account($user_id)
    {

        $data = array(
            'account_status' => 'reset', // Example: Update the account status to 'reset'
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
    }
}