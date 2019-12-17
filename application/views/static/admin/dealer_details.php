<!-- =========Sales Representative end======= -->
    <div id="sales_rep_view" class="container ">
      <h2>Dealer Information</h2>
    <br>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>SNO</th>
             <!-- <th>Employee Id</th> -->
            <th>First Name</th>
           
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
            
          </tr>
        </thead>
          <tbody>
            
          <?php
          $i=1;
          foreach ($records as $row)
           {
echo "<tr>";
        echo "<td>".$i++."</td>";
       /* echo "<td>".$row['dealer_id']."</td>";*/
        echo "<td>".$row['d_first_name']."</td>";
        echo "<td>".$row['d_email']."</td>";
        echo "<td>".$row['d_phone_num']."</td>";
        
        if(in_array('editDealer', $user_permission)){
         echo "<td>
            <a  id='".$row['id']." ' data-toggle='modal' data-target='#myModal1' href='' data-whatever='@getbootstrap'
              onclick='dealer_edit_view(this.id)' ><i class='glyphicon glyphicon-pencil'></i></a></td>"; 
          }
          if(in_array('deleteDealer', $user_permission)){
           echo "<td><a href='' class='del_icon_dealer' data-toggle='modal' data-target='#myModal2' id='".$row['id']."'   onclick='delete_dealer_rep(this.id)' ><i class='glyphicon glyphicon-trash'></i></a></td>";
          }
          echo "</tr>";
          }

            ?>
            <!-- <tr>
           <td><?php echo $i++;?></td>
            <td><?php echo $row['dealer_id'];?></td>
            <td><?php echo $row['d_first_name'];?></td>
            <td><?php echo $row['d_email'];?></td>
             <td><?php echo $row['d_phone_num'];?></td>
             <?php if(in_array('editDealer', $user_permission))
            {?>
            <td><a id="<?php echo $row['id']; ?>" href="" data-toggle='modal' data-target='#myModal1' data-whatever='@getbootstrap'
              onclick='dealer_edit_view(this.id)' style='color:black'><i class='fa fa-pencil-square' ></i></a></td>
            <?php } ?>
            <?php if(in_array('deleteDealer', $user_permission))
            {?>
             <td><a id="<?php echo $row['id']; ?>" 
              onclick='delete_dealer_rep(this.id)' href="" style='color:black'><i class='fa fa-trash-o'></i></a></td>
               <?php } ?>
       </tr> -->

             <!-- Modal for Update -->
  <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update Dealer Representative</h3>
        <button type="button" class="close" style="margin-top: -1.5em;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="edit_dealer" method="POST">
          
          <div class="form-group">
            
            <input type="hidden" class="form-control" id="emp_id" name="d_r_id" value="<?php echo $row['id']; ?>">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">First Name:</label>
            <input type="text" class="form-control" id="f_name" 
            name="d_r_f_name">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="d_r_email">
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone Number:</label>
            <input type="text" class="form-control" id="user_name" 
            name="d_phone_num">
          </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="dealer_rep_edit"
         value="Update">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       
        
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- Delete Modal -->
<div id="myModal2" class=" modal fade " role="dialog">

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
function dealer_edit_view(emp_id)
{
$.ajax(
{
  url:"dealer_edit/"+emp_id,
  type:"POST",
  datatype:"json",
  success:function(data)
  {
   // console.log(data);
   var l=$.parseJSON(data);
   $("#emp_id").val(l[0].dealer_id);
    $("#f_name").val(l[0].d_first_name);
     $("#email").val(l[0].d_email);
      $("#user_name").val(l[0]. d_phone_num);
  }


});
}
function delete_app()
  {
       var emp_id=$('#del_id').val();
        $.ajax(
        {
          url:"delete_dealer/"+emp_id,
          type:"POST",
          //datatype:"json",
          success:function(data)
          {
          //alert(data);
          window.location.href=weblink+'dealer_dtl';

          }


        });
     }
/*===== delete sales representatives========*/
function delete_dealer_rep(emp_id)
{
$('#del_id').val(emp_id);
}
    </script>