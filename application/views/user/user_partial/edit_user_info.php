<h3 class="no_margin">會員資料-編輯會員資料</h3>
<hr/>

<div class="edit_user_info panel panel-success">
	<div class="panel-heading">
		<label class="no_margin">編輯會員資料</label>
	</div>
	<div class="panel-body">
		<form class="">
			<label>姓名</label><label class="hint name_hint pull-right">該欄位必填!</label>
			<input class="form-control" type="text" name="name" placeholder="姓名" maxlength="6" /> 
			<label>電話</label><label class="hint telephone_hint pull-right">該欄位必填!</label>
			<input class="form-control" type="tel" name="telephone" placeholder="電話" maxlength="20" />
			<label>手機</label><label class="hint cellphone_hint pull-right">該欄位必填!</label>
			<input class="form-control" type="tel" name="cellphone" placeholder="手機" maxlength="20" />
			<label>地址</label><label class="hint address_hint pull-right">該欄位必填!</label>
			<textarea class="form-control" type="text" name="address" placeholder="地址" maxlength="100"></textarea>
			<label>E-mail</label><label class="hint email_hint pull-right">該欄位必填!</label>
			<input class="form-control" type="email" name="email" placeholder="E-mail" />

			<label class="btn btn-success" onclick="submit_edit()">儲存</label>
		</form>
	</div>
</div>

<script type="text/javascript">

	$.ajax({
		url: "/index.php/user/get_user_data",
		type: "GET",
		data: {} ,
		success: function(result){
			if( result != 'user_null'){
				obj = JSON.parse(result);
				$('input[name="name"]').val(obj[0].name);
				$('input[name="telephone"]').val(obj[0].telephone);
				$('input[name="cellphone"]').val(obj[0].cellphone);
				$('textarea[name="address"]').val(obj[0].address);
				$('input[name="email"]').val(obj[0].email);
			}
		},
		error: function(error){

		}
	});

function submit_edit(){

	if (isChange == false){
		location.reload();
		return false;
	}
	var name = $('input[name="name"]').val();
	var telephone =	$('input[name="telephone"]').val();
	var cellphone =	$('input[name="cellphone"]').val();
	var address =	$('textarea[name="address"]').val();
	var email =	$('input[name="email"]').val();

	$('.hint').css("display","none");
	if (name.length == 0){
		$('.name_hint').css("display","block");
	} 
	else if(telephone.length == 0 ){
		$('.telephonehint').css("display","block");
	}
	else if(cellphone.length == 0 ){
		$('.cellphonehint').css("display","block");
	}
	else if(address.length == 0 ){
		$('.addresshint').css("display","block");
	}
	else if(email.length == 0){
		$('.email_hint').css("display","block");
	}

	$.ajax({
		url: "/index.php/user/edit_user_info",
		type: "POST",
		data: {
			name: name,
			telephone: telephone,
			cellphone: cellphone,
			address: address,
			email: email
		} ,
		success: function(result){
			if (result == 'name_null'){
				$('.name_hint').text("該欄位必填");
				$('.name_hint').css("display","block");
			} 
			else if(result == 'telephone_null' ){
				$('.telephone_hint').text("該欄位必填");
				$('.telephone_hint').css("display","block");
			}
			else if(result == 'cellphone_null' ){
				$('.cellphone_hint').text("該欄位必填");
				$('.cellphone_hint').css("display","block");
			}
			else if(result == 'address_null' ){
				$('.address_hint').text("該欄位必填");
				$('.address_hint').css("display","block");
			}
			else if(result == 'email_null'){
				$('.email_hint').text("該欄位必填");
				$('.email_hint').css("display","block");
			}
			else if(result == 'telephone_wrong'){
				$('.telephone_hint').text("電話格式錯誤!");
				$('.telephone_hint').css("display","block");
			}
			else if(result == 'cellphone_wrong'){
				$('.cellphone_hint').text("手機格式錯誤");
				$('.cellphone_hint').css("display","block");
			}
			else if(result == 'email_wrong'){
				$('.email_hint').text("email格式錯誤");
				$('.email_hint').css("display","block");
			}
			else if(result == 'name_over'){
				$('.name_hint').text("姓名最多6個字");
				$('.name_hint').css("display","block");
			}
			else if(result == 'telephone_over'){
				$('.telephone_hint').text("電話最多10個字");
				$('.telephone_hint').css("display","block");
			}
			else if(result == 'cellphone_over'){
				$('.cellphone_hint').text("手機最多10個字");
				$('.cellphone_hint').css("display","block");
			}
			else if(result == 'address_over'){
				$('.address_hint').text("地址最多100個字");
				$('.address_hint').css("display","block");
			}
			else if(result == 'email_over'){
				$('.email_hint').text("email最多50個字");
				$('.email_hint').css("display","block");
			}
			else{
				if(result == 'success'){
					isChange = false;
					location.reload();
				}
				console.log(result);
			}

		},
		error: function(error){

		}
	});

};

$(function () { //判斷是否正在編輯
	$('input,textarea').change(function () {
        isChange = true;
     });

	$(window).on('beforeunload', function (e) {
        if (isChange) {
            return '資料尚未儲存，確定要離開該頁面？';
        };
    });
});

</script>