<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trades extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->_is_logged_in()) {
            redirect("Login");
        }
        $this->load->helper('csv_helper');
        $this->load->model('login_model');
    }

    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
    public function index()
    {
        $id = $this->input->post('id');
        $scrip = $this->input->post('scrip');
        $userid = $this->input->post('userid');
        $buy_rate = $this->input->post('buy_rate');
        $sell_rate = $this->input->post('sell_rate');
        $lots_units = $this->input->post('lots_units');
        $username = $this->input->post('username');
        $trading_type = $this->input->post('trading_type');

        $conditions = array();

        if (!empty($id)) {
            $conditions['buy_sell_trades.id'] = $id;
        }

        if (!empty($scrip)) {
            $this->db->group_start();
            $this->db->like('buy_sell_trades.scrip_id', $scrip);
            $this->db->or_like('trading_table.scrip_name', $scrip);
            $this->db->or_where("SUBSTRING_INDEX(trading_table.scrip_name, ' ', -2) LIKE", "%$scrip%");
            $this->db->group_end();
        }

        if (!empty($userid)) {
            $conditions['buy_sell_trades.user_id'] = $userid;
        }

        if (!empty($username)) {
            $this->db->where('users.username', $username);
        }

        if (!empty($buy_rate)) {
            $conditions['trading_table.last'] = $buy_rate;
        }

        if (!empty($sell_rate)) {
            $conditions['trading_table.bid'] = $sell_rate;
        }

        if (!empty($lots_units)) {
            $conditions['buy_sell_trades.lot'] = $lots_units;
        }

        if (!empty($trading_type)) {
            $conditions['trading_table.type'] = $trading_type; 
        }

        // $this->db->select('id');
        // $this->db->from('buy_sell_trades');
        // $this->db->where($conditions);
        // // $data['id'] = $this->db->get()->result_array();

        $this->db->select('buy_sell_trades.id AS trade_id, buy_sell_trades.*, trading_table.type as trading_type, users.*');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
        $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
        $this->db->where($conditions);
        $data['trades_data'] = $this->db->get()->result_array();
        // echo'<pre>';print_r($data['trades_data']);die;
        if (!empty($data['trades_data'])) {
            $data['scrip_names'] = $this->getScripNames($data['trades_data']);
        } else {
            $data['scrip_names'] = array();
        }

        $data['deleted_trades'] = $this->login_model->getDeletedTrades();
        $data['get_drop'] = $this->db->get('users')->result_array();

        $this->load->view('trades/trade', $data);
    }

    public function seach_closed_data()
    {
        $id = $this->input->post('id');
        $scrip = $this->input->post('scrip');
        $buy_rate = $this->input->post('buy_rate');
        $username = $this->input->post('username');
    
        $conditions = array();
    
        if (!empty($id)) {
            $conditions['buy_sell_trades.id'] = $id;
        }
    
        if (!empty($scrip)) {
            $this->db->group_start();
            $this->db->like('buy_sell_trades.scrip_id', $scrip);
            $this->db->or_like('trading_table.scrip_name', $scrip);
            $this->db->or_where("SUBSTRING_INDEX(trading_table.scrip_name, ' ', -2) LIKE", "%$scrip%");
            $this->db->group_end();
        }
    
        if (!empty($username)) {
            $this->db->where('users.username', $username);
        }
    
        if (!empty($buy_rate)) {
            $conditions['trading_table.last'] = $buy_rate;
        }
    
        $this->db->where('buy_sell_trades.status', 'closed'); // Filter for closed trades only
    
        $this->db->select('buy_sell_trades.id AS trade_id, buy_sell_trades.*, trading_table.type as trading_type, users.*');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner');
        $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'inner');
        $this->db->where($conditions);
        $data['trades_data'] = $this->db->get()->result_array();
        // echo'<pre>';print_r($data['trades_data']);die;
        if (!empty($data['trades_data'])) {
            $data['scrip_names'] = $this->getScripNames($data['trades_data']);
        } else {
            $data['scrip_names'] = array();
        }
    
        $data['deleted_trades'] = $this->login_model->getDeletedTrades();
        $data['get_drop'] = $this->db->get('users')->result_array();
    
        // Check if the deleted trades ID is set
        $deleted_trade_id = $this->session->flashdata('deleted_trade_id');
        if (!empty($deleted_trade_id)) {
            $data['deleted_trade_id'] = $deleted_trade_id;
        } else {
            $data['deleted_trade_id'] = 0;
        }
    
        $this->load->view('trades/trade', $data);
    }
    
    private function getScripNames($trades)
    {
        $scripIds = array_column($trades, 'scrip_id');

        $this->db->select('*');
        $this->db->where_in('scrip_id', $scripIds);
        $query = $this->db->get('trading_table');
        $scripNames = array();

        foreach ($query->result_array() as $row) {
            $scripNames[$row['scrip_id']] = array(
                'scrip_name' => $row['scrip_name'],
                'bid' => $row['bid'],
                'last' => $row['last'],
                'type' => $row['type'],
            );
        }
        return $scripNames;
    }

    public function create()
    {
        $data['get_drop'] = $this->db->get('trading_table')->result();
        if (!empty($data['get_drop'])) {
            $data['scrip_names'] = $this->getScripNames($data['get_drop']);
        } else {
            $data['scrip_names'] = array();
        }
        $data['get_user'] = $this->db->get('users')->result_array();
        $this->load->view('trades/create-trades', $data);
    }

    public function save_trades($user_id = null)
    {
        $transaction_password = $this->input->post('transaction_password');
        $users = $this->db
            ->select('users.id,users.transaction_password')
            ->from('users')
            ->where('users.id', $user_id)
            ->get()
            ->row();
        $submit_data = $users->transaction_password;

        if ($submit_data === $transaction_password) {
            $data = $this->input->post();
            $data['order_created_by'] = 'admin';
            unset($data['transaction_password']);
            $this->db->insert('buy_sell_trades', $data);
            $this->session->set_flashdata('success', 'Trades created successfully');
            redirect('trades/create');
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trades/create');
        }
    }

    public function trade_view($id)
    {
        $this->db->select('buy_sell_trades.*,buy_sell_trades.modified_at, users.username');
        $this->db->from('buy_sell_trades');
        $this->db->join('users', 'buy_sell_trades.user_id = users.id', 'left');
        $this->db->where('buy_sell_trades.id', $id);
        $data['trades'] = $this->db->get()->row();
        if (!empty($data['trades_data'])) {
            $data['scrip_names'] = $this->getScripNames($data['trades_data']);
        } else {
            $data['scrip_names'] = array();
        }
        $this->load->view('trades/trade_view', $data);
    }

    public function edit_trade($id)
    {
        $data['trades'] = $this->db->get_where('buy_sell_trades', array('id' => $id))->row();

        if (!empty($data['trades'])) {
            $trades = [$data['trades']];
            $data['scrip_names'] = $this->getScripNames($trades);
        } else {
            $data['scrip_names'] = array();
        }
        $data['get_user'] = $this->db->get('users')->result_array();
        $data['get_drop'] = $this->db->get('trading_table')->result();
        // echo'<pre>';print_r($data['get_drop']);die;
        // echo'<pre>';print_r($data['get_drop']);die;
        $selectedUserId = $data['trades']->user_id;
        $data['selectedUserId'] = $selectedUserId;
        $this->load->view('trades/edit_create_trades', $data);
    }


    public function save_edit_trades($id)
    {
        $transaction_password = $this->input->post('transaction_password');
        $user_id = $this->session->userdata('id');
        $users = $this->db
            ->select('users.id,users.transaction_password')
            ->from('users')
            ->where('users.id', $user_id)
            ->get()
            ->row();
        $submit_data = $users->transaction_password;
        if ($submit_data === $transaction_password) {
            $data = $this->input->post();
            $data['modified_at'] = date('Y-m-d H:i:s');
            unset($data['transaction_password']);
            $this->db->where('id', $id);
            $this->db->update('buy_sell_trades', $data);
            redirect('trade');
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trades/edit_trade/' . $id);
        }
    }

    public function close_trade_view()
    {
        $this->load->view('trades/close-trade-view');
    }

    public function delete($id)
    {
        $this->login_model->softDelete($id);
        $this->session->set_flashdata('success', 'Trade deleted successfully');
        redirect('trade');
    }
    public function permanent_delete($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete('users');

        $this->db->where('user_id', $user_id);
        $this->db->delete('config');

        $this->db->where('userid', $user_id);
        $this->db->delete('create_trades');

        $this->db->where('user_id', $user_id);
        $this->db->delete('permissions');

        $this->db->where('user_id', $user_id);
        $this->db->delete('mcx_features');

        $this->session->set_flashdata('success', 'Trade deleted successfully');
        redirect('trade');
    }

    public function export()
    {
        $this->load->database();
        $this->load->helper('csv');
        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');

        $fromDateFormatted = date('Y-m-d', strtotime($fromDate));
        $toDateFormatted = date('Y-m-d', strtotime($toDate));

        $this->db->where('buy_sell_trades.created_at >=', $fromDateFormatted . ' 00:00:00');
        $this->db->where('buy_sell_trades.created_at <=', $toDateFormatted . ' 23:59:59');
        $data = $this->db->select('*')
            ->from('buy_sell_trades')
            ->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id', 'inner')
            ->get()
            ->result_array();

        $filename = 'trades_' . date('Ymd') . '.csv';
        $headers = array('ID', 'Scrip', 'Buy Rate', 'Sell Rate', 'Lots/Units', 'Open Date', 'Close Date');

        $content = array();
        array_push($content, $headers);
        foreach ($data as $row) {
            $line = array(
                $row['id'],
                $row['scrip_name'],
                $row['bid'],
                $row['last'],
                $row['lot'],
                $row['created_at'],
            );
            array_push($content, $line);
        }
        array_to_csv($content, $filename);
    }
}
