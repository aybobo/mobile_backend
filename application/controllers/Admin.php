<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->model('ion_auth_model');
	}

	//-----------------------------------

	public function index()
	{
		$this->load->view('admin/index_view');
	}

	//--------------------------------

	public function login()
	{
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('remember','Remember me','integer');
		if($this->form_validation->run()===TRUE)
		{
			$remember = (bool) $this->input->post('remember');
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				$this->check_user_status();
			}
			else
			{
				$this->session->set_flashdata('message','Login unsuccessful! Please enter valid email and password');
                $this->session->set_flashdata('error',$this->ion_auth->errors());
			}
		}
		redirect('admin/index');
	}

	//-------------------------------------

	public function check_user_status()
	{
		if ($this->session->userdata('active') == 1) {
			if (!($this->session->userdata('role') == 'Admin' || $this->session->userdata('role') == 'Superadmin')) {
				$this->session->set_flashdata('msg', 'Access denied, kindly contact admin');
				redirect('admin/index');
			}
			else {
				redirect('dashboard/index');
			}
		}
		else {
			$this->session->set_flashdata('msg', 'Account deactivated: contact admin');
			redirect('admin/index');
		}
	}

	//-----------------------------------

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('admin/index');
	}

}
