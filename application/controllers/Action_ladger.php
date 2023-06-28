<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action_ladger extends CI_Controller {

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
		$this->load->view('action');
	}
	
}
