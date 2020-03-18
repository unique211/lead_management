<link rel="stylesheet" href="<?php echo base_url(); ?>assets/multiselect/bootstrap-multiselect.css" type="text/css">

  <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('app'); ?>">  
<div id="accessModal" class=" modal fade " role="dialog">
  <form action="">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">To Synchronize You Need To Login With Google.</h4>
      </div>

      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
     <!--     <input type="submit" class="btn btn-primary" name="submit"
         value="YES"> -->
         <a href="appointment_login" id="contact-send-a" class="btn btn-primary"> YES</a>
         <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
      </div>
    </div>

  </div></form>
</div>
<div class="container">
  <div class="row">
    <div class="row">
      <div class="col-md-8">
         <h2>Appointments Information</h2>
      </div>
      <div class="col-md-2">
        <div ></div>
         <!-- <select class="form-control" style="margin-top: 2em;"> 
           <option>--select--</option>
           <option>s1</option>
           <option>s2</option>
         </select> -->
      </div>
      <div class="col-md-1">
        <button  class="btn btn-primary" style="margin-top: 2em;" onclick='check_authentication()'>Synchronize</button>
      </div>
      <div class="col-md-1">
      <button  type="submit" form="manageappement" class="btn btn-info" style="margin-top: 2em;margin-left:5px;">Book Appointment</button>
      </div>
      <form action="<?php echo base_url() ?>appointment" id="manageappement" name="manageappement"></form>
    </div>
   <br>
     <form action="filter_appointments" method="POST">
    <div class="row">
   
        <div class="col-md-4"><label>Form</label><input type="date" class="form-control" name="min" id="min" required></div>
        <div class="col-md-4"><label>To</label><input type="date" class="form-control" name="max" id="max" required></div>
        <div class="col-md-4"><input type="submit" name="filter_submit" class="btn btn-primary lead_filter_btn" value="Search" ></div>
     
    </div>
    </form>
    <table class="table table-striped" id="appointments_data">
      <thead>
      <tr>
        <th><input type="checkbox" id="masterCheckbox"></th>
        <th>Serial No</th>
        <th>Customer name</th>
    <!--    <th>User Id</th> -->
        <th>Appointment Date</th>
        <?php if( $this->session->userdata('user_type') !="SalesRepresentative"){ ?>
        <th>Sales Representative</th>
        <?php }?>
        <th>Appointment Address</th>
        <!-- <th>Gift</th> change by sagar-->
        <th>Cal Status</th>

        <th>Action</th>
        <th></th>
        <!-- <th>Synchronize</th> -->
      </tr>
      </thead>
      <tbody>
      <?php 
      $s=1;

      foreach ($records as $row)
      {
        /*print_r($records);
        exit();*/
        echo "<tr>";
         if($row['synchronize']=='local')
        {
            echo "<td><input type='checkbox' id='checkItem' class='single-checkbox' name='checkItem' value='".$row['id']."'></td>";
        }else
        {
          echo "<td></td>";

        }
       
        echo "<td>".$s++."</td>";
       

        echo "<td>".$row['lead_id']."</td>";
      /*  echo "<td>".$row['user_id']."</td>";*/
        echo "<td>".$row['start_date']."</td>";
        if( $this->session->userdata('user_type') !="SalesRepresentative"){
        echo "<td>".$row['demo_dealer']."</td>";
        }
        echo "<td>".$row['appointment_address']."</td>";
        // echo "<td>".$row['gift']."</td>"; change by sagar
        
        if($row['synchronize']=='google')
        {
            echo "<td>".'Sync'.' '.'('.$row['calendar_id'].')'."</td>";
        }
        else
        {
          echo "<td>".$row['synchronize']."</td>";

        }
       /* echo "<td>".if('synchronize'=='local'){$row['synchronize']}
        else{$row['synchronize'].'/'.$row['calendar_id  ']
        }."</td>";*/

        if(in_array('editAppointment', $user_permission)){
        echo "<td><a href='' class='edit_icon_style_app' data-toggle='modal' data-target='#myModal' id='".$row['id']."' onclick='getrecord(this.id)'><i class='glyphicon glyphicon-pencil'></i></a></td>";
      }
      if(in_array('deleteAppointment', $user_permission)){
          echo "<td><a class='del_icon_style_app' href='' data-toggle='modal' data-target='#myModal1'  id='".$row['id']."'  onclick='deleterecord(this.id)' ><i class='glyphicon glyphicon-trash'></i></a></td>";
          }
          /*if($row['synchronize']=='local')
        {
          echo '<td><button  class="btn btn-primary" style="margin-top: 2em;margin-left: 5em" onclick="check_authentication_id(this.id)" id="'.$row['id'].'">Sync</button></td>';
        }
        else{
          echo '<td></td>';
        }*/
        echo "</tr>";
        }
        
        ?>
        
        </tbody>
    </table>
  </div>
  <!-- calendar modal -->
