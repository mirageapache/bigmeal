<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BackPanel extends CI_Controller {
	
	//後台主頁
	public function back_main_page($index) {
		session_start();
		if(empty($_SESSION['user'])){
			redirect(site_url("/user/login_page/2"));
			return true;
		}
		if($_SESSION['user']->user_type == 2){
			$data['js'] = array('/js/page_control.js');
			$data['index'] = $index;
			$this->load->view('/back/back_main_page',$data);
		}
		else{
			redirect(site_url("/"));
		}
	}

	//後台各頁面
	public function get_back_page(){
		session_start();
		$index = $_POST['index'];
		if(!empty($_POST['id'])){
			//暫存id，user、porduct、order被選中時存入
			$_SESSION['back_id'] = $_POST['id'];
		}
		$this->load->view('/back/'.$index);
		return false;
	}

	// 查詢總覽資料
	public function get_overview_data(){
		$this->load->model('BackModel');
		$result = $this->BackModel->get_overview_data();
		echo json_encode($result);
	}

	// 計算頁數
	public function page_count(){
		$table = $_POST['table'];
		$filter = $_POST['filter'];
		$this->load->model('BackModel');
		$result = $this->BackModel->page_count($table,$filter);
		echo $result;
	}

	// 查詢會員列表
	public function get_user_data(){
		$filter = $_POST['filter'];
		$n = $_POST['n'];
		$m = $_POST['m'];
		$this->load->model('BackModel');
		$result = $this->BackModel->get_user_data($filter,$n,$m);
		echo json_encode($result);
	}

	// 查詢會員內容
	public function user_detail(){
		session_start();
		$action = $_POST['action'];
		$user_id = $_SESSION['back_id'];
		$this->load->model('BackModel');
		if ($action == 'get'){
			$result = $this->BackModel->get_user_detail($user_id);
			echo json_encode($result);
        }
        elseif ($action == 'update') {
        	$user_type = $_POST['user_type'];
			$result = $this->BackModel->modify_user_detail($user_id,$user_type);
			echo $result;
        }
	}

	// 查詢產品列表
	public function get_product_data(){
		$filter = $_POST['filter'];
		$n = $_POST['n'];
		$m = $_POST['m'];
		$this->load->model('BackModel');
		$result = $this->BackModel->get_product_data($filter,$n,$m);
		echo json_encode($result);
	}

	// 新增產品
	public function insert_product(){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$place = $_POST['place'];
		$b_type = $_POST['b_type'];
		$s_type = $_POST['s_type'];
		$unit = $_POST['unit'];
		$description = $_POST['description'];
		$standard = $_POST['standard'];

		$product_id = '';
        for($i=0;$i<=9;$i++){
           $product_id = $product_id.rand(0,9);
        }

		$this->load->model('BackModel');
		$result = $this->BackModel->insert_product($product_id,$name,$price,$stock,$place,$b_type,$s_type,$unit,$description,$standard);

		session_start();
		$_SESSION['product_id'] = $result;
		echo $result;
	}

	// 新增產品圖片
	public function insert_product_img(){
		$img_id = '';
        for($i=0;$i<=14;$i++){
            if ($i == 10) {
                $img_id = $img_id."-";
            }
            else{
                $img_id = $img_id.dechex(rand(0,15));
            }
        }

		if ($_FILES["file"]["error"] > 0){
			echo "Error: ".$_FILES["file"]["error"];
		}
		else{
		// 　echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
		// 　echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
		// 　echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
		// 　echo "暫存名稱: " . $_FILES["file"]["tmp_name"];

			if(file_exists("/data/products".$_FILES["file"]["name"])){
				echo "檔名已存在";
			}
			else{
				move_uploaded_file($_FILES["file"]["tmp_name"],dirname(__file__)."/../../data/products/".$img_id.'.'.substr($_FILES["file"]["type"],6,4));
			}
		}
		session_start();
	
		$this->load->model('BackModel');
		$result = $this->BackModel->insert_product_img($img_id,$_SESSION['product_id'],$img_id.'.'.substr($_FILES["file"]["type"],6,4));
		unset($_SESSION['product_id']);
		redirect(site_url("/backpanel/back_main_page/2"));
	}

	// 查詢產品內容
	public function get_product_detail(){
		session_start();
		$this->load->model('BackModel');
		$result = $this->BackModel->get_product_detail($_SESSION['back_id']);
		echo json_encode($result);
	}

	// 修改產品內容
	public function modify_product(){
		session_start();
		$_SESSION['img_id'] = $_POST['img_id'];
		$_SESSION['img_name'] = $_POST['img_name'];
		$product_id = $_POST['product_id'];
		$name = $_POST['name'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];
		$place = $_POST['place'];
		$b_type = $_POST['b_type'];
		$s_type = $_POST['s_type'];
		$unit = $_POST['unit'];
		$description = $_POST['description'];
		$standard = $_POST['standard'];

		$this->load->model('BackModel');
		$result = $this->BackModel->modify_product($product_id,$name,$price,$stock,$place,$b_type,$s_type,$unit,$description,$standard);
		echo $result;
	}
	// 修改產品圖片
	public function modify_product_img(){
		session_start();
		$old_img_id = $_SESSION['img_id'];
		$old_img_name = $_SESSION['img_name'];
		$img_name = $_FILES["file"]["name"];
		$this->load->model('BackModel');
		$this->BackModel->modify_product_img($old_img_id,$img_name);
		if ($_FILES["file"]["error"] > 0){
			echo "Error: ".$_FILES["file"]["error"];
		}
		else{
			if(file_exists(dirname(__file__)."/../../data/products/".$old_img_name)){
				unlink(dirname(__file__)."/../../data/products/".$old_img_name);//刪除舊圖片
			}
			move_uploaded_file($_FILES["file"]["tmp_name"],dirname(__file__)."/../../data/products/".$img_name);
		}
		unset($_SESSION['img_id']);
		unset($_SESSION['img_name']);
		redirect(site_url("/backpanel/back_main_page/2"));
	}

	// 刪除產品
	public function delete_product(){
		$data_array = $_POST['data_array'];

		$this->load->model('BackModel');
		$img_array = $this->BackModel->get_img_name($data_array);
		$result = $this->BackModel->delete_product($data_array);
		foreach($img_array as $img_name) {
			if(file_exists(dirname(__file__)."/../../data/products/".$img_name)){
				unlink(dirname(__file__)."/../../data/products/".$img_name);//刪除圖片檔案
			}
		}
		echo $result;
	}

	// 查詢訂單列表
	public function get_order_data(){
		$filter = $_POST['filter'];
		$n = $_POST['n'];
		$m = $_POST['m'];
		$this->load->model('BackModel');
		$result = $this->BackModel->get_order_data($filter,$n,$m);
		echo json_encode($result);
	}

	// 查詢訂單內容
	public function get_order_detail(){
		session_start();
		$this->load->model('BackModel');
		$result = $this->BackModel->get_order_detail($_SESSION['back_id']);
		echo json_encode($result);
	}

	// 修改訂單狀態
	public function modify_order(){
		$order_id = $_POST['order_id'];
		$state = $_POST['state'];

		$this->load->model('BackModel');
		$result = $this->BackModel->modify_order($order_id,$state);
		echo $result;
	}

}

