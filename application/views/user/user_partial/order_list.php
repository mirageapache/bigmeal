<h3 class="no_margin">查詢訂單</h3>
<i class="filter_switch icon-wrench visible-xs" data-display="false" title="搜尋條件" onclick="filter_switch()"></i>
<hr/>
<!-- 訂單列表 -->
<div class="user_order_list">
	<div class="filter">
		<span>
			<label>訂單</label>
			<input class="condition form-control" type="text" placeholder="訂單ID / 收件人" />
		</span>
		<span>
			<label>開始日期</label>
			<input class="start_date form-control" type="date" />
		</span>
		<span>
			<label>結束日期</label>
			<input class="end_date form-control" type="date" />
		</span>
		<span class="visible-xs">
			<label>排序條件</label>
			<select class="sort_prop form-control" name="sort_prop">
				<option class="i_order_id_xs" value="order_id">訂單ID</option>
				<option class="i_name_xs" value="name">收件人</option>
				<option class="i_total_xs" value="total">總額</option>
				<option class="i_state_xs" value="state">訂單狀態</option>
				<option class="i_order_time_xs" selected="true" value="order_time">訂單日期</option>
			</select>
		</span>
		<span class="visible-xs">
			<label style="margin:10px;"><input class="asc" name="order_by" value="asc" type="radio" checked/> 遞增</label>
			<label style="margin:10px;"><input class="desc" name="order_by" value="desc" type="radio" /> 遞減</label>
		</span>
	</div>

	<table class="list_table hidden-xs">
		<tr style="border-top:1px solid gray;border-bottom:1px solid gray;">
			<th class="i_order_id th" ondblclick="sort_data('i_order_id')" title="依訂單編號排序" >訂單編號<i class="icon-up-dir" hidden></i></th>
			<th class="i_name th" ondblclick="sort_data('i_name')" title="依收件人排序" >收件人<i class="icon-up-dir" hidden></i></th>
			<th class="i_total th" ondblclick="sort_data('i_total')" title="依總額排序" >總額<i class="icon-up-dir" hidden></i></th>
			<th class="i_state th" ondblclick="sort_data('i_state')" title="依狀態排序" >狀態<i class="icon-up-dir" hidden></i></th>
			<th class="i_order_time th" ondblclick="sort_data('i_order_time')" title="依日期排序" >日期<i class="icon-up-dir"></i></th>
		</tr>
	</table>

	<div class="list_table_xs visible-xs">
	</div>
</div>
<!-- 訂單內容 -->
<div class="user_order_detail" hidden>
	<div>
		<div class="detail_head">
			<span class="back_btn" style="float:left;" onclick="close_detail()">back</span>
			<span class="detail_ifon_switch icon-up-open visible-xs" style="float:right;" onclick="switch_detail_info()"></span>
			<h3>訂單明細</h3>
		</div>
		<div class="detail_info">
			<div>
				<label >訂單編號： <label class="detail_id"></label></label>
				<label >訂單時間： <label class="detail_time"></label></label>
				<label >訂單狀態： <label class="detail_state"></label></label>
			</div>
			<div>
				<label >收件人： <label class="detail_name"></label></label>
				<label >電話： <label class="detail_phone"></label></label>
				<label >E-mail： <label class="detail_email"></label></label>
				<br>
				<label >收件地址： <label class="detail_address"></label></label>
			</div>
		</div>
		<div class="detail_content">
			<table class="basket_table">
				<tr class="table_title">
					<th style="width:46px;">項目</th>
					<th>品名</th>
					<th class="hidden-xs">價格</th>
					<th class="hidden-xs">數量</th>
					<th class="visible-xs" style="width:130px">價格/數量</th>
				</tr>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	get_user_order();

	$('.condition').change(function(){
		get_user_order();
	});
	$('.start_date').change(function(){
		get_user_order();
	});
	$('.end_date').change(function(){
		get_user_order();
	});
	$('.sort_prop').change(function(){
		sort_data("i_"+$(this).val(),true);
	});
	$('input[name="order_by"]').change(function(){
		sort_data($('.sort_prop').val(),true);
	});

	$('.user_order_detail').click(function(e){
		if (e.target.className == 'user_order_detail') 
		close_detail();
	});


});

function filter_switch(display){
	if (display == null) {
		if($('.filter_switch').attr("data-display") == 'true'){
			$('.filter').css("display","none");
			$('.filter_switch').attr("data-display","false");
		}
		else{
			$('.filter').css("display","block");
			$('.filter_switch').attr("data-display","true");
		}
	}
	else{
		if(display == 'close'){
			$('.filter').css("display","none");
			$('.filter_switch').attr("data-display","false");
		}
		else{
			$('.filter').css("display","block");
			$('.filter_switch').attr("data-display","true");
		}
	}
}

// 排序資料
function sort_data(prop,xs){

	$('.th').find('i').hide();
	$('.'+prop).find('i').show();
	if(!xs){
		if ($('.'+prop).find('i').attr("class") == "icon-down-dir") {
			$('.'+prop).find('i').attr("class","icon-up-dir");
			$('.asc').prop("checked","true");
		}
		else{
			$('.'+prop).find('i').attr("class","icon-down-dir");
			$('.desc').prop("checked","true");
		}
		$('.'+prop+'_xs').prop("selected","true");
	}
	else{
		if ($('.asc').prop("checked") == true) {
			$('.'+prop).find('i').attr("class","icon-up-dir");
		}
		else{
			$('.'+prop).find('i').attr("class","icon-down-dir");
		}
	}
	get_user_order()
}

// 查詢使用者訂單
function get_user_order(){
	condition = $('.condition').val();
	start_date = $('.start_date').val();
	end_date = $('.end_date').val();
	sort_prop = $('.sort_prop').val();
	if($('.asc').prop('checked') == true){
		order_by = 'asc';
	}
	else{
		order_by = 'desc';
	}
	if(window.innerWidth <= 766){filter_switch('close')};
	$.ajax({
		url:'/index.php/user/get_order_list',
		type:'POST',
		data:{condition:condition,start_date:start_date,end_date:end_date,sort_prop:sort_prop,order_by:order_by},
		success:function(result){
			$('.list_table').find('tr.content').remove();
			$('.list_table_xs').text("");
			obj = JSON.parse(result);
			$.each(obj,function(key,value){
				state = order_state_convert(value.state);

				$('.list_table').append('<tr class="content" onclick="get_detail(\''+ value.order_id +'\')">'+
						'<td class="order_id">'+ value.order_id +'</td>'+
						'<td class="name">'+ value.name +'</td>'+
						'<td class="price"> $NT '+ value.total +'</td>'+
						'<td class="state">'+ state +'</td>'+
						'<td class="order_time">'+ value.order_time +'</td>'+
					'</tr>');
				$('.list_table_xs').append('<div onclick="get_detail(\''+ value.order_id +'\')"><label>'+ value.name +'</label>'+
					'<span><label>'+ value.order_id +'</label>'+
					'<br><label>$NT '+ value.total +' / </label>&nbsp'+
					'<label>'+ state +' /</label>&nbsp'+ 
					'<br><label>'+ value.order_time +'</label></span></div>');
			});
		}
	});
}

// 查詢訂單內容
function get_detail(order_id){
	$('.user_order_detail').show();
	$('body').css("overflow","hidden");

	$.ajax({
		url:'/index.php/user/get_order_detail_info',
		type:'POST',
		data:{order_id:order_id},
		success:function(result){
			obj = JSON.parse(result);
				$('.detail_id').text(obj.order_id);
				$('.detail_time').text(obj.order_time);
				$('.detail_state').text(order_state_convert(obj.state));
				$('.detail_name').text(obj.name);
				$('.detail_phone').text(obj.phone);
				$('.detail_email').text(obj.email);
				$('.detail_address').text(obj.post_code+" "+obj.address);
			}
	});

	$('.table_item').remove();
	$.ajax({
		url:'/index.php/user/get_order_detail_content',
		type:'POST',
		data:{order_id:order_id},
		success:function(result){
			obj = JSON.parse(result);
			$.each(obj,function(key,value){
				$('.basket_table').append('<tr class="table_item">'+
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

// 關閉訂單內容
function close_detail(){
	$('.user_order_detail').hide();
	$('body').css("overflow","auto");
}

// 訂單資訊開關
function switch_detail_info(state){
	if($('.detail_ifon_switch').attr("class") == "detail_ifon_switch icon-down-open visible-xs" || state != null){
		$('.detail_ifon_switch').attr("class","detail_ifon_switch icon-up-open visible-xs")
		$('.detail_info').show(200);
	}
	else{
		$('.detail_info').hide(200);
		$('.detail_ifon_switch').attr("class","detail_ifon_switch icon-down-open visible-xs");
	}
}

window.onresize = function(event) {
	if(event.target.innerWidth >= 766){
    	filter_switch('open');  //使用者>查詢訂單
    	switch_detail_info('open');
	}
	else{
    	filter_switch('close');
	}
};

</script>