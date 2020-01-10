
 <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('edit_userdata'); ?>">
<!-- =========Sales Representative end======= -->
    <div id="sales_rep_view" class="container ">
      <h2>Users Information</h2>
    <br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>SNO</th>
             <!-- <th>Employee Id</th> -->
            <!--  <th>User Name</th> -->
            <th>First Name</th> 
            <th>Email</th>
            <th>User Name</th>
           <th>Action</th>
          </tr>
        </thead>
          <tbody>
            
          <?php
          $i=1;
          foreach ($records as $row)
           {
            echo "<tr>";
        echo "<td>".$i++."</td>";
       /* echo "<td>".$row['emp_id']."</td>";*/
        echo "<td>".$row['first_name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['user_name']."</td>";
        
        if(in_array('editUser', $user_permission)){
         echo "<td>
            <a data-toggle='modal' data-target='#myModal' id='".$row['id']." '  data-whatever='@getbootstrap'
              onclick='edit_view(this.id)' ><i class='glyphicon glyphicon-pencil'></i></a></td>"; 
          }
          if(in_array('deleteUser', $user_permission)){
           echo "<td><a href='' data-toggle='modal' data-target='#myModal1' id='".$row['id']."' class='del_icon_user'  onclick='delete_sales_rep(this.id)' ><i class='glyphicon glyphicon-trash'></i></a></td>";
          }
          echo "</tr>";
          }

          ?>
             <!-- Modal for Update -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update User Information</h3>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2em;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="edit_sales_rep" method="POST">
          <input type="hidden" class="form-control" id="emp_id" name="s_r_id" value="<?php echo $row['id']; ?>">
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
            <label for="recipient-name" class="col-form-label">User Name:</label>
            <input type="text" class="form-control" id="user_name" 
            name="user_name">
          </div>
                   <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gender:</label>
             <select class=" form-control" name="gender" id="gender">
                                     <option>--Select--</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  </select>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            
            <input id="email" name="email" placeholder="Email" class="form-control email" required value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
          </div>
              <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone:</label>
            <input type="number" class="form-control" id="phone" 
            name="phone">
          </div>

             <div class="form-group">
            <label for="recipient-name" class="col-form-label">Role:</label>
             <select id="user_role" name="user_role" class="user_role form-control" required >
                                  <option value="">Select</option>
                                  <option value="User">User</option>
                                  <option value="Sales">Sales</option>
                                </select>
          </div>
             <div class="form-group">
            <label for="recipient-name" class="col-form-label">Company Name:</label>
            <input type="text" class="form-control" id="c_name" 
            name="c_name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date Of Joining:</label>
            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="dob" name="dob" placeholder="" class="form-control ap_date"  value="" type="date" <? if($this->session->userdata('user_type') !="Admin"){ ?>disabled <?php } ?> ></div>

               <span class="ap_date1"></span>
          </div>
          
          
            </div>
            <div class="col-md-6">
                <div class="form-group">
            <label for="recipient-name" class="col-form-label">Region:</label>
            <input id="region" name="region" placeholder="Region"
                                 class="tags_input form-control" required value="" type="text" >
          </div>
       <div class="form-group">
            <label for="recipient-name" class="col-form-label">Region Type:</label>
            <select class=" form-control" name="region_type" id="region_type">
                                     <option>--Select--</option>
                                  <option value="zip">Zip</option>
                                  <option value="city">City</option>
                                  <option value="county"> County</option>
                                   <option value="state"> State</option>
                                    <option value="country"> Country</option>
                                 
                                  </select>
          </div>
            
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">User Type:</label>
            <input type="text" class="form-control" id="u_type" 
            name="u_type">
          </div>
               <div class="form-group">
            <label for="recipient-name" class="col-form-label">Calndar ID:</label>
            <input type="text" class="form-control" id="cal_id" 
            name="cal_id">
          </div>
               <div class="form-group">
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control" id="u_title" 
            name="u_title">
          </div>
               <div class="form-group">
            <label for="recipient-name" class="col-form-label">Department:</label>
            <input type="text" class="form-control" id="department" 
            name="department">
          </div> 
         <div class="form-group">
            <label for="recipient-name" class="col-form-label">Comments:</label>
            <textarea class="form-control" id="comments" 
            name="comments"></textarea>          
            </div>
                <div class="form-group">
            <label for="recipient-name" class="col-form-label">Address:</label>
            <textarea class="form-control" id="address" 
            name="address"></textarea>          
            </div>  
            <div class="form-group">
                            <label id="currentfcyear" class="control-label"></label>
                            
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-dollar"></i></span><input type="number" min="0" id="currentfcyearamt" name="currentfcyearamt"  class="form-control" required="true" value="" type="text" maxlength="20"></div>
                            </div>
                        
            </div>
          </div>
     
        <div class="modal-footer">
           <input type="submit" class="btn btn-primary" name="sales_rep_edit"
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
  <!-- ==========model class end========== -->
          <!-- Modal for delete -->
  <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  -->
  <!-- ==========model class end========== -->
         </table>
    </div>
    <!-- =======view sales reps end======== -->
    <script type="text/javascript">
      /*====update sales Representatives======*/
      function getCurrentFinancialYear() {
  var fiscalyear = "";
  var today = new Date();
  var fyear= today.getFullYear().toString().substr(-2);
  if ((today.getMonth() + 1) <= 3) {


  
    fiscalyear = (parseInt(fyear) -parseInt(1)) + "-" + fyear;
   
  } else {
    fiscalyear =parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
    //fiscalyear=  fiscalyear.toString().substr(-2);
  }
  return fiscalyear
}

      var currentfbyear=getCurrentFinancialYear();
$('#currentfcyear').text("Target for FY"+currentfbyear+"(in Lakhs)");

$("#currentfcyearamt").keypress(function (e) {
			
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && e.which !=='-' && (e.which < 48 || e.which > 57)) {

        //$("#errmsg").html("Digits Only");
               return false;
    }else{
		$("#errmsg").hide();
	}
   });
