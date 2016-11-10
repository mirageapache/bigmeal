<h2>訂單資訊</h2>
<div id="order_mg_detail">
	<div class="row">
		<div class="col-lg-5">
			<table class="order_info">
				<tr>
					<td class="title">訂單編號</td>
					<td class="content order_id"></td>
				</tr>
				<tr>
					<td class="title">訂單狀態
						<i class="icon-pencil" style="font-size:12px;" title="點兩下可修改"></i>
					</td>
					<td class="content state hidden-xs" title="點兩下可修改" ondblclick="modify_switch('show')"></td>
					<td class="content state hidden-sm hidden-md hidden-lg" title="點一下可修改" onclick="modify_switch('show')"></td>
					<td class="modify_state" hidden>
						<select class="select_state form-control">
							<option value="0">-</option>
							<option value="1">等待出貨</option>
							<option value="2">已出貨</option>
							<option value="3">已付款</option>
							<option value="9">已完成</option>
						</select>
						<i class="close_modify icon-cancel" onclick="modify_switch('hide')"></i>
					</td>
				</tr>
				<tr>
					<td class="title">金額</td>
					<td class="content total"></td>
				</tr>
				<tr>
					<td class="title">訂購時間</td>
					<td class="content order_time"></td>
				</tr>
				<tr>
					<td class="title">出貨時間</td>
					<td class="content deliver_time"></td>
				</tr>
				<tr>
					<td class="title">付款時間</td>
					<td class="content pay_time"></td>
				</tr>
				<tr>
					<td class="title">完成時間</td>
					<td class="content finish_time"></td>
				</tr>
			</table>
		</div>
		<div class="col-lg-7">
			<table class="receiver_info">
				<tr>
					<td class="title">訂購帳號</td>
					<td class="content account"></td>
				</tr>
				<tr>
					<td class="title">收件人</td>
					<td class="content name"></td>
				</tr>
				<tr>
					<td class="title">電話</td>
					<td class="content phone"></td>
				</tr>
				<tr>
					<td class="title">地址</td>
					<td class="content address"></td>
				</tr>
				<tr>
					<td class="title">E-mail</td>
					<td class="content email"></td>
				</tr>
				<tr>
					<td class="title">運送方式</td>
					<td class="content deliver_type"></td>
				</tr>
				<tr>
					<td class="title">付款方式</td>
					<td class="content pay_type"></td>
				</tr>


			</table>
		</div>
	</div>

	<div class="order_content">
		<table class="content_table">
		</table>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
	get_order_detail();

	$('.select_state').change(function(){
		modify_order();
	});
});

function get_order_detail(){
	$.ajax({
		url:'/index.php/backpanel/get_order_detail',
		type:'GET',
		data:{},	
		success:function(result){
			obj = JSON.parse(result);
			$.each(obj[0],function(key,value){
				if(key == 'state'){
					value = order_state_convert(value);
					$('.select_state').val(value);
				}
				else if (key == 'total') {
					value = "$NT "+value;
				}
				else if (key == 'deliver_type') {
					value = deliver_type_convert(value);
				}
				else if (key == 'pay_type') {
					value = pay_type_convert(value);
				}
				else if (key == 'address'){
					value = obj[0].post_code +' '+ value;
				}
				$('.'+key).text(value);
			})

			get_order_content();
		}
	});
}

function get_order_content(){
	order_id = $('.order_id').text();
	$.ajax({
		url:'/index.php/user/get_order_detail_content',
		type:'POST',
		data:{order_id:order_id},	
		success:function(result){
			obj = JSON.parse(result);
			$('.content_table').text("");

			$('.content_table').append('<tr class="table_title">'+
				'<th style="width:46px;">項目</th><th>品名</th>'+
				'<th class="hidden-xs">價格</th>'+
				'<th class="hidden-xs">數量</th>'+
				'<th class="visible-xs" style="width:130px">價格/數量</th></tr>');

			$.each(obj,function(key,value){
				$('.content_table').append('<tr class="table_item">'+
					'<td class="item_no">'+ (key+1) +'</td>'+
					'<td >'+ value.name +'</td>'+
					'<td class="hidden-xs">$NT '+ value.sub_total +'</td>'+
					'<td class="hidden-xs">'+ value.amount +'</td>'+
					'<td class="visible-xs">$NT '+ value.sub_total +' / '+ value.amount+'</td>'+
				'</tr>');
			});
		}
	});
}

// 修改訂單狀態
function modify_order(){
	order_id = $('.order_id').text();
	state = $('.select_state').val();
	$.ajax({
		url:'/index.php/backpanel/modify_order',
		type:'POST',
		data:{order_id:order_id,state:state},	
		success:function(result){
			modify_switch('close');
			get_order_detail();
		}
	});
}


function modify_switch(action){
	if(action == 'show'){
		$('.state').hide();
		$('.modify_state').show();
	}
	else{
		$('.modify_state').hide();
		$('.state').show();	
	}
}

</script>