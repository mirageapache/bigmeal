<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	
	public function get_product() //產品資訊清單
	{
		$this->load->model('ProductModel');
		$result = $this->ProductModel->get_product();
		echo json_encode($result);
	}

	public function product_detail($id){ //取得產品內容

		$data['css'] = array('/css/product.css');

		$this->load->model('ProductModel');
		$result = $this->ProductModel->get_product_detail($id);
		$data['data'] = $result;

		$this->load->view('/product/product_detail',$data);
	}

	public function check_amount(){ //檢查庫存量
		$id = $_POST['id'];
		$amount = $_POST['amount'];

		$this->load->model('ProductModel');
		$result = $this->ProductModel->check_amount($id,$amount);
		echo $result;

	}

	public function go_pay(){
		session_start();
		$user_id = $_SESSION['user']->ID;

		$data = json_decode($_POST['cookie']);
		$total = 0;

		foreach ($data as $value) {
			$total = $value->sub_total + $total;
		}

		$this->load->library('generateclass');
		$order_id = $this->generateclass->order_id();
		

		$this->load->model('ProductModel');
		//新增訂單
		$order_result = $this->ProductModel->generate_order($order_id,$user_id,$total);
		//新增訂單內容
		$content_result = $this->ProductModel->generate_order_content($order_id,$data);

		if($order_result != 'success'){
			echo 'order_list_wrong';
		}
		elseif ($content_result != 'success') {
			echo 'order_content_wrong';
		}
		else{
			echo true;
		}

	}

}