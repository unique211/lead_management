<input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('edit_userdata'); ?>">
<!-- =========Sales Representative end======= -->
<div id="sales_rep_view" class="container ">
  <h2>Users Information</h2>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>SNO</th>
        <!-- <th>Employee Id</th> -->
        <!--  <th>User Name</th> -->
        <th>First Name</th>
        <th>Email</th>
        <th>User Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i = 1;
      foreach ($records as $row) {
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        /* echo "<td>".$row['emp_id']."</td>";*/
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['user_name'] . "</td>";
       

        if (in_array('editUser', $user_permission)) {
          echo "<td><a data-toggle='modal' data-target='#myModal' id='" . $row['id'] . " '  data-whatever='@getbootstrap'
              onclick='edit_view(this.id)' ><i class='glyphicon glyphicon-pencil'></i></a>&nbsp;</td>";
        }
        if (in_array('deleteUser', $user_permission)) {
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='' data-toggle='modal' data-target='#myModal1' id='" . $row['id'] . "' class='del_icon_user'  onclick='delete_sales_rep(this.id)' ><i class='glyphicon glyphicon-trash'></i></a></td>";
        }
       
        echo "</tr>";
      }

      ?>
      <!-- Modal for Update -->
      <style>
      @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
      @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

      p:not(:last-child) {
         margin: 0 0 20px;
      }

      section {
         display: none;
         padding: 20px 0 0;
         border-top: 1px solid #abc;
      }

      #tab1,
      #tab2,
      #tab3,
      #tab4,
      #tab5,
      #tab6,
      #tab7 {
         display: none;
      }

      label.lbl {
         display: inline-block;
         margin: 0 0 -1px;
         padding: 15px 25px;
         font-weight: 600;
         text-align: center;
         color: #abc;
         border: 1px solid transparent;
      }

      label.lbl:before {
         font-family: fontawesome;
         font-weight: normal;
         margin-right: 10px;
      }

      /* label[for*='1']:before {
        content: '\f007';
    }

    label[for*='2']:before {
        content: '\f02d';
    } */

      label[for*='3']:before {
         content: '\f21b';
      }

      label[for*='4']:before {
         content: '\f19c';
      }

      label[for*='5']:before {
         content: '\f15c';
      }

      label[for*='6']:before {
         content: '\f023';
      }

      label[for*='7']:before {
         content: '\f21b';
      }



      label:hover {
         color: #789;
         cursor: pointer;
      }

      input:checked+label {
         color: #1caf9a;
         border: 1px solid #abc;
         border-top: 2px solid #1caf9a;
         border-bottom: 1px solid #fff;
      }

      #tab1:checked~#content1,
      #tab2:checked~#content2,
      #tab3:checked~#content3,
      #tab4:checked~#content4,
      #tab5:checked~#content5,
      #tab6:checked~#content6,
      #tab7:checked~#content7 {
         display: block;
      }
   </style>
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Update User Information</h3>
              <button type="button" class="close" data-dismiss="modal" style="margin-top: -2em;" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="edit_sales_rep" id="finicial_form" method="POST">
                <input type="hidden" class="form-control" id="emp_id" name="s_r_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" class="form-control" id="esid" name="esid" >
                <div class="col-lg-12">
         <input id="tab1" class="stages" type="radio" name="tabs" checked>
         <label class="lbl" for="tab1">User Info</label>
         <input id="tab2" class="stages" type="radio" name="tabs" >
         <label class="lbl" for="tab2">Target Info</label>
                     <section id="content1">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">First Name:</label>
                      <input type="text" class="form-control" id="f_name" name="f_name">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Last Name:</label>
                      <input type="text" class="form-control" id="l_name" name="l_name">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">User Name:</label>
                      <input type="text" class="form-control" id="user_name" name="user_name">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Gender:</label>
                      <select class=" form-control" name="gender" id="gender">
                        <option>--Select--</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Email:</label>

                      <input id="email" name="email" placeholder="Email" class="form-control email" required value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Phone:</label>
                      <input type="number" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Role:</label>
                      <select id="user_role" name="user_role" class="user_role form-control" required>
                        <option value="">Select</option>
                        <option value="User">User</option>
                        <option value="Sales">Sales</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Company Name:</label>
                      <input type="text" class="form-control" id="c_name" name="c_name">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Date Of Joining:</label>
                      <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input id="dob" name="dob" placeholder="" class="form-control ap_date" value="" type="date" <? if ($this->session->userdata('user_type') != "Admin") { ?>disabled <?php } ?>></div>

                      <span class="ap_date1"></span>
                    </div>


                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Region:</label>
                      <input id="region" name="region" placeholder="Region" class="tags_input form-control" required value="" type="text">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Region Type:</label>
                      <select class=" form-control" name="region_type" id="region_type">
                        <option>--Select--</option>
                        <option value="zip">Zip</option>
                        <option value="city">City</option>
                        <option value="county"> County</option>
                        <option value="state"> State</option>
                        <option value="country"> Country</option>

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">User Type:</label>
                      <input type="text" class="form-control" id="u_type" name="u_type">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Calndar ID:</label>
                      <input type="text" class="form-control" id="cal_id" name="cal_id">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Title:</label>
                      <input type="text" class="form-control" id="u_title" name="u_title">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Department:</label>
                      <input type="text" class="form-control" id="department" name="department">
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Comments:</label>
                      <textarea class="form-control" id="comments" name="comments"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Address:</label>
                      <textarea class="form-control" id="address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                      <label id="currentfcyear" class="control-label"></label>

                      <div class="input-group"><span class="input-group-addon"><i class="fa fa-dollar"></i></span><input type="number" min="0" id="currentfcyearamt" name="currentfcyearamt" class="form-control" required="true" value="" type="text" maxlength="20"></div>
                    </div>

                  </div>
                </div>
                     </section>
                     <section id="content2">
                <div class="row">
                  <div class="col-md-12" id="show_master">

                  </div>
                  <input type="hidden" id="finicialdata" name="finicialdata" value="">
                </div>
              </section>
                </div>

                <div class="modal-footer">
                  <input type="submit" class="btn btn-primary" name="sales_rep_edit" value="Update">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- Delete Modal -->
      <div id="myModal1" class=" modal fade " role="dialog">

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
              <button class="btn btn-primary" onclick="delete_app()">OK</button>

              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
          </div>

        </div>
      </div>
      <!-- ==========model class end========== -->
      <!-- Modal for delete -->
      <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      Modal content-->
      <!-- <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  -->
      <!-- ==========model class end========== -->
  </table>
