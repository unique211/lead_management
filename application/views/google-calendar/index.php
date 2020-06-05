<!-- google access model -->

<div id="myModal" class=" modal fade " role="dialog">
  <form action="">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Would You Like To View Your Google Calendar Appointments?</h4>
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
 <!-- container --> 
  <section class="showcase">
    <div class="container">
         <div class="row">
      <div class="pb-2 mt-4 mb-2 border-bottom col-md-6">
        <h2> <span id='msg'> </span></h2>
      </div>
      <div class="col-md-1" style="margin-top: 2em"><label style="display: none" id="cal-l">Calendar :</label></div>
      <div class="pb-2 mt-4 mb-2 border-bottom col-md-3" style="margin-top: 1.6em">
        <div class="cal_id"> <select id="show_cal" name="show_cal" class="form-control"  onchange="getcalendar(this.value)">
        </select></div>
         
            <div  class="col-md-1">
         <button class="btn btn-primary"   id="link" data-toggle='modal' data-target='#myModal' style="display: none">Google Appointments</button>
        </div><div  class="col-md-1 pull-right" >
         <button  class="btn btn-info  " type="submit" form="manageappement"  id="link">Manage Appointment</button>
          
        </div>
        </div>
      <form action="<?php echo base_url() ?>manage_appointment" id="manageappement" name="manageappement"></form>
      <div></div>
    </div>
    <!--   <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2>List of Appointments in <span id='msg'> </span> </h2><div align="right">
        
        <button class="btn btn-primary"  id="link" data-toggle='modal' data-target='#myModal'>Link Google</button>
      </div>
      </div> -->
      
     <!--  <div class="pb-2 mt-4 mb-2 border-bottom"> -->
    <!--     <a href="javascript:void(0);" data-toggle="modal" data-target="#gc-create-event" data-year="<?php print date('Y', time()); ?>" rel="noopener noreferrer" data-month="<?php print date('m', time()); ?>" data-days="<?php print date('d', time()); ?>"  class="add-gc-event btn btn-sm btn-primary">Create Event</a> -->
<!--         <a href="<?php print site_url();?>googlecalendar/logout" class="add-gc-event btn btn-sm btn-danger">Logout</a> -->
    <!--   </div> -->
      <span id="success-msg"></span> 
      <div class="col-md-3"></div>
      <div class="col-md-3">
       <!--  <div id='cal_id'><label>Calendar :</label><select id="show_cal" name="show_cal" class="form-control" onchange="getcalendar(this.value)">
        </select></div> --> </div>
            <br><br>
            <br><br>
      <div id="event-calendar">     
       
  <!--    <div class="text-center"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div> -->

 
   </div>
    
    </div>
  </section>

<?php $this->load->view('google-calendar/popup/event');?>   
<?php $this->load->view('google-calendar/popup/create');?>   
<!--  <?php $this->load->view('templates/footer');?>  -->  
 <script type="text/javascript">
 var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";
 //alert(access);
 if(access)
 {
 getcal_list();
  $(window).load(function(){        
   $('#myModal').modal('hide');
    $('.cal_id').show();
    $('#cal-l').show();
     $('#link').hide();
    });
  
   $('#msg').text('List of Syncronized Appointments');
 }
 else { $(window).load(function(){        
   $('#myModal').modal('show');
   $('.cal_id').hide();
   $('#link').show();
   $('#msg').text('List of Unsyncronized Appointments');
    });}
       
   function getcal_list()
{
 var xmlhttp = new XMLHttpRequest();
xmlhttp.open('GET', weblink+"getcal_list", false);
xmlhttp.send(null); 
str=xmlhttp.responseText;
str=str.replace(/^\s*([\S\s]*)\b\s*$/, '$1');
//alert(str);
var x=JSON.parse(str);

/*console.log(x);*/
var b = str.search("success");
if(b != -1)
{
window.location.reload();
}else
{
  var op='';
  for(var i=0;i<x.length;i++)
  {
    op+='<option value="'+x[i].id+'">'+x[i].id+'</option>';
  }
  $("#show_cal").html(op);
} 
}

 </script>   
<script type="text/javascript">
  function getcalendar(cal_id)
  {
   
     jQuery.ajax({
          url: baseurl + 'googlecalendar/getCalendar/'+cal_id,
          dataType: 'html',
          beforeSend: function () {
              $('#event-calendar').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
          },
          complete: function () {
              jQuery('[data-caltoggle="tooltip"]').tooltip();
          },
          success: function (html) {
            console.log(html);
              jQuery('#event-calendar').html(html);
              
          },
          error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
 
  }
 

</script>



