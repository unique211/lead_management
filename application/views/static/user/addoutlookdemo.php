 <!-- <style type="text/css">
   .checkmark {
   
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}
 </style> -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/src/tagcomplete.css">
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/tagcomplete.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery.tag-editor.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.filter.range.js"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

  <script src="<?php echo base_url() ?>assets/js/dt.js"></script>

<!--  <script src="assets/js/jquery.tag-editor.min.js"></script>
  <script src="assets/js/tagcomplete.js"></script> -->

	<script type="text/javascript">var weblink = "<?php echo base_url();?>";</script>
  

  <script src="<?php echo base_url() ?>assets/js/jquery.tag-editor.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/tagcomplete.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

 <div id="myModal" class=" modal fade" role="dialog">
   <form action="">
     <div class="modal-dialog ">
       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Are you Want Login On Outlook Login .</h4>
         </div>

         <div class="modal-footer">
           <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
           <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
           <a href="<?php echo base_url(); ?>googlecalendar/calender_event" style="display:none;" id="getcalenderdata" class="btn btn-primary"></a>

           <a href="<?php echo base_url(); ?>googlecalendar/outlook_login" id="contact-send-a" class="btn btn-primary"> YES</a>
           <button type="button" class="btn btn-danger" id="btn_no" data-dismiss="modal">NO</button>
         </div>
       </div>

     </div>
   </form>
 </div>
 <div id="myModal1" class=" modal fade" role="dialog">
   <form action="">
     <div class="modal-dialog ">
       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Appoiment Information</h4>
         </div>
         <div class="modal-body" id="modelbody">

         </div>

         <div class="modal-footer">
           <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
           <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
         
         </div>
       </div>

     </div>
   </form>
 </div>
 <div id="accessModal1" class=" modal fade " role="dialog">
   <form method="post" action="<?php echo base_url(); ?>googlecalendar/calender_create">
     <div class="modal-dialog ">
       <!-- Modal content-->
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Create New Event.</h4>
         </div>
         <div class="modal-body">
           <fieldset>

             <div class="col-md-12">
               <div class="form-group app_css">
                 <div class="row">
                   <label class="col-md-4 control-label">Calender Name</label>
                   <div class="col-md-6 inputGroupContainer">
                     <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                       <select id="calenderid" name="calenderid" class="form-control">
                         <option disabled>Select Calender</option>
                         <?php
                          if (isset($allCalendars)) {


                            foreach ($allCalendars as $cladata) {
                              if (($cladata->name == "Birthdays") || ($cladata->name == "India holidays") || ($cladata->name == "United holidays")) { } else {
                                echo "<option value='$cladata->id'>$cladata->name</option>";
                              }
                            }
                          }
                          ?>
                       </select>
                     </div><span class="demo_notes1"></span>
                   </div>
                   <div class="col-md-2">


                   </div>

                 </div>
                 <br>

                 <div class="row">
                   <label class="col-md-4 control-label">Subject</label>
                   <div class="col-md-6 inputGroupContainer">
                     <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span><input type="text" class="form-control" id="subject" name="subject" placeholder="subject">
                     </div><span class="demo_notes1"></span>
                   </div>


                 </div>
                 <br>

                 <div class="row">
                   <label class="col-md-4 control-label">Content</label>
                   <div class="col-md-6 inputGroupContainer">
                     <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span><textarea class="form-control" id="content" name="content" placeholder="content"> </textarea>
                     </div><span class="demo_notes1"></span>
                   </div>
                   <div class="col-md-2">


                   </div>

                 </div>
                 <br>

                 <div class="row">
                   <div class="form-group app_css">
                     <label class="col-md-4 control-label">Appointment Start Date</label>
                     <div class="col-md-4 inputGroupContainer">
                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="ap_date" name="ap_date" placeholder="" class="form-control ap_date" value="" type="date"></div>

                       <span class="ap_date1"></span>
                     </div>
                     <div class="input-group col-md-2"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input id="ap_stime" name="ap_stime" placeholder="" class="form-control ap_stime" value="" type="time"></div>
                   </div>
                 </div>
                 <br>


                 <div class="row">
                   <div class="form-group app_css">
                     <label class="col-md-4 control-label">Appointment End Date</label>
                     <div class="col-md-4 inputGroupContainer">
                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="ed_date" name="ed_date" placeholder="" class="form-control ap_date" value="" type="date"></div>

                       <span class="ap_date1"></span>
                     </div>
                     <div class="input-group col-md-2"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input id="ed_stime" name="ed_stime" placeholder="" class="form-control ap_stime" value="" type="time"></div>
                   </div>


                 </div>
               </div>








             </div>

           </fieldset>
         </div>

         <div class="modal-footer">
           <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
           <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
           <button type="submit" id="contact-send-a" class="btn btn-primary">Save</a>
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
       </div>

     </div>
   </form>
 </div>
 <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('app1'); ?>">

 <div class="container">
   <h3>Outlook Synced Appointments</h3>
   <div class="" align="right">
     <a href="<?php echo base_url(); ?>googlecalendar/outlook_login" id="btnnologin" style="display:none;" class="btn btn-info pull-right"> Login To Outlook</a>

     <!-- <button class="btn btn-primary pull-right" style="margin-bottom:5px;margin-right:5px;" id="createevent">Create Event</button> -->
   </div>


   <div class="col-md-12">
     <form class=" form-horizontal" method="post" action="<?php echo base_url(); ?>googlecalendar/outlook_login">


     </form>
     <br>



   </div>
   <!-- <div class="col-md-3">
              <div class="row"> 
              <div class="col-12">
                  <div id="map" ></div>
              </div>
        </div>

        </div> -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/core/main.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/daygrid/main.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/timegrid/main.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/list/main.css">
   <!-- <link rel="stylesheet" href="https://fullcalendar.io/js/fullcalendar-2.2.5/fullcalendar.css"> -->
   <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/outfullcalendar.css">
   <script src="<?php echo base_url() ?>assets/css/core/main.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/css/interaction/main.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/css/daygrid/main.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/css/timegrid/main.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/css/list/main.js" type="text/javascript"></script>
   <!-- <script src="https://fullcalendar.io/js/fullcalendar-2.2.5/lib/moment.min.js" type="text/javascript"></script>
   <script src="https://fullcalendar.io/js/fullcalendar-2.2.5/fullcalendar.min.js" type="text/javascript"></script> -->
   <script src="<?php echo base_url() ?>assets/js/outmoment.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url() ?>assets/js/outfullcalendar.min.js" type="text/javascript"></script>
   

   <style>
     textarea {
       resize: none;
     }

     html,
     body {
       overflow: hidden;
       /* don't do scrollbars */
       font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
       font-size: 14px;
     }



     .fc-header-toolbar {
       /*
                                                    the calendar will be butting up against the edges,
                                                    but let's scoot in the header's buttons
                                                    */
       padding-top: 2em;
       padding-left: 2em;
       padding-right: 2em;

     }

     .fc-day-grid-container.fc-scroller {
       height: auto !important;
       overflow-y: auto;
     }

     .pending {
       box-shadow: 0px 0px 10px #1300ff;

     }
   </style>
   <div class="col-md-12">
     <div class="row">

       <div class="col-lg-3">
         <button class="btn" style="background-color:#FF0000;"></button>Rescheduled Appoiment
       </div>
       <div class="col-lg-3">
         <button class="btn" style="background-color:#2a9df4;"></button>Appoiment
       </div>
     </div>
   </div>
   <div class="col-md-12">

     <div id='calendar'></div>
   </div>
 </div>
 
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQAfOY3OpWLwnkhhLlfhOPFVil7Br5PQ&amp;libraries=places"></script>
 <script src="assets/js/bootstrap-notify.js"></script>
 <script src="assets/js/bootstrap-notify.min.js"></script>
 
 <script>
   var calenderdata = <?php echo json_encode($calendardata); ?>;

   console.log(calenderdata);
   //  alert(calenderdata);
 </script>
 <script>
   google.maps.event.addDomListener(window, 'load', initialize);

   function initialize() {
     var input = document.getElementById('ap_addr');
     var autocomplete = new google.maps.places.Autocomplete(input);
     autocomplete.addListener('place_changed', function() {
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
       document.getElementById('add_url').value =
         'https://maps.google.com/?q=' + place;
       //alert(url);
       // url=place.url;
       /* $('#add_url').val(url);https://maps.google.com/?q=tirupati
        alert(place_url);*/
       //url=pl
       var map = '<iframe frameborder="0" width="370em" height="350em" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' + place + '&z=14&output=embed"></iframe>';
       $("#map").html(map);

     });
   }
   var x = document.getElementById('alert_msg').value;
   if (x != '') {
     show_notify(x);
   }

   function show_notify(x) {
     $.notify({
       title: '',
       message: '<strong>Data saved successfully</strong>'
     }, {
       type: 'success'
     });
   }
   var access = "<?php echo $this->session->userdata('is_authenticate_user'); ?>";

   if (access) {
     $('#use_cal').hide();
   }

   function check_authentication() {
     //alert('hi');
     var access = "<?php echo $this->session->userdata('is_authenticate_user'); ?>";
     // alert(access);
     if (access) {
       getcal_list();
       return false;
     } else {
       $('#accessModal1').modal('show');
       return false;
     }
   }

   function validate_data() {
     var cal_id = $('#ap_cal_id').val();
     /* if(cal_id=='')
      {
        $('.ap_cal_id1').text("This field is required");

          $(".ap_cal_id1").css("color","red");
          $("#ap_cal_id").focus();
          return false;
      }*/
     var lead = $('#lead').val();
     if (lead == '') {
       $('.lead1').text("This field is required");

       $(".lead1").css("color", "red");
       $("#lead").focus();
       return false;
     }
     var app_date = $('#ap_date').val();
     if (app_date == '') {
       $('.ap_date1').text("This field is required");

       $(".ap_date1").css("color", "red");
       $("#ap_date").focus();
       return false;
     }
     var ap_stime = $('#ap_stime').val();
     if (ap_stime == '') {
       $('.ap_stime1').text("This field is required");

       $(".ap_stime1").css("color", "red");
       $("#ap_stime").focus();
       return false;
     }
     var demo_dealer = $('#demo_dealer').val();
     if (demo_dealer == '') {
       $('.demo_dealer1').text("This field is required");

       $(".demo_dealer1").css("color", "red");
       $("#demo_dealer").focus();
       return false;
     }
     return true;
   }

   $(document).ready(function() {

     $("#lead").on('change', function() {
       var val = this.value;
       var lead_dealer = '';
       if ($('#leads option').filter(function() {
           return this.value.toUpperCase() === val.toUpperCase();
         }).length) {
         //send ajax request
         $.ajax({
           type: 'POST',

           url: "get_lead_data_appointment/" + this.value,
           async: false,
           datatype: 'JSON',
           success: function(data) {
             var record = $.parseJSON(data);
             var source = "<option value='" + record[0].lead_source + "'>" + record[0].lead_source + "</option>";
             $("#ride").append(source);
             lead_dealer = record[0].lead_dealer;
             var d = "<option value='" + record[0].lead_dealer + "'>" + record[0].lead_dealer + "</option>";
             var lead = record[0].user_address;
             $("#demo_dealer").val(lead_dealer);
             $("#d_dealer").append(lead_dealer);
             //$("#demo_dealer").
             $("#ap_addr").val(lead);
             document.getElementById('add_url').value =
               'https://maps.google.com/?q=' + lead;
             var map = '<iframe frameborder="0" width="370em" height="350em" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' + lead + '&z=14&output=embed"></iframe>';
             $("#map").html(map);
             console.log(data);
           }
         });

         // console.log(lead_dealer);
         $.ajax({
           type: 'POST',
           url: "get_dealers_data/" + lead_dealer,
           datatype: 'JSON',
           async: false,
           success: function(data) {
             var record = $.parseJSON(data);
             var options = '';
             for (var i = 0; i < record.length; i++) {
               options += '<option value="' + record[i].first_name + '">' + record[i].first_name + '</option>';
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
     $(document).on('change', '.ap_cal_id', function() {
       var v = $(this).val();
       if (v == '') {
         $(".ap_cal_id1").text("This field is required");
         $(".ap_cal_id1").css("color", "red");
       } else {
         $(".ap_cal_id1").text("");
       }
     });
     $(document).on('change', '.ap_date', function() {
       var v = $(this).val();
       if (v == '') {
         $(".ap_date1").text("This field is required");
         $(".ap_date1").css("color", "red");
       } else {
         $(".ap_date1").text("");
       }
     });
     $(document).on('change', '.ap_stime', function() {
       var v = $(this).val();
       if (v == '') {
         $(".ap_stime1").text("This field is required");
         $(".ap_stime1").css("color", "red");
       } else {
         $(".ap_stime1").text("");
       }
     });
     $(document).on('change', '.demo_dealer', function() {
       var v = $(this).val();
       if (v == '') {
         $(".demo_dealer1").text("This field is required");
         $(".demo_dealer1").css("color", "red");
       } else {
         $(".demo_dealer1").text("");
       }
     });
   });

   function getcal_list() {
     //alert('hi');
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.open('GET', weblink + "getcal_list", false);
     xmlhttp.send(null);
     str = xmlhttp.responseText;
     str = str.replace(/^\s*([\S\s]*)\b\s*$/, '$1');
     //alert(str);
     var x = JSON.parse(str);
     //console.log(x);
     var b = str.search("success");
     if (b != -1) {
       window.location.reload();
     } else {
       var op = '<option value="--">Select</option>';
       for (var i = 0; i < x.length; i++) {
         op += '<option value="' + x[i].id + '">' + x[i].id + '</option>';
       }
       $("#ap_cal_id").html(op);
     }

   }
   var access = "<?php echo $this->session->userdata('is_authenticate_user'); ?>";
   // alert(access);
   if (access) {
     getcal_list();
   }

   function access_check() {
     if (access) {
       getcal_list();

     } else {
       //alert('fa');
       $('#accessModal1').modal('show');
     }
   }
   //getcal_list();
   var base_url = "<?php echo base_url(); ?>";

   var today = new Date();
   var dd = today.getDate();

   var mm = today.getMonth() + 1;
   var yyyy = today.getFullYear();
   if (dd < 10) {
     dd = '0' + dd;
   }

   if (mm < 10) {
     mm = '0' + mm;
   }
   today = yyyy + '-' + mm + '-' + dd;

   $('#ap_date').val(today);

   $("#ap_date").on('change', function() {
       var date1=$(this).val();
       $('#ed_date').attr('min', date1);

   });

   var dt = new Date();
   var time = dt.getHours() + ":" + dt.getMinutes();
   $('#ap_stime').val(time);
   $('#ed_stime').val(time);
   var flagdata = "<?php echo $flag; ?>";
   $(document).ready(function() {
     if (flagdata == 1) {
       $('#myModal').modal('show');
       $('#accessModal1').modal('hide');
     }




     $(document).on('click', '#createevent', function(e) {
       e.preventDefault();
       $('#myModal').modal('hide');
       $('#accessModal1').modal('show');

     });
     $(document).on('click', '#btn_no', function(e) {
       e.preventDefault();

       $('#btnnologin').show();

       $.ajax({
         type: "POST",
         url: base_url + "Outlookcontroller/getoutlookdata",
         data: {

         },
         dataType: "JSON",
         async: false,
         success: function(data) {
           obj = JSON.stringify(data);
           console.log(obj);


          //  var calendarEl = document.getElementById('calendar');
          //  var calendar = new FullCalendar.Calendar(calendarEl, {
          //   id: 'calendar',
          //    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
          //    height: 'parent',
          //    header: {
          //      left: 'prev,next today',
          //      center: 'title',
          //      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
          //    },
          //    defaultView: 'dayGridMonth',
          //    defaultDate: today,
          //    navLinks: true, // can click day/week names to navigate views
          //    editable: true,

          //    eventLimit: true, // allow "more" link when too many events
          //    views: {
          //      month: {
          //        eventLimit: 4
          //      }
          //    },
          //    eventClick: function(event, jsEvent, view) {
          //     alert(event.start);
          //   },
          //    events: JSON.parse(obj),
             

          //  });
          //  var event = calendar.getEventById(obj['id']);
          //  calendar.render();

          $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: today,
			defaultView: 'month',
			editable: true,
      events: JSON.parse(obj),
      eventClick: function(event, jsEvent, view) {
       var eventid=event.id;

       $.ajax({
         type: "POST",
         url: base_url + "Outlookcontroller/geteventinfo",
         data: {
          eventid:eventid,
         },
         dataType: "JSON",
         async: false,
         success: function(data) {
           
           if(data.length>0){
             $('#myModal1').modal('show');
             $('#modelbody').html('');

             var html='<div class="col-md-12">'+
                  '<div class="row">'+
                   '<label class="col-md-4 control-label">Subject</label>'+
                   '<label class="col-md-6 control-label">'+data[0].appointment_notes+'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">Notes</label>'+
                   '<label class="col-md-6 control-label">'+data[0].appointment_notes+'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">Strat Date- Time:</label>'+
                   '<label class="col-md-6 control-label">'+data[0].start_date+" "+data[0].start_time +'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">End Date- Time:</label>'+
                   '<label class="col-md-6 control-label">'+data[0].end_date+" "+data[0].end_time +'</label>'+
                '</div>';
                if(data[0].resudeal_date !="" && data[0].reschedultime !="" )
                html+=   '<div class="row">'+
                   '<label class="col-md-4 control-label">Resechudel Date:</label>'+
                   '<label class="col-md-6 control-label">'+data[0].resudeal_date+" "+data[0].reschedultime +'</label>'+
                '</div>'+
                    '</div>';
                    $('#modelbody').append(html);

           }
         }
       });
      },
		});
		
           

           // var html="";
           // for (i = 0; i < data.length; i++) {
           //     var sr = i + 1;
           //     var status = "";
           //     var date = "";

           //     html += '<tr>' +
           //        // '<td id="id_' + data[i].id + '">' + sr + '</td>' +
           //        // '<td id="name_' + data[i].id + '">' + data[i].event_id + '</td>' +
           //         '<td id="name_' + data[i].id + '">' + data[i].subname + '</td>' +
           //        // '<td id="name_' + data[i].id + '">' + data[i].content + '</td>' +
           //         '<td id="name_' + data[i].id + '">' + data[i].startdate+" "+data[i].strattime + '</td>' +
           //         '<td id="name_' + data[i].id + '">' + data[i].enddate+" "+data[i].endtime +  '</td>' +
           //         //'<td><button  class="edit_data btn btn-sm  btn-xs  btn-primary" id="' + data[i].id + '" value="' + data[i].id + '" ><i class="fa fa-edit"></i></button></td>' +
           //         '</tr>';

           // }
           // $('#tbl_master').html(html);
         }
       });

     });

     if (calenderdata != "") {
      
       obj = JSON.stringify(calenderdata);
      //  console.log(obj);
      //  var calendarEl = document.getElementById('calendar');
      //  var calendar = new FullCalendar.Calendar(calendarEl, {
      //    plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
      //    height: 'parent',
      //    header: {
      //      left: 'prev,next today',
      //      center: 'title',
      //      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      //    },
      //    defaultView: 'dayGridMonth',
      //    defaultDate: today,
      //    navLinks: true, // can click day/week names to navigate views
      //    editable: true,

      //    eventLimit: true, // allow "more" link when too many events
      //    views: {
      //      month: {
      //        eventLimit: 4
      //      }
      //    },
      //  events: JSON.parse(obj),
    
       
      //  });
       
       
      
      //  calendar.render();
      $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: today,
			defaultView: 'month',
			editable: true,
      events: JSON.parse(obj),
      eventClick: function(event, jsEvent, view) {
       var eventid=event.id;

       $.ajax({
         type: "POST",
         url: base_url + "googlecalendar/check_get_eventinfo",
         data: {
          eventid:eventid,
         },
         dataType: "JSON",
         async: false,
         success: function(data) {
           
           if(data.length>0){
             $('#myModal1').modal('show');
             $('#modelbody').html('');

             var html='<div class="col-md-12">'+
                  '<div class="row">'+
                   '<label class="col-md-4 control-label">Subject</label>'+
                   '<label class="col-md-6 control-label">'+data[0].title+'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">Notes</label>'+
                   '<label class="col-md-6 control-label">'+data[0].content+'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">Strat Date- Time:</label>'+
                   '<label class="col-md-6 control-label">'+data[0].start+'</label>'+


                 '</div>'+
                 '<div class="row">'+
                   '<label class="col-md-4 control-label">End Date- Time:</label>'+
                   '<label class="col-md-6 control-label">'+data[0].end+'</label>'+
                '</div>';
               
                    '</div>';
                    $('#modelbody').append(html);

           }
         }
       });
      },
		});
       
     }
    
     



   });
 </script>