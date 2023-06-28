<?php
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('session');
    }
    
    public function index() {
        $this->load->view('login-form');
    }
    
    public function validation() {
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() === true) {
            // Form validation failed
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->login_model->can_login($username, $password);
            
            if ($result === 'Success') {
                // Login successful, redirect to a protected page
                $this->session->set_userdata('username', $username);
                redirect('dashboard');
            } else {
                // Login failed, display error message
                $data['error_message'] = $result;
                $this->load->view('login-form', $data);
            }
        }
        
    }
    public function logout(){
        $this->session->unset_userdata('username');
        redirect('login');
    }

}