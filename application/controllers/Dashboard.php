<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect("Login");
        }
        $this->load->model('Dashboard_model');
        $this->load->model('trade_model');

    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $data['get_name'] = $this->db->select('fname, lname')->where('id', $user_id)->get('users')->result_array();
        
        $totalMarginUsed = $this->trade_model->getTotalMarginUsed();

        $data['totalMarginUsed'] = $totalMarginUsed;
        
        $this->db->select('SUM(buy_rate * lot) AS total_buy_rate')
        ->select('SUM(sell_rate * lot) AS total_sell_rate')
        ->from('buy_sell_trades')
        ->where_in('status', ['active', 'pending']);

        $query = $this->db->get();
        $result = $query->row();
        // echo'<pre>';print_r($result);die;
        $total_buy_rate = $result->total_buy_rate;
        $total_sell_rate = $result->total_sell_rate;

        $profit_loss = $total_sell_rate - $total_buy_rate;

        $data['profit_loss'] = $profit_loss;  
        // echo'<pre>';print_r($data['profit_loss']);die;
    
        /* Buy Turnover */
        $this->db->select('SUM(buy_sell_trades.buy_rate * buy_sell_trades.lot_size * buy_sell_trades.lot) AS total_mcx_order');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
        $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
        $this->db->where('trading_table.type', 'MCX');
        $data['total_mcx_order'] = $this->db->get()->row()->total_mcx_order;
        $this->db->select('SUM(buy_sell_trades.buy_rate * buy_sell_trades.lot) AS total_nse_order')
        ->from('buy_sell_trades')
        ->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner')
        ->join('users', 'buy_sell_trades.user_id = users.id', 'inner')
        ->where('trading_table.type', 'NSE')
        ->or_where('trading_table.type', 'OPTIONS');
         $data['total_equity_order'] = $this->db->get()->row()->total_nse_order;
    
         /* Sell Turnover */
         $this->db->select('SUM(buy_sell_trades.sell_rate * buy_sell_trades.lot * buy_sell_trades.lot_size) AS total_mcx_sell_order');
         $this->db->from('buy_sell_trades');
         $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
         $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
         $this->db->where('trading_table.type', 'MCX');
         $data['total_mcx_sell_order'] = $this->db->get()->row()->total_mcx_sell_order;


         $this->db->select('SUM(buy_sell_trades.sell_rate * buy_sell_trades.lot) AS total_nse_sell_order');
         $this->db->from('buy_sell_trades');
         $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
         $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
         $this->db->where('trading_table.type', 'NSE')->or_where('trading_table.type', 'OPTIONS');
         $data['total_nse_sell_order'] = $this->db->get()->row()->total_nse_sell_order;
        // print_r($data['total_nse_sell_order']);die;
        
        $this->db->select('SUM(buy_sell_trades.buy_rate) AS total_mcx_buy_order, SUM(buy_sell_trades.sell_rate) AS total_mcx_sell_order');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
        $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
        $this->db->where('trading_table.type', 'MCX');
        $data['total_mcx_buy_sell_turnover'] = $this->db->get()->row();

        $this->db->select('SUM(buy_sell_trades.buy_rate) AS total_nse_buy_order, SUM(buy_sell_trades.sell_rate) AS total_nse_sell_order')
        ->from('buy_sell_trades')
        ->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner')
        ->join('users', 'buy_sell_trades.user_id = users.id', 'inner')
        ->where('trading_table.type', 'NSE')
        ->or_where('trading_table.type', 'OPTIONS');
    
         $data['total_nse_buy_sell_turnover'] = $this->db->get()->row();
     
        $data['total_active_users'] = $this->Dashboard_model->getTotalActiveUsers();   
        
        $this->db->select('sub.scrip_id, SUM(sub.sell_rate) AS profit, t.type');
        $this->db->from('(SELECT scrip_id, action, CASE WHEN action = "buy" THEN -SUM(buy_rate) WHEN action = "sell" THEN SUM(sell_rate) END AS sell_rate FROM buy_sell_trades GROUP BY scrip_id, action) sub');
        $this->db->join('trading_table t', 't.scrip_id = sub.scrip_id', 'left');
        $this->db->group_by('t.type');
        $query = $this->db->get();
        $data['profits'] = $query->result_array();

        $equity_brokerage_rate = 20;
        $mcx_brokerage_rate = 20;
        $nse_options_brokerage_rate = 20; 
        
        $this->db->select('SUM(CASE WHEN action = "buy" THEN buy_rate WHEN action = "sell" THEN sell_rate ELSE 0 END) AS total_trading_value')
            ->select('(SUM(CASE WHEN action = "buy" THEN buy_rate WHEN action = "sell" THEN sell_rate ELSE 0 END) * ' . $equity_brokerage_rate . ') AS equity_brokerage_fee')
            ->select('(SUM(CASE WHEN action = "buy" THEN buy_rate WHEN action = "sell" THEN sell_rate ELSE 0 END) * ' . $mcx_brokerage_rate . ') AS mcx_brokerage_fee')
            ->select('(SUM(CASE WHEN action = "buy" THEN buy_rate WHEN action = "sell" THEN sell_rate ELSE 0 END) * ' . $nse_options_brokerage_rate . ') AS nse_options_brokerage_fee')
            ->from('buy_sell_trades')
            ->join('trading_table t', 't.scrip_id = buy_sell_trades.scrip_id', 'left')
            ->where('t.type', 'MCX')
            ->or_where('t.type', 'NSE OPTIONS');
        
        $query = $this->db->get();
        $result = $query->row();
        $total_trading_value = $result->total_trading_value;
        $mcx_brokerage_fee = $result->mcx_brokerage_fee;
        $nse_options_brokerage_fee = $result->nse_options_brokerage_fee;
        
        $data['total_trading_value'] = $total_trading_value;
        $data['mcx_brokerage_fee'] = $mcx_brokerage_fee;
        $data['nse_options_brokerage_fee'] = $nse_options_brokerage_fee;

        $this->db->select('COUNT(CASE WHEN t.type = "MCX" THEN 1 END) AS mcx_buy_count')
        ->select('COUNT(CASE WHEN t.type IN ("NSE", "OPTIONS") THEN 1 END) AS equity_buy_count')
        ->from('buy_sell_trades')
        ->join('trading_table t', 't.scrip_id = buy_sell_trades.scrip_id', 'left')
        ->where('buy_sell_trades.action', 'buy')
        ->where('buy_sell_trades.status', 'active');
                
        $query = $this->db->get();
        $result = $query->row();
            
        $mcx_buy_count = $result->mcx_buy_count;
        $equity_buy_count = $result->equity_buy_count;
            
        $data['mcx_buy_count'] = $mcx_buy_count;
        $data['equity_buy_count'] = $equity_buy_count;
 
        /*  */
        $this->db->select('COUNT(CASE WHEN t.type = "MCX" AND buy_sell_trades.action = "sell" THEN 1 END) AS mcx_sell_count')
        ->select('COUNT(CASE WHEN t.type IN ("NSE", "OPTIONS") AND buy_sell_trades.action = "sell" THEN 1 END) AS equity_sell_count')
        ->from('buy_sell_trades')
        ->join('trading_table t', 't.scrip_id = buy_sell_trades.scrip_id', 'left')
        ->where('buy_sell_trades.status', 'pending');
    
        $query = $this->db->get();
        $result = $query->row();
        
        $mcx_sell_count = $result->mcx_sell_count;
        $equity_sell_count = $result->equity_sell_count;
        
        $data['mcx_sell_count'] = $mcx_sell_count;
        $data['equity_sell_count'] = $equity_sell_count;
        
        $this->load->view('dashboard', $data);
    }
    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
}