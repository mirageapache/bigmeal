<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class GenerateClass {

    function user_id() //產生User GUID
    {
		$newid = '';
    	for($i=0;$i<=36;$i++){
    		if($i == 9 or $i == 14 or $i == 19 or $i ==24){
    			$newid = $newid."-";
    		}
    		else{
				$newid = $newid.dechex(rand(1,16));
    		}
    	}
    	return $newid;
    }

    function product_id()
    {
        $newid = '';
        for($i=0;$i<=9;$i++){
           $newid = $newid.rand(1,10);
        }
        return $newid;
    }

    function product_img_id()
    {
        $newid = '';
        for($i=0;$i<=16;$i++){
            if ($i == 10) {
                $newid = $newid."-";
            }
            else{
                $newid = $newid.dechex(rand(1,16));
            }
        }
        return $newid;
    }

    function order_id()
    {
        date_default_timezone_set('Asia/Taipei');
        $newid = date('Ymd-');
        for($i=0;$i<=5;$i++){
           $newid = $newid.dechex(rand(1,16));
        }
        return $newid;
    }

}