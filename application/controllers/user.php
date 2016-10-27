<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function login_page($n) {//登入頁
		session_start();
		if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
			redirect(site_url("/")); //轉回首頁
			return true;
		}
		$data['css'] = array('css/user.css');
		$data['js'] = array('js/user.js');
		$data['pageTitle'] = '會員登入';
		$data['n'] = $n;
		if ($n == '1') {
			$data['errorMessage'] = '登入後繼續結帳訂單';
		}
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
		$n = $this->input->post("n");
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
			if ($n == '1') {
				redirect(site_url("/main/basket"));
			}
			else{
				redirect(site_url("/"));
			}
		}
	}

	public function logout() { //登出
		session_start();
		session_destroy();
		redirect(site_url("/user/login_page/9")); //轉回登入頁
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

		if(empty($account)){
			echo 'account_null';
			return false;
		}
		else if(empty($password)){
			echo 'password_null';
			return false;
		}
		else if(empty($password_confirm)) {
			echo 'password_confirm_null';
			return false;
		}
		else if($password <> $password_confirm){
			echo 'password_confirm_wrong';
			return false;
		}
		else if(empty($email)) {
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

		// 產生 user_id
		$id = '';
    	for($i=0;$i<=36;$i++){
    		if($i == 9 or $i == 14 or $i == 19 or $i ==24){
    			$id = $id."-";
    		}
    		else{
				$id = $id.dechex(rand(1,16));
    		}
    	}
		
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
		$result = $this->UserModel->get_user('account','user',array('account'=> $account));
		if(is_null($result)){ 
            return $account;
        }
        else{
            return 'exist';
        }

		echo $result;
	}

	public function user_page($num) { //User Info Page
		session_start();
		if(isset($_SESSION["user"]) == false && $_SESSION["user"] == null){
			redirect(site_url("/user/login_page/_"));
			return true;
		}

		$data['css'] = array('/css/user.css');
		$data['js'] = array('/js/user_partial.js');
		$data['num'] = $num;
		$this->load->view('/user/user_page',$data);
	}

	public function user_partial() { //change User Partial View
		$num = $_POST['num'];

		switch ($num) {
			case '1': //會員資料
				$this->load->view('/user/user_partial/user_info');
				break;
			case '1-1': //新增or編輯會員資料
				$this->load->view('/user/user_partial/edit_user_info');
				break;
			case '2': //訂單查詢
				$this->load->view('/user/user_partial/order_list');
				break;
			case '3': //購物記錄
				$this->load->view('/user/user_partial/purchased');
				break;
			case '4': //收藏
				$this->load->view('/user/user_partial/collection');	
				break;
			case '5': //通知
				$this->load->view('/user/user_partial/message');	
				break;
			default:
				$this->load->view('/user/user_partial/user_info');
				break;
		}
		return false;
	}

	public function get_user_data() { //抓會員資料
		session_start();
		if(isset($_SESSION["user"]) == false && $_SESSION["user"] == null){
			redirect(site_url("/user/login_page/_"));
			return true;
		}
		
		$this->load->model('UserModel');
		$result = $this->UserModel->get_user('*','user_info',array('user_id'=> $_SESSION["user"]->ID));
		if(is_null($result)){
			echo 'user_null'; //查無資料
		}
		else{
			echo json_encode($result);
		}

	}

	public function edit_user_info(){ //新增或修改會員資料
		session_start();
		$name = $_POST['name'];
		$telephone = $_POST['telephone'];
		$cellphone = $_POST['cellphone'];
		$post_code = $_POST['post_code'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$user_id =$_SESSION['user']->ID;

		$this->load->library('formclass');
		if(empty($name)){
			echo 'name_null';
			return false;
		}
		elseif (empty($telephone)) {
			echo 'telephone_null';
			return false;
		}
		elseif (empty($cellphone)) {
			echo 'cellphone_null';
			return false;
		}
		elseif (empty($address)) {
			echo 'post_code_null';
			return false;
		}
		elseif (empty($address)) {
			echo 'address_null';
			return false;
		}
		elseif (empty($email)) {
			echo 'email_null';
			return false;
		}
		elseif (!$this->formclass->telephone_check($telephone)) {
			echo 'telephone_wrong';
			return false;
		}
		elseif (!$this->formclass->cellphone_check($cellphone)) {
			echo 'cellphone_wrong';
			return false;
		}
		elseif (!$this->formclass->email_check($email)) {
			echo 'email_wrong';
			return false;
		}
		elseif ($this->formclass->input_length($name,0,6) == 'over') {
			echo 'name_over';
			return false;
		}
		elseif ($this->formclass->input_length($telephone,0,10) == 'over') {
			echo 'telephone_over';
			return false;
		}
		elseif ($this->formclass->input_length($cellphone,0,10) == 'over') {
			echo 'cellphone_over';
			return false;
		}
		elseif ($this->formclass->input_length($address,0,100) == 'over') {
			echo 'post_code_over';
			return false;
		}
		elseif ($this->formclass->input_length($address,0,100) == 'over') {
			echo 'address_over';
			return false;
		}
		elseif ($this->formclass->input_length($email,0,50) == 'over') {
			echo 'email_over';
			return false;
		}
		else{
			$this->load->model('UserModel');
			$result = $this->UserModel->edit_user_info($name,$telephone,$cellphone,$post_code,$address,$email,$user_id);
			if($result == 'success'){
				echo 'success';
			}
			else{
				echo 'error';
			}
		}

	}

	public function get_order_list(){
		session_start();
		$user_id = $_SESSION['user']->ID;

		$condition = $_POST['condition'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$sort_prop = $_POST['sort_prop'];
		$order_by = $_POST['order_by'];

		$this->load->model('OrderModel');
		$result = $this->OrderModel->get_order_list($condition,$start_date,$end_date,$sort_prop,$order_by,$user_id);
		echo json_encode($result); // 查詢訂單列表
		
	}

	public function get_order_detail_info(){  // 查詢訂單->訂單資訊

		$order_id = $_POST['order_id'];

		$this->load->model('OrderModel');
		$result = $this->OrderModel->get_order($order_id);
		echo json_encode($result);
		
	}

	public function get_order_detail_content(){  // 查詢訂單->訂單內容

		$order_id = $_POST['order_id'];

		$this->load->model('OrderModel');
		$result = $this->OrderModel->get_order_content($order_id);
		echo json_encode($result);
		
	}

}

