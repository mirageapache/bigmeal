$(document).ready(function(){ //登入頁

	$('.login_password').keypress(function(e){
		var key = e.which;
		if(e.keyCode == 13){
			$('#danru').trigger('click');
		}
	});

	$('.login_btn').click(function(){
		var account = $('.login_account').val();
		var password = $('.login_password').val();

		if(account.length == 0){
			$('hint').attr('title','請輸入帳號');
			$('login_account').focus();
			return false;
		}
		else if(password.length == 0){
			$('hint').attr('title','請輸入密碼');
			$('login_password').focus();
			return false;
		}
		else{
		   		//$('form').attr('action','<?=site_url("/user/login_action")?>');
				// $('.login_btn').trigger('click');
			$.ajax({
	            url: "login_action",
	            data:{ account:account, password:password},
	            type:"POST",
	            success: function(result){
	                console.log(result);
	            },
	            error:function(xhr, ajaxOptions, thrownError){ 
	                console.log('failed');
             	}
        	});	
		}
	});

});

$(document).ready(function(){ //註冊頁

	// 檢查帳號是否已存在
	$(".account").blur(function(){
		if ($(".account").val().length != 0) {
			if($(".account").val().length < 4){
				$(".account_hint").css("display","block");
				$(".account_hint").text("帳號至少4個字!!");
				$(".account").attr("title","帳號至少4個字喔!!");
				$(".account").attr("data-check","false");
				return false;
			}
			else{
				$(".account_hint").text("");
				$(".account").attr("title","");
			}

			$.ajax({
				url : "account_check",
				type : "POST",
				data : { account: $(".account").val() },
			    dataType : "text",
				success : function(Message){
					if (Message == "exist"){
						$(".account").focus();
						$(".account_hint").css("display","block");
						$(".account_hint").text("帳號已存在!!請使用其他帳號");
						$(".account").attr("title","帳號已存在!!請使用其他帳號");
						$(".account").attr("data-check","false");
					}	
					else{
						$(".account_hint").css("display","none");
						$(".account_hint").text("");
						$(".account").attr("title","");
						$(".account").attr("data-check","true");
					}
				},
				error : function(){
					console.log("ajax Error");
				}
		    });
		}
		else{
		 	$(".account_hint").css("display","none");
		 	$(".account_hint").text("");
		 	$(".account").attr("title","");
		 	$(".account").attr("data-check","false");
		}
	});

	// 檢查密碼
	$(".password").blur(function(){
		if ($(".password").val().length != 0) {
			if($(".password").val().length < 8){
				$(".password_hint").css("display","block");
				$(".password_hint").text("密碼至少8個字喔!!");
				$(".password").attr("title","密碼至少8個字喔!!");
				$(".password").attr("data-check","false");
			}
			else{
				$(".password_hint").css("display","none");
				$(".password_hint").text("");
				$(".password").attr("title","");
				$(".password").attr("data-check","true");
			}
		}
	});

	// 檢查密碼與確認密碼是否相同
	$(".password_confirm").blur(function(){
		if ($(".password_confirm").val().length != 0) {
			if ($(".password").val() != $(".password_confirm").val()){

				$(".password_confirm").val("");
				$(".password_confirm").focus();
				$(".confirm_hint").css("display","block");
				$(".confirm_hint").text("與密碼不符!!");
				$(".password_confirm").attr("title","與密碼不符!!");
				$(".password_confirm").attr("data-check","false");
			}	
			else{
				$(".confirm_hint").css("display","none");
				$(".confirm_hint").text("");
				$(".password_confirm").attr("title","");
				$(".password_confirm").attr("data-check","true");
			}	
		}	
	});

	// 檢查email
	// $(".email").blur(function(){
	// 	if ($(".email").val().length != 0) {
	// 		var regxp = /^([\w]+)(.[\w]+)*@([\w]+)(.[\w]{2,3}){1,2}$/;
	// 		if (regxp.test($(".email").val()) != true){
	// 			// $(".email").val("");
	// 			$(".email_hint").css("display","block");
	// 			$(".email_hint").text("email格式錯誤!!");
	// 			$(".email").attr("data-check","false");
	// 		}	
	// 		else{
	// 			$(".email_hint").css("display","none");
	// 			$(".email_hint").text("");
	// 			$(".email").attr("data-check","true");
	// 		}	
	// 	}
	// });

	//註冊資料
	$(".register_btn").click(function(){
		
		if($(".account").attr("data-check") == "false"){
			if ($(".account").val().length == 0) {
				// alert('帳號有錯誤喔!!');
				$(".account").focus();
				$(".account_hint").css("display","block");
				$(".account_hint").text("帳號必填喔!!");
				$(".account").attr("title","帳號必填喔!!");
				$(".account").attr("data-check","false");
			}
			else{
				$(".account").trigger("blur");		
			}
		}
		else if( $(".password").attr("data-check") == "false"){
			if ($(".password").val().length == 0) {
				$(".password").focus();
				$(".password_hint").css("display","block");
				$(".password_hint").text("密碼必填喔!!");
				$(".password").attr("title","密碼必填喔!!");
				$(".password").attr("data-check","false");
			}
			else{
				$(".password").trigger("blur");		
			}
		}
		else if( $(".password_confirm").attr("data-check") == "false"){
			$(".password_confirm").trigger("blur");		
		}
		// else if( $(".email").attr("data-check") == "false"){
		// 	if ($(".email").val().length == 0) {
		// 		$(".email").focus();
		// 		$(".email_hint").css("display","block");
		// 		$(".email_hint").text("email密碼必填喔!!");
		// 		$(".email").attr("data-check","false");
		// 	}
		// 	else{
		// 		$(".email").trigger("blur");		
		// 	}
		// }
		else{
			$.ajax({
				url : "/index.php/user/register_action",
				type : "POST",
				data : {
					account: $(".account").val(),
					password: $(".password").val(),
					password_confirm: $(".password_confirm").val(),
					email: $(".email").val()
				},	
			    dataType : "text",
				success : function(result){
					if(result == "account_null"){
						alert("帳號必填喔");
						$(".account").focus();
					}
					else if(result == "account_less_4"){
						alert("帳號至少4個字喔");
						$(".account").focus();
					}
					else if(result == "account_over_20"){
						alert("帳號最多20個字喔");
						$(".account").focus();
					}
					else if(result == "account_exist"){
						alert("帳號已經存在!!");
						$(".account").focus();
					}
					else if(result == "password_null"){
						alert("密碼必填喔!!");
						$(".password").focus();
					}
					else if(result == "password_confirm_null"){
						alert("確認密碼必填喔!!");
						$(".password_confirm").focus();
					}
					else if(result == "password_confirm_wrong"){
						alert("確認密碼與密碼不同!!");
						$(".password_confirm").focus();
					}
					// else if(result == "email_null"){
					// 	alert("email必填喔!!");
					// 	$(".email").focus();
					// }
					// else if(result == "email_wrong"){
					// 	alert("email格式錯誤!!");
					// 	$(".email").focus();
					// }
					else if(result == "success"){
						//註冊成功，進行換頁 
						console.log("成功");
						location.href= "/index.php/user/register_success";
					}
					else{
						console.log("\n---------\n"+result);
						// alert("似乎有錯誤…");
					}
				},
				error : function(){
					console.log("Error");
				}
		    });
		}
	});

});