<div id="calModal" class=" modal fade " role="dialog">

  <div class="modal-dialog ">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Calendar</h4>
      </div>
      <span id='cal_error'></span>
             <form action="sync_appointment" method="POST">
    <input type="hidden" name="ap_ids" id='ap_ids'>
   
    <input type="hidden" name="page" value="manage">
        <div class="modal-body" >

          <div id="show_calendar">
            
            <label> Calendar :</label><select onchange="change_cal_id()" id="cal_id1" name="show_cal" class="form-control" >
              <option value="--" >--select--</option>
        </select>
          </div>
        </div>
      <div class="modal-footer">
      <input type="submit" name="ap_submit" class="btn btn-primary"  onclick=" return sync_appointments()" >
         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div></form>
    </div>

  </div>
</div>
<!-- admin modal -->
<div id="adminModal" class=" modal fade " role="dialog">

  <div class="modal-dialog ">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Users</h4>
      </div>
     
             <form action="attendees" method="POST" onsubmit="return check_users()">
   
        <div class="modal-body" >
         <input type="hidden" name="list" id="list" >
         <input type="hidden" name="appointment_id" id="appointment_id">
         <input type="hidden" name="page" value="manage1">
          <span id='user_error'></span>
          <div id="show_calendar">
            <table class="table">
              <thead>
                <tr>
                <th colspan=""><input type="checkbox" id="users_list" ></th>
                <th>User</th>
              </tr>
            </thead>
            <tbody>
              
                <?php foreach ($users as $key) {
                ?>
                <tr>
                <td><input type='checkbox' id='users' class='single-checkbox1' name='users' value="<?php echo $key['google_calendar_id']; ?>"></td>
                <td><label></label><?php echo $key['user_name']; ?></label></td>
                </tr>
              <?php } ?>              
            </tbody>
            </table>      
          </div>
        </div>
      <div class="modal-footer">
      <input type="submit" name="ap_submit" class="btn btn-primary">
         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div></form>
    </div>

  </div>
</div>
<div id="myModal1" class=" modal fade " role="dialog">

  <div class="modal-dialog ">
    
    <div class="modal-content">
      <!-- <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div> -->
      <span id='cal_error'></span>
             
    <input type="hidden" name="del_id" id='del_id'>
 
        <div class="modal-body" >

          <h5>Are You Sure You Want To Delete</h5>
             <button type="button" class="close" style="margin-top: -1.5em;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="delete_app()">OK</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- calendar modal end -->
<!-- Delete modal -->
<!-- <div id="modal1" class="modal fade" role="dialog">

  <div class="modal-dialog ">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <span id='cal_error'></span>
             
    <input type="hidden" name="del_id" id='del_id'>
 
        <div class="modal-body" >

          <h3>Are You Sure You Want To Delete</h3>
        </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="delete_app()">OK</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div>
    </div>

  </div>
