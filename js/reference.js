$(document).ready(function(){
	

	$('.user_password').keypress(function(e){
		var key = e.which;
		if(e.keyCode == 13){
			$('.submit_login').trigger('click');
		}
	});

	//登入
	$('.submit_login').click(function(){
		var user=$('.user_account').val();
		var pwd=$('.user_password').val();

		if(user.length == 0){
			alert('請輸入帳號');
		}
		else if(pwd.length == 0){
			alert('請輸入密碼');
		}
		else{

			// para =  { account:user, password:pwd};

			$.ajax({
	            url: "login_in",
	            data:{ account:user, password:pwd},
	            type:"POST",
	            success: function(msg){
	                console.log("success");
	                console.log(msg);
	            },
	            error:function(xhr, ajaxOptions, thrownError){ 
	                console.log('fail');
             	}
        	});	
		}
	});



});