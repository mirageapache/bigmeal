<?php if (!isset($_SESSION)) {session_start();} ?>
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

	<?php if (isset($css)){foreach ($css as $css): ?>
	   <link rel="stylesheet" href="<?=base_url().$css;?>" />
	<?php endforeach; }?>

  	<!-- script -->

	<script type="text/javascript" src="<?=base_url("/package/js/jquery-2.1.3.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/package/js/bootstrap.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/package/js/jquery.cookie.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/js/partial.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/js/common.js")?>"></script>

	<?php if (isset($js)){foreach ($js as $js): ?>
	   <script type="text/javascript" src="<?=base_url().$js;?>" ></script>
	<?php endforeach; }?>

</head>
<body>

	<!-- 導覽列 -->
	<nav class="navbar hidden-xs" background="<?=base_url("/data/image/nav_bg.jpg")?>">
	    <a class="navbar-brand" href="<?=site_url("/main/index")?>" title="首頁">青食市集</a>
		<span class="menu">
			<a href="<?=site_url("/main/main_page/vegetable")?>">蔬菜</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("/main/main_page/fruit")?>">水果</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("/main/main_page/meat")?>">肉類</a>&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp 
			<a href="<?=site_url("/main/main_page/cereal")?>">五穀雜糧</a>
		</span>

		<!-- 會員 -->
		<span class="user_pnael" >
			<?php if (!isset($_SESSION['user'])) { ?>
				<button class="btn btn-primary pull-right"  onclick="login()"><a class="in_btn">登入</button>
			<?php } ?>		
			<?php if (isset($_SESSION['user'])) { ?>
			
			<label class="user_name pull-right" onclick="open_user()"><?php echo $_SESSION['user']->account ?>
				<i class="icon-down-dir"></i>
			</label>
			
			<div class="user_option">
				<div class="triangle"></div>
				<h4><a href="<?=site_url("/user/user_page/1")?>"><i class=""></i>會員資料</a></h4>
				<h4><a href="<?=site_url("/user/user_page/2")?>"><i class=""></i>查詢訂單</a></h4>
				<!-- <h4><a href="<?=site_url("/user/user_page/3")?>"><i class=""></i>購物記錄</a></h4>
				<h4><a href="<?=site_url("/user/user_page/4")?>"><i class=""></i>收藏商品</a></h4> -->
				<?php if ($_SESSION['user']->user_type == 2) { ?>
				<h4><a href="<?=site_url("/backpanel/back_main_page/0")?>" target="blank"><i class=""></i>網站管理</a></h4>
				<?php } ?>
				<hr style="margin:5px 0" />
			    <button class="logout_btn btn btn-success pull-right" onclick="logout()"><i class="icon-logout"></i>登出</button>
			</div>
				
			<?php } ?>

			<a class="basket_link pull-right" href="<?=site_url("/main/basket")?>" title="購物籃" ><i class="icon-th-large"></i></a>
		</span>

		<!-- 搜尋 -->
		<?php if (isset($index)) { ?>
			<span class="search hidden-xs hidden-sm pull-right">
				<form>
					<input class="search_input" type="text" placeholder="搜尋產品" />
					<i class="search_submit icon-search" onclick="search()"></i>
				</form>
			</span>
		<?php } ?>

	</nav>

	<!-- 小螢幕導覽列 -->
	<div class="navbar_xs visible-xs">
		<button class="left_menu_btn" onclick="open_left_menu()"><i class="icon-menu"></i></button>
		<a class="brand" href="<?=site_url("/main/index")?>">青食市集</a>
		<a class="basket_link pull-right" href="<?=site_url("/main/basket")?>" title="購物籃" ><i class="icon-th-large"></i></a>
	</div>

	<!-- 左側選單 -->
	<div id="left_menu" class="visible-xs" data-show="false">
		<div>
			<?php if (!isset($_SESSION['user'])) { ?>
				<button class="xs_login btn btn-primary" onclick="login()">登入</button>
			<?php } ?>		
			<?php if (isset($_SESSION['user'])) { ?>
			<label class="user_name" onclick="open_user_xs()"><?php echo $_SESSION['user']->account ?>
				<i class="icon-down-dir"></i>
			</label>
			<div class="user_option_xs">
				<div class="triangle"></div>
				<h4><a href="<?=site_url("/user/user_page/1")?>">會員資料</a></h4>
				<h4><a href="<?=site_url("/user/user_page/2")?>">查詢訂單</a></h4>
<!-- 				<h4><a href="<?=site_url("/user/user_page/3")?>">購物記錄</a></h4>
				<h4><a href="<?=site_url("/user/user_page/4")?>">收藏商品</a></h4> -->
				<?php if ($_SESSION['user']->user_type == 2) { ?>
				<h4><a href="<?=site_url("/backpanel/back_main_page/0")?>" target="blank"></i>網站管理</a></h4>
				<?php } ?>
			</div>
			<?php } ?>

			<hr>
			<h3><a href="<?=site_url("/main/main_page/vegetable")?>">蔬菜</a></h3>
			<h3><a href="<?=site_url("/main/main_page/fruit")?>">水果</a></h3>
			<h3><a href="<?=site_url("/main/main_page/meat")?>">肉類</a></h3>
			<h3><a href="<?=site_url("/main/main_page/cereal")?>">五穀雜糧</a></h3>
			<hr>
			<?php if (isset($_SESSION['user'])) { ?>
				<button class="xs_logout btn btn-success pull-right" onclick="logout()"><i class="icon-logout"></i>登出</button>
			<?php } ?>
		</div>
	</div>
	<div id="black_panel" onclick="black_panel()"></div>
	
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

<script type="text/javascript">
	function login(){
		location.href = "<?=site_url('/user/login_page/_')?>";
	}

	function logout(){
		location.href = "<?=site_url('/user/logout')?>";
		$.cookie('basket', null, { path: '/', expires: -1 });
	}

	// 關閉網站(沒實際作用)
	window.onunload = function(event) {
	  	$.ajax({
			url: "/index.php/main/close_site",
			type: "GET",
			data: {} ,
			success: function(result){
				$.cookie('basket', null, { path: '/', expires: -1 });
			}
		});
	};
</script>