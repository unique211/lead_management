<input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
<?php 
/*print_r($this->session->flashdata('msg'));
exit();*/
?>
<div class="container">
	<h3>New Lead Type</h3>
	<form class=" form-horizontal" method='post' action="newlead_type">
		<br>
		<br>
		<table>
			<tr>
				<td>
					<div class="form-group">
		
		<div class="col-md-4">
			<label class="control-label">Lead Type</label>
		</div>
		<div class="col-md-8"><input class="form-control" type="text" name="lead_type" id="lead_type" maxlength="20">
		</div>
	</div>
	<div class="col-md-4"></div>
		<div class="col-md-4"><input type="submit" class="btn btn-primary" name="submit" value="Add"></div>
		<div class="col-md-3"></div>
				</td>
			</tr>
		</table>
	
	</form>
</div>
     <script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript">
 var x=document.getElementById('alert_msg').value;
alert(x);
 if(x!='')
 {
  show_notify(x);
 }
  function show_notify(x)
  {
$.notify({
  title: '',
  message: '<strong>Data saved successfully</strong>'
},{
  type: 'success'
});
}
</script>