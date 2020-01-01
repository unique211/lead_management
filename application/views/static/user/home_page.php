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
						<th colspan="3" style="text-align: center;width:30%">


							<div class="col-md-8 inputGroupContainer">
								<?php if (($this->session->userdata('user_type') == "SalesRepresentative") && ($this->session->userdata('userrole') == "Sales")) { ?>
									<div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="salesrepresentive1" name="salesrepresentive1" placeholder="Contact Person" class="form-control " maxlength="20" type="text">

									</div><span class="s_lname1"></span>
								<?php } else { ?>
									<div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="salesrepresentive" id="salesrepresentive" class="form-control">
											<option value="">Select</option>

										</select></div>
								<?php } ?>

							</div>
						</th>
						<th colspan="3" style="text-align: center;width:40%" rowspan="2"></th>

					</tr>
					<tr>
						<th colspan="2" id="targetcurrerenyear" style="text-align: center;">Target for FY 18-19 (in Lakhs)</th>
						<th colspan="3" id="targetyearamt" style="text-align: right;">35.00</th>


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
						<td style="width:15%" >Q1 Tgt @ 22%</td>
						<td style="width:10%;text-align:center" id="q1tgt">7.70</td>
						<td style="width:15%">Q2 Target @ 25%</td>
						<td style="width:10%;text-align:center"  id="q2target">8.75</td>
						<td style="width:15%">Q3 Target @ 26%</td>
						<td style="width:10%;text-align:center"  id="q3target">9.10</td>
						<td style="width:15%">Q4 Target @ 27%</td>
						<td style="width:10%;text-align:center" id="q4target">9.45</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Task</td>
						<td style="width:10%;text-align:center" id="q1task">7.70</td>
						<td style="width:15%">Q2 Task</td>
						<td style="width:10%;text-align:center" id="q2task">16.45</td>
						<td style="width:15%">Q3 Task</td>
						<td style="width:10%;text-align:center"  id="q3task">25.55</td>
						<td style="width:15%">Q4 Task</td>
						<td style="width:10%;text-align:center" id="q4task">35.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Achd</td>
						<td style="width:10%;text-align:center" id="q1achd">0.00</td>
						<td style="width:15%">Q2 Achd</td>
						<td style="width:10%;text-align:center"  id="q2achd">0.00</td>
						<td style="width:15%">Q3 Achd</td>
						<td style="width:10%;text-align:center" id="q3achd">0.00</td>
						<td style="width:15%">Q4 Achd</td>
						<td style="width:10%;text-align:center"  id="q4achd">0.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Excess</td>
						<td style="width:10%;text-align:center" id="q1excess">7.70</td>
						<td style="width:15%">Q2 Excess</td>
						<td style="width:10%;text-align:center" id="q2excess">16.45</td>
						<td style="width:15%">Q3 Excess</td>
						<td style="width:10%;text-align:center" id="q3excess">25.55</td>
						<td style="width:15%">Q4 Excess</td>
						<td style="width:10%;text-align:center" id="q4excess">35.00</td>
					</tr>
					<tr>
						<td style="width:15%">Q1 Achd %</td>
						<td style="width:10%;text-align:center" id="q1achdper">0%</td>
						<td style="width:15%">Q2 Achd %</td>
						<td style="width:10%;text-align:center" id="q2achdper">0%</td>
						<td style="width:15%">Q3 Achd %</td>
						<td style="width:10%;text-align:center" id="q3achdper">0%</td>
						<td style="width:15%">Q4 Achd %</td>
						<td style="width:10%;text-align:center" id="q4achdper">0%</td>
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
									<th style="text-align:center" >Target</th>
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
									<td style="text-align:right" id="apriltarget">1.75</td>
									<td style="text-align:right" id="apriltask">1.75</td>
									<td style="text-align:right" id="aprilacheive"></td>
									<td style="text-align:right" id="aprilexcess">1.75</td>
									<td style="text-align:center"  id="aprilachieveper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">May @ 8%</td>
									<td style="text-align:right" id="maytarget">2.80</td>
									<td style="text-align:right" id="maytask">4.55</td>
									<td style="text-align:right" id="mayachieve"></td>
									<td style="text-align:right" id="mayaccess">4.55</td>
									<td style="text-align:center" id="mayper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">June @ 9%</td>
									<td style="text-align:right" id="junetarget">3.15</td>
									<td style="text-align:right" id="junetask">7.70</td>
									<td style="text-align:right" id="juneachive"></td>
									<td style="text-align:right" id="juneaccess">7.70</td>
									<td style="text-align:center" id="juneper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q1</td>
									<td style="text-align:right" id="overallq1target">7.70</td>
									<td style="text-align:right" id="overallq1task">7.70</td>
									<td style="text-align:right" id="overallq1achive">-</td>
									<td style="text-align:right" id="overallq1access">7.70</td>
									<td style="text-align:center" id="overallq1per">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q2 @ 25%</td>
									<td style="text-align:center" >July @ 8%</td>
									<td style="text-align:right" id="julytarget">2.80</td>
									<td style="text-align:right" id="julytask" >10.50</td>
									<td style="text-align:right" id="julyachive"></td>
									<td style="text-align:right" id="julyexcess">10.50</td>
									<td style="text-align:center" id="julyper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">August @ 9%</td>
									<td style="text-align:right" id="augusttarget">3.15</td>
									<td style="text-align:right" id="augusttask">13.65</td>
									<td style="text-align:right" id="augustachive"></td>
									<td style="text-align:right" id="augustexcess">13.65</td>
									<td style="text-align:center" id="augustper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">September @ 8%</td>
									<td style="text-align:right" id="septembertarget">2.80</td>
									<td style="text-align:right" id="septembertask">16.45</td>
									<td style="text-align:right" id="septemberachive"></td>
									<td style="text-align:right" id="septemberexcess">16.45</td>
									<td style="text-align:center" id="septemberper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q2</td>
									<td style="text-align:right" id="overallq2target">8.75</td>
									<td style="text-align:right" id="overallq2task">16.45</td>
									<td style="text-align:right" id="overallq2achive">-</td>
									<td style="text-align:right" id="overallq2access">16.45</td>
									<td style="text-align:center" id="overallq2per">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">H1 @ 47%</td>
									<td style="text-align:right" id="h1target">16.45</td>
									<td style="text-align:right" id="h1task">16.45</td>
									<td style="text-align:right" id="h1achive">-</td>
									<td style="text-align:right" id="h1excess">16.45</td>
									<td style="text-align:center" id="h1per">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q3 @ 26%</td>
									<td style="text-align:center" >October @ 8%</td>
									<td style="text-align:right"  id="octombertarget">2.80</td>
									<td style="text-align:right"  id="octombertask">19.25</td>
									<td style="text-align:right"  id="octomberachive"></td>
									<td style="text-align:right"  id="octomberexcess">19.25</td>
									<td style="text-align:center"  id="octomberper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">November @ 9%</td>
									<td style="text-align:right" id="novembertarget">3.15</td>
									<td style="text-align:right" id="novembertask">22.40</td>
									<td style="text-align:right" id="novemberachive"></td>
									<td style="text-align:right" id="novemberexcess">22.40</td>
									<td style="text-align:center" id="novemberper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">December @ 9%</td>
									<td style="text-align:right" id="decembertarget">3.15</td>
									<td style="text-align:right" id="decembertask">25.55</td>
									<td style="text-align:right" id="decemberachive"></td>
									<td style="text-align:right" id="decemberexcess">25.55</td>
									<td style="text-align:center" id="decemberper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">Over All Q3</td>
									<td style="text-align:right" id="overallq3target">9.10</td>
									<td style="text-align:right" id="overallq3task">25.55</td>
									<td style="text-align:right" id="overallq3achieved">-</td>
									<td style="text-align:right" id="overallq3excess">25.55</td>
									<td style="text-align:center" id="overallq3achieveper">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td rowspan="4">Q4 @ 27%</td>
									<td style="text-align:center">January @ 9%</td>
									<td style="text-align:right" id="januarytarget">3.15</td>
									<td style="text-align:right" id="januarytask">28.70</td>
									<td style="text-align:right" id="januaryachive"></td>
									<td style="text-align:right" id="januaryexcess">28.70</td>
									<td style="text-align:center" id="januaryper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">February @ 8%</td>
									<td style="text-align:right" id="februarytarget">2.80</td>
									<td style="text-align:right" id="februarytask">31.50</td>
									<td style="text-align:right" id="februaryachive"></td>
									<td style="text-align:right" id="februaryexcess">31.50</td>
									<td style="text-align:center" id="februaryper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center">March @ 10%</td>
									<td style="text-align:right" id="marchtarget">3.50</td>
									<td style="text-align:right" id="marchtask">35.00</td>
									<td style="text-align:right" id="marchachive"></td>
									<td style="text-align:right" id="marchexcess">35.00</td>
									<td style="text-align:center" id="marchyper">0%</td>
								</tr>
								<tr>
									<td style="text-align:center" >Over All Q4</td>
									<td style="text-align:right" id="overallq4target">9.45</td>
									<td style="text-align:right" id="overallq4task">35.00</td>
									<td style="text-align:right" id="overallq4achive">-</td>
									<td style="text-align:right" id="overallq4excess">35.00</td>
									<td style="text-align:center" id="overallq4achieveper">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">H2 @ 53%</td>
									<td style="text-align:right" id="h2target">18.55</td>
									<td style="text-align:right" id="h2task">35.00</td>
									<td style="text-align:right" id="h2achive">-</td>
									<td style="text-align:right" id="h2excess">35.00</td>
									<td style="text-align:center" id="h2per">0%</td>
								</tr>
								<tr>
									<td colspan="7" style="text-align:center"></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">Yearly</td>
									<td style="text-align:right" id="yeartarget">35.00</td>
									<td style="text-align:right" id="yeartask">35.00</td>
									<td style="text-align:right" id="yearacheive">-</td>
									<td style="text-align:right" id="yearexcess">35.00</td>
									<td style="text-align:center" id="yearper">0%</td>
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
		
		</script>
	</body>

	</html>




</div>
<script type="text/javascript">
   // Table Append 


	var base_url = "<?php echo base_url(); ?>";
	var usertype="<?php echo $this->session->userdata('user_type') ?>";    
  var userrole="<?php echo $this->session->userdata('userrole') ?>";    
  var useruniqueid="<?php echo $this->session->userdata('useruniqueid') ?>"; 
 
</script>
<script src="<?php echo base_url(); ?>assets/js/myjs/home.js"></script>