</div> -->



   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update Appointment Deatails</h3>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -1.5em;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:350%">
     <form action="edit_appointment_details" method="POST">
      <input type="hidden" name="c_id" id="c_id">
         <input type="hidden" name="app_id" id="app_id"> 
         <input type="hidden" name="event_id" id="event_id">
         <input type="hidden" name="empid" id='empid' value="">
         <input type="hidden" name="attendees" id="attendees">
         <div class="row">
         <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Calendar:</label>
            <select class="form-control cal_id" id="cal_id" name="cal_id">                    
                            </select>
            
          </div>
          </div>
          <div class="col-md-6"></div>
         </div>
        <div class="row">
          
          <div class="col-md-6">
                    
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Appointment Date:</label>
            <input type="date" class="form-control " id="app_date" name="app_date" readonly>

          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Time:</label>
            <input type="time" class="form-control " id="app_time" name="app_time" readonly>
            
          </div>
          <!-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Gift:</label>
            <select class="form-control gift" id="gift" 
            name="gift">   
                            </select>
            
          </div> -->
          
           

          </div>

          <div class="col-md-6">
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Re-scheduling Date:</label>
            <input type="date" class="form-control " id="reschedulingdate" name="reschedulingdate">

          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Re-scheduling Time:</label>
            <input type="time" class="form-control " id="reschedulingtime" name="reschedulingtime">
            
          </div>
       
          <!-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Assistant:</label>
            <input type="text" class="form-control" id="assistant" 
            name="assistant" maxlength="20">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Supervisor:</label>
            <input type="text" class="form-control" id="supervisor" 
            name="supervisor" maxlength="20">
          </div> -->
          
          
          
          <!-- <div class="form-group" id="">
            <label for="recipient-name" class="col-form-label">Demo/Sale Notes:</label>
          
            <textarea class="form-control" id="demo_note" 
            name="demo_note"></textarea>
                  

          </div> -->

          </div>
          
        </div>
        <div class="row">
        
          <div class="col-md-12">
          <div class="form-group" id="">
          <label for="recipient-name" class="col-form-label">Reschedule Detalis:</label>
        </div>
          <hr>
                  <table class="table table-striped" id="reschediledetalis">
                    <thead>
                      <tr>
                        <th>Reschedule Date</th>
                        <th>Reschedule Time</th>
                        <!-- <th>User</th> -->
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody id="rescheduletb_tbody"></tbody>
                  </table>

          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
          <div class="form-group" id="custom-search-input">
            <label for="recipient-name" class="col-form-label">Order Status:</label>
          <select class="form-control status" id="status" name="status">
                              <!-- <option value="">Select</option>
                              <option value="Pending">Pending</option>
                              <option value="Rescheduled">Rescheduled</option>
                              <option value="Demo">Demo</option>
                              <option value="Cancelled">Cancelled</option>
                              <option value="Sale">Sale</option> -->
                                 <option value="">Select</option>
                              <option value="Pre-sales">Pre-sales</option>
                              <option value="Identified">Identified</option>
                              <option value="Quoted">Quoted</option>
                              <option value="Qualified">Qualified</option>
                              <option value="Negotiation">Negotiation</option>
                              <option value="OrderWon"> Order Won</option>
                              <option value="OrderLost">Order Lost</option>
                              <option value="OpportunityDropped">Opportunity Dropped</option>
                            </select>

          </div>
         
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Ride Along:</label>
            <!-- <input type="text" class="form-control" id="ride" 
            name="ride" maxlength="20"> -->
            <select id="ride" multiple name="ride[]" class="form-control ride">
                                  <!-- <option value="">Select</option> -->
                                  <?php  foreach ($leads as $key => $value) {
                               ?>
                               <option value="<?php echo $value['first_name']; ?>"><?php echo $value['first_name']; ?></option>
                               <?php
                              } ?>
                                </select>
          </div>
          <!-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Set By:</label>
            <input type="text" class="form-control" id="set" 
            name="set" maxlength="20">
          </div> -->
         
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sales Representative:</label>
            <input type="text" class="form-control" id="demo_dealer" 
            name="demo_dealer" maxlength="20">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Select Account:</label>
            <input type="text" class="form-control" id="lead" 
            name="lead" maxlength="20">
          </div>
          
          
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group" id="custom-search-input">
            <label for="recipient-name" class="col-form-label"> Address:</label>
          
            <textarea type="text" class="form-control" style="resize: none;" id="app_addr" 
            name="app_addr"></textarea>
                    <input type="hidden" name="lat">
                    <input type="hidden" name="long">

          </div>
          </div>
        </div>
        <div class="row">
          <hr>
          <div class="col-md-12">
              <div class="form-group" id="">
            <label for="recipient-name" class="col-form-label">Appointment Notes Detalis:</label>
          
            <textarea class="form-control" id="note" 
            name="note" style="resize: none;"></textarea>
            <div class="form-group" id="">
            
                  

          </div>

          </div>
          </div>
          <div class="col-md-1">
            <br>
            <br>
          <!-- <button type="button" id="add_btnnotes" class="btn btn-primary"><span class="fa fa-plus"></span></button> -->
        </div>

          </div>
          <div class="row">
          <div class="col-md-12">
                  <table class="table table-striped" id="salesnotes">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Demo Sale Notes</th>
                        <th>User</th>
                        <!-- <th>Action</th> -->
                      </tr>
                    </thead>
                    <tbody id="ac_notes_tbody"></tbody>
                  </table>

          </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="save_update" id="save_update" value="">
          <input type="submit" class="btn btn-primary" name="app_update"
         value="Update">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       
        
      </div>
        </form>
      
      </div>
      
    </div>
  </div>
