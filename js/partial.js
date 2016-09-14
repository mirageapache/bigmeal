$(document).ready(function(){

	$('.user_name').click(function(){
		if ($('.user_option').css('display') == "block") {
			$('.user_option').css('display','none');
			$('#black_panel').css('display','none');
		}
		else{
			$('.user_option').css('display','block');
			$('#black_panel').css('display','block');
		}
	});

	$('#black_panel').click(function(){
		display_none();
	});

	function display_none(){
		if ($('.user_option').css('display') == "block"){
			$('.user_option').css('display','none');
			$('#black_panel').css('display','none');
		}
	}
		

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