<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pending_orders extends CI_Controller
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
		$data['get_pending_data'] = $this->login_model->get_all_pending_data();
		$this->db->select('buy_sell_trades.*, trading_table.*');
		$this->db->from('buy_sell_trades');
		$this->db->join('trading_table', 'trading_table.scrip_id = buy_sell_trades.scrip_id');
		$this->db->where('buy_sell_trades.status', 'pending');
		$this->db->order_by('buy_sell_trades.id', 'desc');
		$data['scrips'] = $this->db->get()->result_array();

		$this->load->view('pending_orders/pending-order', $data);
	}

	public function create($user_id = null) {
		$user_id = $this->session->userdata('id');
		$data['get_all_data'] = $this->db->get('users')->result_array();
		$this->db->select('buy_sell_trades.scrip_id, trading_table.*');
		$this->db->from('buy_sell_trades');
		$this->db->join('trading_table', 'trading_table.scrip_id = buy_sell_trades.scrip_id');
		$data['scrips'] = $this->db->get()->result_array();
		$this->load->library('form_validation');
		$data['get_drop'] = $this->db->get('trading_table')->result();
	
		$data['scrip_names'] = (!empty($data['get_drop'])) ? $this->getScripNames($data['get_drop']) : array();
	
		$this->form_validation->set_rules('lot', 'Lots/Units', 'required');
		$this->form_validation->set_rules('order_ask_price', 'Price', 'required');
	
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('pending_orders/create-pending-order', $data);
		} else {
			$transaction_password = $this->input->post('transaction_password');
			$user = $this->db
				->select('transaction_password')
				->from('users')
				->where('id', $user_id)
				->get()
				->row();
	
			if ($user && isset($user->transaction_password)) {
				$submit_password = $user->transaction_password;
				$order_ask_price = $this->input->post('order_ask_price');
				$buy_rate = $order_ask_price;
				$scrip_id = $this->input->post('scrip_id');
				$query = $this->db->select('last')->where('scrip_id', $scrip_id)->get('trading_table')->row_array();
				$bidPriceFromDatabase = $query['last'];
	
				$status = ($order_ask_price != $bidPriceFromDatabase) ? 'pending' : 'active';
				if ($transaction_password === $submit_password) {
					$data = $this->input->post();
					$data['order_created_by'] = 'admin';
					$data['status'] = $status;
					$data['buy_rate'] = $buy_rate;
					$data['market_type'] = 'order';
					$data['bought_at'] = date('Y-m-d H:i:s');
					unset($data['transaction_password']);
					$this->login_model->save_pending_orders($data);
					$this->session->set_flashdata('success', 'Pending orders created successfully');
					redirect('pending-orders/create-pending-order');
				} else {
					$this->session->set_flashdata('terror', 'Transaction password does not match.');
					redirect(base_url('pending-orders/create-pending-order'));
				}
			} else {
				$this->session->set_flashdata('terror', 'User not found or transaction password not set.');
				redirect(base_url('pending-orders/create-pending-order'));
			}
		}
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
	public function order_view($id)
	{
		$data['get_pending'] = $this->db->where('id', $id)->get('buy_sell_trades')->row_array();
		// echo'<pre>';print_r($data['get_pending']);die;
		$this->load->view('pending_orders/pending-order-view', $data);
	}

	public function delete_pending_data($id)
	{
		$this->login_model->delete_pending_data($id);
		$this->session->set_flashdata('success', 'Pending order deleted successfully');
		redirect('pending-orders');
	}
}