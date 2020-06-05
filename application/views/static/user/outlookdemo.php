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
        <h4 class="modal-title">Are you Want Login On Outlook Login  .</h4>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
     <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
         <a href="<?php echo base_url(); ?>googlecalendar/outlook_login" id="contact-send-a" class="btn btn-primary"> YES</a>
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
      <form class=" form-horizontal" method="post" action="<?php echo base_url(); ?>googlecalendar/outlook_login">
      <table class="table table-striped">
          <tbody>
             <tr>
                <td colspan="1">
                   
                      <fieldset>
                        
                      </fieldset>
                 
                </td>
                <td></td>
              </tr>
              <tr>
                <td>
                  <div class=""><input type="submit"  class="btn btn-primary" value="Out Look Login" name="ap_submit">
                   
                  </div></td>
                  <td>
                    
                     
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

   $(document).ready(function()
  {
    
    $('#myModal').modal('show');

   
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
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
    $(document).on('click', '#btnsave', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "googlecalendar/outlook_login",
            data: {
               
            },
            dataType: "JSON",
            async: false,
            success: function(data) {
                console.log(data);
            }
        });

    });

});
</script>
