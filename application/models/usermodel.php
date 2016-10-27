<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    //登入
    function login($account,$password){
        $this->db->select("*");
        $query = $this->db->get_where("user",Array("account" => $account, "password" => $password ));

        if ($query->num_rows() > 0){ //如果數量大於0
            return $query->row();  //回傳第一筆
        }else{
            return null;
        }
    }

    //檢查帳號是否重復
    function get_user($atr,$table,$condition){
        $this->db->select($atr);
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() >0){
            $result = $query->result_array();
            return $result;
        }
        else{
            return null;
        }  
    }

    //註冊
    function register($user_id,$account,$password,$email,$create_date){
    	$this->db->insert("user",Array(
                "ID" => $user_id,
          		"account" => $account,
                "password" => $password,
          		"email" => $email,
                "create_day" => $create_date,
                "state" => 1,
                "user_type" => 1,
                "email_confirm" => 0
    		));

      return 'success';
    }

    // 修改會員資訊
    function edit_user_info($name,$telephone,$cellphone,$post_code,$address,$email,$user_id){
        $this->db->select("*");
        $query = $this->db->get_where("user_info",Array("user_id" => $user_id));

        if($query->num_rows == 0){ //使用者還沒新增資料
            $this->db->insert("user_info",Array(
                "name" => $name,
                "telephone" => $telephone,
                "cellphone" => $cellphone,
                "post_code" => $post_code,
                "address" => $address,
                "email" => $email,
                "user_id" => $user_id
            ));

            return 'success';
        }
        else{ //修改資料
            $this->db->where('user_id',$user_id);
            $this->db->update("user_info",Array(
                "name" => $name,
                "telephone" => $telephone,
                "cellphone" => $cellphone,
                "post_code" => $post_code,
                "address" => $address,
                "email" => $email
            ));

            return 'success';
        }
    }

    // 記錄使用者連線資訊
    function user_log($user_id){
        date_default_timezone_set('Asia/Taipei');
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
          $ip=$_SERVER['REMOTE_ADDR'];
        }

        $this->db->insert("user_log",Array(
            "time" => date('Y-m-d H:i:s'),
            "ip" => $ip,
            "os_info" => $_SERVER["HTTP_USER_AGENT"],
            "user_id" => $user_id
        ));

    }
}