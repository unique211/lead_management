<div>
	
		<h2>Welcome <?php echo $name; ?></h2>

		<html>

<head>
	
	<script src="<?php echo base_url() ?>assets/js/chart.funnel.bundled.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<style>
		canvas {
			align:center;
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>
</head>

<body>
<div id="canvas-holder"  style="width:500px;align:right;">
	<canvas style="align:center;"  id="chart-area" height="250"></canvas>
</div>
<script>

	var Quatation=90;
	var Order=60;
	var Area=30;
	var config = {
		type: 'funnel',
		data: {
			datasets: [{
				data: [Quatation, Order,Area],
				backgroundColor: [
					"#FF6384",
					"#36A2EB",
					"#FFCE56"
				],
				hoverBackgroundColor: [
					"#FF6384",
					"#36A2EB",
					"#FFCE56"
				]
			}],
			labels: [
				"Order",
				"Quatation",
				"Yellow"
			]
		},
		options: {
			responsive: true,
			legend: {
				position: 'top'
			},
			title: {
				display: true,
				text: 'Lead Management'
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	};

	window.onload = function() {
		var ctx = document.getElementById("chart-area").getContext("2d");
		window.myDoughnut = new Chart(ctx, config);
	};
</script>
</body>
</html>
 
 
		
		
</div>