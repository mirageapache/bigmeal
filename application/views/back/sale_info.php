<h2>銷售資訊</h2>
<div id="sale_info">
	<div class="filter">
		<div class="btn-group" role="group">
			<button type="button" class="week btn btn-primary" onclick="get_sale_info('week')">近7日</button>
			<button type="button" class="month btn btn-primary" onclick="get_sale_info('month')">整月</button>
			<button type="button" class="year btn btn-primary" onclick="get_sale_info('year')">年度</button>
		</div>
		<select class="month_select form-control" hidden></select>
	</div>
	<div id="chart_panel">
		<div id="data_chart"></div>
	</div>
</div>
<script type="text/javascript" src="<?=base_url("/package/js/highcharts.js")?>"></script>
<script type="text/javascript" src="<?=base_url("/package/js/exporting.js")?>"></script>
<script type="text/javascript">
var data_array = [];
var xaxis_array = [];
var chart_title;

$(document).ready(function () {
	for (var i = 1; i <= 12; i++) {
		$('.month_select').append("<option value="+i+">"+i+"月</option>");
	}
	get_sale_info('week','none');
	
	$('.month_select').change(function(){
		get_sale_info('month',$('.month_select').val());
	});
		
});

function get_sale_info(type,filter){
	var t = new Date();
	y = t.getFullYear().toString();
	m = (t.getMonth() + 1).toString();
	d = t.getDate().toString();

	if (type == null) {type = 'week'};
	if (type == 'week') {
		chart_title = '近7日營業額';
		$('.month_select').hide();
		filter = y+'-'+m+'-'+d;
	}
	else if (type == 'month') {
		$('.month_select').show();
		if (filter == null) {
			chart_title = m+'月營業額';
			filter = y+'-'+m;
			$('.month_select').val(m);
		}
		else{
			chart_title = filter+'月營業額';
			if (filter < 10) {filter = '0'+filter;}
			filter = y+'-'+filter;
		}
	}
	else if (type == 'year') {
		chart_title = y+'年度營業額';
		$('.month_select').hide();
		filter = y;
	}

	$.ajax({
		url:'/index.php/backpanel/get_sale_turnover',
		type:'POST',
		data:{type:type,filter:filter},
		success:function(result){
			obj = JSON.parse(result);
			data_array = obj["turnover"];
			xaxis_array = obj["xaxis"];

			Highcharts.chart('data_chart', {
		        title: {
		            text: chart_title,
		            x: -20 //center
		        },
		        xAxis: {
		            categories: xaxis_array
		        },
		        yAxis: {
		            title: {
		                text: '營業額(元)',
		            },
		            plotLines: [{
		                value: 0,
		                width: 2,
		                color: '#808080'
		            }]
		        },
		        plotOptions: {
		            line: {
		                dataLabels: {
		                    enabled: true
		                },
		                enableMouseTracking: false
		            }
		        },
		        series: [{
		            name: chart_title,
		            data: data_array
		        }],
		    });


		}
	});
}

</script>