</div>
<!-- =======view sales reps end======== -->
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

  var monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  /*====update sales Representatives======*/
  function getCurrentFinancialYear() {
    var fiscalyear = "";
    var today = new Date();
    var fyear = today.getFullYear().toString().substr(-2);
    if ((today.getMonth() + 1) <= 3) {



      fiscalyear = (parseInt(fyear) - parseInt(1)) + "-" + fyear;

    } else {
      fiscalyear = parseInt(fyear) + "-" + (parseInt(fyear) + parseInt(1));
      //fiscalyear=  fiscalyear.toString().substr(-2);
    }
    return fiscalyear
  }

  var currentfbyear = getCurrentFinancialYear();
  $('#currentfcyear').text("Target for FY" + currentfbyear + "(in Lakhs)");

  $("#currentfcyearamt").keypress(function(e) {

    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && e.which !== '-' && (e.which < 48 || e.which > 57)) {

      //$("#errmsg").html("Digits Only");
      return false;
    } else {
      $("#errmsg").hide();
    }
  });
  $("#currentfcyearamt").attr("placeholder", "Target for FY" + currentfbyear + "(in Lakhs)").placeholder();

  function edit_view(emp_id) {
   
    $('#esid').val(emp_id);
    $.ajax({
      // alert(emp_id);
      url: "edit/" + emp_id,
      type: "POST",
      datatype: "json",
      success: function(data) {
        // console.log(data);
        var l = $.parseJSON(data);
        $("#emp_id").val(l[0].emp_id);
        $("#f_name").val(l[0].first_name);
        $("#l_name").val(l[0].last_name);
        $("#user_name").val(l[0].user_name);

        $("#gender").val(l[0].gender);
        $("#phone").val(l[0].phone_num);
        $("#email").val(l[0].email);
        $("#user_name").val(l[0].user_name);
        $("#user_role").val(l[0].user_role);
        $("#c_name").val(l[0].company_name);
        $("#region").val(l[0].region);
        $("#region_type").val(l[0].region_type);
        $("#u_type").val(l[0].user_type);
        $("#cal_id").val(l[0].google_calendar_id);
        $("#u_title").val(l[0].title);
        $("#department").val(l[0].department);
        $("#comments").val(l[0].comments);
        $("#address").val(l[0].address);
        $("#currentfcyearamt").val(l[0].finicialyear_amt);
        $("#dob").val(l[0].dob);
      
        if (l[0].user_type == "SalesRepresentative") {
          $('#show_master').show();
          $.ajax({
            // alert(emp_id);
            url: base_url + "welcome/editfiniciadetalis",
            data: {
              emp_id: emp_id,
            },
            type: "POST",
            dataType: 'json',
            success: function(data1) {
              console.log(data1);
              var html1 = '<table class="table table-striped" >' +
                '<thead>' +
                '<tr>' +
                '<td>Month</td>' +
                '<td>Financial Year</td>' +
                '<td>Target</td>' +

                '</tr>' +
                '</thead><tbody>';
              if (data1.length > 0) {
                for (i = 0; i < data1.length; i++) {
                  
                  html1 += '<tr class="monthdata" id="' + i + '" >' +
                    '<td id="monthnm_' + i + '">' + data1[i].month_name + '</td>' +
                    '<td id="fiscalyear_' + i + '">' + data1[i].finicial_year + '</td>' +
                    '<td><input type="number" class="form-control finialamtd" style="text-align:right;" id="finicialamt_' + i + '" name="finicialamt_' + i + '" value="' + data1[i].target + '"></td>' +
                    '</tr>';
                }
                '</tbody></table>';
                $('#show_master').html(html1);
              } else {
                var fiscalyear = "";
                var today = new Date();
                if ((today.getMonth() + 1) <= 3) {
                  fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear()
                } else {
                  fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1)
                }
                var session_month = today.getMonth();

                for (var i = session_month; i < 12; i++) {
                  html1 += '<tr class="monthdata" id="' + i + '" >' +
                    '<td id="monthnm_' + i + '">' + monthNames[i] + '</td>' +
                    '<td id="fiscalyear_' + i + '">' + fiscalyear + '</td>' +
                    '<td><input type="number" class="form-control finialamtd" style="text-align:right;" id="finicialamt_' + i + '" name="finicialamt_' + i + '" value="0"></td>' +
                    '</tr>';
                }
                for (var i = 0; i < 3; i++) {
                  html1 += '<tr class="monthdata" id="' + i + '" >' +
                    '<td id="monthnm_' + i + '">' + monthNames[i] + '</td>' +
                    '<td id="fiscalyear_' + i + '">' + fiscalyear + '</td>' +
                    '<td ><input type="number" class="form-control finialamtd" style="text-align:right;" id="finicialamt_' + i + '" name="finicialamt_' + i + '" value="0"></td>' +
                    '</tr>';
                }
                '</tbody></table>';
                $('#show_master').html(html1);
              }
            }
          });
        }else{
          $('#show_master').hide();
        }

      }


    });

  }

  function delete_app() {
    var emp_id = $('#del_id').val();
    $.ajax({
      url: "delete_sales/" + emp_id,
      type: "POST",
      //datatype:"json",
      success: function(data) {
        //alert(data);
        window.location.href = weblink + 'user_dtl';

      }
    });
  }
  /*===== delete sales representatives========*/
  function delete_sales_rep(emp_id) {
    $('#del_id').val(emp_id);


  }
