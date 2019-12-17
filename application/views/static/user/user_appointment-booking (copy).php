 <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('lead1'); ?>">
 <?php  #echo $this->session->flashdata('lead1');exit; ?>
  <div class="container">
      <br>
      <h3>Lead Creation</h3>
      <form class=" form-horizontal" method="post" action="user_information">
      
          <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr>  Marital status and Lead date to the "New Lead"  screen.-->
                 
                    
                        <div class="row">
                          <div class="col-md-6">
                         <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fname" name="fname" placeholder="First Name" class="form-control fname" required="true" maxlength="20" value="" type="text" onkeypress="return restrict_name(event)" ></div>
                               <span class="fname1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="lname" name="lname" placeholder="Last Name" class="form-control lname" required="true" maxlength="20" type="text" onkeypress="return restrict_name(event)">
                                
                               </div><span class="lname1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Gender</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                                <select name="gender" id="gender" class="gender form-control">
                                     <option value="">Select</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                  </select>
                               </div><span class="gender1"></span>
                            </div>
                         </div>
                           <div class="form-group">
                            <label class="col-md-4 control-label">Marital status</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="m_status" id="m_status" class="m_status form-control" onchange="show_spouse(this.value)">
                                     <option value="">Select</option>
                                  <option value="Married">Married</option>
                                  <option value="Unmarried">Unmarried</option>
                                  </select></div><span class="m_status1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control email" required value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phn" name="phn" placeholder="Phone Number" class="form-control phn small-input" required pattern="[0-9]{10}" type="number" onkeypress="preventNonNumericalInput(event)"></div><span class="phn1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                <input type="text" class="form-control u_addr" name="u_addr" id="u_addr"><!-- <textarea rows="4" cols="40" class="form-control u_addr" name="u_addr" id="u_addr" placeholder="Address"> </textarea> --></div><span class="u_addr1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Residence</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="residence" name="residence" placeholder="Residence" class="form-control residence" required="true" value="" type="text" maxlength="20"></div><span class="residence"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Job</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input id="job" name="job" placeholder="Job" class="form-control job" required="true" value="" type="text" maxlength="20"></div><span class="job1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Branch Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-sitemap"></i></span><input id="br_name" name="br_name" placeholder="Branch Name" class="form-control br_name" required="true" value="" type="text" maxlength="20"></div><span class="br_name1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Lead Date</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                 <input type="date"  id="l_date"name="l_date" class="form-control l_date"></div><span class="l_date1"></span>
                            </div>
                         </div>
                            </div>
               
                         <div class="col-md-6">
                     
                          <div class="form-group">
                            <label class="col-md-4 control-label">Lead type</label>
                            <div class="col-md-8 inputGroupContainer">
                              <div class="input-group"><span class="input-group-addon adj_size"><i class="fa fa-filter" style="font-size:14px;"></i></span>
							  <input name="l_type" id="l_type" class="form-control l_type" list="l_types" autocomplete="off">
							  <datalist id="l_types">
							   <?php 
                                foreach($lead_type as $l)
                                {
                                ?>
                                <option value="<?php echo $l['lead_type']; ?>"><?php echo $l['lead_type']; ?></option>
                                 <?php } ?>
							  </datalist>
							
                               </div>
                             <span class="l_type1"></span>
                            </div>
                         </div>

                         <div class="form-group lead_source" style="display: none">
                            <label class="col-md-4 control-label">Lead Source</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-magnet" style="font-size:13px;"></i></span>
                                <div class="source1">
                                  <input type="text" name="l_source" id="l_source" list='leads1' class="form-control l_source" onchange="show_lead_dealer(this.value)" autocomplete="off">
                                  <datalist id="leads1">
                                  </datalist>
                                 </div></div><span class="l_source1"></span>
                            </div>
                         </div>
                         <div class="form-group d_relation"  style="display: none">
                            <label class="col-md-4 control-label">Relationship</label>
                            <div class="col-md-8 inputGroupContainer">
                                  <div class="input-group"><span class="input-group-addon adj_size"><i class="fa fa-handshake-o" style="font-size:13px;"></i></span>
								<input type="text" name="relation" id="relation" class="form-control relation" list="rel" autocomplete="off">
								<datalist id="rel">
								 <?php  foreach ($relation as $key) {
                                    ?>
                                    <option value="<?php echo $key['relationship']; ?>"><?php echo $key['relationship']; ?></option>
                                    <?php
                                  } ?> 
								</datalist>
                                </div>
                                <span class="relation1"></span>           
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Lead Dealer</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-building" style="font-size:16px;"></i></span>
                                 <input id="l_dealer" name="l_dealer" class="form-control l_dealer" list="lead_dealer" autocomplete="off">
								 <datalist id="lead_dealer">
								  <?php 
                                foreach($records1 as $l)
                                {

                                ?>
                                <option value="<?php echo 
                                $l['first_name']; ?>"><?php echo $l['first_name']; ?></option>
            <?php } ?>              
								 </datalist>
                             
                               </div><span class="l_dealer1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Light Status</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="adj_size input-group-addon" ><i class="material-icons" style="font-size:15px;">traffic</i>
                               </i></span>
							   <input name="l_status" id="l_status" class="form-control l_status" list="status" autocomplete="off">
							   <datalist id="status">
							  
                                    <option value="unprocessed">Unprocessed</option>
                                    <option value="processed">Processed</option>
							   </datalist>
                                  </div><span class="l_status1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Lead Note</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="adj_size input-group-addon"><i class="glyphicon glyphicon-pencil" style="font-size:15px;"></i></span>
                              <textarea name="l_note" id="l_note" placeholder="Lead Note" class="form-control l_note" rows="4" cols="35"></textarea></div>
                                 <span class="l_note1"></span>
                            </div>
                         </div>
                          <div id="secondary_details" style="display: none;" >
                          <h4 align="left">Secondary</h4>
                          <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="s_fname" name="sec_fname" placeholder="First Name" class="form-control "  maxlength="20"  type="text"  ></div>
                               <span class="s_fname1"></span>
                            </div>
                         </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="s_lname" name="sec_lname" placeholder="Last Name" class="form-control " maxlength="20" type="text">
                                
                               </div><span class="s_lname1"></span>
                            </div>
                         </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="s_email" name="sec_email" placeholder="Email" class="form-control s_email"  value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="" name="sec_phn" placeholder="Phone Number" class="form-control s_phn small-input"  pattern="[0-9]{10}" type="number" onkeypress="preventNonNumericalInput1(event)"></div><span class=""></span>
                            </div>
                         </div>
                    <div class="form-group">
                            <label class="col-md-4 control-label">Job</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input id="" name="sec_job" placeholder="Job" class="form-control "  type="text" maxlength="20"></div><span class="s_job1"></span>
                            </div>
                         </div>
                         </div>
                         <div id="spouse_details" style="display: none;" >
                          <h4 align="left">Spouse/Partner</h4>
                          <div class="form-group">
                            <label class="col-md-4 control-label">First Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="s_fname" name="s_fname" placeholder="First Name" class="form-control "  maxlength="20"  type="text"  ></div>
                               <span class="s_fname1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Last Name</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="s_lname" name="s_lname" placeholder="Last Name" class="form-control " maxlength="20" type="text">
                                
                               </div><span class="s_lname1"></span>
                            </div>
                         </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="s_email" name="s_email" placeholder="Email" class="form-control s_email"  value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Phone Number</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="s_phn" name="s_phn" placeholder="Phone Number" class="form-control s_phn small-input"  pattern="[0-9]{10}" type="number" onkeypress="preventNonNumericalInput1(event)"></div><span class="s_phn1"></span>
                            </div>
                         </div>
                    <div class="form-group">
                            <label class="col-md-4 control-label">Job</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span><input id="s_job" name="s_job" placeholder="Job" class="form-control s_job"  type="text" maxlength="20"></div><span class="s_job1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Age</label>
                           <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon " style="width: 14px;"></i></span><input id="s_age" name="s_age" placeholder="Last Name" class="form-control " maxlength="20" type="text">
                                
                               </div><span class="s_job1"></span>
                            </div>
                         </div>

                         </div>
                       </div>          
             <hr>
             <div class="row">
               <div class="col-md-8">
                 <input type="submit" class="btn btn-primary" value="Save" name="lead_submit" id="save">
                 <input type="reset" class="btn btn-danger" 
                 name="" value="Reset">
               </div>
             </div>
           
        </form>
