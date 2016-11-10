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
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.min.css")?>">
	<link rel="stylesheet" href="<?=base_url("/package/css/bootstrap/bootstrap-theme.css.map")?>">
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
	<script type="text/javascript" src="<?=base_url("/package/js/jquery.uploadfile.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/js/back_panel.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("/js/common.js")?>"></script>

	<?php if (isset($js)){foreach ($js as $js): ?>
	   <script type="text/javascript" src="<?=base_url().$js;?>" ></script>
	<?php endforeach; }?>
</head>
<body>
<!-- 內容 -->
<div id="back_panel" data-index="<?php echo $index;?>">
</div>
<!-- 左側選單 -->
<div id="back_panel_menu">
	<div>
		<ul class="menu_item">
			<li id="overview" class="action" onclick="get_back_page('overview')">總覽</li>
			<li id="user_mg" onclick="get_back_page('user_mg')">會員管理</li>
			<li id="product_mg" onclick="get_back_page('product_mg')">產品管理</li>
			<li id="order_mg" onclick="get_back_page('order_mg')">訂單管理</li>
			<li id="sale_info" onclick="get_back_page('sale_info')">銷售資訊</li>
			<li id="report" onclick="get_back_page('report')">報表</li>
		</ul>
	</div>
</div>
<span class="menu_tag visible-xs" onclick="back_menu_switch()"><i class="icon-menu"></i></span>


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

<div id="black_panel" onclick="close_panel()"></div>

</body>
</html>
<script type="text/javascript">
var index_page;
$(document).ready(function(){
	index = $('#back_panel').attr("data-index");
	if(index == '1'){
		index_page = 'user_mg';
	}
	else if(index == '2'){
		index_page = 'product_mg';
	}
	else if(index == '3'){
		index_page = 'order_mg';
	}
	else if(index == '4'){
		index_page = 'sale_info';
	}
	else if(index == '5'){
		index_page = 'report';
	}

	get_back_page(index_page);
	if (window.innerWidth < 767) {
		back_menu_switch('close');
		$('#back_panel').css("width","100%");
	};
});

function get_back_page(index,id){  //換頁
	//是否在編輯資料中
	if(editing()){
		isChange = false;
		if (index == null) {index = 'overview';};
		$('.menu_item').find('li').attr("class","");
		$.ajax({
			url: "/index.php/backpanel/get_back_page",
			type: "POST",
			data: {'index':index,'id':id},
			success: function(result){
				$('#back_panel').text("");
				$('#back_panel').append(result);
			}
		});
		if(index == 'user_mg_detail'){
			$('#user_mg').attr("class","action");
		}
		else if(index == 'product_mg_detail'){
			$('#product_mg').attr("class","action");
		}
		else if(index == 'order_mg_detail'){
			$('#order_mg').attr("class","action");
		}
		else{
			$('#'+index).attr("class","action");
		}
		back_menu_switch('close');
	}


}

function back_menu_switch(cond){
	if(cond == 'open'){
		$('#back_panel_menu').css("left","0px");
		$('.menu_tag').attr("onclick","back_menu_switch('close')");
		if (window.innerWidth < 766) {
			$('#black_panel').css("display","block");
			$('#black_panel').css("background-color","rgba(50,50,50,0.5)");
		};
	}
	else{
		if (window.innerWidth < 766) {
			$('#back_panel_menu').css("left","-280px");
			$('.menu_tag').attr("onclick","back_menu_switch('open')");
			$('#black_panel').css("display","none");
		};
	}
}

function close_panel(){
	back_menu_switch('close');
}

window.onresize = function(event) {
	if(event.target.innerWidth > 766){
    	back_menu_switch('open');
		$('#back_panel').css("width","calc(100% - 280px)");
    	$('#black_panel').css("display","none");
	}
	else{
		$('#back_panel').css("width","100%");
    	back_menu_switch('close');
	}
}

</script>