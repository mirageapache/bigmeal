<?php include("/../partial/site_head.php"); ?>

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
			<tr>
				<td>
					<label class="title">*E-mail</label><label class="hint email_hint pull-right"></label>
					<input class="email form-control" type="email" placeholder="XXXXXXX@XX.XX" data-check="false" maxlength="50"/>
				</td>
			</tr>
		</table>
		<!-- <hr>
			<table class="fill_in_table">
				<tr>
					<td>
						<label class="title">姓名</label><label class="hint name_hint pull-right"></label>
						<input class="name form-control" type="text" placeholder="輸入姓名" />
					</td>
				</tr>
				<tr>
					<td>
						<label class="title">電話</label><label class="hint phone_hint pull-right"></label>
						<input class="phone form-control" type="password" placeholder="09XXXXXXXX" />
					</td>
				</tr>
				<tr>
					<td>
						<label class="title">地址</label><label class="hint address_hint pull-right"></label>
						<input class="address form-control" type="password" placeholder="XX市XX路XX號" />
					</td>
				</tr>
				<tr>
					
				</tr>	

			</table> -->
		<hr>
		<br/>
		<button class="register_btn btn btn-primary" >註冊</button>
		
	</div>
</div>

<?php include("/../partial/site_footer.php");  ?>
