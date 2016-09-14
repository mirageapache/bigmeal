<?php include("/../partial/site_head.php"); ?>

<div class="container">

	<div class="menu_panel" data-index="<?php echo $num;?>" >
		<span class="tag_action" data-index="1">
			<label class="user_info_label tag_label">會員資料</label>
		</span>
		<span class="tag" data-index="2">
			<label class="order_list_label tag_label">查詢訂單</label>
		</span>
		<span class="tag" data-index="3">
			<label class="purchased_label tag_label">購物記錄</label>
		</span>
		<span class="tag" data-index="4">
			<label class="collection_label tag_label">我的收藏</label>
		</span>
	</div>
	<div class="partial_view">
		
	</div>
</div>
<?php include("/../partial/site_footer.php"); ?>