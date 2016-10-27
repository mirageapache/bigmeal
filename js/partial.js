// 開啟User功能表
function open_user(){
	if ($('.user_option').css('display') == "block") {
		$('.user_option').css('display','none');
		$('#black_panel').css('display','none');
	}
	else{
		$('.user_option').css('display','block');
		$('#black_panel').css('display','block');
	}
}

// 開啟左側選單-xs
function open_left_menu(){
	if ($('#left_menu').css("left") == "-280px") {
		$('#left_menu').animate({left:"0px"});
		$('#left_menu').css("display","block");
		$('#black_panel').css("display","block");
		$('#black_panel').css("background-color","rgba(50,50,50,0.5)");
	}
}

// 關閉暗框及啟用中的選單
function black_panel(){
	if ($('.user_option').css('display') == "block"){
		$('.user_option').css('display','none');
		$('#black_panel').css('display','none');
	}
	if ($('#black_panel').css("display") == "block") {
		$('#left_menu').animate({left:"-280px"});
		$('#black_panel').css("display","none");
		$('#black_panel').css("background-color","transparent");
		
	}
}

// 螢幕大小改變
window.onresize = function(event) {
	if(event.target.innerWidth >= 766){
    	black_panel();
    	filter_switch('open');  //使用者>查詢訂單
    	switch_detail_info('open');
	}
	else{
    	filter_switch('close');

	}

	// left menu 登出鈕的位置
	if(event.target.innerHeight < parseInt($('#left_menu').find('div').css("height"))+100){
		$('.xs_logout').css("position","relative");
	}
	if(event.target.innerHeight > parseInt($('#left_menu').find('div').css("height"))+100){
		$('.xs_logout').css("position","absolute");
	}
};

function call_alert(text){
	$('#alert_text').text(text);
	$('#alert').css("opacity","1");
	$('#alert').show();
	$('#alert').delay(3000).fadeTo(2000, 0);
	$('#alert').hide(0);

	$('#alert_text_xs').text(text);
	$('#alert_xs').css("opacity","1");
	$('#alert_xs').show();
	$('#alert_xs').delay(3000).fadeTo(2000, 0);
	$('#alert_xs').hide(0);
}

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
		state = "狀態3";
	}
	else if(state == 9){
		state = "已完成";
	}
	return state;
}

$(document).ready(function(){
	// 不可反白選取
	var omitformtags=["input", "textarea", "select"]

	omitformtags=omitformtags.join("|")

	function disableselect(e){
		if (omitformtags.indexOf(e.target.tagName.toLowerCase())==-1)
		return false
	}

	function reEnable(){
		return true
	}

	if (typeof document.onselectstart!="undefined")
		document.onselectstart=new Function ("return false")
	else{
	document.onmousedown=disableselect
	document.onmouseup=reEnable
	}

});