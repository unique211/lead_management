
        <input type="hidden" name="alert_msg" id='alert_msg' value="<?php 
        if($this->session->flashdata('e_l_msg'))
        {
        echo $this->session->flashdata('e_l_msg');	
        }
   
         ?>">
<div class="container">
	<div class="row">
    <div class="col-md-12">
		<h2>Lead Information</h2><br>
    <form action="filter_leads" method="POST">
    <div class="row">
   
        <div class="col-md-4"><label>Form</label><input type="date" class="form-control" name="min" id="min" required></div>
        <div class="col-md-4"><label>To</label><input type="date" class="form-control" name="max" id="max" required></div>
        <div class="col-md-4"><input type="submit" name="filter_submit" class="btn btn-primary lead_filter_btn" value="Search" ></div>
     
    </div>
    </form>
		<table class="table table-striped display nowrap" id="leads_data">
			<thead>
			<tr>
				<th>Serial No</th>
				<th>User Name</th>
				<th>Lead Date</th>
				<th>Lead Type</th>

				<th>Lead Source</th>
				<th>Lead Dealer</th>
				<th>Action</th>
        <th></th>
			</tr>
			</thead>
      <tbody>
			<?php 
			$s=1;
			foreach ($records as $row)
			{
				/*print_r($records);
				exit();*/
				echo "<tr>";
				echo "<td>".$s++."</td>";
				echo "<td>".$row['first_name']."</td>";
				echo "<td>".$row['lead_date']."</td>";
				echo "<td>".$row['lead_type']."</td>";
				echo "<td>".$row['lead_source']."</td>";
				echo "<td>".$row['lead_dealer']."</td>";

				if(in_array('editLead', $user_permission))
				 {echo "<td>
				 		<a href='' data-toggle='modal' data-target='#myModal' class='edit_icon_style' id='".$row['id']." ' onclick='getrecord(this.id)'><i class='glyphicon glyphicon-pencil'></i></a>
						<?php  ?>
						</td>"; 
					}
				 if(in_array('deleteLead', $user_permission))
				 {
					 echo "<td><a href='' data-toggle='modal' data-target='#myModal1' id='".$row['id']."'  onclick='deleterecord(this.id)' class='del_icon_style'><i class='glyphicon glyphicon-trash'></i></a></td>";
					echo "</tr>";
				}
				}
				?>			
	 </tbody>
  	</table>
  </div>
	</div>
	 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update Lead Deatails</h3>
        <button type="button" style="margin-top: -2em;" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="edit_lead_details" method="POST">
           <input type="hidden" name="empid" id='empid' value="">
          <div class="row">
            <div class="col-md-6">
               
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="f_name" 
            name="f_name">
          </div>
              <div class="form-group">
            <label for="recipient-name" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="l_name" 
            name="l_name">
          </div>
             <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gender:</label>
            <input type="text" class="form-control" id="gender" name="gender">
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Martial Status:</label>
            <input type="text" class="form-control" id="m_status" name="m_status">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone:</label>
            <input type="number" class="form-control" id="phone" 
            name="phone">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <textarea class="form-control" id="address" 
            name="address"></textarea>          
            </div>
               <div class="form-group">
            <label for="recipient-name" class="col-form-label">Residence:</label>
             <input type="text" class="form-control" id="residence" 
            name="residence">
            
            </div>
                  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Job:</label>
             <input type="text" class="form-control" id="job" 
            name="job">            
            </div> 
          </div>
            <div class="col-md-6">     
                  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Branch:</label>
             <input type="text" class="form-control" id="branch" 
            name="branch">
            
            </div>
                  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lead Date:</label>
            <input type="date" class="form-control" id="l_date" 
            name="l_date">
          </div>
                  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lead Type:</label>
            <input type="text" class="form-control" id="l_type" 
            name="l_type">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lead Source:</label>
            <input type="text" class="form-control" id="l_source" 
            name="l_source">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lead Dealer:</label>
            <input type="text" class="form-control" id="l_dealer" 
            name="l_dealer">
          </div>
         <div class="form-group">
            <label for="recipient-name" class="col-form-label">Relationship:</label>
            <input type="text" class="form-control" id="relationship" 
            name="relationship">
          </div>
               <div class="form-group">
            <label for="recipient-name" class="col-form-label">Light Status:</label>
            <input type="text" class="form-control" id="l_status" 
            name="l_status">
          </div>
              <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lead Note:</label>
            <textarea class="form-control" id="l_note" 
            name="l_note"></textarea>
            
            </div>
          </div>
            </div>
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
     $(document).ready(function() {
    $('#leads_data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'pdf'
        ]
    } );
      $('#min').change( function() { 

        table.draw(); } );
      $('#max').change( function() {
         //console.log("hi");
       table.draw(); } );
} );
  
  </script>
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
	function getrecord(id)
	{
		//alert('id'+id);
		$.ajax(
		{
		  url:"get_lead_record/"+id,
		  type:"POST",
		  datatype:"json",
		  success:function(data)
		  {
		   // console.log(data);
		   var l=$.parseJSON(data);
		   $("#empid").val(l[0].id);
		    $("#f_name").val(l[0].first_name);
         $("#l_name").val(l[0].last_name);
         $("#gender").val(l[0].gender);
         $("#m_status").val(l[0].martial_status);
		     $("#email").val(l[0].email);
         $("#phone").val(l[0].mobile);
         $("#address").val(l[0].user_address);
         $("#residence").val(l[0].residence);
         $("#job").val(l[0].user_job);
         $("#branch").val(l[0].user_office_branchname);
		     $("#l_type").val(l[0].lead_type);
		     $("#l_source").val(l[0].lead_source);
		     $("#l_dealer").val(l[0].lead_dealer);
         $("#l_date").val(l[0].lead_date);
          $("#l_status").val(l[0].lead_status);
           $("#l_note").val(l[0].lead_note);
          $("#relationship").val(l[0].relation);


		      //$("#user_name").val(l[0].user_name);
		  }

		});
	}
	function delete_app()
  {
  	   var emp_id=$('#del_id').val();
	 $.ajax(
		{
		  url:"delete_lead/"+emp_id,
		  type:"POST",
		  //datatype:"json",
		  success:function(data)
		  {
		/*  alert(data);*/
		  window.location.href=weblink+'managelead';

		  }
		 });
  }
	function deleterecord(emp_id)
	{
       $('#del_id').val(emp_id);

	}
</script>
    