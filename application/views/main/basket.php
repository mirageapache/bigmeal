<?php include(dirname(__file__)."/../partial/site_head.php");?>

<div class="container">
	<div class="basket_panel">
		<h2>購物籃</h2>
		<table class="basket_table hidden-xs">
			<tr class="table_title">
				<th></th>
				<th>品名</th>
				<th>價格</th>
				<th>數量</th>
			</tr>	
			<tr class="hint_message"><td colspan="4"><h3 style="text-align: center;">購物籃沒東西！<a href="<?=site_url("/main/index")?>">去買東西</a></h3></td></tr>

		</table>

		<div class="xs_panel visible-xs">
			<span class="hint_message">
				<h3 style="text-align: center;">購物籃沒東西！
					<br>
					<a href="<?=site_url("/main/index")?>">去逛逛</a>
				</h3>
			</span>
			<div class="product_item">
				<img class="xs_img" src="">
				<h3 class="xs_name"></h3>
				<h4>
					<label class="xs_price"></label>&nbsp&nbsp|&nbsp&nbsp
					<label class="xs_amount"></label>&nbsp&nbsp|&nbsp&nbsp
					<label class="xs_sub_total"></label>
				</h4>
			</div>
			
			<label class="next" onclick="slide('+')"><i class="icon-right-open"></i></label>
			<label class="prev" onclick="slide('-')"><i class="icon-left-open"></i></label>
		</div>
		

		<hr style="border-color:#ddd;">
		
	</div>
</div>
</body>
</html>

<script type="text/javascript">
	data_arr = JSON.parse($.cookie('basket'));
	index = 0;
	if($.cookie('basket') == null){
		$('.hint_message').css("display","grid");
	}
	else{
		$('.hint_message').css("display","none");
		total = 0;

		$.each(data_arr, function(key,value){
			$('.basket_table').append('<tr class="table_contain">'+
				'<td class="img"><img src="<?=base_url("'+value.img_path+'")?>"></td>'+
				'<td class="name">'+value.name+'</td>'+
				'<td class="price">$NT '+value.price+'</td>'+
				'<td class="amount">'+value.amount+'/'+value.unit+'</td>'+
			'</tr>');
			total = total + value.sub_total;
		});

		$('.xs_img').attr("src",data_arr[0].img_path);
		$('.xs_name').text(data_arr[0].name);
		$('.xs_price').text("$NT"+ data_arr[0].price);
		$('.xs_amount').text("數量："+ data_arr[0].amount +" "+ data_arr[0].unit);
		$('.xs_sub_total').text("小計 "+ data_arr[0].sub_total +"元");

		$('.basket_panel').append('<button class="pay btn btn-success pull-right" onclick="gopay()">總共 NT '+ total +'元 結帳</button>');

		if(data_arr.length != 1){
			$('.next').css("display","block");
		}

	}

	function gopay(){
		
		<?php if(!isset($_SESSION['user'])){ ?>
			location.href = "<?=site_url("/user/login_page/1")?>";
		<?php } ?>

		$.ajax({
			url: "/index.php/product/go_pay",
			type: "POST",
			data: {'cookie':$.cookie('basket')} ,
			success: function(result){
				if(result){
					$.cookie('basket', null, { path: '/', expires: -1 });
					location.replace("<?=site_url("/main/post_data")?>");
				}
				console.log(result);
			}
		});

	}

	function slide(act){
		if(act == '+'){
			if (index < (data_arr.length-1)) {
				index++;
			}
		}
		else{
			if (index > 0) {
				index--;
			}
		}
		$('.xs_img').attr("src",data_arr[index].img_path);
		$('.xs_name').text(data_arr[index].name);
		$('.xs_price').text("$NT"+ data_arr[index].price);
		$('.xs_amount').text("數量："+ data_arr[index].amount +" "+ data_arr[index].unit);
		$('.xs_sub_total').text("小計 "+ data_arr[index].sub_total +"元");

		$('.prev').css("display","block");
		$('.next').css("display","block");
		if(index >= data_arr.length-1){
			$('.next').css("display","none"); index = data_arr.length-1;
		}
		if(index <= 0){
			$('.prev').css("display","none"); index = 0;
		}
	}

</script>