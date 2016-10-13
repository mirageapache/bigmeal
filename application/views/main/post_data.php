<?php include(dirname(__file__)."/../partial/site_head.php");?>

<div class="container">
	<div class="post_data_panel">
		<h2>填寫收件資料</h2>
		
		<form class="">
			<label class="same_user"><input type="checkbox"></input>同會員資料</label>
			<h4 class="title">*收件人<input class="name form-control" type="text" /></h4>
			<h4 class="title">*地址
				<input class="post_code form-control" placeholder="郵地區號" />
				<textarea class="address form-control" ></textarea></h4>
			<h4 class="title">*電話/手機<input class="phone form-control" type="text" /></h4>
			<h4 class="title">E-mail<input class="email form-control" type="text" /></h4>
			<h4 class="title">運送方式：</h4>
			<label><input class="deliver" name="deliver_type" type="radio" value="0" checked/>宅配</label>&nbsp&nbsp&nbsp
			<label><input class="deliver" name="deliver_type" type="radio" value="1" />郵寄</label>
			<h4 class="title">付款方式：</h4>
			<label><input class="pay_type" name="pay_type" type="radio" value="0" checked/>貨到付款</label>&nbsp&nbsp&nbsp
			<label><input class="pay_type" name="pay_type" type="radio" value="1" />帳轉</label>&nbsp&nbsp&nbsp
			<label><input class="pay_type" name="pay_type" type="radio" value="2" />信用卡</label>
		</form>
		 
		<hr style="border-color:#ddd;">
		<button class="btn btn-success pull-right">送出資料</button>
	</div>
</div>
</body>
</html>