<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BackPanel extends CI_Controller {

	public function back_main_page() {//後台頁
		session_start();
		if(isset($_SESSION["user"]) == false && $_SESSION["user"] == null){
			redirect(site_url("/user/login_page/_"));
			return true;
		}
		$this->load->view('/back/back_main_page');
	}

	public function get_back_page(){
		$index = $_POST['index'];
		$this->load->view('/back/'.$index);
		return false;
	}

	public function get_overview_data(){

		$this->load->model('BackModel');
		$result = $this->BackModel->get_overview_data();

		echo json_encode($result);

	}


}

