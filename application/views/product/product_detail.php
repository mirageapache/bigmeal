<?php include(dirname(__file__)."/../partial/site_head.php");?>
<div class="container">
	<div class="product_detail row">
		<div class="product_img col-md-6">
			<img src="<?=base_url("$data->path/$data->img_name.jpg")?>">
		</div>
		<div class="product_info col-md-6">
			<h2 class="name"><?php echo $data->name; ?></h2>
			<label class="price">$NT <?php echo $data->price; ?></label>
			<laebl class="unit">/<?php echo $data->unit; ?></laebl>
			<br>
			<h4>產地：<?php echo $data->place; ?></h4>
			<h4>分類：<?php echo $data->b_type; ?> / <?php echo $data->s_type; ?></h4>
			<hr style="margin: 15px 0;border-color: #aaa;">
			<span>
				<label class="amount_title">購買數量：</label>
				<select class="amount form-control" name="amount">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
				</select>
				<label class="unit_title">/台斤</label>
			</span>
			<br>
			<?php if( $data->stock == 0){ ?>
				<button class="buy_it btn btn-default" disabled="disabled">庫存不足</button>
			<?php } else{ ?>
				<button class="buy_it btn btn-success" onclick="add_basket('<?php echo $data->product_id; ?>','<?php echo $data->name; ?>',<?php echo $data->price; ?>,'<?php echo $data->unit; ?>','<?php echo $data->path.'/'.$data->img_name; ?>'+'.jpg')">加入菜籃</button>
			<?php } ?>
			
<!-- 			<button class="btn btn-primary" onclick="get_cookie()">cookie</button>
			<button class="btn btn-primary" onclick="delete_cookie()">delete</button> -->
			
		</div>

	</div>
</div>