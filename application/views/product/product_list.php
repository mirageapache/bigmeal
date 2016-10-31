<script type="text/javascript">
	$.ajax({
        url: "/index.php/product/get_product",
        data:{},
        type:"GET",
        success: function(result){
        	var obj = JSON.parse(result);
            $.each(obj, function( key, value ) {
				$('.product_list').append('<a class="product_list_item" href="<?=site_url("/product/product_detail/'+value.product_id+'")?>">'+
					'<div class="product_img" style="background-image: url(\''+value.path+'/'+value.img_name+'.jpg\');"></div>'+
						'<div class="product_info">'+
							'<hr><p class="product_name">'+value.name+'</p><label class="price">$NT '+value.price+'</label>'+
						'</div>'+
					'</a>');

			}); 
        }
	});	

</script>
