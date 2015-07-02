<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends LN_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->library(array('session', 'MyCaptcha', 'form_validation', 'MyAuth'));
		
	}
	
	public function index()
	{
		if($redirect = $this->session->flashdata('redirect')) {
			$this->session->set_flashdata('redirect', $redirect);
		}
		
		$error_flag = $this->session->userdata('error_flag');
		
		$this->load->view('Backend/login-index', array('error_flag'=>$error_flag));
	}
	
	public function get_code() 
	{
			
		  $code = $this->mycaptcha->getCaptcha();
		  $this->session->set_userdata('code', $code);
		  $this->mycaptcha->showImg();
		  
	}
	
	public function validate() 
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$captcha_code = $this->input->post('captcha');
		
		$error_flag = $this->session->userdata('error_flag');
		
		if($error_flag) 
		{
			//验证验证码
			if(strtolower($this->session->userdata('code')) == strtolower($captcha_code))
			{
				//再验证用户名和密码
				if($this->myauth->login_admin($username, $password))
				{
					$redirect = $this->session->flashdata('redirect');
					$redirect = $redirect ? $redirect : 'admin/index';
					redirect($redirect);
				}
				else 
				{
					$this->session->set_userdata("error_flag", 1);
					redirect('login/index');
				}
			} else {
				redirect('login/index');
			}
		} 
		else 
		{
			//无需验证验证码
			if($this->myauth->login_admin($username, $password))
			{
				$redirect = $this->session->flashdata('redirect');
				$redirect = $redirect ? $redirect : 'admin/index';
				redirect($redirect);
			}
			else 
			{
				$this->session->set_userdata("error_flag", 1);
				redirect('login/index');
			}
		}
	}
	
	
}
