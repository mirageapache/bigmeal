<h2>產品管理</h2>
<input class="filter form-control" placeholder="產品名,類別" />
<span class="" style="display:inline-block;padding-top:5px;">
	<button class="new_product btn btn-primary" onclick="get_back_page('product_mg_insert')">新增產品</button>
	<button class="edit_switch btn btn-primary" onclick="edit_more('open')">多選編輯</button>
	<span class="edit_panel" hidden>
		<!-- <button class="btn btn-primary" onclick="modify_products">修改</button> -->
		<button class="btn btn-danger" onclick="delete_products()">刪除</button>
		<i class="cancel_edit icon-cancel" onclick="edit_more('close')"></i>
	</span>
</span>

<div id="product_mg">
	
	<div class="alert_panel" hidden>查無資料...</div>
	<table class="content_table hidden-xs">
	</table>

	<div class="content_table_xs visible-xs" style="border-top:1px solid #888;">
	</div>

	<div class="page_panel" data-table="products">
	</div>
</div>

<script type="text/javascript">
var edit_mode = false; //多選編輯狀態
var obj = [];
var id_array = []; // 選中的產品id
var temp_id_array = []; // 暫存id對應的index
$(document).ready(function(){
	page_control(1,'1');
	
	$('.filter').keyup(function(){
		page_control(1,'1');
	});

});

function get_product_data(n,m){
	filter = $('.filter').val();
	$.ajax({
		url:'/index.php/backpanel/get_product_data',
		type:'POST',
		data:{filter:filter,n:n,m:m},	
		success:function(result){
			obj = JSON.parse(result);
			$('.content_table').text("");
			$('.content_table_xs').text("");
			$('.content_table').append('<tr class="table_title">'+
				'<th class="check_td" hidden><input class="all_check" type="checkbox" title="全選" onclick="all_check(\'check\')"/></th>'+
				'<th>名稱</th>'+
				'<th>類別</th>'+
				'<th>價格</th>'+
				'<th>庫存</th></tr>');
			$.each(obj, function(key,value){
				$('.content_table').append('<tr class="table_content" onclick="product_detail(\'product_mg_detail\',\''+value.product_id+'\')">'+
				'<td class="check_td" hidden><input class="check_item" type="checkbox" name="'+value.product_id+'"'+
				'value="'+value.product_id+'" onclick="check_item('+value.product_id+')"/></td>'+
				'<td class="name">'+value.name+'</td>'+
				'<td>'+value.b_type+' / '+value.s_type+'</td>'+
				'<td> $NT '+value.price+'</td>'+
				'<td>'+value.stock+'</td></tr>');

				$('.content_table_xs').append('<span class="table_item" onclick="product_detail(\'product_mg_detail\',\''+value.product_id+'\')">'+
				'<label class="check_label" hidden><input class="check_item" type="checkbox" name="'+value.product_id+'"'+
				'value="'+value.product_id+'" onclick="check_item('+value.product_id+')"/></label>'+
				'<h3>'+ value.name +'</h3>'+
				'<h4>'+value.b_type+' / '+value.s_type+'</h4>'+
				'<h4> $NT '+value.price+' / 庫存：'+value.stock+'</h4></span>');
			});
		}
	});
}

// 多選編輯開關
function edit_more(action){
	if (action == 'open') {
		$('.edit_switch').hide();
		$('.edit_panel').show();
		$('.check_td').show();
		$('.check_label').show();
		edit_mode = true;
	}
	else if(action == 'close'){
		$('.edit_switch').show();
		$('.edit_panel').hide();
		$('.check_td').hide();
		$('.check_label').hide();
		$('.all_check').prop("checked",false);
		$('.check_item').prop("checked",false);
		edit_mode = false;
		id_array = [];
		temp_id_array = [];
	}
}

// 全選
function all_check(action){
	id_array = [];
	temp_id_array = [];
	if(action == 'check'){
		$('.all_check').attr("onclick","all_check('uncheck')");
		$('.check_item').prop("checked",true);
		$.each(obj,function(key,value){
			id_array.push(value.product_id);
			temp_id_array.push({id:value.product_id,index:key});
		});
	}
	else{
		$('.check_item').prop("checked",false);
		$('.all_check').attr("onclick","all_check('check')");
	}
}

// 單選產品
function check_item(id){
	is_check = $('input[name="'+id+'"]').prop("checked");
	if(is_check){ // uncheck
		$('input[name="'+id+'"]').prop("checked",false);
		$('.all_check').prop("checked",false);
		$('.all_check').attr("onclick","all_check('check')");
		for(i=0;i<=id_array.length;i++){
			if (id == temp_id_array[i].id) {
				id_array.splice(temp_id_array[i].index,1);
				break;
			}
		}
		temp_id_array = []; // 重設index
		$.each(id_array,function(index,value){
			temp_id_array.push({id:value,index:index});
		});
	}
	else{ // check
		$('input[name="'+id+'"]').prop("checked",true);
		id_array.push(id);
		temp_id_array.push({id:id,index:(id_array.length-1)});
	}
}

// 查詢產品內容
function product_detail(index,id){
	if(edit_mode){
		check_item(id);
	}
	else{
		get_back_page(index,id);
	}
}

// 刪除產品
function delete_products(){
	var r = confirm("確定要刪除嗎?");
    if (r == true) {
		$.ajax({
			url:'/index.php/backpanel/delete_product',
			type:'POST',
			data:{'data_array':id_array},	
			success:function(result){
				console.log(result);
				if(result == 'success'){
					page_control(1,'1');
				}

			}
		});
    }
    else{
    	edit_more('close');
    }
}

</script>