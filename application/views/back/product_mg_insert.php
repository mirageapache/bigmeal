<h2>新增產品</h2>
<div id="product_mg_insert">
	<div class="row">
		<div class="col-md-5" style="text-align:center;">
			<form class="img_form" action="/index.php/backpanel/insert_product_img" method="POST" enctype="multipart/form-data">
				<div class="img_div">
					<img class="product_img" src"">
					<div class="upload_hint" hidden>上傳圖片</div>
				</div>
				<input class="img_input" type="file" name="file" style="display:none;" />
				<input class="upload_img" type="submit" name="submit" hidden/>
			</form>
		</div>
		<div class="col-md-7">
			<label class="label_title">名稱 <label class="hint name_hint pull-right"></label></label>
			<input class="name form-control" maxlength="50" />
			<label class="label_title">售價 <label class="hint price_hint pull-right"></label></label>
			<input class="price form-control" type="number" min="0" maxlength="8" />
			<label class="label_title">庫存 <label class="hint stock_hint pull-right"></label></label>
			<input class="stock form-control" type="number" min="0" maxlength="6" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label class="label_title">產地 <label class="hint place_hint pull-right"></label></label>
			<input class="place form-control" maxlength="10" />
		</div>
		<div class="col-md-4">
			<label class="label_title">類別</label>
			<select class="s_type form-control">
				<optgroup label="生鮮">
					<option value="蔬菜">蔬菜</option>
					<option value="水果">水果</option>
					<option value="肉類">肉類</option>
					<option value="海鮮">海鮮</option>
				</optgroup>
				<optgroup label="乾貨">
					<option value="五穀雜糧">五穀雜糧</option>
				</optgroup>
				<optgroup label="調味料">
					<option value="調味料">調味料</option>
				</optgroup>
				<optgroup label="廚具">
					<option value="廚具">廚具</option>
				</optgroup>
			</select>
		</div>
		<div class="col-md-4">
			<label class="label_title">單位 <label class="hint unit_hint pull-right"></label></label>
			<input class="unit form-control" maxlength="5" />
		</div>
	</div>
	<div>
		<label class="label_title">產品說明 <label class="hint description_hint pull-right"></label></label>
		<textarea class="description form-control"></textarea>
		<label class="label_title">產品規格 <label class="hint standard_hint pull-right"></label></label>
		<textarea class="standard form-control"></textarea>
	</div>
	<button class="btn btn-success pull-right" onclick="insert_product()">新增</button>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$('.img_div').mouseover(function(){
		$('.upload_hint').show();
	}).mouseout(function(){
		$('.upload_hint').hide();
	});

	$('.img_div').click(function(){
		$('input[type=file]').trigger('click');
	});
	$('input[type=file]').on('change', function(){
		img_preview(this);
	});

});

//新增產品
function insert_product(){
	$('.hint').hide();
	temp_arr = ['name','price','stock','place','s_type','unit','description','standard'];
	for (i=0; i<=temp_arr.length-1;i++) {
		if($('.'+temp_arr[i]).val().length == 0){
			$('.'+temp_arr[i]+'_hint').show();
			$('.'+temp_arr[i]+'_hint').text("該欄位必填");
			$('.'+temp_arr[i]).focus();
			return false;
		}
	}

	name = $('.name').val();
	price = $('.price').val();
	stock = $('.stock').val();
	place = $('.place').val();
	s_type = $('.s_type').val();
	b_type = get_b_type(s_type);
	unit = $('.unit').val();
	description = $('.description').val();
	standard = $('.standard').val();

	$.ajax({
		url:'/index.php/backpanel/insert_product',
		type:'POST',
		data:{name:name,price:price,stock:stock,place:place,b_type:b_type,s_type:s_type,
			  unit:unit,description:description,standard:standard},
		success:function(result){
			$('.upload_img').trigger('click');
			get_back_page('product_mg');
		}
	});
}

// 圖片預覽
function img_preview(input) {
 	// 參考 http://jsnwork.kiiuo.com/archives/2258
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.product_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    else{
    	$('.product_img').attr('src',"");
    }
}

</script>
