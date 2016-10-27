<?php include(dirname(__file__)."/../partial/site_head.php");?>

<div class="container">
	<div class="post_data_panel">
		<h2>填寫收件資料</h2>
		
		<form class="">
			<label><input class="same_user" type="checkbox" name="same_user"></input> 同會員資料</label>
			<h4 class="title">*收件人
				<label class="hint name_hint pull-right"></label>
				<input class="name form-control" type="text" />
			</h4>

			<h4 class="title">*地址
				<label class="hint address_hint pull-right"></label>
				<input class="post_code form-control" placeholder="郵地區號" />
				<textarea class="address form-control" ></textarea>
			</h4>
			<h4 class="title">*電話/手機
				<label class="hint phone_hint pull-right"></label>
				<input class="phone form-control" type="text" />
			</h4>
			<h4 class="title">E-mail
				<label class="hint email_hint pull-right"></label>
				<input class="email form-control" type="text" />
			</h4>

			<h4 class="title">運送方式：</h4>
			<label><input class="deliver_0" name="deliver_type" type="radio" value="0" checked/>宅配</label>&nbsp&nbsp&nbsp
			<label><input class="deliver_1" name="deliver_type" type="radio" value="1" />郵寄</label>
			<h4 class="title">付款方式：</h4>
			<label><input class="pay_type_0" name="pay_type" type="radio" value="0" checked/>貨到付款</label>&nbsp&nbsp&nbsp
			<label><input class="pay_type_1" name="pay_type" type="radio" value="1" />帳轉</label>&nbsp&nbsp&nbsp
			<label><input class="pay_type_2" name="pay_type" type="radio" value="2" />信用卡</label>
		</form>
		 
		<hr style="border-color:#ddd;">
		<button class="btn btn-success pull-right" onclick="new_order()">送出資料</button>
	</div>
</div>
</body>
</html>