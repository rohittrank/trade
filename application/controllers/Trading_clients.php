<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trading_clients extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->_is_logged_in()) {
            redirect("Login");
        }
        $this->load->model('login_model');
        $this->load->model('trade_model');
    }
    public function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }
    public function index()
    {
        $username = $this->input->post('username');
        $amount = $this->input->post('amount');

        $conditions = array();

        if (!empty($username)) {
            $conditions['users.id'] = $username;
        }
        if (!empty($amount)) {
            $conditions['trader_funds.amount'] = $amount;
        }

        $this->db->select('users.*, config.*, mcx_features.*, equity_features.*, trader_funds.*')
            ->from('users')
            ->join('config', 'config.user_id = users.id', 'left')
            ->join('mcx_features', 'mcx_features.user_id = users.id', 'left')
            ->join('equity_features', 'equity_features.user_id = users.id', 'left')
            ->join('trader_funds', 'trader_funds.userid = users.id', 'left')
            ->where('users.user_role', 'user');

        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        $data['results'] = $this->db->get()->result();
        $data['get_all_clients'] = $this->login_model->getclientsData();
        $this->load->view('trading_cliends/trading-client', $data);
    }

    public function search()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('account_status', 'Option Value', 'required');

        $username = $this->input->post('username');
        $accountStatus = $this->input->post('account_status');
        $data['result'] = $this->login_model->searchClients($username, $accountStatus);
        if ($this->form_validation->run() == false) {
            $this->load->view('trading_cliends/trading-client-view', $data);
        } else {
            $this->load->view('trading_cliends/trading-client-view', $data);
        }
    }


    public function add_clients()
    {
        $data['get_all_data'] = $this->db->get('users')->result_array();
        $this->load->view('trading_cliends/create-trading-clients', $data);
    }
    public function duplicate_user($id)
    {

        $data['get_all_clients'] = $this->login_model->get_clients_data($id);

        $data['get_all_data'] = $this->db->get('users')->result_array();
        $this->load->view('trading_cliends/duplicate_user', $data);
    }

    public function insert_client()
    {
        $user_id = $this->session->userdata('id');
        $submittedPassword = $this->input->post('transaction_password');

        if ($this->checkTransactionPassword($user_id, $submittedPassword)) {
            $data = $this->input->post();
            $personal_details = array(
                'username' => $data['username'],
                'password' => md5($data['password']),
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'initial_funds' => $data['initial_funds'],
                'city' => $data['city'],
                'type' => 'user',
            );
            $this->db->insert('users', $personal_details);
            $user_id = $this->db->insert_id();

            $config = array(
                'user_id' => $user_id,
                'demo_account' => $data['demo_account'],
                'fresh_entry' => $data['fresh_entry'],
                'orders_between' => $data['orders_between'],
                'trade_equity' => $data['trade_equity'],
                'account_status' => $data['account_status'],
                'auto_close_trades_condition_met' => $data['auto_close_trades_condition_met'],
                'aut_close_all_active' => $data['aut_close_all_active'],
                'notify_client_Ledger_balance' => $data['notify_client_Ledger_balance'],
            );
            $this->db->insert('config', $config);
            $ledger_balance = $data['notify_client_Ledger_balance'];
            $auto_close_threshold = $data['aut_close_all_active'];
            $this->auto_close_trades($user_id, $ledger_balance, $auto_close_threshold);
            $next_execution = strtotime('+5 minutes');
            $this->schedule_task('send_loss_notifications', $next_execution, $user_id);

            $mcx_features = array(
                'user_id' => $user_id,
                'mcx_trading' => $data['mcx_trading'],
                'mcx_brokerage_type' => $data['mcx_brokerage_type'],
                'mcx_brokerage' => $data['mcx_brokerage'],
                'exposure_mcx_type' => $data['exposure_mcx_type'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'minimum_lot' => $data['minimum_lot'],
                'maximum_lot_per_single' => $data['maximum_lot_per_single'],
                'maximum_lot_per_script' => $data['maximum_lot_per_script'],
                'max_size' => $data['max_size'],
                'goldM' => $data['goldM'],
                'silverM' => $data['silverM'],
                'bulldex' => $data['bulldex'],
                'gold' => $data['gold'],
                'silver' => $data['silver'],
                'crudeoil' => $data['crudeoil'],
                'cooper' => $data['cooper'],
                'nickel' => $data['nickel'],
                'zinc' => $data['zinc'],
                'lead' => $data['lead'],
                'naturalgas' => $data['naturalgas'],
                'naturalgas_mini' => $data['naturalgas_mini'],
                'aluminium' => $data['aluminium'],
                'methanoil' => $data['methanoil'],
                'cotton' => $data['cotton'],
                'silvermic' => $data['silvermic'],
                'zincmini' => $data['zincmini'],
                'alumini' => $data['alumini'],
                'lead_mini' => $data['lead_mini'],
                'crudeoil_mini' => $data['crudeoil_mini'],
            );
            $this->db->insert('mcx_features', $mcx_features);

            $equity_features = array(
                'user_id' => $user_id,
                'equity_trading' => $data['equity_trading'],
                'equity_brokerage' => $data['equity_brokerage'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'transaction_password' => $data['transaction_password'],
                'min_lot_size_equity' => $data['min_lot_size_equity'],
                'max_lot_size_equity' => $data['max_lot_size_equity'],
                'min_lot_size_equity_index' => $data['min_lot_size_equity_index'],
                'max_lot_size_equity_index' => $data['max_lot_size_equity_index'],
                'max_lot_size_active_equity' => $data['max_lot_size_active_equity'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity' => $data['holding_exposure_equity'],
                'order_away_percentage' => $data['order_away_percentage']
            );
            $this->db->insert('equity_features', $equity_features);

            $options_features = array(
                'user_id' => $user_id,
                'options_trading' => $data['options_trading'],
                'options_brokerage_type' => $data['options_brokerage_type'],
                'options_brokerage' => $data['options_brokerage'],
                'options_min_bid_price' => $data['options_min_bid_price'],
                'options_short_selling' => $data['options_short_selling'],
                'min_lot_size_equity_options' => $data['min_lot_size_equity_options'],
                'max_lot_size_equity_options' => $data['max_lot_size_equity_options'],
                'min_lot_size_index_options' => $data['min_lot_size_index_options'],
                'max_lot_size_index_options' => $data['max_lot_size_index_options'],
                'max_lot_size_active_equity_index' => $data['max_lot_size_active_equity_index'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity_option' => $data['holding_exposure_equity_option'],
                'order_away_percentage_option' => $data['order_away_percentage_option'],
            );
            $this->db->insert('option_config', $options_features);

            $others = array(
                'user_id' => $user_id,
                'notes' => $data['notes'],
                'broker' => $data['broker'],
                'transaction_password' => $data['transaction_password']
            );
            $this->db->insert('others', $others);

            $this->session->set_flashdata('success', 'Clients created successfully.');
            redirect('trading-clients/create-trading-clients');
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trading-clients/create-trading-clients');
        }
    }
    public function send_loss_notifications()
    {
        $user_id = $this->session->userdata('id');
        $user = $this->db
            ->select('ledger_balance, aut_close_all_active')
            ->from('config')
            ->where('user_id', $user_id)
            ->get()
            ->row();

        $ledger_balance = $user->ledger_balance;
        $auto_close_threshold = $user->aut_close_all_active;

        $losses = 90;

        if (($ledger_balance - $losses) < ($auto_close_threshold / 100) * $ledger_balance) {
            $this->session->set_flashdata('notification', 'Your losses have crossed the threshold.');

            $next_execution = strtotime('+5 minutes');
            $this->schedule_task('send_loss_notifications', $next_execution, $user_id);
        }
    }
    private function schedule_task($task_name, $next_execution, $user_id)
    {
        $task_data = array(
            'task_name' => $task_name,
            'next_execution' => $next_execution,
            'user_id' => $user_id,
        );
        $this->db->insert('scheduled_tasks', $task_data);
    }

    private function auto_close_trades($user_id, $ledger_balance, $auto_close_threshold)
    {
        $threshold_amount = ($auto_close_threshold / 100) * $ledger_balance;
        $trades = $this->db->get_where('buy_sell_trades', array('user_id' => $user_id, 'status' => 'active'))->result_array();
        foreach ($trades as $trade) {
            $losses = ($trade['bid'] - $trade['last']) * $trade['lot'];
            if ($losses >= $threshold_amount) {
                $this->db->where('id', $trade['id']);
                $this->db->update('buy_sell_trades', array('status' => 'closed'));
            }
        }
    }
    public function duplicate_insert_user($user_id)
    {
        $userid = $this->session->userdata('id');

        $submittedPassword = $this->input->post('transaction_password');
        if ($this->checkTransactionPassword($userid, $submittedPassword)) {
            // echo'su';die;
            $data = $this->input->post();
            $personal_details = array(
                'username' => $data['username'],
                'password' => $data['password'],
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'initial_funds' => $data['initial_funds'],
                'city' => $data['city'],
                'type' => 'user',

            );
            $this->db->insert('users', $personal_details);

            $user_id = $this->db->insert_id();

            $config = array(
                'user_id' => $user_id,
                'demo_account' => isset($data['demo_account']) ? $data['demo_account'] : null,
                'fresh_entry' => isset($data['fresh_entry']) ? $data['fresh_entry'] : null,
                'orders_between' => isset($data['orders_between']) ? $data['orders_between'] : null,
                'trade_equity' => isset($data['trade_equity']) ? $data['trade_equity'] : null,
                'account_status' => isset($data['account_status']) ? $data['account_status'] : null,
                'auto_close_trades_condition_met' => isset($data['auto_close_trades_condition_met']) ? $data['auto_close_trades_condition_met'] : null,
                'aut_close_all_active' => isset($data['aut_close_all_active']) ? $data['aut_close_all_active'] : null,
                'notify_client_Ledger_balance' => isset($data['notify_client_Ledger_balance']) ? $data['notify_client_Ledger_balance'] : null,
            );
            $this->db->insert('config', $config);

            $mcx_features = array(
                'user_id' => $user_id,
                'mcx_trading' => $data['mcx_trading'],
                'mcx_brokerage_type' => $data['mcx_brokerage_type'],
                'mcx_brokerage' => $data['mcx_brokerage'],
                'exposure_mcx_type' => $data['exposure_mcx_type'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'minimum_lot' => $data['minimum_lot'],
                'maximum_lot_per_single' => $data['maximum_lot_per_single'],
                'maximum_lot_per_script' => $data['maximum_lot_per_script'],
                'max_size' => $data['max_size'],
                'mcx_brokerage_type' => $data['mcx_brokerage_type'],
                'mcx_brokerage' => $data['mcx_brokerage'],
                'exposure_mcx_type' => $data['exposure_mcx_type'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'goldM' => $data['goldM'],
                'silverM' => $data['silverM'],
                'bulldex' => $data['bulldex'],
                'gold' => $data['gold'],
                'silver' => $data['silver'],
                'crudeoil' => $data['crudeoil'],
                'cooper' => $data['cooper'],
                'nickel' => $data['nickel'],
                'zinc' => $data['zinc'],
                'lead' => $data['lead'],
                'naturalgas' => $data['naturalgas'],
                'naturalgas_mini' => $data['naturalgas_mini'],
                'aluminium' => $data['aluminium'],
                'methanoil' => $data['methanoil'],
                'cotton' => $data['cotton'],
                'silver' => $data['silver'],
                'silvermic' => $data['silvermic'],
                'zincmini' => $data['zincmini'],
                'alumini' => $data['alumini'],
                'lead_mini' => $data['lead_mini'],
                'crudeoil_mini' => $data['crudeoil_mini'],
            );
            $this->db->insert('mcx_features', $mcx_features);

            $equity_features = array(
                'user_id' => $user_id,
                'equity_trading' => $data['equity_trading'],
                'equity_brokerage' => $data['equity_brokerage'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'transaction_password' => $data['transaction_password'],
                'min_lot_size_equity' => $data['min_lot_size_equity'],
                'max_lot_size_equity' => $data['max_lot_size_equity'],
                'min_lot_size_equity_index' => $data['min_lot_size_equity_index'],
                'max_lot_size_equity_index' => $data['max_lot_size_equity_index'],
                'max_lot_size_active_equity' => $data['max_lot_size_active_equity'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity' => $data['holding_exposure_equity'],
                'order_away_percentage' => $data['order_away_percentage']
            );
            $this->db->insert('equity_features', $equity_features);

            $equity_features = array(
                'user_id' => $user_id,
                'options_trading' => $data['options_trading'],
                'options_brokerage_type' => $data['options_brokerage_type'],
                'options_brokerage' => $data['options_brokerage'],
                'options_min_bid_price' => $data['options_min_bid_price'],
                'options_short_selling' => $data['options_short_selling'],
                'min_lot_size_equity_options' => $data['min_lot_size_equity_options'],
                'max_lot_size_equity_options' => $data['max_lot_size_equity_options'],
                'min_lot_size_index_options' => $data['min_lot_size_index_options'],
                'max_lot_size_index_options' => $data['max_lot_size_index_options'],
                'max_lot_size_active_equity_index' => $data['max_lot_size_active_equity_index'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity_option' => $data['holding_exposure_equity_option'],
                'order_away_percentage_option' => $data['order_away_percentage_option'],
            );
            $this->db->insert('option_config', $equity_features);

            $equity_features = array(
                'user_id' => $user_id,
                'notes' => $data['notes'],
                'broker' => $data['broker'],
                'transaction_password' => $data['transaction_password']
            );
            $this->db->insert('others', $equity_features);
            $this->session->set_flashdata('success', 'Clients created successfully.');
            redirect('trading_clients/duplicate_user/' . $user_id);
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trading_clients/duplicate_user/' . $user_id);
        }
    }
    public function clients_view($id)
    {
        $cleint_data['cleint_data'] = $this->login_model->get_user_data($id);
        $this->load->view('trading_cliends/create-cleint-view', $cleint_data);
    }

    public function edit_cleint_view($id)
    {
        $cleint_data['cleint_data'] = $this->login_model->edit_cleint_data($id);
        $this->load->view('cleint/edit_cleint', $cleint_data);
    }

    public function update_client($user_id)
    {
        $userid = $this->session->userdata('id');
        $submittedPassword = $this->input->post('transaction_password');
        if ($this->checkTransactionPassword($userid, $submittedPassword)) {
            $data = $this->input->post();
            $personal_details = array(
                'username' => $data['username'],
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'initial_funds' => $data['initial_funds'],
                'city' => $data['city'],
                'type' => 'user',
            );
            $this->db->where('id', $user_id);
            $this->db->update('users', $personal_details);

            $config = array(
                'user_id' => $user_id,
                'demo_account' => isset($data['demo_account']) ? $data['demo_account'] : null,
                'fresh_entry' => isset($data['fresh_entry']) ? $data['fresh_entry'] : null,
                'orders_between' => isset($data['orders_between']) ? $data['orders_between'] : null,
                'trade_equity' => isset($data['trade_equity']) ? $data['trade_equity'] : null,
                'account_status' => isset($data['account_status']) ? $data['account_status'] : null,
                'auto_close_trades_condition_met' => isset($data['auto_close_trades_condition_met']) ? $data['auto_close_trades_condition_met'] : null,
                'aut_close_all_active' => isset($data['aut_close_all_active']) ? $data['aut_close_all_active'] : null,
                'notify_client_Ledger_balance' => isset($data['notify_client_Ledger_balance']) ? $data['notify_client_Ledger_balance'] : null,
            );

            $this->db->where('user_id', $user_id);
            $this->db->update('config', $config);

            $mcx_features = array(
                'user_id' => $user_id,
                'mcx_trading' => $data['mcx_trading'],
                'mcx_brokerage_type' => $data['mcx_brokerage_type'],
                'mcx_brokerage' => $data['mcx_brokerage'],
                'exposure_mcx_type' => $data['exposure_mcx_type'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'minimum_lot' => $data['minimum_lot'],
                'maximum_lot_per_single' => $data['maximum_lot_per_single'],
                'maximum_lot_per_script' => $data['maximum_lot_per_script'],
                'max_size' => $data['max_size'],
                'goldM' => $data['goldM'],
                'silverM' => $data['silverM'],
                'bulldex' => $data['bulldex'],
                'gold' => $data['gold'],
                'silver' => $data['silver'],
                'crudeoil' => $data['crudeoil'],
                'cooper' => $data['cooper'],
                'nickel' => $data['nickel'],
                'zinc' => $data['zinc'],
                'lead' => $data['lead'],
                'naturalgas' => $data['naturalgas'],
                'naturalgas_mini' => $data['naturalgas_mini'],
                'aluminium' => $data['aluminium'],
                'methanoil' => $data['methanoil'],
                'cotton' => $data['cotton'],
                'silver' => $data['silver'],
                'silvermic' => $data['silvermic'],
                'zincmini' => $data['zincmini'],
                'alumini' => $data['alumini'],
                'lead_mini' => $data['lead_mini'],
                'crudeoil_mini' => $data['crudeoil_mini'],
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('mcx_features', $mcx_features);

            $equity_features = array(
                'user_id' => $user_id,
                'equity_trading' => $data['equity_trading'],
                'equity_brokerage' => $data['equity_brokerage'],
                'intraday_exposure' => $data['intraday_exposure'],
                'holding_exposure' => $data['holding_exposure'],
                'transaction_password' => $data['transaction_password'],
                'min_lot_size_equity' => $data['min_lot_size_equity'],
                'max_lot_size_equity' => $data['max_lot_size_equity'],
                'min_lot_size_equity_index' => $data['min_lot_size_equity_index'],
                'max_lot_size_equity_index' => $data['max_lot_size_equity_index'],
                'max_lot_size_active_equity' => $data['max_lot_size_active_equity'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity' => $data['holding_exposure_equity'],
                'order_away_percentage' => $data['order_away_percentage']
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('equity_features', $equity_features);

            $option_config = array(
                'user_id' => $user_id,
                'options_trading' => $data['options_trading'],
                'options_brokerage_type' => $data['options_brokerage_type'],
                'options_brokerage' => $data['options_brokerage'],
                'options_min_bid_price' => $data['options_min_bid_price'],
                'options_short_selling' => $data['options_short_selling'],
                'min_lot_size_equity_options' => $data['min_lot_size_equity_options'],
                'max_lot_size_equity_options' => $data['max_lot_size_equity_options'],
                'min_lot_size_index_options' => $data['min_lot_size_index_options'],
                'max_lot_size_index_options' => $data['max_lot_size_index_options'],
                'max_lot_size_active_equity_index' => $data['max_lot_size_active_equity_index'],
                'max_size_all_equity' => $data['max_size_all_equity'],
                'max_size_all_index' => $data['max_size_all_index'],
                'intraday_exposure_equity' => $data['intraday_exposure_equity'],
                'holding_exposure_equity_option' => $data['holding_exposure_equity_option'],
                'order_away_percentage_option' => $data['order_away_percentage_option'],
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('option_config', $option_config);

            $equity_features = array(
                'user_id' => $user_id,
                'notes' => $data['notes'],
                'broker' => $data['broker'],
                'transaction_password' => $data['transaction_password']
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('others', $equity_features);

            $this->session->set_flashdata('success', 'Trading Clients Updated successfully.');
            redirect('trading_clients/edit_clients/' . $user_id);
            redirect('trading-clients');
        } else {
            $this->session->set_flashdata('error', 'Transaction password is incorrect.');

            redirect('trading_clients/edit_clients/' . $user_id);
        }
    }
    public function delete($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->delete('users');

        $this->db->where('user_id', $user_id);
        $this->db->delete('config');

        $this->db->where('user_id', $user_id);
        $this->db->delete('others');

        $this->db->where('user_id', $user_id);
        $this->db->delete('permissions');

        $this->db->where('user_id', $user_id);
        $this->db->delete('mcx_features');

        $this->session->set_flashdata('success', 'Trading Clients deleted successfully.');
        redirect('trading-clients');
    }

    public function nullAllValuesById($id)
    {
        error_reporting(0);

        $data = $this->input->post();

        $personal_details = array(
            'mobile' => $data['mobile'],
            'initial_funds' => $data['initial_funds'],
            'city' => $data['city'],
            'type' => 'user',
        );

        $this->db->where('id', $id);
        $this->db->update('users', $personal_details);

        $config = array(
            'user_id' => $id,
            'demo_account' => null,
            'fresh_entry' => null,
            'orders_between' => null,
            'trade_equity' => null,
            'account_status' => null,
            'auto_close_trades_condition_met' => null,
            'aut_close_all_active' => null,
            'notify_client_Ledger_balance' => null,
        );

        $this->db->where('user_id', $id);
        $this->db->update('config', $config);

        $mcx_features = array(
            'user_id' => $id,
            'mcx_trading' => null,
            'mcx_brokerage_type' => null,
            'mcx_brokerage' => null,
            'exposure_mcx_type' => null,
            'intraday_exposure' => null,
            'holding_exposure' => null,
            'minimum_lot' => null,
            'maximum_lot_per_single' => null,
            'maximum_lot_per_script' => null,
            'max_size' => null,
            'goldM' => null,
            'silverM' => null,
            'bulldex' => null,
            'gold' => null,
            // 'silver1' => null,
            'crudeoil' => null,
            'cooper' => null,
            'nickel' => null,
            'zinc' => null,
            'lead' => null,
            'naturalgas' => null,
            'naturalgas_mini' => null,
            'aluminium' => null,
            'methanoil' => null,
            'cotton' => null,
            // 'silver2' => null,
            'silvermic' => null,
            'zincmini' => null,
            'alumini' => null,
            'lead_mini' => null,
            'crudeoil_mini' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('mcx_features', $mcx_features);

        $equity_features = array(
            'user_id' => $id,
            'equity_trading' => null,
            'equity_brokerage' => null,
            'intraday_exposure' => null,
            'holding_exposure' => null,
            'transaction_password' => null,
            'min_lot_size_equity' => null,
            'max_lot_size_equity' => null,
            'min_lot_size_equity_index' => null,
            'max_lot_size_equity_index' => null,
            'max_lot_size_active_equity' => null,
            'max_size_all_equity' => null,
            'max_size_all_index' => null,
            'intraday_exposure_equity' => null,
            'holding_exposure_equity' => null,
            'order_away_percentage' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('equity_features', $equity_features);

        $option_config = array(
            'user_id' => $id,
            'options_trading' => null,
            'options_brokerage_type' => null,
            'options_brokerage' => null,
            'options_min_bid_price' => null,
            'options_short_selling' => null,
            'min_lot_size_equity_options' => null,
            'max_lot_size_equity_options' => null,
            'min_lot_size_index_options' => null,
            'max_lot_size_index_options' => null,
            'max_lot_size_active_equity_index' => null,
            'max_size_all_equity' => null,
            'max_size_all_index' => null,
            'intraday_exposure_equity' => null,
            'holding_exposure_equity_option' => null,
            'order_away_percentage_option' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('option_config', $option_config);

        $brokerage_data = array(
            'user_id' => $id,
            'company_id' => null,
            'scrip_id' => null,
            'bidprice' => null,
            'lot' => null,
            'action' => null,
            'status' => null,
            'buy_rate' => null,
            'sell_rate' => null,
            'order_created_by' => null,
            'created_at' => null,
            'sell_ip' => null,
            'buy_ip' => null,
            'sell_at' => null,
            'bought_at' => null,
            'modified_at' => null,
            'deleted_at' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('buy_sell_trades', $brokerage_data);

        $others = array(
            'user_id' => $id,
            'notes' => null,
            'broker' => null,
            'transaction_password' => null
        );
        $this->db->where('user_id', $id);
        $this->db->update('others', $others);

        $wallet = array(
            'user_id' => $id,
            'amount' => '0',
            'withdraw_amount' => '0',
            'total_amount' => '0',
            'created_at' => null,
            'transaction_date' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('funds', $wallet);

        $transaction_history = array(
            'user_id' => $id,
            'amount' => '0',
            'type' => null,
            'transaction_date' => null,
        );
        $this->db->where('user_id', $id);
        $this->db->update('transaction_history', $transaction_history);

        $this->session->set_flashdata('success', 'Account Reset Successfully');
        redirect('trading_clients/mcx_users_view/' . $id);
    }


    public function create_funds_withdrawal($id)
    {
        $cleint_data['client_data'] = $this->login_model->get_clients_data($id);
        $this->load->view('trading_cliends/fund_withdrawal', $cleint_data);
    }

    public function save_funds_withdrawal($user_id)
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
            $withdrawal_amount = $this->input->post('withdrawal_amount');
            $this->load->model('trade_model');
            $withdrawal_successful = $this->trade_model->withdrawAmount($user_id, $withdrawal_amount);
            $this->session->set_flashdata('success', 'Funds Withdrawal Successfully.');
            redirect('trading_clients/create_funds_withdrawal/' . $user_id);
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trading_clients/create_funds_withdrawal/' . $user_id);
        }
    }
    public function add_funds($id)
    {
        $cleint_data['client_data'] = $this->login_model->get_clients_data($id);
        $this->load->view('trading_cliends/add_fund', $cleint_data);
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
            unset($data['transaction_pass']);

            $insertData = array(
                'user_id' => $user_id,
                'amount' => $data['amount'],
                'notes' => $data['notes'],
                'transaction_date' => date('d-m-Y')
            );

            $this->load->model('trade_model');
            $this->trade_model->add_fund_from_admin($insertData);

            $this->session->set_flashdata('success', 'Fund Created Successfully.');
            redirect('trading_clients/add_funds/' . $user_id);
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trading_clients/add_funds/' . $user_id);
        }
    }
    public function edit_clients($id)
    {
        $data['get_all_clients'] = $this->login_model->get_clients_data($id);
        $data['get_all_data'] = $this->db->get('users')->result_array();
        $this->load->view('trading_cliends/edit-trading-clients', $data);
    }
    public function mcx_users_view($id)
    {
        $data['get_all_clients'] = $this->login_model->get_clients_data($id);
        $data['get_all_trades'] = $this->login_model->get_trades_data($id);
        $data['transaction_history'] = $this->db->get_where('transaction_history', array('user_id' => $id))->result_array();

        $this->load->view('trading_cliends/mcxusers-views', $data);
    }

    public function change_user_password($id)
    {
        $data['get_all_clients'] = $this->login_model->get_clients_data($id);
        $this->load->view('trading_cliends/change_user_password', $data);
    }

    public function update_password($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('new_password', 'New Password', 'required');
            $this->form_validation->set_rules('transaction_password', 'Transaction Password', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('Login_model');
                $user_id = $this->session->userdata('id');
                $transaction_password = $this->input->post('transaction_password');

                $password = $this->Login_model->get_user_transaction_password($user_id);
                if ($password) {
                    $submit_password = $password->transaction_password;
                    if ($submit_password === $transaction_password) {
                        $new_password = $this->input->post('new_password');
                        $this->Login_model->update_user_password($id, $new_password);

                        $this->session->set_flashdata('success', 'Password changed successfully');
                        redirect('change-user-password/' . $id);
                    } else {
                        $this->session->set_flashdata('error', 'Incorrect Transaction Password');
                        redirect('change-user-password/' . $id);
                    }
                } else {
                    $this->session->set_flashdata('error', 'User ID not found');
                }
            }
        } else {
            redirect('trading-clients');
        }
    }

    public function reset($user_id)
    {
        $this->load->model('login_model');
        $this->load->library('session');

        $user = $this->login_model->get_user_by_id($user_id);
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('trading-clients');
        }

        $this->login_model->reset_account($user_id);

        $this->session->set_flashdata('success', 'Account reset successfully.');
        redirect('users');
    }
    public function downloadpdf($id)
    {
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $data = array(
            'from_date' => $from_date,
            'to_date' => $to_date
        );

        $this->session->set_userdata($data);

        $from_date = $this->session->userdata('from_date');
        $to_date = $this->session->userdata('to_date');

        $this->load->model('login_model');

        $data['get_all_clients'] = $this->login_model->get_clients_data_by_dates($id, $from_date, $to_date);
        $data['get_fund'] = $this->login_model->get_funds_data_by_dates($id, $from_date, $to_date);

        $this->db->select('*');
        $this->db->from('buy_sell_trades');
        $this->db->join('trading_table', 'buy_sell_trades.scrip_id = trading_table.scrip_id');
        $this->db->where('buy_sell_trades.user_id', $id);
        $this->db->where('buy_sell_trades.created_at >=', $from_date . ' 00:00:00');
        $this->db->where('buy_sell_trades.created_at <=', $to_date . ' 23:59:59');
        $data['get_all_trades'] = $this->db->get()->result_array();

        $this->load->library('pdf');

        $pdfFilePath = 'mypdf.pdf';

        $html = $this->load->view('trading_cliends/GeneratePdfView', $data, true);
        $this->pdf->createPDF($html, $pdfFilePath, false);

        if (file_exists($pdfFilePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($pdfFilePath) . '"');
            header('Content-Length: ' . filesize($pdfFilePath));
            readfile($pdfFilePath);
            exit;
        }
    }


    public function export_funds($user_id)
    {
        $this->load->database();
        $this->load->helper('csv');
        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');

        $fromDateFormatted = date('Y-m-d', strtotime($fromDate));
        $toDateFormatted = date('Y-m-d', strtotime($toDate));

        $this->db->where('transaction_history.transaction_date >=', $fromDateFormatted . ' 00:00:00');
        $this->db->where('transaction_history.transaction_date <=', $toDateFormatted . ' 23:59:59');
        $data = $this->db->select('*')
            ->from('transaction_history')
            ->where('user_id', $user_id)
            ->get()
            ->result_array();

        $filename = 'Funds' . date('Ymd') . '.csv';
        $headers = array('ID', 'Amount', 'Type', 'Transaction_date');

        $content = array();
        array_push($content, $headers);
        foreach ($data as $row) {
            $line = array(
                $row['id'],
                $row['amount'],
                $row['type'],
                $row['transaction_date'],
            );
            array_push($content, $line);
        }
        array_to_csv($content, $filename);
    }

    public function export_trade($user_id)
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
            ->where('user_id', $user_id)
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

    private function checkTransactionPassword($user_id, $submittedPassword)
    {
        $user = $this->db
            ->select('transaction_password')
            ->from('users')
            ->where('users.id', $user_id)
            ->get()
            ->row();

        $storedPassword = $user->transaction_password;

        return $submittedPassword === $storedPassword;
    }
}
