<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php 
			if(isset($pageTitle)){ 
				echo $pageTitle ; //透過變數設定
			} else{ 
				echo "青食市集" ; //預設標題
			} 
		?>
	</title>

	<!-- css -->
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap.css.map")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.css.map")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/fontello/fontello.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/fontello/animation.css")?>">
 
	<link rel="stylesheet" href="<?=base_url("/css/main.css")?>">
	<link rel="stylesheet" href="<?=base_url("/css/common.css")?>">
	<link rel="stylesheet" href="<?=base_url("/css/partial.css")?>">



	<?php foreach ($css as $css): ?>
	   <link rel="stylesheet" href="<?=base_url().$css;?>" />
	<?php endforeach;?>

  	<!-- script -->

	<script type="text/javascript" src="<?=base_url("/package/js/jquery-2.1.3.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/package/js/bootstrap.min.js")?>"></script>
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
	
	<script type="text/javascript" src="<?=base_url("/js/user.js")?>"></script>



</head>
<body>

	<!-- 導覽列 -->
	<nav class="navbar hidden-xs" background="<?=base_url("/data/image/nav_bg.jpg")?>">
	    <a class="navbar-brand" href="<?=site_url("/main/index")?>">青食市集</a>
 		<!--<label class="pull-right" data-toggle="modal" data-target=".login">登入</label>
		<label class="pull-right signin_btn" data-toggle="modal" data-target=".signin">註冊</label> -->
		<span class="menu">
			<a href="<?=site_url("")?>">項目1</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("")?>">項目2</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("")?>">項目3</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("")?>">項目4</a>
		</span>

		<!-- 會員 -->
		<span class="user_pnael" >
			<button class="btn btn-primary pull-right"><a class="in_btn" href="<?=site_url("/user/login_page")?>">登入</a></button>		
			

		</span>

		<span class="search hidden-xs hidden-sm pull-right">
			<form>
				<input type="text" placeholder="search" />
				<input class="submit" type="submit" value=" "/>
				<i class="icon-search"></i>
			</form>
		</span>

		
	</nav>

	<!-- 小螢幕導覽列 -->
	<div class="navbar-xs visible-xs">
		<button class="left_menu_btn"><i class="icon-menu"></i></button>
		<a class="brand" href="<?=site_url("/main/index")?>">Wardrobe</a>
	</div>

	<!-- 左側選單 -->
	<div id="left_menu" class="hidden-sm hidden-md hidden-lg" data-show="false">
		<div>
			<h3><a>首頁</a></h3>
			<hr>
			<h3><a>item</a></h3>
			<h3><a>item</a></h3>
			<h3><a>item</a></h3>
			<h3><a>item</a></h3>
		</div>
	</div>
	<div id="black_panel" class="hidden-sm hidden-md hidden-lg"></div>
