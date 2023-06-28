<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Active_position extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect("Login");
        }
    }
    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
    public function index()
    {
        $this->db->select('buy_sell_trades.*, SUM(buy_sell_trades.lot) as total_lots, AVG(buy_sell_trades.buy_rate) as avg_rate, AVG(buy_sell_trades.sell_rate) as avg_sell_rate');
        $this->db->where('buy_sell_trades.status', 'active');
        $this->db->group_by('buy_sell_trades.scrip_id');
        $this->db->from('buy_sell_trades');
        $data['active_buy_sell'] = $this->db->get()->result_array();
        
        // echo'<pre>';print_r($data['active_buy_sell']);die;
    
        if (!empty($data['active_buy_sell'])) {
            $data['scrip_names'] = $this->getScripNames($data['active_buy_sell']);
        } else {
            $data['scrip_names'] = array();
        }
    
        $this->load->view('active_position/active-position', $data);
    }
    

    private function getScripNames($trades)
    {
        $scripIds = array_column($trades, 'scrip_id');
        $this->db->select('scrip_id, scrip_name, bid, last');
        $this->db->where_in('scrip_id', $scripIds);
        $query = $this->db->get('trading_table');

        $scripNames = array();
        foreach ($query->result_array() as $row) {
            $scripNames[$row['scrip_id']] = array(
                'scrip_name' => $row['scrip_name'],
                'bid' => $row['bid'],
                'last' => $row['last'],
            );
        }
        return $scripNames;
    }
}
