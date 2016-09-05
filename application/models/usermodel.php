<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    //登入
    function login($account,$password){
        $query = $this->db->query("SELECT * FROM User WHERE account='".$account."';");
        foreach ($query->result() as $row)
        {
           // echo $row->Account;
           // echo "<br>";
           // echo $row->Email;
           // echo "<br>";
           // echo $row->Password;
           // echo "<br>";
        }
        // if($account_exist > 0){
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }

    //檢查帳號是否重復
    function account_check($account){
        $query = $this->db->query("SELECT * FROM user WHERE account='".$account."'");       

        if($query->num_rows() > 0){
            echo 'exist';
          }
          else{
            echo $account;
          }

    }

    //註冊
    function register($user_id,$account,$email,$password,$create_date){
    	$this->db->insert("user",Array(
                "user_id" => $user_id,
          			"account" => $account,
          			"email" => $email,
          			"password" => $password,
                "create_date" => $create_date
    		));

    }

}
