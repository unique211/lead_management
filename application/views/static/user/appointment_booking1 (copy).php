 <!-- <style type="text/css">
   .checkmark {
   
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}
 </style> -->
 <div id="myModal" class=" modal fade" role="dialog">
  <form action="">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you want to view appoinments in google calendar.</h4>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
     <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
         <a href="api_login" id="contact-send-a" class="btn btn-primary"> YES</a>
         <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
      </div>
    </div>

  </div></form>
</div>
 <div id="accessModal1" class=" modal fade " role="dialog">
  <form action="">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">To Use Calendar You Need To Login With Google.</h4>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
     <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
         <a href="appointment_bkng_login" id="contact-send-a" class="btn btn-primary"> YES</a>
         <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
      </div>
    </div>

  </div></form>
</div>
 <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('app1'); ?>">  
           
   <div class="container">
   <h3>Appointment Booking</h3><div class="" align="right"></div>

      <div class="col-md-9">
      <form class=" form-horizontal" method="post" action="apptmnt_booking">
      <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   
                      <fieldset>
                         <div class="row">
                          <div class="col-md-12">
                        <div class="form-group app_css">
                          <div class="row">
                               <label class="col-md-4 control-label">Select Calendar Id</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group sec_cal"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>   <select class="form-control ap_cal_id" id="ap_cal_id" name="ap_cal_id">
                              <option value="--">Select</option>
                              
                            </select></div>
                               <span class="ap_cal_id1"></span>
                            </div>
                           <div class="col-md-2">
                               
                            <button id='use_cal' class="btn btn-primary" onclick='return check_authentication()'>Use Calendar</button></div>
                          </div>
                         
                         </div>
                         
                           <div class="form-group app_css">
                            <label class="col-md-4 control-label">Appointment Date</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="ap_date" name="ap_date" placeholder="" class="form-control ap_date"  value="" type="date" ></div>

                               <span class="ap_date1"></span>
                            </div>
                             <div class="input-group col-md-2"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input id="ap_stime" name="ap_stime" placeholder="" class="form-control ap_stime"  value="" type="time" ></div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Select Lead</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon " style=" width: 14px;"></i></span> 
                                <input type="text" list="leads" id="lead" name="lead" class="form-control" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" autocomplete="off">
                                <datalist id="leads">
                                   <?php  foreach ($leads as $key => $value) {
                               ?>
                               <option value="<?php echo $value['first_name']; ?>"><?php echo $value['first_name']; ?></option>
                               <?php
                              } ?>
                                </datalist>
                                </div>
                               <span class="lead1"></span>
                            </div>
                           
                         </div>
              
                          <div class="form-group">
                            <label class="col-md-4 control-label">Gift</label>
                            <div class="col-md-4 inputGroupContainer">
                                 <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></span>
                               <select class="form-control gift" id="gift" name="gift">
                              <option value="">Select</option>
                              <option value="Rainmate">Rainmate</option>
                              <option value="Gift">Gift</option>
                            </select></div><span class="gift1"></span>
                            
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Demo Dealer</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="demo_dealer" name="demo_dealer" class="form-control demo_dealer" autocomplete="off" list="d_dealer">
								<datalist id="d_dealer">
								<?php 
                                foreach($records1 as $l)
                                {

                                ?>
                                <option value="<?php echo 
                                $l['first_name']; ?>"><?php echo $l['first_name']; ?></option>
   
            <?php } ?>
								</datalist>
                
                               </div><span class="demo_dealer1"></span>
                            </div>
                         </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Ride Along</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <select id="ride" name="ride" class="form-control ride">
                                  <option value="">Select</option>
                                  <?php  foreach ($leads as $key => $value) {
                               ?>
                               <option value="<?php echo $value['first_name']; ?>"><?php echo $value['first_name']; ?></option>
                               <?php
                              } ?>
                                </select>
                              <!--   <input type="text" class="form-control ride"id="ride" name="ride" maxlength="20"> --></div><span class="ride1"></span>
                            </div>
                         </div>
                               <div class="form-group">
                            <label class="col-md-4 control-label">Assistant</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" class="form-control assistant" id="assistant" name="assistant" list="dealers" autocomplete="off" >
                                <datalist id="dealers">
                                  
                                </datalist></div><span class="assistant1"></span>
                            </div>
                         </div>
                               <div class="form-group">
                            <label class="col-md-4 control-label">Supervisor</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" class="form-control supervisor"id="supervisor" autocomplete="off" name="supervisor" list="dealers">
                               <datalist id="dealers">                       
                                </datalist></div><span class="supervisor1"></span>
                            </div>
                         </div>
                         <div class="form-group">
                            <label class="col-md-4 control-label">Set By</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="fa fa-cog"></i></span><input type="text" class="form-control setby" name="setby" id="setby" maxlength="20"></div><div class="col-md-3"></div><span class="setby1"></span>
                            </div>
                         </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-4 inputGroupContainer">
                                 <div class="input-group" ><span class="input-group-addon" ><i class="glyphicon" style=" width: 14px;" ></i></span>
								 
								<!-- <input type="text" class="form-control status" id="status" name="status" list="status-value" autocomplete="off">
								 <datalist list='status-value'>
								 <option value="Pending">Pending</option>
                              <option value="Rescheduled">Rescheduled</option>
                              <option value="Demo">Demo</option>
                              <option value="Cancelled">Cancelled</option>
                              <option value="Sale">Sale</option>
								 </datalist>-->
								  <select class="form-control status" id="status" name="status">
                              <option value="">Select</option>
                              <option value="Pending">Pending</option>
                              <option value="Rescheduled">Rescheduled</option>
                              <option value="Demo">Demo</option>
                              <option value="Cancelled">Cancelled</option>
                              <option value="Sale">Sale</option>
                            </select>
                               </div><span class="status1"></span>
                            
                            </div>
                         </div>

                         <div class="form-group"  id="custom-search-input">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>

                                 <input type="text"  class="form-control ap_addr" name="ap_addr" id="ap_addr"> </input>

                                 <input type="hidden"    class="form-control" 
                                 name="add_url" id="add_url"> </input>

                                 <input type="hidden" name="lat">
                                 <input type="hidden" name="long">
                              </div><span class="ap_addr1"></span>
                            </div>
                         </div>

                        <!--  <div class="form-group">
                          <div class="col-md-7"></div>
                            <div class="col-2">
                               <button  class="btn btn-primary"  >Show Map</button>
                            </div>
                         </div> -->
                             <div class="form-group">
                            <label class="col-md-4 control-label">Demo/Sale Notes</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span><textarea rows="4" cols="50" class="form-control demo_notes" id="demo_notes" name="demo_notes" placeholder="Notes"> </textarea>
                                </div><span class="demo_notes1"></span>
                            </div>
                         </div> 
                         <div class="form-group">
                            <label class="col-md-4 control-label">Appointment Notes</label>
                            <div class="col-md-4 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span><textarea rows="4" cols="50" class="form-control ap_notes" id="ap_notes" name="ap_notes" placeholder="Notes"> </textarea>
                                </div><span class="ap_notes1"></span>
                            </div>
                         </div> 
                       </div>
                     </div>
                      </fieldset>
                 
                </td>
                <td></td>
              </tr>
              <tr>
                <td>
                  <div class=""><input type="submit" class="btn btn-primary" value="Save" name="ap_submit" onclick="return validate_data()">
                   
                  </div></td>
                  <td>
                    <div class="set_btn"><input type="reset" class="btn btn-danger" 
                      value="Reset" name="" ></div>
                     
                  </td>
              </tr>
            </tbody></table>  
          </form>
        </div>
        <div class="col-md-3">
              <div class="row"> 
              <div class="col-12">
                  <div id="map" ></div>
              </div>
        </div>

        </div>
            </div>
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQAfOY3OpWLwnkhhLlfhOPFVil7Br5PQ&amp;libraries=places"></script>
         <script src="assets/js/bootstrap-notify.js"></script>
  <script src="assets/js/bootstrap-notify.min.js"></script>
