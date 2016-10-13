var isChange = false;

$(document).ready(function(){ //會員info
	var index_page = ($('.menu_panel').attr("data-index"));
	partial_view_ajax(index_page);
});

function editing(){  //是否在編輯資料
	if(isChange){
	    if (window.confirm("資料尚未儲存，確定離開此網頁嗎?")) { 
		    return 'true';
		} else { 
		    return false;
		}
	}
	else{
		return 'true';
	}
};

function partial_view_ajax(index_page){ //載入partial view
	//1 會員資料   1-1新增/修改會員資料     2 訂單查詢
	//3 購物記錄   4 收藏

	var result = editing();
	if(result === 'true'){
		isChange = false;
		$('.tag_action').attr("class","tag");
		switch(index_page){
			case '1':
				$('.user_info_label').parent().attr('class','tag_action');
				break;
			case '2':
				$('.order_list_label').parent().attr('class','tag_action');
				break;
			case '3':
				$('.purchased_label').parent().attr('class','tag_action');
				break;
			case '4':
				$('.collection_label').parent().attr('class','tag_action');
				break;
			case '5':
				$('.message_label').parent().attr('class','tag_action');
				break;
			default:
				$('.user_info_label').parent().attr('class','tag_action');
				break;
		}

		$.ajax({
			url: "/index.php/user/user_partial",
			type: "POST",
			data: {num: index_page} ,
			success: function(result){
				$('.partial_view').text("");
				$('.partial_view').append(result);
			},
			error: function(error){

			}
		});
	}
}