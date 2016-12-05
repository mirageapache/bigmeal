<?php if (!isset($_SESSION)) {session_start();} ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>青食市集-後台</title>

	<!-- css -->
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap.css.map")?>">
	<!-- <link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.css.map")?>"> -->
	<link rel="stylesheet" href="<?=base_url("/package/css/fontello/fontello.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/fontello/animation.css")?>">
 
	<link rel="stylesheet" href="<?=base_url("/css/common.css")?>">
	<link rel="stylesheet" href="<?=base_url("/css/back_panel.css")?>">

	<?php if (isset($css)){foreach ($css as $css): ?>
	   <link rel="stylesheet" href="<?=base_url().$css;?>" />
	<?php endforeach; }?>

  	<!-- script -->

	<script type="text/javascript" src="<?=base_url("/package/js/jquery-2.1.3.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/package/js/bootstrap.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/package/js/jquery.cookie.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/js/back_panel.js")?>"></script>

	<?php if (isset($js)){foreach ($js as $js): ?>
	   <script type="text/javascript" src="<?=base_url().$js;?>" ></script>
	<?php endforeach; }?>

</head>
<body>


<!-- 左側選單 -->
<div id="back_panel_menu">
	<div>
		<ul class="menu_item">
			<li class="action">總覽</li>
			<li>會員管理</li>
			<li>產品管理</li>
			<li>訂單管理</li>
			<li>銷售資訊</li>
			<li>報表</li>
		</ul>
	</div>
</div>

<!-- 訊息框 -->
<div id="alert" class="hidden-xs" hidden>
	<h4 id="alert_text">
		message box!!
	</h4>
</div>

<!-- 小訊息框 -->
<div id="alert_xs" class="hidden-sm hidden-md hidden-lg" hidden>
	<label id="alert_text_xs">
		message box!!
	</label>
</div>

<div id="black_panel" onclick="black_panel()"></div>
<!-- <button class="btn" onclick="call_alert('123456789')">test</button> -->


<script type="text/javascript">
	function login(){
		location.href = "<?=site_url('/user/login_page/_')?>";
	}

	function logout(){
		location.href = "<?=site_url('/user/logout')?>";
	}
</script>