<script>
  google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var input = document.getElementById('ap_addr');
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
      document.getElementById('add_url').value=
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
var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";

 if(access)
 {
   $('#use_cal').hide(); 
 }
 
function check_authentication()
  {
    //alert('hi');
    var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";
// alert(access);
 if(access)
 {
   getcal_list();
   return false;
}
else {
  $('#accessModal1').modal('show');
  return false;
  }
}
  function validate_data(){
    var cal_id=$('#ap_cal_id').val();
   /* if(cal_id=='')
    {
      $('.ap_cal_id1').text("This field is required");

        $(".ap_cal_id1").css("color","red");
        $("#ap_cal_id").focus();
        return false;
    }*/
    var lead=$('#lead').val();
       if(lead=='')
    {
      $('.lead1').text("This field is required");

        $(".lead1").css("color","red");
        $("#lead").focus();
        return false;
    }
    var app_date=$('#ap_date').val();
      if(app_date=='')
    {
      $('.ap_date1').text("This field is required");

        $(".ap_date1").css("color","red");
        $("#ap_date").focus();
        return false;
    }
    var ap_stime=$('#ap_stime').val();
       if(ap_stime=='')
    {
      $('.ap_stime1').text("This field is required");

        $(".ap_stime1").css("color","red");
        $("#ap_stime").focus();
        return false;
    }
    var demo_dealer=$('#demo_dealer').val();
    if(demo_dealer=='')
    {
      $('.demo_dealer1').text("This field is required");

        $(".demo_dealer1").css("color","red");
        $("#demo_dealer").focus();
        return false;
    }
    return true;
  }

   $(document).ready(function()
  {
   
   $("#lead").on('change', function () {
    var val = this.value;
     var lead_dealer='';
    if($('#leads option').filter(function(){
        return this.value.toUpperCase() === val.toUpperCase();        
    }).length) {
        //send ajax request
           $.ajax({
        type: 'POST',

        url: "get_lead_data_appointment/"+this.value,
         async: false,
        datatype: 'JSON',
        success: function(data) {
          var record=$.parseJSON(data);
          var source="<option value='"+record[0].lead_source+"'>"+record[0].lead_source+"</option>";
          $("#ride").append(source);
          lead_dealer=record[0].lead_dealer;
		  var d="<option value='"+record[0].lead_dealer+"'>"+record[0].lead_dealer+"</option>";
          var lead=record[0].user_address;
		  $("#demo_dealer").val(lead_dealer);
		  $("#d_dealer").append(lead_dealer);
		  //$("#demo_dealer").
          $("#ap_addr").val(lead);
          document.getElementById('add_url').value=
      'https://maps.google.com/?q='+lead;
           var map='<iframe frameborder="0" width="370em" height="350em" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q='+lead+'&z=14&output=embed"></iframe>';
           $("#map").html(map);
          console.log(data);
        }
    });

          // console.log(lead_dealer);
           $.ajax({
                  type: 'POST',
                  url: "get_dealers_data/"+lead_dealer,
                  datatype:'JSON',
                  async: false,
                   success: function(data) {
                  var record=$.parseJSON(data);
                  var options='';
                 for(var i = 0; i < record.length; i++){
                options += '<option value="'+record[i].first_name+'">'+record[i].first_name+'</option>';
                }
                 console.log(options);
              document.getElementById('dealers').innerHTML = options;
              $("#dealers").html(options);
                  //console.log(data);
                }

           });

       // alert(this.value);
    }
  });
    // validations for appointment
    $(document).on('change','.ap_cal_id',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".ap_cal_id1").text("This field is required");
        $(".ap_cal_id1").css("color","red");
      }
      else
      {
        $(".ap_cal_id1").text("");
      }
    });
    $(document).on('change','.ap_date',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".ap_date1").text("This field is required");
        $(".ap_date1").css("color","red");
      }
      else
      {
        $(".ap_date1").text("");
      }
    });
    $(document).on('change','.ap_stime',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".ap_stime1").text("This field is required");
        $(".ap_stime1").css("color","red");
      }
      else
      {
        $(".ap_stime1").text("");
      }
    });
    $(document).on('change','.demo_dealer',function()
    {
       var v=$(this).val();
      if(v=='')
      {
        $(".demo_dealer1").text("This field is required");
        $(".demo_dealer1").css("color","red");
      }
      else
      {
        $(".demo_dealer1").text("");
      }
    });
  });

function getcal_list()
{
 //alert('hi');
 var xmlhttp = new XMLHttpRequest();
xmlhttp.open('GET', weblink+"getcal_list", false);
xmlhttp.send(null); 
str=xmlhttp.responseText;
str=str.replace(/^\s*([\S\s]*)\b\s*$/, '$1');
//alert(str);
var x=JSON.parse(str);
//console.log(x);
var b = str.search("success");
if(b != -1)
{
window.location.reload();
}else
{
  var op='<option value="--">Select</option>';
  for(var i=0;i<x.length;i++)
  {
    op+='<option value="'+x[i].id+'">'+x[i].id+'</option>';
  }
  $("#ap_cal_id").html(op);
}
 
}
var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";
// alert(access);
 if(access)
 {
  getcal_list();
 }
 function access_check()
 {    
   if(access)
 {
  getcal_list();
  
 }
 else
 {
  //alert('fa');
  $('#accessModal1').modal('show');
 }
 }
//getcal_list();
</script>