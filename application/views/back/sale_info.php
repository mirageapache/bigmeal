<h2>銷售資訊</h2>
<div id="sale_info">
	<div id="data_flot" style="width:100%;height:350px;overflow:auto"></div>

</div>

<script type="text/javascript">

var data = [[1, 130], [2, 40], [3, 80], [4, 160], [5, 159], [6, 370], [7, 330], [8, 350], [9, 370], [10, 400], [11, 330], [12, 350]];
var data2 = [[1, 120], [2, 480], [3, 210], [4, 158], [5, 409], [6, 400], [7, 310], [8, 120], [9, 600], [10, 100], [11, 230], [12, 500]];

var dataset = [{label: "data1",data: data},{label: "data2",data: data2}];
var options = {
	series:{
		lines: { show: true },
			points: {
				radius: 4,
				show: true
			}
		},
		legend: {
            noColumns: 1,
            labelBoxBorderColor: "#888",
            position: "nw"
        }
		
	};
$(document).ready(function () {
	$.plot($("#data_flot"), dataset, options);
});


</script>