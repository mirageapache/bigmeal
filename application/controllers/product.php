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
		$data['js'] = array('/js/basket_action.js');
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
		if($result != false){
			// 修改庫存
			$data = $this->ProductModel->stock_change($id,$amount,'-');
		}
		echo $result;
	}

	public function stock_change(){ //修正產品庫存量
		$id = $_POST['id'];
		$amount = $_POST['amount'];
		$act = $_POST['act'];

		$this->load->model('ProductModel');
		$result = $this->ProductModel->stock_change($id,$amount,$act);
		echo $result;
	}

}