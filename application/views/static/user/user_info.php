
   <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('permissions_update'); ?>">
      <h3 style="margin-left: 6em">Page Access</h3><hr>
      <br>
       <div class="container">
        <div  class="form-group">
          <form method="post" action="set_permissions">
          
          
          <div class="row">
           
            <div class="col-md-2">
                          <label class=" control-label">Select User Type</label>                      
            </div>
             <div class="col-md-4">
               <div class=" inputGroupContainer">
                    <div class="input-group"><span class="input-group-addon">
                      <i class="fa fa-user-circle"></i></span>
                      <select class=" form-control" 
                      name="user_type" id="user_type" onchange='usertype(this.value)'>
                      <option>--Select--</option>
                      <option value="SalesRepresentative">Sales Representative</option>
                      <option value="Admin">Admin</option>
                      <option value="Secretary"> Secretary</option>

                      </select>
                    </div>
                </div>
             </div>
          
          </div>
          <br>
          <div class="row">
            <div class="col-md-10">
              <table class="table table-striped">
              <thead>
                <tr>
                    <th>Page Name</th>
                    <th><input type="checkbox" id="createpermisson" class="selectall">  Create</th>
                    <th><input type="checkbox" id="editpermission" class="selectall"> Edit</th>
                    <th><input type="checkbox" id="deletepermission" class="selectall"> Delete</th>
                    <th><input type="checkbox" id="exportpermission" class="selectall"> Export</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                foreach ($pagename as $key) {
                ?>
                  <tr>
                    <td><label><?php echo  $key['page_name']; ?></label></td>
                    <td><?php  if(in_array('createPermissions', $user_permission)){?>
                      <input type="checkbox" class="createpermisson" style="" name="permission[]" id="permission" value="create<?php echo  $key['page_name']; ?>" >
                       <?php } ?>
                    </td>
                    <td><?php  if(in_array('editPermissions', $user_permission)){?>
                      <input type="checkbox" class="editpermission" name="permission[]" id="permission" value="edit<?php echo  $key['page_name']; ?>" >
                      <?php } ?>
                    </td>
                    <td><?php  if(in_array('deletePermissions', $user_permission)){?>
                      <input type="checkbox" class="deletepermission" name="permission[]" id="permission" value="delete<?php echo  $key['page_name']; ?>">
                      <?php } ?>
                    </td>
                    <td><?php ?>
                      <input type="checkbox" class="exportpermission" name="permission[]" id="permission" value="export<?php echo  $key['page_name']; ?>">
                      <?php //} ?>
                    </td>
                  </tr>
                <?php 
                 }
                ?>
               
              </tbody>
               <tr><td><input type="submit" class="btn btn-primary" name="submit" value="submit"></td></tr>
              </table> 
            </div>
          </div>  
          <br>

          </form>
        </div>
       </div>
    </div>
    <script type="text/javascript">   
  function usertype(utype)
{
 // alert(utype);
   var xmlhttp = new XMLHttpRequest();
          xmlhttp.open('GET', weblink+"edit_page_access/"+utype, false);
          xmlhttp.send(null); 
          str=xmlhttp.responseText;

          //alert(str);
          str=str.replace(/^\s*([\S\s]*)\b\s*$/, '$1');
          //  alert(str);
            //var sp=$.parseJSON(str);
            
           var s=str.split(',');
          // alert(s);
            //alert(x.split(','));
          var b = str.search("success");
          if(b != -1)
          {
            window.location.reload();
          }else
          {
         
            $('input[name="permission[]"]').each(function() {
                  this.checked = false;
                });
            var inputElems = document.getElementsByTagName("input");
            for (var i=0; i<inputElems.length; i++) {       
                   if (inputElems[i].type == "checkbox"){
                   // alert('checkbox');
                      for (var j=0; j<s.length;j++)
                      {
                       // alert(str[i]);
                        if(inputElems[i].value==s[j])
                        {
                         // alert(inputElems[i].value);
                          inputElems[i].checked=true;
                          break;

                        }
                      }
                   }
                }
          }
           /* var s=$.parseJSON(str);
            console.log(str);*/
        }
        $(document).ready(function() {
          //change event of checkbox

          $(document).on('change', '.selectall', function() {
           var id=  $(this).attr('id');
           if($('#'+id).prop("checked") == true){
            $('.'+id).prop('checked', true);
           }else{
            $('.'+id).prop('checked', false);
           }
          });


});



        
 
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
  message: '<strong>Data saved successfully</strong>'
},{
  type: 'success'
});
}
</script>
   