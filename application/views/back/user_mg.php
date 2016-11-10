<h2>會員管理</h2>
<input class="filter form-control" placeholder="帳號" />
<div id="user_mg">
	
	<div class="alert_panel" hidden>查無資料...</div>
	<table class="content_table hidden-xs">
	</table>

	<div class="content_table_xs visible-xs" style="border-top:1px solid #888;">
	</div>

	<div class="page_panel" data-table="user">
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	page_control(1,'1');
	
	$('.filter').keyup(function(){
		page_control(1,'1');
	});

});

function get_user_data(n,m){
	filter = $('.filter').val();
	$.ajax({
		url:'/index.php/backpanel/get_user_data',
		type:'POST',
		data:{filter:filter,n:n,m:m},	
		success:function(result){
			obj = JSON.parse(result);
			$('.content_table').text("");
			$('.content_table_xs').text("");
			$('.content_table').append('<tr class="table_title">'+
				'<th>帳號</th>'+
				'<th>狀態</th>'+
				'<th>類型</th>'+
				'<th>建立日期</th></tr>');
			$.each(obj, function(key,value){
				$('.content_table').append('<tr class="table_content" onclick="get_back_page(\'user_mg_detail\',\''+value.ID+'\')">'+
				'<td class="account">'+value.account+'</td>'+
				'<td>'+user_state_convert(value.state)+'</td>'+
				'<td class="user_type">'+user_type_convert(value.user_type)+'</td>'+
				'<td>'+value.create_day+'</td></tr>');

				$('.content_table_xs').append('<span class="table_item" onclick="get_back_page(\'user_mg_detail\',\''+value.ID+'\')">'+
				'<h3>'+ value.account +'</h3>'+
				'<h4>狀態：'+user_state_convert(value.state)+' / 類型：'+user_type_convert(value.user_type)+'</h4>'+
				'<h4>'+value.create_day+'</h4></span>');
			});
		}
	});
}

</script>