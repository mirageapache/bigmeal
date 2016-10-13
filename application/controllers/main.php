<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function index() //首頁
	{
		$data['css'] = array('/css/product.css');
		$this->load->view('index',$data);
	}

	public function basket() //購物籃
	{
		$data['pageTitle'] = '購物籃';
		$this->load->view('/main/basket',$data);
	}

	public function post_data() //收件資料
	{
		$this->load->view('/main/post_data');
	}

	public function finish_buying() //完成訂購
	{
		$this->load->view('/main/finish_buying');
	}

}

