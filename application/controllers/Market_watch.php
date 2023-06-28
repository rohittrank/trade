<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market_watch extends CI_Controller {
	public function __construct(){
        parent::__construct();

        if(!$this->_is_logged_in())  
        {
            redirect("Login");
        }
        $this->load->model('Dashboard_model');
    }
	public function _is_logged_in() {
        return $this->session->has_userdata('username');
    }
	public function index()
	{
        $data['scrip_name'] = $this->db->get('trading_table')->result_array();
        $this->db->where('user_role', 'user');
        $data['num_clients'] = $this->Dashboard_model->getTotalActiveUsers(); 
        // echo'<pre>';print_r($data['num_clients']);die;
		$this->load->view('market-watch',$data);
	}
}
