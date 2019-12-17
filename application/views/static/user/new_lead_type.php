


 <div class="container">
      <h3>Lead Type Creation</h3><br>
         <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
       <table class="table table-striped">
          <tbody>
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr> -->
             <tr>
                <td colspan="1">
                   <form class=" form-horizontal" method="POST" action="newlead_type">
                      <fieldset>
                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">Lead Type </label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-filter"></i></span><input  name="lead_type" id="lead_type" autocomplete="off" placeholder="Lead Type" class="form-control" required="true" value="" type="text" maxlength="20"></div><span class=""></span>
                            </div>
                          <!--   <div class="col-md-2 inputGroupContainer">
                              <div>

                                <input type="radio" name="leads" class="leads" onchange="get_leads()" >Leads</div>
                            </div>
                            <div><input type="radio" name="leads" class="users" onchange="get_users()">Users</div> -->
                            </div>
                         </div>
                         
                         <div class="form-group">
                            <label class="col-md-4 control-label">Lead Source</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-magnet"></i></span>
                                <input type="text" name="source" id="source" class="form-control" placeholder="Lead Source" required maxlength="20" autocomplete="off">
                               <!--  <select name="source" id="source" class="form-control" required>
                                  <option value="">Select</option>
                                </select> -->
                               
                               <!-- 	<select name="l_dealer" id="" class="form-control "><option value="">select</option>
                                <?php 
                                #foreach($lead_type as $l)
                                {

                                ?>
                                <option value="<?php #echo 
                               # $l['lead_type']; ?>"><?php # echo 
                               # $l['lead_type']; ?></option>
   
            <?php } ?>
            </select> -->
                               </div><span class=""></span>
                            </div>
                         </div>                       
                         <div class="form-group">
                            <label class="col-md-4 control-label">Lead Dealer</label>
                            
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-building"></i></span>
                                <input type="text" name="l_dealer" id="" class="form-control " required maxlength="20" autocomplete="off" placeholder="Lead Dealer">
            <!--                    		<select name="l_dealer" id="" class="form-control " required=""><option value="">select</option>
                                <?php 
                                foreach($records1 as $l)
                                {

                                ?>
                                <option value="<?php echo 
                                $l['first_name']; ?>"><?php echo $l['first_name']; ?></option>
   
            <?php } ?>
            </select> -->
                               </div>
                            </div>
                         
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Add SubLead</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa" style="width: 14px;"></i></span>
                                <input type="text" name="sublead" id="sublead" maxlength="20" class="form-control " placeholder="Sub Lead" autocomplete="off">
                              <!--   <select name="sublead" id="sublead" class="form-control" required onchange="add_sublead(this.value)">
                                  <option value="">Select</option>
                                  <option value="YES">YES</option>
                                  <option value="NO">NO</option>
                                </select> -->
                                </div><span class=""></span>
                            </div>
                         </div>
                   
                        <tr><td><input type="submit" class="btn btn-primary" 
                          name="submit" value="Save" ></td>
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