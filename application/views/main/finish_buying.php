<?php include(dirname(__file__)."/../partial/site_head.php");?>

<!-- <?php echo $order['order_id']; ?> -->
<div class="container">
	
	<div class="finish_order_panel ">
		<h2>完成訂購</h2>
		<div class="row">
			<div class="col-sm-6">
				<h3>訂單資訊</h3>
				<table class="order_info">
					<tr>
						<td class="title">訂單編號</td>
						<td class="content"><?php echo $order['order_id']; ?></td>
					</tr>
					<tr>
						<td class="title">訂購日期</td>
						<td class="content"><?php echo $order['order_time']; ?></td>
					</tr>
					<tr>
						<td class="title">總金額</td>
						<td class="content">$NT <?php echo $order['total']; ?></td>
					</tr>
					<tr>
						<td class="title">訂單狀態</td>
						<?php if($order['state'] == 0){ ?>
							<td class="content">新訂單</td>
						<?php }elseif($order['state'] == 1){ ?>
							<td class="content">等待出貨</td>
						<?php }elseif($order['state'] == 2){ ?>
							<td class="content">已出貨</td>
						<?php }elseif($order['state'] == 3){ ?>
							<td class="content">訂單完成</td>
						<?php } ?>
					</tr>
				</table>
			</div>
			<div class="col-sm-6">
				<h3>訂單資訊</h3>
				<table class="reciver_info">
					<tr>
						<td class="title">收件人</td>
						<td class="content"><?php echo $order['name']; ?></td>
					</tr>
					<tr>
						<td class="title">地址</td>
						<td class="content"><?php echo $order['post_code'].' '.$order['address']; ?></td>
					</tr>
					<tr>
						<td class="title">電話/手機</td>
						<td class="content"><?php echo $order['phone']; ?></td>
					</tr>
					<tr>
						<td class="title">E-mail</td>
						<td class="content"><?php echo $order['email']; ?></td>
					</tr>
					<tr>
						<td class="title">運送方式</td>
						<?php if($order['deliver_type'] == 0){ ?>
							<td class="content">宅配</td>
						<?php }elseif($order['deliver_type'] == 1){ ?>
							<td class="content">郵寄</td>
						<?php } ?>
					</tr>
					<tr>
						<td class="title">付款方式</td>
						<?php if($order['pay_type'] == 0){ ?>
							<td class="content">貨到付款</td>
						<?php }elseif($order['pay_type'] == 1){ ?>
							<td class="content">轉帳</td>
						<?php }elseif($order['pay_type'] == 2){ ?>
							<td class="content">信用卡</td>
						<?php } ?>
					</tr>
				</table>
			</div>
		</div>
		<hr style="border-color: #ddd">
		<div style="text-align: center; margin-top: 20px;">
			<a href="<?=site_url("/main/index")?>">回首頁</a>
			&nbsp&nbsp|&nbsp&nbsp
			<a href="<?=site_url("/user/user_page/2")?>">查詢訂單</a>
		</div>
	</div>
</div>
</body>
</html>