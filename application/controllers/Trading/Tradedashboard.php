<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tradedashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect("trading");
        }
        $this->load->model('trade_model');
        $this->load->model('login_model');
    }
    public function index()
    {
        $user_id = $this->session->userdata('id');
        $this->load->view('trade/explore');
    }
    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
    public function watchlist()
    {
        $data['trading_data'] = $this->db->get('trading_table')->result_array();
        $user_id = $this->session->userdata('id');
        $this->session->set_userdata('user_id', $user_id);
        $data['config_data'] = $this->db->select('options_trading')
                                         ->where('user_id', $user_id)
                                         ->get('option_config')
                                         ->row_array();
        $data['equity_active'] = $this->db->select('equity_trading')
                                         ->where('user_id', $user_id)
                                         ->get('equity_features')
                                         ->row_array();
        $data['mcx_active'] = $this->db->select('mcx_trading')
                                         ->where('user_id', $user_id)
                                         ->get('mcx_features')
                                         ->row_array();
                                         
        $this->load->view('trade/watchlist', $data);        
    }
    public function detail_watchlist($scrip_name = null)
    {
        $user_id = $this->session->userdata('id');
        $data['trading_data'] = $this->db->get('trading_table')->result_array();
        $data['get'] = $this->db->get_where('trading_table', array('scrip_name' => $scrip_name))->row_array();
        $data['max_lot_size'] = $this->trade_model->getMaxLotSize($user_id);
        $this->load->view('trade/detail_watchlist', $data);
    }
    public function trades()
    {
        $user_id = $this->session->userdata('id');
        $this->db->where('user_id', $user_id);
        $data['trade'] = $this->db->select('*')
        ->from('buy_sell_trades')
        ->join('trading_table', 'trading_table.scrip_id = buy_sell_trades.scrip_id')
        ->order_by('buy_sell_trades.id', 'desc')
        ->get()
        ->result_array();
        $data['data'] = $this->db->where('user_id', $user_id)->get('mcx_features')->result_array();
        $data['holdingdata']= $this->db->where('user_id',$user_id)->get('mcx_features')->result_array();
    if (!empty($data['trade'])) {
        $data['scrip_names'] = $this->getScripNames($data['trade']);
    } else {
        $data['scrip_names'] = array();
    }
  
        $this->load->view('trade/trades', $data);
    }

    public function portfolio()
    {
        $user_id = $this->session->userdata('id');
        $data['usersdata'] = $this->login_model->getUsersData($user_id);
        $total_balance = $this->trade_model->getTotalAmount($user_id);
        $data['total_amount'] = $total_balance;
        $data['data']= $this->db->where('user_id',$user_id)->get('mcx_features')->result_array();
        $this->db->select('buy_sell_trades.*, trading_table.*, 
        AVG(CASE WHEN buy_sell_trades.action = "buy" AND (buy_sell_trades.status != "pending" OR buy_sell_trades.market_type != "order") THEN buy_rate ELSE NULL END) AS avg_buy_rate,
        SUM(CASE WHEN buy_sell_trades.action = "buy" AND (buy_sell_trades.status != "pending" OR buy_sell_trades.market_type != "order") THEN buy_sell_trades.lot WHEN buy_sell_trades.action = "sell" THEN -buy_sell_trades.lot ELSE 0 END) AS lot');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'trading_table.scrip_id = buy_sell_trades.scrip_id');
        $this->db->where('buy_sell_trades.user_id', $user_id);
        $this->db->where('buy_sell_trades.status !=', 'closed');
        $this->db->group_by('buy_sell_trades.scrip_id, trading_table.scrip_name');
        $data['trades'] = $this->db->get()->result_array();
    //    echo'<pre>';print_r($data['trades']);die;
        // echo'<pre>';print_r($data['trades']);die;
        // echo $this->db->last_query();
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'closed');
        $data['lb'] = $this->db->get('buy_sell_trades')->result_array();
        // echo'<pre>';print_r($data['lb']);die;
        $user_id = $this->session->userdata('id');

        $query = $this->db->select('scrip_id, SUM(sell_rate) AS profit')
            ->from('(SELECT scrip_id, action, CASE
                      WHEN action = "buy" THEN -SUM(buy_rate)
                      WHEN action = "sell" THEN SUM(sell_rate)
                  END AS sell_rate
                  FROM buy_sell_trades
                  WHERE user_id = ' . $user_id . '
                  GROUP BY scrip_id, action) sub')
            ->group_by('scrip_id')
            ->get();
        
        $data['profits'] = $query->result_array();
        
        $allProfits = array_column($data['profits'], 'profit');
        $totalProfit = array_sum($allProfits);
        
        $data['totalProfit'] = $totalProfit;
        $user_id = $this->session->userdata('id');

        if (!empty($data['trades'])) {
            $data['scrip_names'] = $this->getScripNames($data['trades']);
        
            $total_turnover = 0;
            foreach ($data['trades'] as $trade) {
                $total_turnover += ($trade['buy_rate'] * $trade['lot']);
            }
        
            $this->db->select('holding_exposure');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('mcx_features');
            $result = $query->row();
        
            if ($result) {
                $holding_exposure = $result->holding_exposure;
            } else {
                $holding_exposure = 0;
            }
        
            $margin_required = $total_turnover / $holding_exposure;
            $data['margin_required'] = $margin_required;
        
            $margin_m2m = 44335;
            if ($margin_m2m >= $margin_required) {
                $data['holding_status'] = 'Sufficient';
            } else {
                $data['holding_status'] = 'Insufficient';
            }
        } else {
            $data['scrip_names'] = array();
            $data['margin_required'] = 0;
            $data['holding_status'] = 'No Trades';
        }

        $this->load->view('trade/portfolio', $data);
    }

    public function detail_scrip($scrip_name = null)
    {
        $data['get'] = $this->db->get_where('buy_sell_trades', array('scrip_id' => $scrip_name))->result_array();
        if (!empty($data['get'])) {
            $data['scrip_names'] = $this->getScripNames($data['get']);
        } else {
            $data['scrip_names'] = array();
        }

        $this->load->view('active_position/detail_active_position', $data);
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

    public function account()
    {
        $user_id = $this->session->userdata('id');
        $total_balance = $this->trade_model->getTotalAmount($user_id);
        $data['total_amount'] = $total_balance;
        $data['get_transaction_date'] = $this->db->select('transaction_date')
            ->where('user_id', $user_id)
            ->get('funds')
            ->result_array();
        $data['profile'] = $this->db->select('*')
            ->where('user_id', $user_id)
            ->get('equity_features')
            ->result_array();
        $data['trading_enabled'] = $this->db->select('*')
            ->where('user_id', $user_id)
            ->get('option_config')
            ->result_array();
        $data['mcx_enabled'] = $this->db->select('*')
            ->where('user_id', $user_id)
            ->get('mcx_features')
            ->result_array();
            // echo'<pre>';print_r($data['mcx_enabled']);die;
        $this->load->view('trade/account', $data);
    }
    public function update_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('new_password', 'New Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[new_password]');

            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post('old_password');
                $encryptCurrentPassword = $old_password;
                $check = $this->trade_model->checkCurrentPassword($encryptCurrentPassword);

                if ($check == true) {
                    $newPassword = md5($this->input->post('new_password'));
                    $encryptPassword = $newPassword;
                    $this->trade_model->updatePassword($encryptPassword);
                    $response = array(
                        'status' => 'success',
                        'message' => 'Password changed successfully'
                    );
                    $this->session->set_flashdata('success', 'Password changed successfully');
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Old Password is wrong'
                    );
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => validation_errors()
                );
            }

            echo json_encode($response);
        } else {
            redirect('account');
        }
    }

    public function add_fund()
    {
        $data = $this->input->post();
        $transaction_id = $this->trade_model->generate_transaction_id();
        $data['transaction_id'] = $transaction_id;

        $this->trade_model->add_fund($data);

        if ($data) {
            $this->session->set_flashdata('success', 'Fund added successfully.');
        } else {
            $this->session->set_flashdata('failed', 'Fund addition failed. Please try again.');
        }
        redirect('account');
    }
    public function withdrawal_fund()
    {
        $user_id = $this->session->userdata('id');
        $withdrawal_amount = $this->input->post('withdrawal_amount');
        $withdrawal_successful = $this->trade_model->withdrawAmount($user_id, $withdrawal_amount);
        if ($withdrawal_successful) {
            $this->session->set_flashdata('withdraw_success', 'Withdrawal successful.');
        } else {
            $this->session->set_flashdata('withdraw_failed', 'Insufficient funds for withdrawal.');
        }
        redirect('account');
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        redirect('trade');
    }
    public function explore()
    {
        $user_id = $this->session->userdata('id');
        $data['trade'] = $this->db->get('explore_trade_table')->result_array();
        // echo'<pre>';print_r($data['trade']);die;
        $this->load->view('trade/explore', $data);
    }
    public function downloadPDF()
    {
        $this->load->library('pdf');
        $html = $this->load->view('trade/GeneratePdfView', [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }
}