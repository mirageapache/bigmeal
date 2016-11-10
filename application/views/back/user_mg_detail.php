<div id="user_mg_detail" class="row">
	<div class="col-md-6">
		<h3>帳號資訊</h3>
		<table class="account_info">
			<tr>
				<td class="title">使用者編號</td>
				<td class="content user_id"></td>
			</tr>
			<tr>
				<td class="title">帳號</td>
				<td class="content account"></td>
			</tr>
			<tr>
				<td class="title">狀態</td>
				<td class="content state"></td>
			</tr>
			<tr>
				<td class="title">類型<i class="edit icon-pencil" title="點兩下可修改"></i></td>
				<td class="content user_type hidden-xs" title="點兩下可修改" ondblclick="modify_switch('show')"></td>
				<td class="content user_type hidden-sm hidden-md hidden-lg" title="點一下可修改" onclick="modify_switch('show')"></td>
				<td class="modify" hidden style="padding:0 10px;">
					<select class="form-control">
						<option class="normal_user" value="1">一般會員</option>
						<option class="system_admin" value="2">網站管理員</option>
					</select>
					<i class="close_modify icon-cancel" onclick="modify_switch('hide')"></i>
				</td>
			</tr>
			<tr>
				<td class="title">註冊日期</td>
				<td class="content create_day"></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<h3>使用者資訊</h3>
		<table class="user_info">
			<tr>
				<td class="title">姓名</td>
				<td class="content name"></td>
			</tr>
			<tr>
				<td class="title">電話</td>
				<td class="content telephone"></td>
			</tr>
			<tr>
				<td class="title">手機</td>
				<td class="content cellphone"></td>
			</tr>
			<tr>
				<td class="title">地址</td>
				<td class="content address"></td>
			</tr>
			<tr>
				<td class="title">Email</td>
				<td class="content email"></td>
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	get_user_detail('get');
	$('.modify').find('select').change(function(){
		if($(this).val()!=$('.user_type').attr("data-type")){
			$.ajax({
				url:'/index.php/backpanel/user_detail',
				type:'POST',
				data:{'action':'update','user_type':$(this).val()},
				success:function(result){
					$('.user_type').text(user_type_convert(result));
					$('.user_type').attr("data-type",result);
					modify_switch('hide');
				}
			});
		}
	});
});

function get_user_detail(action){
	$.ajax({
		url:'/index.php/backpanel/user_detail',
		type:'POST',
		data:{'action':action},	
		success:function(result){
			obj = JSON.parse(result);
			$('.user_id').text(obj.ID);
			$('.account').text(obj.account);
			$('.state').text(user_state_convert(obj.state));
			$('.user_type').text(user_type_convert(obj.user_type));
			$('.create_day').text(obj.create_day);
			$('.name').text(obj.name);
			$('.telephone').text(obj.telephone);
			$('.cellphone').text(obj.cellphone);
			$('.address').text(obj.address);
			$('.email').text(obj.email);

			$('.user_type').attr("data-type",obj.user_type);
			if(obj.user_type == 1){
				$('.normal_user').prop("selected",true);
			}
			else if(obj.user_type == 2){
				$('.system_admin').prop("selected",true);
			}
		}
	});
}

function modify_switch(action){
	if(action == 'show'){
		$('.user_type').hide();
		$('.modify').show();
	}
	else{
		$('.modify').hide();
		$('.user_type').show();	
	}
}

</script>