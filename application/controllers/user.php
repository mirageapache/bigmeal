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

	public function register_page() //註冊頁
	{
		$data['css'] = array('/css/user.css');
		$this->load->view('/user/register_page',$data);
	}

	public function register_action() //註冊
	{
		
		$Message = array
		(
			'account' =>$_POST['account'] ,
			'password' => $_POST['password'],
			'name' => $_POST['name'],
			'phone' => $_POST['phone'],
			'address' => $_POST['address'],
			'email' => $_POST['email']
		);

		echo $Message;

	}

	public function account_check() //檢查帳號是否已存在
	{
		$account = $_POST['account'];

		$this->load->model("UserModel");
		$result = $this->UserModel->account_check($account);
		echo $result;
	}





}

