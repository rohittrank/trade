<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trader_funds extends CI_Controller
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

    private function _is_logged_in()
    {
        return $this->session->has_userdata('username');
    }

    public function index()
    {
        $userid = $this->input->post('userid');
        $amount = $this->input->post('amount');

        $conditions = array();

        if (!empty($userid)) {
            $conditions['users.id'] = $userid;
        }
        if (!empty($amount)) {
            $conditions['trader_funds.fund'] = $amount;
        }

        $this->db->select('trader_funds.id, trader_funds.*, users.*')
            ->from('trader_funds')
            ->join('users', 'users.id = trader_funds.userid');

        if (!empty($conditions)) {
            $this->db->where($conditions);
        }

        $data['get_all_funds'] = $this->db->get()->result_array();
        $this->load->view('Trader_funds/funds', $data);
    }

    public function create()
    {
        $data['get_drop'] = $this->db->get('users')->result_array();
        $this->load->view('Trader_funds/new-fund', $data);
    }

    public function save_create($user_id)
    {
        $submittedPassword = $this->input->post('transaction_password');
        // echo'<pre>';print_r($submittedPassword);
        $user = $this->db
            ->select('users.*')
            ->from('users')
            ->where('users.id', $user_id)
            ->get()
            ->row();

        $storedPassword = $user->transaction_password;
// echo'<pre>';print_r($storedPassword);die;
        if ($submittedPassword === $storedPassword) {
            $data = $this->input->post();
            $this->login_model->insert_funds($data);
            $this->session->set_flashdata('success', 'Trader funds crated Successfully.');
            redirect('trader_funds');
        } else {
            $this->session->set_flashdata('error', 'Transaction password does not match.');
            redirect('trader_funds/create/' . $user_id);
        }
    }

    public function funds_view($id)
    {
        $this->db->select('users.id, users.*, trader_funds.*')
            ->from('trader_funds')
            ->join('users', 'users.id = trader_funds.userid')
            ->where('users.id', $id);

        $data['get_all_funds'] = $this->db->get()->result_array();

        $this->load->view('Trader_funds/fund-view', $data);
    }

    public function download_funds()
    {
        $this->load->database();
        $this->load->helper('csv');

        $fromDate = $this->input->post('from_date');
        $toDate = $this->input->post('to_date');

        $fromDateFormatted = date('Y-m-d', strtotime($fromDate));
        $toDateFormatted = date('Y-m-d', strtotime($toDate));

        $this->db->select('trader_funds.id, trader_funds.*, users.*')
            ->from('trader_funds')
            ->join('users', 'users.id = trader_funds.userid')
            ->where('trader_funds.created_at >=', $fromDateFormatted)
            ->where('trader_funds.created_at <=', $toDateFormatted);

        $query = $this->db->get();
        $data['get_all_funds'] = $query->result_array();

        $filename = 'trades_' . date('Ymd') . '.csv';
        $headers = array('ID', 'Username', 'Name', 'User ID', 'Amount', 'Txn Type', 'Txn Reason', 'Notes', 'Time');

        $content = array($headers);

        foreach ($data['get_all_funds'] as $row) {
            $line = array(
                $row['id'],
                $row['username'],
                $row['fname'] . ' ' . $row['lname'],
                $row['userid'],
                $row['amount'],
                $row['type'],
                $row['txn_reason'],
                $row['notes'],
                $row['created_at']
            );
            $content[] = $line;
        }

        array_to_csv($content, $filename);
    }
}
