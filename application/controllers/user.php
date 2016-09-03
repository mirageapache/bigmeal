<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	
	public function login_page() //登入頁
	{
		$data['css'] = array('/css/user.css');
		$this->load->view('/user/login_page',$data);
	}

	public function login_action() //登入
	{

	}

	public function regist_page() //註冊頁
	{


		$data['css'] = array('/css/user.css');
		$this->load->view('/user/regist_page',$data);
	}

	public function regist_action() //註冊
	{



	}




}