</div>
</div>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQAfOY3OpWLwnkhhLlfhOPFVil7Br5PQ&amp;libraries=places"></script>
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

   google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
      var input = document.getElementById('app_addr');
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      // place variable will have all the information you are looking for.
      $('#lat').val(place.geometry['location'].lat());
      $('#long').val(place.geometry['location'].lng());
    });
  }
</script>
<script>

  var editid='';
  function check_users()
  {
   // alert('hi');
    var checked = $("input[type=checkbox][name='users']:checked").length;
  
   if(checked>0)
   {
     var list=[];
      $.each($("input[name='users']:checked"), function(){

        list.push($(this).val());
                       
        });
          var x=Object.assign({}, list);
          var ids1=JSON.stringify(Object.assign({}, list));
              $("#list").val(ids1);
           var id=[];
           var att_ids='';
              $.each($("input[name='checkItem']:checked"), function(){
                      id.push($(this).val());  
                      att_ids+=$(this).val()+',';                     
                    });
              var x=Object.assign({}, id);
              var ids=JSON.stringify(Object.assign({}, id));
              $("#appointment_id").val(ids);
    return true;
   }else{
         $("#user_error").text("Please Select Calendar");
         $("#user_error").css("color","red");
          $("#users").focus();
          
          return false;

   }
   /* console.log('users');
        var checked = $("input[type=checkbox][name='users']:checked").length;
       
        if (checked > 0) {
          
            var list=[];
              $.each($("input[name='users']:checked"), function(){

                      list.push($(this).val());
                       
                    });
           
              var x=Object.assign({}, list);
             
              var ids=JSON.stringify(Object.assign({}, list));
              console.log(ids);
              $("#list").val(ids);
              return true;
        }else{
          return false;
        
           $.notify({
              title: '',
              message: 'Please Select checkbox'
            },{
              type: 'danger'
            });
           
        }*/
  }
  function change_cal_id()
  {
      var cal= $("#cal_id1").val();
    if(cal!='')
    {
      $("#cal_error").text("");
     
    }
  }
  function sync_appointments()
  {
    var cal= $("#cal_id1").val();
    if(cal=='--')
    {
      $("#cal_error").text("Please Select Calendar");
     $("#cal_error").css("color","red");
      $("#cal_id1").focus();
      return false
    }
    //if(cal)
             var id=[];
              $.each($("input[name='checkItem']:checked"), function(){

                      id.push($(this).val());
                       
                    });
           
              var x=Object.assign({}, id);
             // console.log(x);
              var ids=JSON.stringify(Object.assign({}, id));
             // console.log(ids);
              $("#ap_ids").val(ids);
              return true;
          /*     $.ajax(
            {
              type:'POST',
              url:"sync_appointment",
               
               data:ids,
              datatype:"json",
              
              success:function(data)
              {
                console.log(data);
              }
            });
*/
  }
    
  function check_authentication()
  {
  
    var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";
    var user_type="<?php echo $this->session->userdata('user_type'); ?>";
// alert(access);
 if(access)
 {
    var checked = $("input[type=checkbox]:checked").length;
 
            if (checked > 0) {
                if(user_type=='Admin'){
                   $('#adminModal').modal('show');
                }
                else{
                      $.ajax(
                      {
                        url:"getcal_list",
                       
                        datatype:"json",
                        success:function(data)
                        {
                          var op='<option value="--">--Select--</option>';
                          var x=$.parseJSON(data);
                           for(var i=0;i<x.length;i++)
                            {
                              op+='<option value="'+x[i].id+'">'+x[i].id+'</option>';
                            }
                            $("#cal_id1").html(op);
                        }
                      });
                      $('#calModal').modal('show');
                }
   
         }else{
            $.notify({
              title: '',
              message: 'Please Select checkbox'
            },{
              type: 'danger'
            });
                           }  
/*  $(window).load(function(){        
   $('#myModal').modal('hide');
    $('#cal_id').show();
    });*/

 }
 else {
  $('#accessModal').modal('show');
      /*$(window).load(function(){        
       
       $('#cal_id').hide();
        });*/
    }
         
  }
  var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";
  function getrecord(id)
  {
    //alert('id'+id);
    /*if(access)
    {*/
      editid=id;
     $.ajax(
    {
      url:"get_appointment_record/"+id,
      type:"POST",
      //data:{name:name, email:email}
      datatype:"json",
      success:function(data)
      {
     /*  console.log(data);*/
       var l=$.parseJSON(data);
       $("#empid").val(l[0].id);
       // $("#u_id").val(l[0].user_id);
         $("#app_date").val(l[0].start_date);
         $("#app_time").val(l[0].start_time);
         $("#demo_dealer").val(l[0].demo_dealer);
         $("#app_addr").val(l[0].appointment_address);
         var x='<option selected value="'+l[0].gift+'">'+l[0].gift+'</option>';
         x+=' <option value="Rainmate">Rainmate</option>';
                             x+='<option value="Gift">Gift</option>';
                      $("#gift").html(x);        
         $("#gift").val(l[0].gift);
        // $("#ride").val(l[0].ride_along);
         var ridealong=l[0].ride_along;
         var dataarray = ridealong.split(",");
        $("#ride").val(dataarray).multiselect('rebuild').trigger('change');
         $("#set").val(l[0].set_by);
        // $("#note").val(l[0].appointment_notes);
         $("#event_id").val(l[0].event_id);
         $("#lead").val(l[0].lead_id);
         $("#assistant").val(l[0].assistant);
         $("#supervisor").val(l[0].supervisor);
          $("#attendees").val(l[0].attendees);
         $("#demo_note").val(l[0].demo_notes);
         var st=l[0].appointment_status;
         var c=l[0].calendar_id;
         $('select[name^="status"] option[value="'+st+'"]').attr("selected","selected");
            $("#c_id").val(c);
               //$('select[name^="cal_id"] option[value="'+c+'"]').attr("selected","selected");
               if(c=='--')
               {
                var op='<option selected value="'+c+'">'+c+'</option>';
               $('#cal_id').append(op);
               }
               else if(access){
                 $('select[name^="cal_id"] option[value="'+c+'"]').attr("selected","selected");
               }
               else
               {
                  var op='<option selected value="'+c+'">'+c+'</option>';
               $('#cal_id').append(op); 
               
               }
               
            $("#app_id").val(l[0].id);
           // console.log($("#app_id").val());
      
/*         var inputElems = document.getElementsByTagName("select");
         console.log(inputElems.length);
for (var i=0; i<inputElems.length; i++) {       
          if (inputElems[i].id == "cal_id"){
          }
       }*/
      /*   var c='<option selected value="'+l[0].calendar_id+'">'+l[0].calendar_id+'</option>';
         $("#cal_id").append(c);*/
          //$("#user_name").val(l[0].user_name);
      }

    });
         
    
   
 
  }
  function delete_app()
  {
    var emp_id=$('#del_id').val();
    $.ajax(
{
  url:"delete_appoint/"+emp_id,
  type:"POST",
  //datatype:"json",
  success:function(data)
  {
 // alert(data);
  window.location.href=weblink+'manage_appointment';

  }

 });
  }
  function deleterecord(emp_id)
  {
    //alert('kk');
    $('#del_id').val(emp_id);
   // $('#d').modal('show');
     
  }
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
  var op='';
  for(var i=0;i<x.length;i++)
  {
    op+='<option value="'+x[i].id+'">'+x[i].id+'</option>';
  }
  $("#cal_id").append(op);
}

}
 var access="<?php echo $this->session->userdata('is_authenticate_user'); ?>";

 if(access)
 {
  getcal_list();
}

