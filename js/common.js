// 訂單狀態
function order_state_convert(state){
	if (state == 0) {
		state = "新訂單，等待審核";
	}
	else if(state == 1){
		state = "等待出貨";
	}
	else if(state == 2){
		state = "已出貨";
	}
	else if(state == 3){
		state = "已付款";
	}
	else if(state == 9){
		state = "已完成";
	}
	return state;
}

// 訂單狀態反轉換
function order_state_disconvert(state){
	if (state == "新訂單，等待審核") {
		state = 0;
	}
	else if(state == "等待出貨"){
		state = 1;
	}
	else if(state == "已出貨"){
		state = 2;
	}
	else if(state == "已付款"){
		state = 3;
	}
	else if(state == "已完成"){
		state = 9;
	}
	return state;
}

// 會員狀態
function user_state_convert(state){
	if (state == 0) {
		state = "無";
	}
	else if(state == 1){
		state = "正常";
	}
	else if(state == 9){
		state = "黑名單";
	}

	return state;
}

// 會員類型
function user_type_convert(type){
	if (type == 0) {
		type = "未定";
	}
	else if(type == 1){
		type = "一般會員";
	}
	else if(type == 2){
		type = "網站管理員";
	}
	else if(type == 9){
		type = "系統管理員";
	}

	return type;
}

// 運送方式
function deliver_type_convert(type){
	if (type == 0) {
		type = "宅配";
	}
	else if(type == 1){
		type = "郵寄";
	}
	return type;
}

// 付款方式
function pay_type_convert(type){
	if (type == 0) {
		type = "貨到付款";
	}
	else if(type == 1){
		type = "轉帳";
	}
	else if(type == 2){
		type = "信用卡";
	}
	return type;
}