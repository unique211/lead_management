
<div>
  <div id="menu2"class="container">
     <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msg'); ?>">
    
      <h3>User Creation</h3>
       <table class="table table-striped">
          <tbody>
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr> -->
             <tr>
                <td colspan="1">
                   <form class=" form-horizontal" method="POST" action="user_creation">
                      <fieldset>
                      	<div class="row">
                      		<div class="col-md-6">
                      			<div class="form-group">
	                            	<label class="col-md-4 control-label">Employee ID</label>
	                            	<div class="col-md-6 inputGroupContainer">
	                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-address-card"></i></span>
	                                <input id="emp_id" name="emp_id" placeholder="Employee ID" class="form-control emp_id" required type="number" max="9999999"></div><span class="emp_id1"></span>
	                            	</div>
                         		</div>
                         		<div class="form-group">
		                            <label class="col-md-4 control-label">User Name</label>
		                            <div class="col-md-6 inputGroupContainer">
		                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                                <input id="user_name" name="user_name" placeholder="User Name" class="form-control user_name" required="true" value="" type="text" onkeypress="return restrict_name(event)" maxlength="15"></div><span class="user_name1"></span>
		                            </div>
		                         </div>
                         			<div class="form-group">
		                            <label class="col-md-4 control-label">First Name</label>
		                            <div class="col-md-6 inputGroupContainer">
		                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		                                <input id="fisrt_name" name="fisrt_name" placeholder="First Name" class="form-control fisrt_name" required="true" value="" type="text" onkeypress="return restrict_name(event)" maxlength="15"></div><span class="fisrt_name1"></span>
		                            </div>
		                         </div>
		                         <div class="form-group">
		                            <label class="col-md-4 control-label">Last Name</label>
		                            <div class="col-md-6 inputGroupContainer">
		                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="last_name" name="last_name" placeholder="Last Name" class="form-control last_name" required value="" type="text" onkeypress="return restrict_name(event)" maxlength="15"></div>
		                            </div>
		                         </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <select class=" form-control" name="gender" id="gender">
                                     <option>--Select--</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  </select>
                               </div>
                            </div>
                         </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label">Role</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <select id="user_role" name="user_role" class="user_role form-control" required >
                                  <option value="">Select</option>
                                  <option value="User">User</option>
                                  <option value="Dealer">Dealer</option>
                                </select>
                                </div>
                            </div>
                         </div>
		                         <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control email" required value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input id="password" name="password" placeholder="Password" class="form-control" required="true" value="" type="password" maxlength="20"></div><span class="pswd"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input id="cpassword" name="cpassword" placeholder="Confirm Password" class="form-control cpassword" required="true" value="" type="password" maxlength="20"></div><span class="pswd1"></span>
                            </div>
                         </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phone_number" name="phone_number" placeholder="Phone Number" class="form-control phn small-input" required="true" type="number" pattern="[0-9]{10}" onkeypress="preventNonNumericalInput(event)" ></div><span class="phn1"></span>
                            </div>
                         </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">Region</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input id="demo" name="d_region" placeholder="Region"
                                 class="tags_input form-control" required="true" value="" type="text" ></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Region Type</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <select class=" form-control" name="d_region_type">
                                     <option>--Select--</option>
                                  <option value="zip">Zip</option>
                                  <option value="city">City</option>
                                  <option value="county"> County</option>
                                   <option value="state"> State</option>
                                    <option value="country"> Country</option>
                                 
                                  </select>
                               </div>
                            </div>
                         </div>
                      		</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Company Name</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-users"></i></span><input id="d_company_name" 
                                name="d_company_name" placeholder="Company Name" class="form-control" required="true" value="" type="text" ></div><span class="d_company_name1"></span>
                            </div>
                         </div>
                      			<div class="form-group">
                            <label class="col-md-4 control-label">User Type</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group">
                                <span class="input-group-addon"> <i class="fa fa-user-circle"></i><!-- <img src="lead_type.jpg"> --></span>
                                <select class=" form-control user_type" id='user_type' name="user_type">
                                     <option value="">--Select--</option>
                                  <option value="SalesRepresentative">Sales Representative</option>
                                  <option value="Admin">Admin</option>
                                  <option value="Secretary"> Secretary</option>
                                 
                                  </select>
                               </div><span class="user_type1"></span>
                            </div>
                         </div>
         
                         <div class="form-group">
                            <label class="col-md-4 control-label">Google Calendar Id</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="google_id" name="google_id" placeholder="" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required="true" value="" type="text"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Title</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-subtitles"></i></span><input id="title" name="title" placeholder="Title" class="form-control" required="true" value="" type="text" maxlength="20"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-sitemap"></i></span><input id="department" name="department" placeholder="Department" class="form-control" required="true" value="" type="text" maxlength="20"></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Comments</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-comments"></i></span><textarea rows="4" cols="40" class="form-control" name="comments"> </textarea></div>
                            </div>
                         </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-6 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span><textarea rows="4" cols="40" class="form-control" name="d_address"> </textarea></div>
                            </div>
                         </div>

                      </div>
                    </div>           
                         <tr><td><input type="submit" class="btn btn-primary" name="create_user" value="Save" onclick="return validate_data()"></td>
                         <td><input type="reset" class="btn btn-danger set_btn1" name="" value="Reset" onclick="" ></td>
                       </tr>
                      </fieldset>
                   </form>
                </td>
                             
             </tr>
          </tbody>
       </table>
    </div>
