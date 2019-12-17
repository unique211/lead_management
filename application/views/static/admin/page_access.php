
  <div class="container" style="background-color: #F8F9F9;padding-top: 2em;">
    <div id="newlead" class=" ">
      <h3>Page Access</h3><hr>
      
       <div class="container">
        <div  class="form-group">
           <form method="post" action="set_permissions">
          
          
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
                          <label class=" control-label">Select User Type</label>
                            
                        
            </div>
             <div class="col-md-4">
               <div class=" inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                <select class=" form-control" 
                                name="user_type" id="user_type">
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
            <div class="col-md-3"></div>
           
            <div class="col-md-2"><h4>Page Name</h4></div>
             <div class="col-md-2"><h4>Create</h4></div>
              <div class="col-md-2"><h4>Edit</h4></div> 
               <div class="col-md-2"><h4>Delete</h4></div> 

          </div>
          <hr>
           
            <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>Lead</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createLead"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editLead"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deleteLead"></h4></div> 
            
          </div>
            <br>
            <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>Appointment</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createAppointment"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editAppointment"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deleteAppointment"></h4></div> 
            
          </div>
            <br>
            <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>Dealer</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createDealer"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editDealer"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deleteDealer"></h4></div> 
            
          </div>
            <br><div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>Lead Type</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createLeadtype"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editLeadtype"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deleteLeadtype"></h4></div> 
            
          </div>
            <br>
          <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>User</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createUser"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editUser"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deleteUser"></h4></div> 
            
          </div>
          <br>
          <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-2"><label>Permissions</label></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="createPermissions"></h4></div>
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="editPermissions"></h4></div> 
                <div class="col-md-2"><h4><input type="checkbox" name="permission[]" id="permission" value="deletePermissions"></h4></div> 
            
          </div>
          <br>
          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-3"><input type="submit" class="btn btn-primary" name="submit" value="submit"></div>
            <div class="col-md-3"></div>
          </div>
          </form>
        </div>
       </div>
    </div>