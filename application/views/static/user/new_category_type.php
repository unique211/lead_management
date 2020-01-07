

<?php if ($user_permission){?>
 <div class="container">
      <h3>Category Type Creation</h3><br>
         <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
       <table class="table table-striped">
          <tbody>
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr> -->
             <tr>
                <td colspan="1">
                   <form   class=" form-horizontal" id="category_type" name="category_type" method="POST" >
                      <fieldset>
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">Category Type* </label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-filter"></i></span><input  name="category" id="category" autocomplete="off" placeholder="Category Type" class="form-control" required="true" value="" type="text" maxlength="20" required></div><span class=""></span>
                            </div>
                          <!--   <div class="col-md-2 inputGroupContainer">
                              <div>

                                <input type="radio" name="leads" class="leads" onchange="get_leads()" >Leads</div>
                            </div>
                            <div><input type="radio" name="leads" class="users" onchange="get_users()">Users</div> -->
                            </div>
                         </div>
                                           
                        <tr><td><input type="submit" id="btnsave"  class="btn btn-primary" 
                          name="submit" value="Save" ></td>
                          <td>
                            <input type="hidden" id="save_update" name="save_update" value="">
                          	<input type="reset" class="btn btn-danger set_btn1" 
                          name="" value="Reset" onclick="" ></td>
                      </tr>
                      </fieldset>
                   </form>
                </td>            
             </tr>
          </tbody>
       </table>
    </div>
    <div class="container">
	
	<input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
	<div class="row" id="show_master">
		
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
        <button class="btn btn-primary" id="delete">OK</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div>
    </div>

  </div>
</div>
</div>
<script> 
  var arrayFromPHP = <?php echo json_encode($user_permission); ?>;
  console.log(arrayFromPHP);
 </script>
<?php } ?>



   <!--   <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='assets/src/tagcomplete.js'></script> -->
<script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/myjs/new_category.js"></script>
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
/*function get_leads(){
    
      $.ajax(
    {
      url:"get_leads",
      type:"POST",
      datatype:"json",
      success:function(data)
      {
        
       var l=$.parseJSON(data);
     
       var op='<option value="">Select</option>';
        for(var i=0;i<l.length;i++)
        {
          op+='<option value="'+l[i].first_name+'">'+l[i].first_name+'</option>';
        }
                             
        $("#source").html(op);
    
      }

    });

  
}
function get_users(){
 
    $.ajax(
    {
      url:"get_users",
      type:"POST",
      datatype:"json",
      success:function(data)
      {
       
        var l=$.parseJSON(data);
        var op='<option value="">Select</option>';
        for(var i=0;i<l.length;i++)
        {
          op+='<option value="'+l[i].first_name+'">'+l[i].first_name+'</option>';
        }
                             
        $("#source").html(op);
         
      }

    });
  
}*/
</script>