</div>
  <script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript">
    $(function(){
  var data = [
    'cow',
    'goat',
    'pig',
    'snake',
    'hamster',
    'elephant',
    'lion',
    'tiger',
    'monkey',
    'lizard',
    'bird',
    'crocodile',
    'gazelle',
    'antelope'
  ];

  $(".tags_input").tagComplete({

        keylimit: 1,
        hide: false,
        autocomplete: {
          data: data
        }
    });
});
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
function restrict_name(e)
{

    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123));
      
}
function validate_data()
{
  var emp_id=$('#emp_id').val();
  if(emp_id=='')
  {
        $(".emp_id1").text("This field is required");
        $(".emp_id1").css("color","red");
        $(".emp_id").focus();
        return false;

  }
  var user_name=$('#user_name').val();

  if(user_name=='')
  {
    $(".user_name1").text("This field is required");
        $(".user_name1").css("color","red");
        $(".user_name").focus();
        return false;
  }
  var fname=$('#fisrt_name').val();
  if(fname=='')
  {
    $(".fisrt_name1").text("This field is required");
        $(".fisrt_name1").css("color","red");
        $(".fisrt_name").focus();
        return false;
  }
  var email=$('#email').val();
  if(email=='')
  {
    $(".email1").text("This field is required");
        $(".email1").css("color","red");
        $(".email").focus();
        return false;
  }
  var user_type=$('#user_type').val();
  if(user_type=='')
  {
    $(".user_type1").text("This field is required");
        $(".user_type1").css("color","red");
        $(".user_type").focus();
        return false;
  }
  return true;
}
  $(document).ready(function()
  {
  
    $(document).on('change','#emp_id',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".emp_id1").text("This field is required");
        $(".emp_id1").css("color","red");
      }
      else
      {
        $(".emp_id1").text("");
      }

      });
    $(document).on('change','#password',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".pswd").text("This field is required");
        $(".pswd").css("color","red");
      }
      else
      {
        $(".pswd").text("");
      }

      });
    $(document).on('change','#cpassword',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".pswd1").text("This field is required");
        $(".pswd1").css("color","red");
      }
      else
      {
        $(".pswd1").text("");

      }
       var p=$('#password').val();
        if(p!=v)
        {
           $(".pswd").text("Password and Confirm Password miss match");
        $(".pswd").css("color","red");
        $('#cpassword').val("");
        $('#password').val("");
         $('#password').focus();
        }

      });
     $(document).on('keyup','.phn',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".phn1").text("This field is required");
        $(".phn1").css("color","red");
      }
      else
      {
         if(v.length<10){
            $('.phn1').text("Phone number must contain alteast 10 digits");
            $(".phn1").css("color","red");

          }
          else if(v.length>10)
          {
           $('.phn1').text("Please enter 10 digit phone number");
            $(".phn1").css("color","red");
          }
          else
          {
            $('.phn1').text("");
          }
        
      }
    });
     $(document).on('change','#user_name',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".user_name1").text("This field is required");
        $(".user_name1").css("color","red");
      }
      else
      {
        $(".user_name1").text("");
      }

      });
     $(document).on('change','#fisrt_name',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".fisrt_name1").text("This field is required");
        $(".fisrt_name1").css("color","red");
      }
      else
      {
        $(".fisrt_name1").text("");
      }

      });
     $(document).on('change','#email',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".email1").text("This field is required");
        $(".email1").css("color","red");
      }
      else
      {
        $(".email1").text("");
      }

      });
     $(document).on('change','#user_type',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".user_type1").text("This field is required");
        $(".user_type1").css("color","red");
      }
      else
      {
        $(".user_type1").text("");
      }

      });
      $(document).on('keyup','.phn',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".phn1").text("This field is required");
        $(".phn1").css("color","red");
      }
      else
      {
         if(v.length<10){
            $('.phn1').text("Phone number must contain alteast 10 digits");
            $(".phn1").css("color","red");

          }
          else if(v.length>10)
          {
           $('.phn1').text("Please enter 10 digit phone number");
            $(".phn1").css("color","red");
          }
          else
          {
            $('.phn1').text("");
          }
        
      }
    });
  });
   function preventNonNumericalInput(e) {
  e = e || window.event;
  var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
  var charStr = String.fromCharCode(charCode);

  if (!charStr.match(/^[0-9]+$/))
    e.preventDefault();
}
</script>