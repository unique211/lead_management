<div class="container">
  <h3>Funnel Report</h3><br>
  <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">

</div>
<div class="container">

  <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
  <div class="row" id="show_master">
    <table id="funnelreport_tb" class="table table-striped table-bordered" style="width:100%">
      <thead>

        <tr>
          <td>Sales Person</td>


          <td colspan="3" style="text-align: center;width:30%">


            <div class="col-md-8 inputGroupContainer">
              <?php if (($this->session->userdata('user_type') == "SalesRepresentative") && ($this->session->userdata('userrole') == "Sales")) { ?>
                <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="salesrepresentive1" name="salesrepresentive1" placeholder="Sales Person" class="form-control " maxlength="20" type="text">

                </div><span class="s_lname1"></span>
              <?php } else { ?>
                <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="salesrepresentive" id="salesrepresentive" class="form-control">
                    <option value="">Select</option>

                  </select></div>
              <?php } ?>

            </div>
          </td>
          <td></td>
          <td></td>

          <td></td>

          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total</td>
          <td></td>
          <td>0</td>
          <td>0</td>
          <td> </td>
          <td> </td>
          <td> </td>
          <td> </td>
        </tr>
        <tr>
          <td>SBU</td>
          <td>Customer</td>
          <td>Principal</td>
          <td>Product Description</td>
          <td>Opportunity Identification Date</td>
          <td>Top Line</td>
          <td>Bottom Line</td>
          <td>Probability </td>
          <td>Projected Closure date </td>
          <td>Current Status </td>
          <td>Remarks </td>
        </tr>
      </thead>
      <tbody id="funnelrep_tbody">


      </tbody>
    </table>
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
          <button class="btn btn-primary" id="delete">OK</button>

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>

    </div>
  </div>
</div>


<!--   <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>
    <script src='assets/src/tagcomplete.js'></script> -->
<script src="assets/js/bootstrap-notify.js"></script>
<script src="assets/js/bootstrap-notify.min.js"></script>


<script src="<?php echo base_url(); ?>assets/js/myjs/funnelreport.js"></script>

<script type="text/javascript">
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
  /*function get_leads(){
      
        $.ajax(
      {
        url:"get_leads",
        type:"POST",
        datatype:"json",
        success:function(data)
        {
          
         var l=$.parseJSON(data);
       
         var op='<option value="">Select</option>';
          for(var i=0;i<l.length;i++)
          {
            op+='<option value="'+l[i].first_name+'">'+l[i].first_name+'</option>';
          }
                               
          $("#source").html(op);
      
        }

      });

    
  }
  function get_users(){
   
      $.ajax(
      {
        url:"get_users",
        type:"POST",
        datatype:"json",
        success:function(data)
        {
         
          var l=$.parseJSON(data);
          var op='<option value="">Select</option>';
          for(var i=0;i<l.length;i++)
          {
            op+='<option value="'+l[i].first_name+'">'+l[i].first_name+'</option>';
          }
                               
          $("#source").html(op);
           
        }

      });
    
  }*/
</script>
<script>
var base_url = "<?php echo base_url(); ?>";

	var usertype="<?php echo $this->session->userdata('user_type') ?>";    
  var userrole="<?php echo $this->session->userdata('userrole') ?>";    
  var useruniqueid="<?php echo $this->session->userdata('useruniqueid') ?>"; 
  </script>