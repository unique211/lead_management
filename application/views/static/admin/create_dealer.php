 <div class="container">
      <h3>Dealer Creation</h3><br>
         <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msg2'); ?>">
       <table class="table table-striped">
          <tbody>
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr> -->
             <tr>
                <td colspan="1">
                   <form class=" form-horizontal" method="POST" action="create_dealer">
                      <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Dealer ID</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-address-card"></i></span><input id="dealer_id" 
                                name="dealer_id" placeholder="Dealer ID" class="form-control dealer_id" required  type="number" max="9999999"></div>
                            </div><span class="dealer_id1"></span>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="d_first_name" name="d_first_name" placeholder="First Name" class="form-control" required="true"  onkeypress="return restrict_name(event)" maxlength="20" type="text"></div><span class="d_first_name1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="d_last_name" name="d_last_name" placeholder="Last Name" class="form-control d_last_name" required="true" maxlength="20" onkeypress="return restrict_name(event)" type="text"></div><span class="d_last_name1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="d_email" name="d_email" placeholder="Email" class="form-control d_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text"></div><span class="d_email1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phn" name="d_phone_number" placeholder="Phone Number" class="form-control phn small-input" required="true" type="number" pattern="[0-9]{10}" onkeypress="preventNonNumericalInput(event)" ></div><span class="phn1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Company Name</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-users"></i></span><input id="d_company_name" 
                                name="d_company_name" placeholder="Company Name" class="form-control" required="true" value="" type="text" ></div><span class="d_company_name1"></span>
                            </div>
                         </div>
                      <div class="form-group">
                            <label class="col-md-4 control-label">Region</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-globe"></i></span>
                                <input id="demo" name="d_region" placeholder="Region"
                                 class="tags_input form-control" required="true" value="" type="text" ></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Region Type</label>
                            <div class="col-md-4 inputGroupContainer">
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
                         <div class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker"></i></span><textarea rows="4" cols="40" class="form-control" name="d_address"> </textarea></div>
                            </div>
                         </div>
                         
                         
                        <tr><td><input type="submit" class="btn btn-primary" 
                          name="dealer_creation" value="Save" onclick="return validate_data()"></td>
                          <td><input type="reset" class="btn btn-danger set_btn1" 
                          name="" value="Reset" onclick="" ></td></tr>
                      </fieldset>
                   </form>
                </td>
               
                
             </tr>
          </tbody>
       </table>
    </div>
   <!--   <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='assets/src/tagcomplete.js'></script> -->
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
function validate_data()
{
  var dealer_id=$('#dealer_id').val();
  if(dealer_id=='')
  {
    $(".dealer_id1").text("This field is required");
        $(".dealer_id1").css("color","red");
        $(".dealer_id").focus();
        return false;
  }
  var d_first_name=$('d_first_name').val();
  if(d_first_name=='')
  {
    $(".d_first_name1").text("This field is required");
        $(".d_first_name1").css("color","red");
        $(".d_first_name").focus();
        return false;
  }
  var d_last_name=$('#d_last_name').val();

  if(d_last_name=='')
  {
        $(".d_last_name1").text("This field is required");
        $(".d_last_name1").css("color","red");
        $(".d_last_name").focus();
        return false;
  }
  var email=('#d_email').val();
  if(email=='')
  {
        $(".d_email").text("This field is required");
        $(".d_email1").css("color","red");
        $(".d-email").focus();
        return false;
  }
  var d_company_name=$('#d_company_name').val();
  if(d_company_name=='')
  {
       $(".d_company_name1").text("This field is required");
        $(".d_company_name1").css("color","red");
        $(".d_company_name").focus();
        return false;
  }
  return true;
}
function restrict_name(e)
{

    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123));
      
}
 $(document).ready(function()
  {
    //alert('hi');
    $(document).on('change','.dealer_id',function()
    {
      
       var v=$(this).val();
      if(v=='')
      {
        $(".dealer_id1").text("This field is required");
        $(".dealer_id1").css("color","red");
      }
      else
      {
        $(".dealer_id1").text("");
      }

      });
    $(document).on('change','.d_first_name',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".d_first_name1").text("This field is required");
        $(".d_first_name1").css("color","red");
      }
      else
      {
        $(".d_first_name1").text("");
      }

      });
    $(document).on('change','.d_last_name',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".d_last_name1").text("This field is required");
        $(".d_last_name1").css("color","red");
      }
      else
      {
        $(".d_last_name1").text("");
      }

      });
    $(document).on('change','.d_email',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".d_email1").text("This field is required");
        $(".d_email1").css("color","red");
      }
      else
      {
        $(".d_email1").text("");
      }

      });
    $(document).on('change','.d_company_name',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".d_company_name1").text("This field is required");
        $(".d_company_name1").css("color","red");
      }
      else
      {
        $(".d_company_name1").text("");
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