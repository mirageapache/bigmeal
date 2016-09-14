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
    function account_check($account){
        $query = $this->db->query("SELECT * FROM user WHERE account='".$account."'");
        if($query->num_rows() > 0){
            return 'exist';
          }
          else{
            return $account;
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

}
