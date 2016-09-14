<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function login_page() {//登入頁
		session_start();
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
			redirect(site_url("/")); //轉回首頁
			return true;
		}
		$data['css'] = array('css/user.css');
		$data['js'] = array('js/user.js');
		$data['pageTitle'] = '會員登入';
		$this->load->view('/user/login_page',$data);
	}

	public function login_action() {//登入
		session_start();
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
			redirect(site_url("/")); //轉回首頁
			return true;
		}
		$data['css'] = array('/css/user.css');
		$data['js'] = array('/js/user.js');
		$data['pageTitle'] = '會員登入';

		$account = trim($this->input->post("account")); //trim()可清除字串前後的空白
		$password = trim($this->input->post("password"));
		if(strlen($account) == 0){
			$data['errorMessage'] = '請輸入帳號';
			$this->load->view("/user/login_page",$data);		
		}
		else if (strlen($password) == 0) {
			$data['errorMessage'] = '請輸入密碼';
			$this->load->view("/user/login_page",$data);		
		}
		else{
			$this->load->model("UserModel");
			$user = $this->UserModel->login($account,$password);

			if(is_null($user)){
				$data['errorMessage'] = '帳號或密碼錯誤';
				$this->load->view("/user/login_page",$data);		
				return true;
			}
			$_SESSION["user"] = $user;
			redirect(site_url("/"));
		}
	}

	public function logout() { //登出
		session_start();
		session_destroy();
		redirect(site_url("/user/login_page")); //轉回登入頁
	}

	public function register_page() { //註冊頁
	
		$data['css'] = array('/css/user.css');
		$data['js'] = array('js/user.js');
		$this->load->view('/user/register_page',$data);
	}

	public function register_action() { //註冊
		$account = $_POST['account'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		$email = $_POST['email'];
		

		$this->load->library('formclass');

		if($this->formclass->essential($account)){
			echo 'account_null';
			return false;
		}
		else if($this->formclass->essential($password)){
			echo 'password_null';
			return false;
		}
		else if($this->formclass->essential($password_confirm)) {
			echo 'password_confirm_null';
			return false;
		}
		else if($password <> $password_confirm){
			echo 'password_confirm_wrong';
			return false;
		}
		else if($this->formclass->essential($email)) {
			echo 'email_null';
			return false;
		}
		

		$result = $this->formclass->input_length($account,4,20);
		$this->load->model('UserModel');
		$db_result = $this->UserModel->account_check($account);
		if($result == "less") {
			echo 'account_less_4';
			return false;
		}
		else if($result == "over") {
			echo 'account_over_20';
			return false;
		}
		else if($db_result == "exist"){
			echo 'account_exist';
			return false;
		}

		$result = $this->formclass->email_check($email);
		if(!$result){
			echo 'email_wrong';
			return false;
		}

		

		$this->load->library('userclass');
        $id = $this->userclass->generate_id(); //呼叫產生User Id
		$create_date = date('y/m/d'); //註冊日期

		$result = $this->UserModel->register($id,$account,$password,$email,$create_date);

		if ($result == 'success'){
			echo $result;
	
			// 用ajax 無法直接load view (會傳程式碼回去…)
			// $data['css'] = array('/css/user.css');
			// $this->load->view('/user/register_success_page',$data);
		}
	}

	public function account_check() { //檢查帳號是否已存在
	
		$account = $_POST['account'];
		$this->load->model('UserModel');
		$result = $this->UserModel->account_check($account);
	}

	public function user_page($num) { //User Info
		$data['css'] = array('/css/user.css');
		$data['js'] = array('/js/user.js');
		$data['num'] = $num;
		$this->load->view('/user/user_page',$data);

	}

	public function user_partial() {

		$num = $_POST['num'];
		switch ($num) {
			case '1':
				$this->load->view('/user/user_partial/user_info');
				break;
			case '2':
				$this->load->view('/user/user_partial/order_list');
				break;
			case '3':
				$this->load->view('/user/user_partial/purchased');
				break;
			case '4':
				$this->load->view('/user/user_partial/collection');
				break;
			default:
				$this->load->view('/user/user_partial/user_info');
				break;
		}
		return false;

	}


}

