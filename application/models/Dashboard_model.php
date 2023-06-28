<?php
class Dashboard_model extends CI_Model
{
        public function getTotalActiveUsers()
        {
            $this->db->select('COUNT(*) as total_active_users');
            $this->db->from('users');
            $this->db->join('config', 'users.id = config.user_id', 'inner');
            $this->db->where('config.account_status', 'on'); // Assuming 'on' represents an active configuration
            $query = $this->db->get();
            $result = $query->row();
            return $result->total_active_users;
            }
}
