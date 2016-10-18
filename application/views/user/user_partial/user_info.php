<h3 class="no_margin">會員資料</h3>
<hr/>

<div class="user_info">
	<div class="row">
		<div class="col-md-2">
			<h5>帳號：
				<?php session_start(); echo $_SESSION['user']->account?>
			</h5>
		</div>
		<div class="col-md-2"><h5><a href="" style="color:blue;">修改密碼</a></h5></div>
	</div>
	<br>

	<div class="alert alert-info" role="alert">
		還沒有任何資料---><label class="no_margin" onclick="partial_view_ajax('1-1')"><b>新增資料</b></span>
	</div>
	<div class="info_panel panel panel-primary">
		<div class="panel-heading">
			<label class="no_margin">會員資料</label>
			<i class="icon-edit pull-right" title="修改" onclick="partial_view_ajax('1-1')"></i>
		</div>
		<div class="panel-body">

			<h5 class="info_data_name">姓名：<label class="no_margin"></label></h5>
			<hr/>
			<h5 class="info_data_telephone">電話：<label class="no_margin"></label></h5>
			<hr/>
			<h5 class="info_data_cellphone">手機：<label class="no_margin"></label></h5>
			<hr/>
			<h5 class="info_data_address">地址：<label class="no_margin"></label></h5>
			<hr/>
			<h5 class="info_data_email">E-mail：<label class="no_margin"></label></h5>
			
		</div>
	</div>

</div>

<script type="text/javascript">

	$.ajax({
			url: "/index.php/user/get_user_data",
			type: "GET",
			data: {} ,
			success: function(result){
				if (result == 'user_null') {
					$('.alert').css("display","block");
					$('.info_panel').css("display","none");
				}
				else{
					obj = JSON.parse(result);
					// console.log(obj);
					$('.info_data_name').find('label').text(obj[0].name);
					$('.info_data_telephone').find('label').text(obj[0].telephone);
					$('.info_data_cellphone').find('label').text(obj[0].cellphone);
					$('.info_data_address').find('label').text(obj[0].post_code+" "+obj[0].address);
					$('.info_data_email').find('label').text(obj[0].email);
					$('.alert').css("display","none");
					$('.info_panel').css("display","block");
				}
			},
			error: function(error){

			}
		});
</script>
