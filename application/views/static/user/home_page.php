<div>

	<h2>Welcome <?php echo $name; ?></h2>

	<html>

	<head>

		<script src="<?php echo base_url() ?>assets/js/chart.funnel.bundled.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<style>
			canvas {
				align: center;
				-moz-user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
		</style>
	</head>

	<body>
		<div class="col-lg-12 table table-responsive">
			<table class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th colspan="8" style="text-align: center;width:100%; background-color: #0071ba; color:white;">Target and Achievement Dash board</th>
					</tr>
					<tr>
						<th colspan="8" style="text-align: center;width:100%"></th>
					</tr>
					<tr>
						<th colspan="2" style="text-align: center;width:30%">Sales Person</th>
						<th colspan="3" style="text-align: center;width:30%"></th>
						<th colspan="3" style="text-align: center;width:40%" rowspan="2"></th>

					</tr>
					<tr>
						<th colspan="2" style="text-align: center;">Target for FY 18-19 (in Lakhs)</th>
						<th colspan="3" style="text-align: right;">35.00</th>


					</tr>
					<tr>
						<th colspan="8" style="text-align: center;width:100%"></th>
					</tr>
					<tr>
						<th colspan="8" style="text-align: center;width:100%"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:15%">Q1 Tgt @ 22%</td>
						<td style="width:10%;text-align:center">7.70</td>
						<td style="width:15%">Q2 Target @ 25%</td>
						<td style="width:10%;text-align:center">8.75</td>
						<td style="width:15%">Q3 Target @ 26%</td>
						<td style="width:10%;text-align:center">9.10</td>
						<td style="width:15%">Q4 Target @ 27%</td>
						<td style="width:10%;text-align:center">9.45</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Task</td>
						<td style="width:10%;text-align:center">7.70</td>
						<td style="width:15%">Q2 Task</td>
						<td style="width:10%;text-align:center">16.45</td>
						<td style="width:15%">Q3 Task</td>
						<td style="width:10%;text-align:center">25.55</td>
						<td style="width:15%">Q4 Task</td>
						<td style="width:10%;text-align:center">35.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Achd</td>
						<td style="width:10%;text-align:center">0.00</td>
						<td style="width:15%">Q2 Achd</td>
						<td style="width:10%;text-align:center">0.00</td>
						<td style="width:15%">Q3 Achd</td>
						<td style="width:10%;text-align:center">0.00</td>
						<td style="width:15%">Q4 Achd</td>
						<td style="width:10%;text-align:center">0.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Excess</td>
						<td style="width:10%;text-align:center">7.70</td>
						<td style="width:15%">Q2 Excess</td>
						<td style="width:10%;text-align:center">16.45</td>
						<td style="width:15%">Q3 Excess</td>
						<td style="width:10%;text-align:center">25.55</td>
						<td style="width:15%">Q4 Excess</td>
						<td style="width:10%;text-align:center">35.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Achd %</td>
						<td style="width:10%;text-align:center">0%</td>
						<td style="width:15%">Q2 Achd %</td>
						<td style="width:10%;text-align:center">0%</td>
						<td style="width:15%">Q3 Achd %</td>
						<td style="width:10%;text-align:center">0%</td>
						<td style="width:15%">Q4 Achd %</td>
						<td style="width:10%;text-align:center">0%</td>
					</tr>
					<tr>
						<td colspan="8" style="text-align: center;width:100%"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6" style="float:left">
					<div class="table table-responsive">
						<table class="table table-bordered table-striped" style="width:100%">
							<thead>
								<tr>
									<th style="text-align:center" colspan="2"></th>
									<th style="text-align:center">Target</th>
									<th style="text-align:center">Task</th>
									<th style="text-align:center">Achieved</th>
									<th style="text-align:center">Excess</th>
									<th style="text-align:center">Achieved %</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td rowspan="4">Q1 @ 22%</td>
									<td style="text-align:center">April @ 5%</td>
									<td style="text-align:right">1.75</td>
									<td style="text-align:right">1.75</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">1.75</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">May @ 8%</td>
									<td style="text-align:right">2.80</td>
									<td style="text-align:right">4.55</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">4.55</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">June @ 9%</td>
									<td style="text-align:right">3.15</td>
									<td style="text-align:right">7.70</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">7.70</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q1</td>
									<td style="text-align:right">7.70</td>
									<td style="text-align:right">7.70</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">7.70</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q2 @ 25%</td>
									<td style="text-align:center">July @ 8%</td>
									<td style="text-align:right">2.80</td>
									<td style="text-align:right">10.50</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">10.50</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">August @ 9%</td>
									<td style="text-align:right">3.15</td>
									<td style="text-align:right">13.65</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">13.65</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">September @ 8%</td>
									<td style="text-align:right">2.80</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q2</td>
									<td style="text-align:right">8.75</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">H1 @ 47%</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">16.45</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q3 @ 26%</td>
									<td style="text-align:center">October @ 8%</td>
									<td style="text-align:right">2.80</td>
									<td style="text-align:right">19.25</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">19.25</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">November @ 9%</td>
									<td style="text-align:right">3.15</td>
									<td style="text-align:right">22.40</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">22.40</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">December @ 9%</td>
									<td style="text-align:right">3.15</td>
									<td style="text-align:right">25.55</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">25.55</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q3</td>
									<td style="text-align:right">9.10</td>
									<td style="text-align:right">25.55</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">25.55</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q4 @ 27%</td>
									<td style="text-align:center">January @ 9%</td>
									<td style="text-align:right">3.15</td>
									<td style="text-align:right">28.70</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">28.70</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">February @ 8%</td>
									<td style="text-align:right">2.80</td>
									<td style="text-align:right">31.50</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">31.50</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">March @ 10%</td>
									<td style="text-align:right">3.50</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:right"></td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q4</td>
									<td style="text-align:right">9.45</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">H2 @ 53%</td>
									<td style="text-align:right">18.55</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:center">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">Yearly</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:right">-</td>
									<td style="text-align:right">35.00</td>
									<td style="text-align:center">0%</td>
								</tr>
							</tbody>

						</table>
					</div>

				</div>
				<div class="col-md-6" style="float:right">
					<div id="canvas-holder" style="width:500px;align:right;">
						<canvas style="align:center;" id="chart-area" height="250"></canvas>
					</div>
				</div>
			</div>


		</div>



		<script>
			var Quatation = 90;
			var Order = 60;
			var Area = 30;
			var config = {
				type: 'funnel',
				data: {
					datasets: [{
						data: [Quatation, Order, Area],
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