</script>
<script src="assets/js/bootstrap-notify.js"></script>
<script src="assets/js/bootstrap-notify.min.js"></script>
<script type="text/javascript">
  var x = document.getElementById('alert_msg').value;

  if (x != '') {
    show_notify(x);
  }

  function show_notify(x) {
    $.notify({
      title: '',
      message: '<strong>Data updated successfully</strong>'
    }, {
      type: 'success'
    });
  }
  var monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  $(document).on('change', '#user_type', function() {
    var v = $(this).val();

    if (v == "SalesRepresentative") {
      $('#show_master').show();
      var fiscalyear = "";
      var today = new Date();
      if ((today.getMonth() + 1) <= 3) {
        fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear()
      } else {
        fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1)
      }
      var session_month = today.getMonth();



      var html1 = '<table class="table table-striped" >' +
        '<thead>' +
        '<tr>' +
        '<td>Month</td>' +
        '<td>Financial Year</td>' +
        '<td>Target</td>' +

        '</tr>' +
        '</thead><tbody>';

      for (var i = session_month; i < 12; i++) {
        html1 += '<tr class="monthdata" id="' + i + '" >' +
          '<td id="monthnm_' + i + '">' + monthNames[i] + '</td>' +
          '<td id="fiscalyear_' + i + '">' + fiscalyear + '</td>' +
          '<td><input type="number" class="form-control finialamtd" style="text-align:right;" id="finicialamt_' + i + '" name="finicialamt_' + i + '" value="0"></td>' +
          '</tr>';
      }
      for (var i = 0; i < 3; i++) {
        html1 += '<tr class="monthdata" id="' + i + '" >' +
          '<td id="monthnm_' + i + '">' + monthNames[i] + '</td>' +
          '<td id="fiscalyear_' + i + '">' + fiscalyear + '</td>' +
          '<td ><input type="number" class="form-control finialamtd" style="text-align:right;" id="finicialamt_' + i + '" name="finicialamt_' + i + '" value="0"></td>' +
          '</tr>';
      }
      '</tbody></table>';
      $('#show_master').html(html1);
    } else {
      $('#show_master').hide();
    }

  });
  $(document).on('blur', '.finialamtd', function() {
      sumoftgt();
   });
   function sumoftgt(){
      var sum=0;
      $(".monthdata").each(function() {
         var id1 = $(this).attr('id');
         var finicialamt = $('#finicialamt_' + id1).val();
         if(finicialamt >0){
            sum=parseInt(finicialamt)+parseInt(sum);
         }

      });
      $('#currentfcyearamt').val(sum);
   }

  $(document).on('submit', '#finicial_form', function() {
    var examb = [];

    $(".monthdata").each(function() {

      var id1 = $(this).attr('id');



      var premision = {};



      var monthnm = $('#monthnm_' + id1).html();
      var fiscalyear = $('#fiscalyear_' + id1).html();
      var finicialamt = $('#finicialamt_' + id1).val();




      premision["monthnm"] = monthnm;
      premision["fiscalyear"] = fiscalyear;
      premision["finicialamt"] = finicialamt;
      examb.push(premision);

    });

    $('#finicialdata').val(JSON.stringify(examb));
  });
</script>