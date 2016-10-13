<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class FormClass { // 表單驗證
    
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

    function telephone_check($input){
        if(preg_match('/^[0][1-9]{1,3}[-][0-9]{6,8}$/',$input) == true){
            return true; // 電話格式正確
        }
        else {
            return false;
        }
    }

    function cellphone_check($input){
        if(preg_match('/09[0-9]{8}/',$input) == true){
            return true; // 手機格式正確
        }
        else {
            return false;
        }
    }


    



    

}