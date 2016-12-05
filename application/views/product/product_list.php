<script type="text/javascript">
$(document).ready(function(){
	if($('.product_list').attr("data-index").length != 0){
		filter = convert_filter($('.product_list').attr("data-index"));
		get_product(filter);
	}
	else{
		get_product('all');
	}
	
	$('.search_input').keyup(function(){
		get_product($(this).val());
	});
})

function get_product(filter){
	$.ajax({
        url: "/index.php/product/get_product",
        data:{filter:filter},
        type:"POST",
        success: function(result){
        	var obj = JSON.parse(result);
        	$('.product_list').text("");
        	if(obj.length == 0){
        		$('.product_error_page').show();
        	}
        	else{
        		$('.product_error_page').hide();
	            $.each(obj, function( key, value ) {
					$('.product_list').append('<a class="product_list_item" href="<?=site_url("/product/product_detail/'+value.product_id+'")?>">'+
						'<div class="product_img" style="background-image: url(\''+value.path+'/'+value.img_name+'\');"></div>'+
							'<div class="product_info">'+
								'<hr><p class="product_name">'+value.name+'</p><label class="price">$NT '+value.price+'</label>'+
							'</div>'+
						'</a>');

				}); 
        	}
        }
	});	
}

function convert_filter(string){
	result = '';
	en_arr = ['food','vegetable','fruit','meat','seafood','dried','cereal','flavoring','cooker'];
	ch_arr = ['生鮮','蔬菜','水果','肉類','海鮮','乾貨','五穀雜糧','調味料','廚具'];
	$.each(en_arr,function(key,value){
		if (value == string){
			result = ch_arr[key];
		}
	});
	return result;
}
</script>
