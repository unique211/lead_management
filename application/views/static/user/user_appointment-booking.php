 <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('lead1'); ?>">
 <?php  #echo $this->session->flashdata('lead1');exit; 
  ?>

 <div class="container">
   <br>
   <button class="btn btn-primary pull-right btnhide"><i class="fa fa-plus"></i>Add</button>
   <br>
   <h3>New Account</h3>
   <form class=" form-horizontal" method="post" id="newaccountform" name="newaccountform">

     <!--   <tr>
              <td colspan="1">User details</td>
              <td colspan="1">Lead info</td>
            </tr>  Marital status and Lead date to the "New Lead"  screen.-->

     <div class="btnhideshow" style="display:none;">

       <div class="row">
         <div class="col-md-6">
           <div class="form-group">
             <label class="col-md-4 control-label">Date</label>
             <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                 <input type="date" id="date" name="date" class="form-control ldate"></div><span class="l_date1"></span>
             </div>
           </div>
           <div class="form-group">
             <label class="col-md-4 control-label">Customer Name</label>
             <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="cname" name="cname" placeholder="Customer Name" class="form-control " required="true" maxlength="20" type="text">

               </div><span class="lname1"></span>
             </div>
           </div>
           <div class="form-group">
             <label class="col-md-4 control-label">Customer Type</label>
             <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="customer_type" id="customer_type" class="form-control" >
                   <option value="">Select</option>
                   <option value="Married">Married</option>
                   <option value="Unmarried">Unmarried</option>
                 </select></div><span class="m_status1"></span>
             </div>
           </div>
         </div>









         <div class="col-md-6">

           <div class="form-group">
             <label class="col-md-4 control-label">Category</label>
             <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="category" id="category" class="m_status form-control">
                   <option value="">Select</option>
                   <option value="Married">Married</option>
                   <option value="Unmarried">Unmarried</option>
                 </select></div><span class="m_status1"></span>
             </div>
           </div>

           <div class="form-group">
             <label class="col-md-4 control-label">No of employees</label>
             <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="number" id="employees" name="employees" placeholder="No of employees" class="form-control " required="true" maxlength="20" type="text">

               </div><span class="employees"></span>
             </div>
           </div>







         </div>
       </div>
       <div class="row">

         <b>Contact Information</b>
         <div style="margin-top:0px;border-bottom:2px solid;width:100%;"></div><br>
         <button class="btn btn-primary pull-right" id="addcontact" name="addcontact">Add</button>
       </div>
       <div class="row">
       
         
         <div class="col-md-12" id="contactinformation">
           <input type="hidden" id="row_id" name="row_id" value="0">
           <table>
             <thead>
               <tr>
                 <th style="text-align:center;">Contact Name</th>
                 <th style="text-align:center;">Designation</th>
                 <th style="text-align:center;">Email id</th>
                 <th style="text-align:center;">Mobile no</th>
                 <th style="text-align:center;">Land line</th>
                 <th style="text-align:center;">Action</th>
               </tr>
             </thead>
             <tbody id="contactinformation_tbody"></tbody>
           </table>


         </div>
       </div>

       <div class="row">

<br>
<div style="margin-top:0px;border-bottom:2px solid;width:100%;"></div><br>
</div>

       <div class="row">
       <div class="col-md-12">
       <div class="form-group">
             <label class="col-md-2 control-label">Requirement</label>
             <div class="col-md-10 inputGroupContainer">
               <textarea id="requirement" name="requirement" class="form-control" placeholder="Requirement"></textarea>
             </div>
           </div>
       
       </div>
