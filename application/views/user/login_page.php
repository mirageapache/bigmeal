<?php include("/../partial/site_head.php"); ?>



<div class="container">
	<div class="login_panel">
		<h3 style="margin: 0 10px 10px;">登入</h3>
		<input class="account form-control" type="text" placeholder="Account" />
		<input class="password form-control" type="password" placeholder="Password" />
		<button class="login_btn btn btn-primary">登入</button>
		<span><a href=""><h5><i class="icon-help-circled"></i>忘記密碼</h5></a></span>
		<span><a href="<?=site_url("/user/regist_page")?>"><h5><i class="icon-info-circled"></i>前往註冊</h5></a></span>
	</div>
</div>



<?php include("/../partial/site_footer.php"); ?>
