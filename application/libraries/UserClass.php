<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class UserClass {

    function generate_id() //產生GUID
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
}