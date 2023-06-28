<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->_is_logged_in()) {
			redirect("Login");
		}
		$this->load->model('login_model');
	}
	public function _is_logged_in()
	{
		return $this->session->has_userdata('username');
	}
	public function index()
	{
		$user_id = $this->session->userdata('username');
		// print_r($user_id);die;
		$data['usersdata'] = $this->login_model->getUsersData($user_id);
		// echo'<pre>';print_r($data['usersdata']);die;
		$this->load->view('user/user', $data);
	}
	public function create()
	{
		$this->load->view('user/create-user');
	}

	public function insert_user()
	{
		$data = $this->input->post();

		$personal_details = array(
			'username' => $data['username'],
			'password' => $data['password'],
			'transaction_password' => $data['transaction_password'],
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'type' => $data['type'],
			'user_role' => 'superadmin'
		);
     
	
		$this->db->insert('users', $personal_details);

		$user_id = $this->db->insert_id();

		$config = array(
			'user_id' => $user_id,
			'application_status' => $data['application_status'],
			'config_active' => $data['config_active'],
			'config_notifty' => $data['config_notifty'],
			'profit_loss' => $data['profit_loss'],
			'brokerage_share' => $data['brokerage_share'],
			'trading_clients' => $data['trading_clients'],
			'sub_broker' => $data['sub_broker']
		);
		$this->db->insert('config', $config);

		// Insert data into another table
		$permissions = array(
			'user_id' => $user_id,
			'sub_broker_actions' => $data['sub_broker_actions'],
			'payinAllowed' => $data['payinAllowed'],
			'payoutAllowed' => $data['payoutAllowed'],
			'createClientsAllowed' => $data['createClientsAllowed'],
			'clientTasksAllowed' => $data['clientTasksAllowed'],
			'tradeActivityAllowed' => $data['tradeActivityAllowed'],
			'notificationsAllowed' => $data['notificationsAllowed']
		);
		$this->db->insert('permissions', $permissions);

		// Insert data into another table
		$mcx_features = array(
			'user_id' => $user_id,
			'mcx_trading' => $data['mcx_trading'],
			'mcx_brokerage_type' => $data['mcx_brokerage_type'],
			'mcx_brokerage' => $data['mcx_brokerage'],
			'exposure_mcx_type' => $data['exposure_mcx_type'],
			'intraday_exposure' => $data['intraday_exposure'],
			'holding_exposure' => $data['holding_exposure']
		);
		$this->db->insert('mcx_features', $mcx_features);

		$equity_features = array(
			'user_id' => $user_id,
			'equity_trading' => $data['equity_trading'],
			'equity_brokerage' => $data['equity_brokerage'],
			'intraday_exposure' => $data['intraday_exposure'],
			'holding_exposure' => $data['holding_exposure'],
			'transaction_password' => $data['transaction_password']
		);
		$this->db->insert('equity_features', $equity_features);

		$this->session->set_flashdata('success', 'User created successfully.');

		redirect('User');
	}
	public function user_view($id)
	{
		$user_data['user_data'] = $this->login_model->get_user_data($id);
		$this->load->view('user/create-user-view', $user_data);
	}

	public function edit_user_view($id)
	{
		$user_data['user_data'] = $this->login_model->edit_user_data($id);
		// echo'<pre>';print_r($user_data);die;
		$this->load->view('user/edit_user', $user_data);
	}

	public function update_user($user_id)
	{
		// print_r($user_id);die;
		$data = $this->input->post();
		$personal_details = array(
			'user_id' => $user_id,
			'username' => $data['username'],
			'password' => $data['password'],
			'transaction_password' => $data['transaction_password'],
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'type' => $data['type'],
		);
		$this->session->set_userdata('LoginSession', $personal_details);
		$this->db->where('id', $user_id);
		$this->db->update('users', $personal_details);

		$config = array(
			'user_id' => $user_id,
			'application_status' => $data['application_status'],
			'config_active' => $data['config_active'],
			'config_notifty' => $data['config_notifty'],
			'profit_loss' => $data['profit_loss'],
			'brokerage_share' => $data['brokerage_share'],
			'trading_clients' => $data['trading_clients'],
			'sub_broker' => $data['sub_broker']
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('config', $config);

		$permissions = array(
			'user_id' => $user_id,
			'sub_broker_actions' => $data['sub_broker_actions'],
			'payinAllowed' => $data['payinAllowed'],
			'payoutAllowed' => $data['payoutAllowed'],
			'createClientsAllowed' => $data['createClientsAllowed'],
			'clientTasksAllowed' => $data['clientTasksAllowed'],
			'tradeActivityAllowed' => $data['tradeActivityAllowed'],
			'notificationsAllowed' => $data['notificationsAllowed']
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('permissions', $permissions);

		$mcx_features = array(
			'user_id' => $user_id,
			'mcx_trading' => $data['mcx_trading'],
			'mcx_brokerage_type' => $data['mcx_brokerage_type'],
			'mcx_brokerage' => $data['mcx_brokerage'],
			'exposure_mcx_type' => $data['exposure_mcx_type'],
			'intraday_exposure' => $data['intraday_exposure'],
			'holding_exposure' => $data['holding_exposure']
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('mcx_features', $mcx_features);

		$equity_features = array(
			'user_id' => $user_id,
			'equity_trading' => $data['equity_trading'],
			'equity_brokerage' => $data['equity_brokerage'],
			'intraday_exposure' => $data['intraday_exposure'],
			'holding_exposure' => $data['holding_exposure'],
			'transaction_password' => $data['transaction_password']
		);
		$this->db->where('user_id', $user_id);
		$this->db->update('equity_features', $equity_features);

		$this->session->set_flashdata('success', 'User Updated successfully.');
		redirect('user');
	}
	public function delete($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete('users');

		$this->db->where('user_id', $user_id);
		$this->db->delete('config');

		$this->db->where('user_id', $user_id);
		$this->db->delete('permissions');

		$this->db->where('user_id', $user_id);
		$this->db->delete('mcx_features');

		$this->session->set_flashdata('success', 'User deleted successfully.');
		redirect('User');
	}

	public function search()
	{
		$this->form_validation->set_rules('search', 'Username', 'required');
    
		if ($this->form_validation->run() === true) {

		$search = $this->input->post('search');
		$this->load->model('login_model');
		$data['results'] = $this->login_model->search_user($search);
		$this->load->view('user/search_results', $data);
	}
	else{
		// echo'hi';die;
		 redirect('user');
	}
}
}