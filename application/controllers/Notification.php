<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
	public function __construct(){
        parent::__construct();

        if(!$this->_is_logged_in())  
        {
            redirect("Login");
        }
    }
	public function _is_logged_in() {
        return $this->session->has_userdata('username');
    }
	public function index()
	{
		$data['notification'] = $this->db->order_by('id', 'desc')->get('notification')->result_array();
		$this->load->view('notification/notification',$data);
	}

	public function add_notification(){
   
		$this->load->view('notification/send-noti');
	}
	public function insert_notification(){  
	    $data = $this->input->post();
		// echo'<pre>';print_r($data);die;
		$this->db->insert('notification',$data);
		redirect('notification');
	}
}
