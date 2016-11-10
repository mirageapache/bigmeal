var isChange = false;

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

// 是否在編輯資料
function editing(){
	if(isChange){
	    if (window.confirm("資料尚未儲存，確定離開此網頁嗎?")) { 
		    return true;
		} else { 
		    return false;
		}
	}
	else{
		return true;
	}
};

// 取得b_type
function get_b_type(s_type){
	if (s_type == '蔬菜' || s_type == '水果' || s_type == '肉類' || s_type == '海鮮') {
       return '生鮮';
    }
    else if (s_type == '五穀雜糧') {
        return '乾貨';
    }
    else if (s_type == '調味料') {
        return '調味料';
    }
    else if (s_type == '廚具') {
        return '廚具';
    }
}
