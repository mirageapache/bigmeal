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
	}

	// left menu 登出鈕的位置
	if(event.target.innerHeight < parseInt($('#left_menu').find('div').css("height"))+100){
		$('.xs_logout').css("position","relative");
	}
	if(event.target.innerHeight > parseInt($('#left_menu').find('div').css("height"))+100){
		$('.xs_logout').css("position","absolute");
	}
};

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