<h2>總覽</h2>
<div class="overview">
	<span class="info_item view">
		<label class="title" style="border-color: #d23535;">今日瀏覽數</label>
		<label class="content number">0</label>
		<label class="unit"></label>
	</span>
	<span class="info_item order">
		<label class="title" style="border-color: #3f84bf;">今日訂單</label>
		<label class="content number">0</label>
		<label class="unit"> 筆</label>
	</span>
	<span class="info_item popular">
		<label class="title" style="border-color: #55a256;">熱門產品</label>
		<label class="content" style="font-size:24px;"></label>
		<label class="unit"></label>
	</span>
	<span class="info_item turnover">
		<label class="title" style="border-color: #e6872c;">今日營收</label>
		<label class="unit">$ </label>
		<label class="content number">0</label>
	</span>
	<span class="info_item user_num">
		<label class="title" style="border-color: #ecd13a;">會員總數</label>
		<label class="content number">0</label>
		<label class="unit"></label>
	</span>
	<span class="info_item">
		<label class="title" style="border-color: #4e5663;">標題</label>
		<label class="content">0</label>
		<label class="unit"></label>
	</span>
</div>

<script type="text/javascript">
	
$.ajax({
	url: "/index.php/backpanel/get_overview_data",
	type: "GET",
	data: {},
	success:function(result){
		obj = JSON.parse(result);
		console.log(obj);

		$('.view').find('.content').text(obj.views);
		$('.order').find('.content').text(obj.orders);
		$('.popular').find('.content').text(obj.popular);
		$('.popular').find('.content').attr("title",obj.popular);
		$('.turnover').find('.content').text(obj.turnover);
		$('.turnover').find('.content').attr("title","$"+obj.turnover);
		$('.user_num').find('.content').text(obj.user_num);

		$('.number').each(function(){
			$(this).prop('Counter',0).animate({
		        Counter: $(this).text()
		    }, {
		        duration: 800,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(Math.ceil(now));
		        }
		    });
		});


	}
});










</script>

