$(document).ready(function(){

	// 檢查帳號是否已存在
	$(".account").blur(function(){
		
		if ($(".account").val().length != 0) {
			if($(".account").val().length < 8){
				$(".account_hint").css("display","block");
				$(".account_hint").text("帳號最少8個字!!");
				return false;
			}
			else{
				$(".account_hint").text("");
			}

			$.ajax({
				url : "account_check",
				type : "POST",
				data : { account: $(".account").val() },
			    dataType : "text",
				success : function(Message){
					console.log(Message);
					if (Message == "exist"){
						// $(".account").val("");
						$(".account").focus();
						$(".account_hint").css("display","block");
						$(".account_hint").text("帳號已存在!!請使用其他帳號");
					}	
					else{
						$(".account_hint").css("display","none");
						$(".account_hint").text("");
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
			}	
			else{
				$(".confirm_hint").css("display","none");
				$(".confirm_hint").text("");
			}	
		}
		
	});

	// 註冊資料
	$(".register_btn").click(function(){
		// var account;

		// account = $(".account").val();
		// console.log("account:"+ $(".password_confirm").val() +"\npassword:"+ $(".password").val());


		$.ajax({
			url : "/index.php/user/register_action",
			type : "POST",
			data : {
				account: $(".account").val(),
				password: $(".password").val(),
				name: $(".name").val(),
				phone: $(".phone").val(),
				address: $(".address").val(),
				email: $(".email").val()
			},	
		    dataType : "text",
			success : function(Message){
				console.log('success');
				
			},
			error : function(){
				console.log("Error");
			}
	    });


	});



	//$("#item").click(function(){
		
		//var product_id = $(this).data('id')

	  //   $.ajax({
			// url : "/index.php/product/women",
			// url: base_url + "product/display",
			// type : "post",
			// data : {id : product_id},	
		 //    dataType : "text",
		 //    cache:false,
			// success : function(Message){
			// 	console.log(product_id);
			// },
			// error : function(){
			// 	alert("Error");
			// }
	  //   });
	    
    //});





});