<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct(){
        parent::__construct();

        if(!$this->_is_logged_in())  
        {
            redirect("Login");
        }
        $this->load->model('login_model');
    }
	public function _is_logged_in() {
        return $this->session->has_userdata('username');
    }
	public function index()
	{
		$this->load->view('setting/setting');
	}

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('password', 'New Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'required|matches[password]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post('old_password');
                $encryptCurrentPassword = $old_password;
                $check = $this->login_model->checkCurrentPassword($encryptCurrentPassword);
    
                if ($check == true) {
                    $newPassword = $this->input->post('password');
                    $encryptPassword = $newPassword;
                    $this->login_model->updatePassword($encryptPassword);
    
                    $this->session->set_flashdata('success', 'Login Password changed Successfully');
                    redirect(base_url('setting'));
                } else {
                    $this->session->set_flashdata('error', 'Old Password is wrong');
                    redirect(base_url('setting'));
                }
            } else {
                $this->load->view('setting/setting');
            }
        } else {
            $this->load->view('setting/setting');
        }
    }
    
    public function change_transaction_Password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('transaction_old_password', 'Old Password', 'required');
            $this->form_validation->set_rules('transaction_password', 'New Password', 'required');
            $this->form_validation->set_rules('transaction_confirm_password', 'Confirm New Password', 'required|matches[transaction_password]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = $this->input->post('transaction_old_password');
                $encryptCurrentPassword = $old_password;
                $check = $this->login_model->checkCurrent_t_Password($encryptCurrentPassword);
    
                if ($check == true) {
                    $newPassword = $this->input->post('transaction_password');
                    $encryptPassword = $newPassword;
                    $this->login_model->update_t_Password($encryptPassword);
    
                    $this->session->set_flashdata('tsuccess', 'Transaction Password changed Successfully');
                    redirect(base_url('setting'));
                } else {
                    $this->session->set_flashdata('terror', 'Old Password is wrong');
                    redirect(base_url('setting'));
                }
            } else {
                $this->load->view('setting/setting');
            }
        } else {
            $this->load->view('setting/setting');
        }
    }
    
    
}