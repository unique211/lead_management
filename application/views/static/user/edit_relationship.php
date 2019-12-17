
<div class="container">
	<h2>Relationship Information</h2><br>
	<input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msg_relation'); ?>">
	<div class="row">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Serial No</th>
				<th>Relationship</th>
				<th>Action  </th>
			</tr>
			</thead>
			<?php 
			$s=1;
			foreach ($records as $row)
			{
				/*print_r($records);
				exit();*/
				echo "<tr>";
				echo "<td>".$s++."</td>";
				echo "<td>".$row['relationship']."</td>";
				
				if(in_array('editRelationship', $user_permission)){
				 echo "<td>
				 		<a href='' data-toggle='modal' class='edit_icon_lead_type' data-target='#myModal' id='".$row['id']." ' onclick='getrecord(this.id)'><i class='glyphicon glyphicon-pencil'></i></a>
						<?php  ?>
						</td>"; 
					}
					if(in_array('deleteRelationship', $user_permission)){
					 echo "<td><a href='' class='del_icon_relation' data-toggle='modal' data-target='#myModal1' id='".$row['id']."'  onclick='deleterecord(this.id)'><i class='glyphicon glyphicon-trash' ></i></a></td>";
					}
					echo "</tr>";
				}
				?>
				
				
		</table>
	</div>
	 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update Relationship</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -2em;" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="edit_reltionship_details" method="POST">
          
         <input type="hidden" name="relationid" id='relationid' value="">
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Relationship:</label>
            <input type="text" class="form-control" id="relation" 
            name="relation">
          </div>
         
        <div class="modal-footer">
        	 <input type="submit" class="btn btn-primary" name="submit"
         value="Update">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       
       
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div id="myModal1" class=" modal fade " role="dialog">

  <div class="modal-dialog ">
    
    <div class="modal-content">
    <!--   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div> -->
      <span id='cal_error'></span>
             
    <input type="hidden" name="del_id" id='del_id'>
 
        <div class="modal-body" >

          <h5>Are You Sure You Want To Delete</h5>
            <button type="button" class="close" style="margin-top: -1.5em;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="delete_app()">OK</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div>
    </div>

  </div>
</div>
</div>
<script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript">
 var x=document.getElementById('alert_msg').value;

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

<script type="text/javascript">
	function getrecord(id)
	{
		//alert('id'+id);
		$.ajax(
		{
		  url:"get_relationship_record/"+id,
		  type:"POST",
		  datatype:"json",
		  success:function(data)
		  {
		   // console.log(data);
		   var l=$.parseJSON(data);
		   $("#relationid").val(l[0].id);
		    $("#relation").val(l[0].relationship);
		    
		      //$("#user_name").val(l[0].user_name);
		  }

		});
	}
	function delete_app()
  {
       var emp_id=$('#del_id').val();
       $.ajax(
		{
		  url:"delete_relationship/"+emp_id,
		  type:"POST",
		  //datatype:"json",
		  success:function(data)
		  {
		 
		  window.location.href=weblink+'managerelationship';

		  }


		 });
   }
	function deleterecord(emp_id)
	{
		$('#del_id').val(emp_id);
		
	}
</script>