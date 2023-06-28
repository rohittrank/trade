<?php
class Trading extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('trade_model');
        $this->load->library('session');
    }
    
    public function index() {
        $this->load->view('trade/trade_login');
    }

    public function contact_us() {
        $this->load->view('trade/contact_us');
    }

    public function validation() {
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->trade_model->can_login($username, $password);
            if ($result === 'Success') {
                $this->session->set_userdata('username', $username);
                $this->session->set_flashdata('success', 'Login successful');
                redirect('explore');
            } elseif ($result === 'Access Denied: Only users can login') {
                $data['error_message'] = $result;
                $this->load->view('trade/trade_login', $data);
            } elseif ($result === 'Wrong Password') {
                $data['error_message'] = $result;
                $this->load->view('trade/trade_login', $data);
            } elseif ($result === 'Wrong User Name') {
                $data['error_message'] = $result;
                $this->load->view('trade/trade_login', $data);
            } elseif ($result === 'Account is inactive') {
                $data['error_message'] = 'Account is inactive. Please contact your broker for assistance.';
                $this->load->view('trade/trade_login', $data);
            } else {
                $data['error_message'] = 'Unexpected login result';
                $this->load->view('trade/trade_login', $data);
            }
        } else {
            $this->load->view('trade/trade_login');
        }
    }
    public function logout(){
        $this->session->unset_userdata('username');
        redirect('trading');
    }
}