<?php include(dirname(__file__)."/../partial/site_head.php");?>

<div class="container">
	<div class="login_panel">
		<h3 style="margin: 0 10px 10px;">登入</h3>
		<form class="login_form" action="<?=site_url("/user/login_action")?>" method="post">
			<input class="login_account form-control" name="account" type="text" placeholder="Account" maxlength="20" />
			<input class="login_password form-control" name="password" type="password" placeholder="Password" maxlength="20" />
			<input class="n" name="n" type="password" value="<?php echo $n ?>" hidden/>
			<?php if (isset($errorMessage)) { ?>
				<label class="login_hint"><?=$errorMessage?></label>
			<?php } ?>
			<!-- <button class="login_btn btn btn-primary">登入</button> -->
			<input id="danru" class="btn btn-primary" type="submit" value="登入" />
		</form>
		<span><a href=""><h5><i class="icon-help-circled"></i>忘記密碼</h5></a></span>
		<span><a href="<?=site_url("/user/register_page")?>"><h5><i class="icon-info-circled"></i>前往註冊</h5></a></span>
	</div>
</div>


</body>
</html>

