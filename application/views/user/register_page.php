<?php include(dirname(__file__)."/../partial/site_head.php");?>

<div class="container">
	<div class="register_panel">
		<h3 style="margin: 0 10px 10px;">註冊</h3>
		<table class="fill_in_table">
			<tr>
				<td>
					<label class="title">*帳號</label><label class="hint account_hint pull-right">帳號已存在</label>
					<input class="account form-control" type="text" placeholder="輸入英文或數字4-20個字" data-check="false" maxlength="20" title ="" />
				</td>
			</tr>
			<tr>
				<td>
					<label class="title">*密碼</label><label class="hint password_hint pull-right"></label>
					<input class="password form-control" type="password" placeholder="輸入英文或數字8-20個字" data-check="false" maxlength="20" title="" />
				</td>
			</tr>
			<tr>
				<td>
					<label class="title">*確認密碼</label><label class="hint confirm_hint pull-right"></label>
					<input class="password_confirm form-control" type="password" placeholder="再次輸入密碼" data-check="false" maxlength="20" title="" />
				</td>
			</tr>
		</table>
		<label class="rule_label"><input class="rule_read" type="checkbox" onclick="read_rule();"> 我已閱讀</input></label>
		<a href="<?=site_url("/main/rule")?>" target="blank">《網站使用條款》</a>
		<hr>
		<br/>
		<button class="register_btn btn btn-primary" disabled="disabled">註冊</button>
		
	</div>
</div>
<script type="text/javascript">
	function read_rule(){
		if ($('.rule_read').prop('checked')) {
			$('.register_btn').attr('disabled',false);
		}
		else{
			$('.register_btn').attr('disabled',true);
		}
	};
</script>