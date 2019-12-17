<div id="myModal" class=" modal fade " role="dialog">
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
 <!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2>List of Appointments in Google Calendar</h2>
      </div>
     <!--  <div class="pb-2 mt-4 mb-2 border-bottom"> -->
    <!--     <a href="javascript:void(0);" data-toggle="modal" data-target="#gc-create-event" data-year="<?php print date('Y', time()); ?>" rel="noopener noreferrer" data-month="<?php print date('m', time()); ?>" data-days="<?php print date('d', time()); ?>"  class="add-gc-event btn btn-sm btn-primary">Create Event</a> -->
<!--         <a href="<?php print site_url();?>googlecalendar/logout" class="add-gc-event btn btn-sm btn-danger">Logout</a> -->
    <!--   </div> -->
      <span id="success-msg"></span> 
      <div class="col-md-3"></div>
      <div class="col-md-3"><label>Calendar :</label><select id="show_cal" name="show_cal" class="form-control" onchange="getcalendar(this.value)">
        </select> </div>
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
 
       $(window).load(function(){        
   $('#myModal').modal('show');
    }); 
  
 </script>   
<script type="text/javascript">

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
  $("#show_cal").append(op);
}
 
}

getcal_list();
</script>


