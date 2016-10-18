<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function check_out(){ //結帳並填寫收件資料
		session_start();
		if(!isset($_SESSION['user'])){
			echo 'no_login';
			return false;
		}
		$user_id = $_SESSION['user']->ID;

		$data = json_decode($_POST['cookie']);
		$total = 0;

		foreach ($data as $value) {
			$total = $value->sub_total + $total;
		}

		$this->load->library('generateclass');
		$order_id = $this->generateclass->order_id();
		
		$this->load->model('OrderModel');
		//新增暫存訂單
		$order_result = $this->OrderModel->generate_temp_order($order_id,$user_id,$total);
		//新增訂單內容
		$content_result = $this->OrderModel->generate_order_content($order_id,$data);



		if($order_result == 'success'){
			echo 'success';
		}
		elseif ($content_result != 'success') {
			echo 'order_content_wrong';
		}
		else{
			echo $result;
		}
	}

	public function new_order(){ //結帳並填寫收件資料
		session_start();
		if(!isset($_SESSION['user'])){
			echo 'no_login';
			return false;
		}

		$name = $_POST['name'];
		$post_code = $_POST['post_code'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$deliver_type = $_POST['deliver_type'];
		$pay_type = $_POST['pay_type'];


		if (empty($name)) {
			echo 'name_null';
			return false;
		}
		elseif (empty($post_code)) {
			echo 'post_code_null';
			return false;
		}
		elseif (empty($address)) {
			echo 'address_null';
			return false;
		}
		elseif (empty($phone)) {
			echo 'phone_null';
			return false;
		}
		else{
			$user_id = $_SESSION['user']->ID;
			
			$this->load->model('OrderModel');
			//新增暫存訂單
			$result = $this->OrderModel->generate_order($user_id,$name,$post_code,$address,$phone,$email,$deliver_type,$pay_type);

			$_SESSION['order_id'] = $result;
			$_SESSION['finish_order'] = true;
			echo 'success';
		}

	}

}