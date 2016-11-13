<h2>編輯產品</h2>
<div id="product_mg_detail">
	<div class="row">
		<div class="col-md-5" style="text-align:center;">
			<form class="img_form" action="/index.php/backpanel/modify_product_img" method="POST" enctype="multipart/form-data">
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
			<input class="name form-control" />
			<label class="label_title">售價 <label class="hint price_hint pull-right"></label></label>
			<input class="price form-control" type="number" min="0" />
			<label class="label_title">庫存 <label class="hint stock_hint pull-right"></label></label>
			<input class="stock form-control" type="number" min="0"/>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label class="label_title">產地 <label class="hint place_hint pull-right"></label></label>
			<input class="place form-control" />
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
			<input class="unit form-control" />
		</div>
	</div>
	<div>
		<label class="label_title">產品說明 <label class="hint description_hint pull-right"></label></label>
		<textarea class="description form-control"></textarea>
		<label class="label_title">產品規格 <label class="hint standard_hint pull-right"></label></label>
		<textarea class="standard form-control"></textarea>
	</div>
	<button class="btn btn-success pull-right" onclick="modify_product()">儲存</button>
</div>

<script type="text/javascript">
var obj = [];
$(document).ready(function(){
	get_product_detail();

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

// 查詢產品內容
function get_product_detail(){
	$.ajax({
		url:'/index.php/backpanel/get_product_detail',
		type:'GET',
		data:{},	
		success:function(result){
			obj = JSON.parse(result);
			$('.product_img').attr("src",obj[0].path+'/'+obj[0].img_name);
			$('.name').val(obj[0].name);
			$('.price').val(obj[0].price);
			$('.stock').val(obj[0].stock);
			$('.place').val(obj[0].place);
			$('.s_type').val(obj[0].s_type);
			$('.unit').val(obj[0].unit);
			$('.description').val(obj[0].description);
			$('.standard').val(obj[0].standard);
		}
	});
}

// 修改產品內容
function modify_product(){
	isChange = false;
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
		url:'/index.php/backpanel/modify_product',
		type:'POST',
		data:{product_id:obj[0].product_id,name:name,price:price,stock:stock,place:place,b_type:b_type,s_type:s_type,
			  unit:unit,description:description,standard:standard,
			  img_id:obj[0].img_id,img_name:obj[0].img_name},
		success:function(result){
			console.log(result);
			if ($('input[type=file]').val().length > 0) {
				$('.upload_img').trigger('click');
			}
			else{
				location.replace("<?=site_url('/backpanel/back_main_page/2')?>");
			}
		}
	});
}


// 判斷是否正在編輯
$(function () {
	$('input,textarea').change(function () {
        isChange = true;
     });

	$(window).on('beforeunload', function (e) {
        if (isChange) {
            return '資料尚未儲存，確定要離開該頁面？';
        };
    });
});
</script>