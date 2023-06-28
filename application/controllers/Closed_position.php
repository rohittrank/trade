<?php
defined('BASEPATH') or exit('No direct script access allowed');

class closed_position extends CI_Controller
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
        $this->db->where('status', 'closed');
        $data['active_buy_sell'] = $this->db->get('buy_sell_trades')->result_array();

        if (!empty($data['active_buy_sell'])) {
            $data['scrip_names'] = $this->getScripNames($data['active_buy_sell']);
        } else {
            $data['scrip_names'] = array();
        }

        $this->load->view('closed_position/closed-position', $data);
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
    public function closed_position_user()
    {
        $this->load->view('closed_position/closed-position-user');
    }
}
