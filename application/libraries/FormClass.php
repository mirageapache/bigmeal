<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class FormClass { // 表單驗證
    
    function essential($input) // 必填欄位
    {
		if( strlen($input) == 0){
            return true; //field是空值
        }
        else{
            return false;
        }
    }

    function input_length($input,$min,$max) // 字數限制
    {
        if( $min > $max){
            $temp = $min;
            $max = $min;
            $min = $temp;
        }

        if(strlen($input) < $min){
            return 'less'; //字數太少
        }
        if(strlen($max) <> 0 or is_null($max) == false){
            if (strlen($input) > $max) {
                return 'over'; //字數太多
            }
        }
        return 'ok';
    }

    function email_check($input){
        if(preg_match('/^[-_.0-9a-z]+@([-_0-9a-z][-_0-9a-z]+\.)+[a-z]{2,3}$/i',$input) == true){
            return true; // email格式正確
        }
        else {
            return false;
        }
    }

}