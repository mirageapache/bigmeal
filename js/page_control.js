function page_control(cur_page,target_page){
	count = 15; //每頁筆數
	table = $('.page_panel').attr("data-table"); // 欲查詢的資料表
	total_data = 0; // 資料總筆數
	filter = order_state_disconvert($('.filter').val());

	// 查詢資料總筆數
	$.ajax({
		url:'/index.php/backpanel/page_count',
		type:'POST',
		data:{table:table,filter:filter},	
		success:function(result){
			total_data = Number(result); 
			total_page = Math.ceil(total_data/count); // 總頁數

			if(target_page == 'first'){
				target_page = 1;
			}
			else if(target_page == 'prev'){
				target_page = cur_page - 1;
				if(target_page < 1){
					target_page = 1;
				}
			}
			else if(target_page == 'next'){
				target_page = cur_page + 1;
				if(target_page > total_page){
					target_page = total_page;
				}
			}
			else if(target_page == 'last'){
				target_page = total_page;
			}
			n = (target_page - 1) * count; //第n筆開始

			$('.page_panel').text("");
			if (total_data == 0) {
				$('.alert_panel').show();
				$('.content_table').text("")
				$('.content_table_xs').text("")
				return false;
			}
			else{
				$('.alert_panel').hide();
			}

			switch(table){
				case 'user':
					get_user_data(n,count);
					break;
				case 'products':
					get_product_data(n,count);
					break;
				case 'order_list':
					get_order_data(n,count);
					break;
			}
			
			if(total_page == 1){
				return false;
			}
			else if (target_page == 1){
				gern_num_page(total_page,target_page);
				gern_next_page(total_page,target_page);
			}
			else if (target_page == total_page){
				gern_prev_page(total_page,target_page);
				gern_num_page(total_page,target_page);
			}
			else{
				gern_prev_page(total_page,target_page);
				gern_num_page(total_page,target_page);
				gern_next_page(total_page,target_page);
			}
		}
	});
}

function gern_prev_page(total_page,target_page){
	$('.page_panel').append('<span class="page_button first" onclick="page_control('+target_page+',\'first\')"'+
		'title="第一頁"><label class="icon-angle-double-left"></label></span>'+
		'<span class="page_button prev" onclick="page_control('+target_page+',\'prev\')" title="上一頁">'+
		'<label class="icon-angle-left"></label></span>');
}
function gern_num_page(total_page,target_page){
	if(target_page <= 5 && total_page <= 5){
		for (var i = 1; i <= total_page; i++) {
			insert_page(target_page,i);
		};
	}
	else if(target_page <= 5 && total_page > 5){
		for (var i = 1; i <= 5; i++) {
			insert_page(target_page,i);
		};
	}
	else if(target_page > 5 && target_page > (total_page - 3)){
		for (var i = target_page-2; i <= total_page; i++) {
			insert_page(target_page,i);
		}
	}
	else{
		for (var i = target_page-2; i <= target_page+2; i++) {
			insert_page(target_page,i);
		}
		
	}
}

function insert_page(target_page,i){
	if(i == target_page){
		$('.page_panel').append('<span class="page_button_action">'+
		'<label>'+i+'</label></span>');
	}
	else{
		$('.page_panel').append('<span class="page_button"'+
		'onclick="page_control('+target_page+','+i+')" title="第'+i+'頁">'+
		'<label>'+i+'</label></span>');
	}
}

function gern_next_page(total_page,target_page){
	$('.page_panel').append('<span class="page_button next" onclick="page_control('+target_page+',\'next\')"'+
		'title="下一頁"><label class="icon-angle-right"></label></span>'+
		'<span class="page_button last" onclick="page_control('+target_page+',\'last\')" title="最終頁">'+
		'<label class="icon-angle-double-right"></label></span>');		
}