/*======Script for checkboxes=====
*/

</script>

<script type="text/javascript">
  
  $(document).ready(function() {
    $('#appointments_data').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'pdf'
        ],
        order:[[1, 'asc']]
    } );
    $("#users_list").click(function() {
    $('.single-checkbox1').not(this).prop('checked', this.checked);
     $("#user_error").text("");
  });
      //Event to Check or Uncheck main Checkbox
  $(".single-checkbox1").click(function() {

    if ($('.single-checkbox1:checked').length == $('.single-checkbox1').length) {
      $("#users").prop('checked', true);
       $("#user_error").text("");
    } else {
      $("#users").prop('checked', false);
       $("#user_error").text("");
    }

  });
  //One Checkbox to check them all...
  $("#masterCheckbox").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

  //Event to Check or Uncheck main Checkbox
  $(".single-checkbox").click(function() {

    if ($('.single-checkbox:checked').length == $('.single-checkbox').length) {
      $("#masterCheckbox").prop('checked', true);
    } else {
      $("#masterCheckbox").prop('checked', false);
    }

  });
  $('.ride').multiselect({
			enableFiltering: true,
		
			includeSelectAllOption: false,
			buttonWidth: '100%'
		});
});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/bootstrap-multiselect.js"></script>

   <script src="<?php echo base_url(); ?>assets/js/myjs/viewappoiment.js"></script>
