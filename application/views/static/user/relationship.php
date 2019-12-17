


 <div class="container">
      <h3>Relationships</h3><br>
         <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msg_relation'); ?>">
       <table class="table table-striped">
          <tbody>
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr> -->
             <tr>
                <td colspan="1">
                   <form class=" form-horizontal" method="POST" action="relationship">
                      <fieldset>
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">Enter Relationship </label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span><input  name="relationship" id="relationship" placeholder="Enter Relationship" class="form-control" required type="text" maxlength="20"></div><span class="relationship1"></span>
                            </div>
                         </div>
                                               
                        <tr><td><input type="submit" class="btn btn-primary" 
                          name="submit" value="Save"></td>
                          <td>
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
   <!--   <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='assets/src/tagcomplete.js'></script> -->
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
function check_validation(){
  var rel=$("#relationship").val();
  if(rel==''){

  }
}
</script>