$("#currentfcyearamt").attr("placeholder", "Target for FY"+currentfbyear+"(in Lakhs)").placeholder();
function edit_view(emp_id)
{

$.ajax(
{
 // alert(emp_id);
  url:"edit/"+emp_id,
  type:"POST",
  datatype:"json",
  success:function(data)
  {
   // console.log(data);
   var l=$.parseJSON(data);
   $("#emp_id").val(l[0].emp_id);
    $("#f_name").val(l[0].first_name);
    $("#l_name").val(l[0].last_name);
        $("#user_name").val(l[0].user_name);

    $("#gender").val(l[0].gender);
    $("#phone").val(l[0].phone_num);
     $("#email").val(l[0].email);
    $("#user_name").val(l[0].user_name);
      $("#user_role").val(l[0].user_role);
      $("#c_name").val(l[0].company_name);
        $("#region").val(l[0].region);
      $("#region_type").val(l[0].region_type);
      $("#u_type").val(l[0].user_type);
      $("#cal_id").val(l[0].google_calendar_id);
      $("#u_title").val(l[0].title);
      $("#department").val(l[0].department);
      $("#comments").val(l[0].comments);
      $("#address").val(l[0].address);
      $("#currentfcyearamt").val(l[0].finicialyear_amt);
      $("#dob").val(l[0].dob);
  }


});
}

function delete_app()
  {
       var emp_id=$('#del_id').val();
       $.ajax(
        {
          url:"delete_sales/"+emp_id,
          type:"POST",
          //datatype:"json",
          success:function(data)
          {
          //alert(data);
          window.location.href=weblink+'user_dtl';

          }
      });
     }
/*===== delete sales representatives========*/
function delete_sales_rep(emp_id)
{
  $('#del_id').val(emp_id);


}
    </script>
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
  message: '<strong>Data updated successfully</strong>'
},{
  type: 'success'
});
}

</script>