</div>
<div class="row">
       <div class="col-md-12">
       <div class="form-group">
             <label class="col-md-2 control-label">Remarks</label>
             <div class="col-md-10 inputGroupContainer">
               <textarea id="remark" name="remark" class="form-control" placeholder="Remarks"></textarea>
             </div>
           </div>
       
       </div>

       </div>

       <hr>
       <div class="row">
         <div class="col-md-8">
           <input type="hidden" id="save_update" name="save_update" value="">
           <input type="submit" class="btn btn-primary" value="Save" name="lead_submit" id="save">
           <input type="reset" id="reset" class="btn btn-danger" name="" value="Reset">
         </div>
       </div>
     </div>
   </form>
 </div>
 <div class="container">

   <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
   
   <div class="row tablehideshow">
   <form id="search_form" name="search_form">
   <div class="form-group">
   <div class="col-md-4">
   <label class="control-label">From Date</label>
  
               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                 <input type="date" id="frmdate" name="frmdate" class="form-control ldate" required></div><span class="l_date1"></span>
            
   </div>
   <div class="col-md-4">
   <label class="control-label">To Date</label>
  
               <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                 <input type="date" id="todate" name="todate" class="form-control ldate" required></div><span class="l_date1"></span>
            
   </div>
   <div class="col-md-2">
  <br>
  
  
  <input type="submit" class="btn btn-primary" value="Search" name="lead_submit">
            
   </div>
   </div>
   </form>
   <br>
   <div class="row" id="show_master"></div>

   </div>

   <!-- Delete Modal -->
   <div id="myModal1" class="modal fade" role="dialog">

     <div class="modal-dialog ">

       <div class="modal-content">
         <!--   <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div> -->
         <span id='cal_error'></span>

         <input type="hidden" name="del_id" id='del_id'>

         <div class="modal-body">

           <h5>Are You Sure You Want To Delete</h5>
           <button type="button" class="close" style="margin-top: -1.5em;" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </div>
         <div class="modal-footer">
           <button class="btn btn-primary" id="delete">OK</button>

           <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
         </div>
       </div>

     </div>
   </div>
 </div>
 <script src="assets/js/bootstrap-notify.js"></script>
 <script src="assets/js/bootstrap-notify.min.js"></script>
 
 <script src="<?php echo base_url(); ?>assets/js/myjs/user_appointment.js"></script>

 <link type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