</div>
     <script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQAfOY3OpWLwnkhhLlfhOPFVil7Br5PQ&amp;libraries=places"></script>
<script>
  google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var input = document.getElementById('u_addr');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      // place variable will have all the information you are looking for.
      /* $('#lat').val(place.geometry['location'].lat());
       $('#long').val(place.geometry['location'].lng());*/
      place = place.name;
      //place=place.url;
      //alert(place);
//console.log(place);
//console.log(place.url);
      //display the url of that address
      //document.getElementById('add_url').value=
      'https://maps.google.com/?q='+place;
      //alert(url);
     // url=place.url;
     /* $('#add_url').val(url);https://maps.google.com/?q=tirupati
      alert(place_url);*/
      //url=pl
    var map='<iframe frameborder="0" width="370em" height="350em" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q='+place+'&z=14&output=embed"></iframe>';
    $("#map").html(map);
     
    });
  }
</script>
<script type="text/javascript">
  $("#spouse_details").hide();
  function show_spouse(m_status){
    if(m_status=='Married'){
      $("#spouse_details").show();
      //$("#secondary_details").hide();
    }else{
      $("#spouse_details").hide();
    //  $("#secondary_details").show();
    }
    
  }
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
function get_leads(){
         $.ajax(
            {
              type:'POST',
              url:"get_leads",
               
               //data:{l_type:x,l_source:v},
              datatype:"json",
				 async : false,
              success:function(data)
              {
            
                var x=$.parseJSON(data);
                var op='';
                for(var i=0;i<x.length;i++){
                   op+='<option value="'+x[i].first_name+'">'+x[i].first_name+'</option>';
                } 
                $("#leads").html(op);
              }
            });
}



 function show_lead_dealer(v)
{
  var x=$('#l_type').val();
      if(v=='')
      {
       
        $(".l_source1").text("This field is required");
        $(".l_source1").css("color","red");
        $(".l_dealer").val(null);
      }
      else
      {
        $(".l_source1").text("");
      }
      $.ajax(
            {
              type:'POST',
              url:"lead_source_depdent",
               
               data:{l_type:x,l_source:v},
              //datatype:"json",

              success:function(data)
              {
                //console.log(data);
         /*       var op="<select class='form-control l_source' name='l_source' id='l_source' onchange='show_lead_dealer(this.value)'><option value=''>select</option>";*/
                //var sr=JSON.parse(data);

                var x=$.parseJSON(data);
                var dealer=x[0].lead_dealer;
                var op='<option value="'+dealer+'">'+dealer+'</option>';
               // console.log(dealer);
                $("#l_dealer").val(dealer);
				$("#lead_dealer").append(op);
                       /*for(var i=0;i<x.length;i++)
                        {
                          op+='<option value="'+x[i].lead_source+'">'+x[i].lead_dealer+'</option>';
                        }
                        op+='</select>';*/
                        //$(".source").html(c);
                        
                       // $('select[name^="l_dealer"] option[value="'+dealer+'"]').attr("selected","selected");
                        
                
              }
            });
    
        
}
/*function check_phone(ph)
{
  var p=ph.length;

}*/
function restrict_name(e)
{

    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123));
      
}
function validate_data()
{
  var fname=$(".fname").val();
    var lname=$(".lname").val();
   var  gender=$(".gender").val();
 var m_status=$('.m_status').val();
  var email=$('.email').val();
  var l_date=$('.l_date').val();
  var l_type=$('.l_type').val();
  if(fname=='')
  {
        $(".fname1").text("This field is required");
        $(".fname1").css("color","red");
        $(".fname").focus();
        return false;
  }
  if(lname=='')
  {
        $(".lname1").text("This field is required");
        $(".lname1").css("color","red");
        $(".lname").focus();
        return false;
  }
if(gender=='')
  {
        $(".gender1").text("This field is required");
        $(".gender1").css("color","red");
        $(".gender").focus();
        return false;
  }
  if(m_status=='')
  {
        $(".m_status1").text("This field is required");
        $(".m_status1").css("color","red");
        $(".m_status").focus();
        return false;
  }
    if(email=='')
  {
        $(".email1").text("This field is required");
        $(".email1").css("color","red");
        $(".email").focus();
        return false;
  }
     if(l_date=='')
  {
        $(".l_date1").text("This field is required");
        $(".l_date1").css("color","red");
        $(".l_date").focus();
        return false;
  }
    if(l_type=='')
  {
        $(".l_type1").text("This field is required");
        $(".l_type1").css("color","red");
        $(".l_type").focus();
        return false;
  }
  return true;
}
  $(document).ready(function()
  {
   // validation for duplicates based on names

    // validations for new lead 
    $(document).on('change','.fname',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".fname1").text("This field is required");
        $(".fname1").css("color","red");
      }
      else
      {
        $(".fname1").text("");
      }
    });
    $(document).on('change','.lname',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".lname1").text("This field is required");
        $(".lname1").css("color","red");
      }
      else
      {
        $(".lname1").text("");
      }
      var f_name=$(".fname").val();
      var l_name=v;
          $.ajax({
        type: 'POST',
        url: 'check_lead_duplicate',
        data: { f_name: f_name,l_name: l_name },
        //dataType: 'json',
        success: function(data) {
          if(data=='duplicate')
          {
             $(".lname1").text("Record already exits with same names");
        $(".lname1").css("color","red");
          }
        },
        error: function(response) {
           
           // alert(response.responseJSON.message);
        }
    });
    });
    $(document).on('change','.gender',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".gender1").text("This field is required");
        $(".gender1").css("color","red");
      }
      else
      {
        $(".gender1").text("");
      }
    });
        $(document).on('change','.m_status',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".m_status1").text("This field is required");
        $(".m_status1").css("color","red");
      }
      else
      {
        $(".m_status1").text("");
      }
    });
    $(document).on('change','.email',function()
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
     $(document).on('keyup','.s_phn',function()
    {
       var v=$(this).val();
      

      if(v=='')
      {
        $(".s_phn1").text("This field is required");
        $(".s_phn1").css("color","red");
       
      }
      else
      {
         if(v.length<10){
            $('.s_phn1').text("Phone number must contain 10 digits");
            $(".s_phn1").css("color","red");
            $("#save").attr("disabled","disabled");

          }
          else if(v.length>10)
          {
           $('.s_phn1').text("Please enter 10 digit phone number");
            $(".s_phn1").css("color","red");
            $("#save").attr("disabled","disabled");
          }
          else
          {
            $('.s_phn1').text("");
            $("#save").removeAttr("disabled");
          }
        
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
            $('.phn1').text("Phone number must contain 10 digits");
            $(".phn1").css("color","red");
            $("#save").attr("disabled","disabled");

          }
          else if(v.length>10)
          {
           $('.phn1').text("Please enter 10 digit phone number");
            $(".phn1").css("color","red");
            $("#save").attr("disabled","disabled");
          }
          else
          {
            $('.phn1').text("");
            $("#save").removeAttr("disabled");
          }
        
      }
    });
       $(document).on('change','.l_type',function()
    {
        
       var x=$('#l_type').val();
      //$("#l_dealer").prop('selected','selected');
     // $('select[name^="l_dealer"] option[value=""]').attr("selected","selected");
        var source=$("#l_source").val();
        var dealer=$("#l_dealer").val();
		console.log(source);
		console.log(dealer);
		if(source!=''||dealer!='')
		{
			$("#l_source").val("");
			$("#l_dealer").val("");
		}
	
	
      if(x=='')
      {
        $(".l_type1").text("This field is required");
        $(".l_type1").css("color","red");
        $(".lead_source").hide();
        $(".d_relation").hide();
         $('.l_dealer').val(null);
      }
      else
      {
        $(".l_type1").text("");
        $(".lead_source").show();
        $(".d_relation").show();
         var x=$('#l_type').val();
         var op='';
            
       $.ajax(
            {
              type:'POST',
              url:"lead_type_depdent",
               
               data:{l_type:x},
              //datatype:"json",
				 async : false,
              success:function(data)
              {
                //console.log(data);
                //var op="";
                //var sr=JSON.parse(data);
                var x=$.parseJSON(data);
                //console.log(x);
                var sub_lead=x[0].sub_lead;
                if(sub_lead=='YES'){
                    $("#secondary_details").show();
                }else{
                    $("#secondary_details").hide();
                }  
              //  var op='';
                       for(var i=0;i<x.length;i++)
                        {

                          op+='<option value="'+x[i].lead_source+'">'+x[i].lead_source+'</option>';
                        }
                        
                        //$(".source").html(c);
                        //$(".l_source").append(op);
                       // console.log(op);
                       
                
              }
            });
			$.ajax({
              type:'POST',
              url:"get_leads",
              datatype:"json",
				 async : false,
              success:function(data)
              {
                
                var x=$.parseJSON(data);
                
                for(var i=0;i<x.length;i++){
                   op+='<option value="'+x[i].first_name+'">'+x[i].first_name+'</option>';
                }
               // console.log(op); 
			    $("#leads1").html(op);
                
              }
            });
      }
    });

    $(document).on('change','.l_date',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".l_date1").text("This field is required");
        $(".l_date1").css("color","red");
      }
      else
      {
        $(".l_date1").text("");
      }
    });
     
           $(document).on('change','.relation',function()
    {
       var v=$(this).val();
      
      if(v=='')
      {
        $(".relation1").text("This field is required");
        $(".relation1").css("color","red");
      }
      else
      {
        $(".relation1").text("");
      }
    });
    $(document).on('change','.l_dealer',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".l_dealer1").text("This field is required");
        $(".l_dealer1").css("color","red");
      }
      else
      {
        $(".l_dealer1").text("");
      }
    });
    $(document).on('change','.l_status',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".l_status1").text("This field is required");
        $(".l_status1").css("color","red");
      }
      else
      {
        $(".l_status1").text("");
      }
    });
    $(document).on('change','.l_note',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".l_note1").text("This field is required");
        $(".l_note1").css("color","red");
      }
      else
      {
        $(".l_source1").text("");
      }
    });
    $(document).on('change','.job',function()
    {
      var v=$(this).val();
      if(v=='')
      {
        $(".job1").text("This field is required");
        $(".job1").css("color","red");
      }
      else
      {
        $(".job1").text("");
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
 function preventNonNumericalInput1(e) {
  e = e || window.event;
  var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
  var charStr = String.fromCharCode(charCode);

  if (!charStr.match(/^[0-9]+$/))
    e.preventDefault();
}
</script>