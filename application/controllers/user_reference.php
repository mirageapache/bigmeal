<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	//登入頁面
	public function login(){
		$data['css'] = array('/css/login.css');
		$data['pageTitle'] = "登入系統";
		$this->load->view('/user/login',$data);

	}

	//登入
	public function login_in(){
		$account = $_POST["account"];
		$password = $_POST["password"];

		$this->load->model("UserModel");
		$login_success = $this->UserModel->login($account,$password);

	}

	//註冊頁面
	public function signup(){

		$data['css'] = array('/css/login.css');
		$data['pageTitle'] = "註冊";
		$this->load->view('/user/signup',$data);
	}

	// 註冊(insert to database)
	public function register(){

		$account = $this->input->post("account");
		$email = $this->input->post("email");
        $password = $this->input->post("password");
        $pwd_confirm = $this->input->post("pwd_confirm");

        $data['css'] = array('/css/login.css');

		if( is_null($account) or strlen($account) == 0 ){
			echo '<script type="text/javascript">alert("請輸入帳號!!")</script>';
			$this->load->view('/user/signup',$data);
		}
		else if(is_null($password) or strlen($password) == 0 ){
        	echo '<script type="text/javascript">
        			alert("請輸入帳密碼!!")
        		  </script>';
		}
		else if($password != $pwd_confirm){
        	echo '<script type="text/javascript">alert("密碼與確認密碼不一致!!")</script>';
			$this->load->view('/user/signup',$data);
		}
		else{
	        $this->load->library("userclass");
	        $id = $this->userclass->generate_id(); //呼叫產生User Id
			$create_date = date("y/m/d"); //註冊日期
	        
	        $this->load->model("UserModel");
			//檢查帳號、密碼是否重復
			$result = $this->UserModel->check_user($account,$password);
			echo $result;


	        //insert user
	        //$this->UserModel->register($id,$account,$email,$password,$create_date);

	        $data['user_id'] = $id;
	        $data['account'] = $account;
	        $data['email'] = $email;
	        $data['password'] = $password;
	        $data['create_date'] = $create_date;
	        $this->load->view('/user/register_success',$data);		
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */