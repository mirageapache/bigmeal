<h2>訂單管理</h2>
<input class="filter form-control" placeholder="訂單編號or時間" />
<div class="order_mg">
	
	<div class="alert_panel" hidden>查無資料...</div>
	<table class="content_table hidden-xs">
	</table>

	<div class="content_table_xs visible-xs" style="border-top:1px solid #888;">
	</div>

	<div class="page_panel" data-table="order_list">
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	page_control(1,'1');
	
	$('.filter').keyup(function(){
		page_control(1,'1');
	});

});

function get_order_data(n,m){
	filter = order_state_disconvert($('.filter').val());
	$.ajax({
		url:'/index.php/backpanel/get_order_data',
		type:'POST',
		data:{filter:filter,n:n,m:m},	
		success:function(result){
			obj = JSON.parse(result);
			$('.content_table').text("");
			$('.content_table_xs').text("");
			$('.content_table').append('<tr class="table_title">'+
				'<th>訂單編號</th>'+
				'<th>狀態</th>'+
				'<th>金額</th>'+
				'<th>訂單時間</th></tr>');
			$.each(obj, function(key,value){
				$('.content_table').append('<tr class="table_content" onclick="get_back_page(\'order_mg_detail\',\''+value.order_id+'\')">'+
				'<td class="order_id">'+value.order_id+'</td>'+
				'<td>'+order_state_convert(value.state)+'</td>'+
				'<td>$NT '+value.total+'</td>'+
				'<td>'+value.order_time+'</td></tr>');

				$('.content_table_xs').append('<span class="table_item" onclick="get_back_page(\'order_mg_detail\',\''+value.order_id+'\')">'+
				'<h3>'+ value.order_id +'</h3>'+
				'<h4>$NT '+value.total+' / '+order_state_convert(value.state)+'</h4>'+
				'<h4>'+value.order_time+'</h4></span>');
			});
		}
	});
}

</script>