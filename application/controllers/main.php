<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function index() //首頁
	{

		$data['css'] = array('');
		$data['js'] = array('');
		$this->load->view('index',$data);
	}
}

