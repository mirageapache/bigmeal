<?php include(dirname(__file__)."/partial/site_head.php");?>
<div class="container">
	<div id="product_error_page" class="product_error_page" hidden>
		<h2>搜尋不到任何相關產品!!</h2>
	</div>
	<div class="product_list" align="center" data-index="<?php if(!empty($index)){echo $index;} ?>">
		<?php include(dirname(__file__)."/product/product_list.php");?>
	</div>
	
</div>

</body>
</html>