<link type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
 
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQAfOY3OpWLwnkhhLlfhOPFVil7Br5PQ&amp;libraries=places"></script>


 <script>
   google.maps.event.addDomListener(window, 'load', initialize);

   function initialize() {
     var input = document.getElementById('u_addr');
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
       //document.getElementById('add_url').value=
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
 </script>
 <script type="text/javascript">
   $("#spouse_details").hide();

   function show_spouse(m_status) {
     if (m_status == 'Married') {
       $("#spouse_details").show();
       //$("#secondary_details").hide();
     } else {
       $("#spouse_details").hide();
       //  $("#secondary_details").show();
     }

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

   function get_leads() {
     $.ajax({
       type: 'POST',
       url: "get_leads",

       //data:{l_type:x,l_source:v},
       datatype: "json",
       async: false,
       success: function(data) {

         var x = $.parseJSON(data);
         var op = '';
         for (var i = 0; i < x.length; i++) {
           op += '<option value="' + x[i].first_name + '">' + x[i].first_name + '</option>';
         }
         $("#leads").html(op);
       }
     });
   }



   function show_lead_dealer(v) {
     var x = $('#l_type').val();
     if (v == '') {

       $(".l_source1").text("This field is required");
       $(".l_source1").css("color", "red");
       $(".l_dealer").val(null);
     } else {
       $(".l_source1").text("");
     }
     $.ajax({
       type: 'POST',
       url: "lead_source_depdent",

       data: {
         l_type: x,
         l_source: v
       },
       //datatype:"json",

       success: function(data) {
         //console.log(data);
         /*       var op="<select class='form-control l_source' name='l_source' id='l_source' onchange='show_lead_dealer(this.value)'><option value=''>select</option>";*/
         //var sr=JSON.parse(data);

         var x = $.parseJSON(data);
         var dealer = x[0].lead_dealer;
         var op = '<option value="' + dealer + '">' + dealer + '</option>';
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
   function restrict_name(e) {

     var k;
     document.all ? k = e.keyCode : k = e.which;
     return ((k > 64 && k < 91) || (k > 96 && k < 123));

   }

   function validate_data() {
     var fname = $(".fname").val();
     var lname = $(".lname").val();
     var gender = $(".gender").val();
     var m_status = $('.m_status').val();
     var email = $('.email').val();
    // var l_date = $('.l_date').val();
     var l_type = $('.l_type').val();
     if (fname == '') {
       $(".fname1").text("This field is required");
       $(".fname1").css("color", "red");
       $(".fname").focus();
       return false;
     }
     if (lname == '') {
       $(".lname1").text("This field is required");
       $(".lname1").css("color", "red");
       $(".lname").focus();
       return false;
     }
     if (gender == '') {
       $(".gender1").text("This field is required");
       $(".gender1").css("color", "red");
       $(".gender").focus();
       return false;
     }
     if (m_status == '') {
       $(".m_status1").text("This field is required");
       $(".m_status1").css("color", "red");
       $(".m_status").focus();
       return false;
     }
     if (email == '') {
       $(".email1").text("This field is required");
       $(".email1").css("color", "red");
       $(".email").focus();
       return false;
     }
     if (l_date == '') {
       $(".l_date1").text("This field is required");
       $(".l_date1").css("color", "red");
       $(".l_date").focus();
       return false;
     }
     if (l_type == '') {
       $(".l_type1").text("This field is required");
       $(".l_type1").css("color", "red");
       $(".l_type").focus();
       return false;
     }
     return true;
   }
   $(document).ready(function() {
     // validation for duplicates based on names

     // validations for new lead 
     $(document).on('change', '.fname', function() {
       var v = $(this).val();
       if (v == '') {
         $(".fname1").text("This field is required");
         $(".fname1").css("color", "red");
       } else {
         $(".fname1").text("");
       }
     });
     $(document).on('change', '.lname', function() {
       var v = $(this).val();
       if (v == '') {
         $(".lname1").text("This field is required");
         $(".lname1").css("color", "red");
       } else {
         $(".lname1").text("");
       }
       var f_name = $(".fname").val();
       var l_name = v;
       $.ajax({
         type: 'POST',
         url: 'check_lead_duplicate',
         data: {
           f_name: f_name,
           l_name: l_name
         },
         //dataType: 'json',
         success: function(data) {
           if (data == 'duplicate') {
             $(".lname1").text("Record already exits with same names");
             $(".lname1").css("color", "red");
           }
         },
         error: function(response) {

           // alert(response.responseJSON.message);
         }
       });
     });
     $(document).on('change', '.gender', function() {
       var v = $(this).val();
       if (v == '') {
         $(".gender1").text("This field is required");
         $(".gender1").css("color", "red");
       } else {
         $(".gender1").text("");
       }
     });
     $(document).on('change', '.m_status', function() {
       var v = $(this).val();
       if (v == '') {
         $(".m_status1").text("This field is required");
         $(".m_status1").css("color", "red");
       } else {
         $(".m_status1").text("");
       }
     });
     $(document).on('change', '.email', function() {
       var v = $(this).val();
       if (v == '') {
         $(".email1").text("This field is required");
         $(".email1").css("color", "red");
       } else {
         $(".email1").text("");
       }
     });
     $(document).on('keyup', '.s_phn', function() {
       var v = $(this).val();


       if (v == '') {
         $(".s_phn1").text("This field is required");
         $(".s_phn1").css("color", "red");

       } else {
         if (v.length < 10) {
           $('.s_phn1').text("Phone number must contain 10 digits");
           $(".s_phn1").css("color", "red");
           $("#save").attr("disabled", "disabled");

         } else if (v.length > 10) {
           $('.s_phn1').text("Please enter 10 digit phone number");
           $(".s_phn1").css("color", "red");
           $("#save").attr("disabled", "disabled");
         } else {
           $('.s_phn1').text("");
           $("#save").removeAttr("disabled");
         }

       }
     });

     $(document).on('keyup', '.phn', function() {
       var v = $(this).val();


       if (v == '') {
         $(".phn1").text("This field is required");
         $(".phn1").css("color", "red");

       } else {
         if (v.length < 10) {
           $('.phn1').text("Phone number must contain 10 digits");
           $(".phn1").css("color", "red");
           $("#save").attr("disabled", "disabled");

         } else if (v.length > 10) {
           $('.phn1').text("Please enter 10 digit phone number");
           $(".phn1").css("color", "red");
           $("#save").attr("disabled", "disabled");
         } else {
           $('.phn1').text("");
           $("#save").removeAttr("disabled");
         }

       }
     });
     $(document).on('change', '.l_type', function() {

       var x = $('#l_type').val();
       //$("#l_dealer").prop('selected','selected');
       // $('select[name^="l_dealer"] option[value=""]').attr("selected","selected");
       var source = $("#l_source").val();
       var dealer = $("#l_dealer").val();
       console.log(source);
       console.log(dealer);
       if (source != '' || dealer != '') {
         $("#l_source").val("");
         $("#l_dealer").val("");
       }


       if (x == '') {
         $(".l_type1").text("This field is required");
         $(".l_type1").css("color", "red");
         $(".lead_source").hide();
         $(".d_relation").hide();
         $('.l_dealer').val(null);
       } else {
         $(".l_type1").text("");
         $(".lead_source").show();
         $(".d_relation").show();
         var x = $('#l_type').val();
         var op = '';

         $.ajax({
           type: 'POST',
           url: "lead_type_depdent",

           data: {
             l_type: x
           },
           //datatype:"json",
           async: false,
           success: function(data) {
             //console.log(data);
             //var op="";
             //var sr=JSON.parse(data);
             var x = $.parseJSON(data);
             //console.log(x);
             var sub_lead = x[0].sub_lead;
             if (sub_lead == 'YES') {
               $("#secondary_details").show();
             } else {
               $("#secondary_details").hide();
             }
             //  var op='';
             for (var i = 0; i < x.length; i++) {

               op += '<option value="' + x[i].lead_source + '">' + x[i].lead_source + '</option>';
             }

             //$(".source").html(c);
             //$(".l_source").append(op);
             // console.log(op);


           }
         });
         $.ajax({
           type: 'POST',
           url: "get_leads",
           datatype: "json",
           async: false,
           success: function(data) {

             var x = $.parseJSON(data);

             for (var i = 0; i < x.length; i++) {
               op += '<option value="' + x[i].first_name + '">' + x[i].first_name + '</option>';
             }
             // console.log(op); 
             $("#leads1").html(op);

           }
         });
       }
     });

     $(document).on('change', '.l_date', function() {
       var v = $(this).val();
       if (v == '') {
         $(".l_date1").text("This field is required");
         $(".l_date1").css("color", "red");
       } else {
         $(".l_date1").text("");
       }
     });

     $(document).on('change', '.relation', function() {
       var v = $(this).val();

       if (v == '') {
         $(".relation1").text("This field is required");
         $(".relation1").css("color", "red");
       } else {
         $(".relation1").text("");
       }
     });
     $(document).on('change', '.l_dealer', function() {
       var v = $(this).val();
       if (v == '') {
         $(".l_dealer1").text("This field is required");
         $(".l_dealer1").css("color", "red");
       } else {
         $(".l_dealer1").text("");
       }
     });
     $(document).on('change', '.l_status', function() {
       var v = $(this).val();
       if (v == '') {
         $(".l_status1").text("This field is required");
         $(".l_status1").css("color", "red");
       } else {
         $(".l_status1").text("");
       }
     });
     $(document).on('change', '.l_note', function() {
       var v = $(this).val();
       if (v == '') {
         $(".l_note1").text("This field is required");
         $(".l_note1").css("color", "red");
       } else {
         $(".l_source1").text("");
       }
     });
     $(document).on('change', '.job', function() {
       var v = $(this).val();
       if (v == '') {
         $(".job1").text("This field is required");
         $(".job1").css("color", "red");
       } else {
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