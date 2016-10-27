$(document).ready(function(){
	// 同會員資料
	var user_data = [];
	$('.same_user').click(function(){
		if($('.same_user').prop('checked')){
			if(user_data.length == 0){
				$.ajax({
					url: "/index.php/user/get_user_data",
					type: "GET",
					data: {} ,
					success: function(result){
						obj = JSON.parse(result);
						user_data.push({name:obj[0].name,post_code:obj[0].post_code,address:obj[0].address,phone:obj[0].cellphone,email:obj[0].email});
						$('.name').val(obj[0].name);
						$('.post_code').val(obj[0].post_code);
						$('.address').val(obj[0].address);
						$('.phone').val(obj[0].cellphone);
						$('.email').val(obj[0].email);
					}
				});
			}
			else{
				console.log(user_data[0]);
				$('.name').val(user_data[0].name);
				$('.post_code').val(obj[0].post_code);
				$('.address').val(user_data[0].address);
				$('.phone').val(user_data[0].cellphone);
				$('.email').val(user_data[0].email);
			}
		}
		else{
			$('.name').val("");
			$('.post_code').val("");
			$('.address').val("");
			$('.phone').val("");
			$('.email').val("");
		}
	})


});

// 收件人資料新增訂單
function new_order(){
	name = $('.name').val();
	post_code = $('.post_code').val();
	address = $('.address').val();
	phone = $('.phone').val();
	email = $('.email').val();

	if($('.deliver_0').prop('checked')){
		deliver_type = $('.deliver_0').val();
	}
	else{
		deliver_type = $('.deliver_1').val();
	}

	if ($('.pay_type_0').prop('checked')) {
		pay_type = $('.pay_type_0').val();
	}
	else if($('.pay_type_1').prop('checked')){
		pay_type = $('.pay_type_1').val();
	}
	else{
		pay_type = $('.pay_type_2').val();
	}

	$('.hint').css("display","none");
	if (name.length == 0){
		$('.name_hint').text("收件人姓名必填");
		$('.name_hint').css("display","block");
		$('.name').focus();
		return false;
	} 
	else if(post_code.length == 0){
		$('.address_hint').text("郵地區號必填");
		$('.address_hint').css("display","block");
		$('.post_code').focus();
		return false;
	}
	else if(address.length == 0 ){
		$('.address_hint').css("display","block");
		$('.address_hint').text("地址必填");
		$('.address').focus();
		return false;
	}
	else if(phone.length == 0 ){
		$('.phone_hint').text("電話/手機必填");
		$('.phone_hint').css("display","block");
		$('input[name="telephone"]').focus();
		return false;
	}
	else{

		$.ajax({
			url:"/index.php/order/new_order",
			data:{name:name,post_code:post_code,address:address,phone:phone,email:email,deliver_type:deliver_type,pay_type:pay_type},
			type:"POST",
			success: function(result){
				if (result == 'success') {
					location.replace('/index.php/main/finish_buying');
				}
				console.log(result);
			}

		});

	}

}


