<div class="container">
<!-- <button class="btn btn-primary pull-right btnhide"><i class="fa fa-plus"></i>Add</button> -->
<button class="btn btn-primary pull-right closehide" style="display:none">Close</button>
   <h3>Order </h3><br>
   

   <div class="btnhideshow"  style="display:none;">
  
      <table id="btntable" class="table table-striped">
         <tbody>
            <tr>
               <td colspan="1">
                  <form class="form-horizontal" id="order_form" name="order_form" method="POST">
                     <fieldset>

                        <div class="row">
                           <div class="col-md-6">

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Customer Name</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="cus_name" name="cus_name" placeholder="Customer Name" class="form-control " required="true" maxlength="20" type="text">

                                    </div><span class="lname1"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Contact Person</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="cotactperson" name="cotactperson" placeholder="Contact Person" class="form-control " maxlength="20" type="text">

                                    </div><span class="s_lname1"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Mobile No</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phn" name="phn" placeholder="Phone Number" class="form-control phn small-input" required pattern="[0-9]{10}" type="number" onkeypress="preventNonNumericalInput(event)"></div><span class="phn1"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Email</label>

                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="s_email" name="s_email" placeholder="Email" class="form-control s_email" value="" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></div><span class="email1"></span>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-md-4 control-label">Sales Representative</label>


                                 <div class="col-md-8 inputGroupContainer">
                                    <?php if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){ ?>
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="salesrepresentive1" name="salesrepresentive1" placeholder="Contact Person" class="form-control " maxlength="20" type="text">

                                    </div><span class="s_lname1"></span>
                                    <?php }else {?>
                                 <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="salesrepresentive" id="salesrepresentive" class="form-control">
                                             <option value="">Select</option>
                                            
                                          </select></div>
                                    <?php } ?>

                                 </div>
                              </div>

                           </div>

                           <div class="col-md-6">

                              <div class="form-group">

                                 <label class="col-md-4 control-label">Order Number</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="orderno" name="orderno" placeholder="Quatation Number" class="form-control " required="true" maxlength="20" type="text">

                                    </div><span class="Bill_No"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label"> Ref Number</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="refno" name="refno" placeholder="Ref Number" class="form-control " required="true" maxlength="20" type="text">

                                    </div><span class="BillRefNo"></span>
                                 </div>
                              </div>

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Order Date</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                       <input type="date" id="o_date" name="o_date" class="form-control o_date"></div><span class="o_date"></span>
                                 </div>
                              </div>
                              <!-- 
                    <div class="form-group">
                    <label class="col-md-4 control-label">Discount</label>
                       <div class="col-md-8 inputGroupContainer">
                       <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="Discount" id="Discount" class="m_status form-control" >
                                <option value="">Select</option>
                             <option value="1">Before Discount</option>
                             <option value="2">After Discount</option>
                             </select></div><span class="m_status1"></span>
                       </div>
                    </div> -->

                              <div class="form-group">
                                 <label class="col-md-4 control-label">Order Due Date</label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                       <input type="date" id="o_due_date" name="o_due_date" class="form-control o_date"></div><span class="o_date"></span>
                                 </div>
                              </div>


                              <div class="form-group">
                                 <label class="col-md-4 control-label">Description</label>

                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                       <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                                    </div><span class="o_due_date"></span>
                                 </div>
                              </div>

                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">

                              <table class="table table-bordered table-hover" id="product_table">
                               
                                 <thead>
                                    <tr style="display:none;" id="searchversion">
                                    <th colspan="2"><label>Quotation Number:</label></th>
                                       <th colspan="3" ><br><br><label name="quatation_no" id="quatation_no">
                                       <th colspan="4"></th>
                                       <th><label>Version:</label></th>
                                       <th colspan="3" ><br><br><label name="search_version" id="search_version">
                                           
                                            
                                          </label></th>

                                    </tr>
                                    <tr>

                                       <th>Description</th>
                                       <th>Qty</th>
                                       <th>UnitTransfer Price</th>
                                       <th>Total Transfer Price</th>


                                       <th>Tax (%) </th>
                                       <th>Tax (Rs) </th>

                                       <th>Total Transfer Price With Inc Tax </th>


                                       <th>Unit Ord Value</th>
                                       <th>Total Ord Value</th>
                                       <th> Tax % </th>
                                       <th> Tax (Value) </th>

                                       <th>Total Ord Val With Tax</th>
                                       <th>Margin</th>
                                       <th>

                                          <button type="button" id="add_row" class="btn btn-default" style="font-size: 12px; color:green"><i class="fa fa-plus"></i></button>
                                       </th>


                                    </tr>
                                 </thead>
                                 <tbody>
                                    <!-- 
                    <tr id="row_1" class="producttbrow"> 
                    <td>
                    <input type="text" value="" class="form-control" name="P_Id[]" id="P_Id_1" placeholder="Product Name">
                    </td>

                    <td> 
                    <input type="text" value="1" class="form-control" name="P_Qty[]" id="P_Qty_1"  placeholder=" Qty" >
                    </td>

                    <td>
                    <input type="text" value="" class="form-control" name="Ut_Price[]" id="Ut_Price_!" placeholder="Unit Transfer Price">
                    </td>

                    <td>
                    <input type="text" value="" class="form-control" name="Total_Transfer_Price[]" id="Total_Transfer_Price_1" placeholder="Unit Transfer Price">
                    </td>

                    <td> 
                    <input type="text" class="form-control" name="Tax[]" id="Tax_1"  placeholder="Tax %" >
                    </td>



                    <td> 
                    <input type="text" value="" class="form-control" name="Tax_Rs[]" id="Tax_Rs_1" placeholder="Tax Rs" readonly>
                    </td>

                    <td> 
                    <input type="text" value="" class="form-control" name="TTrans_P_With_Tax[]" id="TTrans_P_With_Tax_1" placeholder=" Total Transfer Price With Inc Tax" readonly>
                    </td>

                   
                    <td> 
                    <input type="text" class="form-control" name="U_Ord_Val[]" id="U_Ord_Val_1"  placeholder="U Ord Val" >
                    </td>

                    <td> 
                    <input type="text" class="form-control" name="P_Tax[]" id="P_Tax_1"  placeholder="P Tax" >
                    </td>



                    <td> 
                    <input type="text" class="form-control" name="P_TotalAmt[]" id="P_TotalAmt_1" placeholder="P Value" >
                    </td>

                    <td> 
                    <input type="text" class="form-control" name="P_Tax_Rs[]" id="P_Tax_Val_1" placeholder="Total  Order Val With Tax" >
                    </td>

                    <td> 
                    <input type="text" class="form-control" name="Margin[]" id="Margin_1" placeholder="Margiin" >
                    </td>



                    <td> 
                    <button type="button" onclick="removeRow('1')" class="btn btn-default" style="font-size: 12px; color:red"><i class="fa fa-close"></i></button>
                    </td>

                     </tr>

                   
                    <td colspan="13" id="rows_1"> 
                    <textarea class="form-control" rows="2" name="P_Desc[]" id="P_Desc_1"></textarea>
                    </td>

                    
                    </tr> -->


                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td>

                                       </td>

                                       <td>

                                       </td>



                                       <td colspan="2">
                                          <input type="number" style="text-align:right;" value="" class="form-control" name="totaltrasnforprice" id="totaltrasnforprice" placeholder="Total Transfer Price">
                                       </td>





                                       <td colspan="2">
                                          <input type="text" style="text-align:right;" value="" class="form-control" name="totaltaxprice" id="totaltaxprice" placeholder="Tax Rs" readonly>
                                       </td>

                                       <td colspan="2">
                                          <input type="text" style="text-align:right;" value="" class="form-control" name="totaltranforpricewithtax" id="totaltranforpricewithtax" placeholder=" Total Transfer Price With Inc Tax" readonly>
                                       </td>








                                       <td colspan="2">
                                          <input type="text" style="text-align:right;" class="form-control" name="P_TotalAmt[]" id="P_TotalAmt_1" placeholder="P Value">
                                       </td>

                                       <td colspan="2">
                                          <input type="text" style="text-align:right;" class="form-control" name="P_Tax_Rs[]" id="P_Tax_Val_1" placeholder="Total  Order Val With Tax">
                                       </td>

                                       <td colspan="2">
                                          <input type="text" style="text-align:right;" class="form-control" name="Margin[]" id="Margin_1" placeholder="Margiin">
                                       </td>





                                    </tr>

                                 </tfoot>
                              </table>
                              <input type="hidden" id="product_tbody" name="product_tbody" value="0">

                              <div class="content" style="">


                                 <div class="col-sm-5 col-md-7">
                                 <div id="wait" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;display:none;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br>
                                          <center>
                                             <h5>Please Wait...</h5>
                                          </center>
                                       </div>
                                 </div>



                                 <div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-0">



                                    <!-- <div class="form-inline">
		<label class="col-sm-5"><b>Total Tax : </b></label>
		<div class="form-check-inline col-sm-5">
		<input type="text" class="form-control" id="subTotal" name="subTotal" readonly>
        </div></br></br> -->

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>Total Order Value(₹) (without Tax) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="finalordvalue" name="finalordvalue">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>Total Transfer Price(₹) (without Tax) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="finaltrasforprice" name="finaltrasforprice">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>Less Input Tax if CST(₹) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="lesstaxcst" name="lesstaxcst">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>Less Transporation(₹) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="lesstrasporation" name="lesstrasporation">
                                       </div>
                                    </div>


                                    <div class="form-group">
                                       <label class="col-sm-4"><b> Less BG/Insurance Cost(₹) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="lessbg" name="lessbg">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>Less others(₹) (if any) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control getmargindata" id="lessother" name="lessother">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                       <label class="col-sm-4"><b>MARGIN(₹) </b></label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <input type="number" style="text-align:right;" class="form-control " id="finalmargin" name="finalmargin">
                                       </div>
                                    </div>











                                 </div>
                              </div>
                           </div>


            <tr>
               <td><input type="submit" class="btn btn-primary" name="submit" value="Save">
              
                  <input type="hidden" id="save_update" name="save_update" value="">
                  <input type="hidden" id="quatationid" name="quatationid" value="">
                  <input type="hidden" id="customerid" name="customerid" value="">
                  <input type="reset" id="reset" class="btn btn-danger" name="reset" value="Reset">
                  <?php if ($user_permission){?>
                     <?php if (in_array('exportOrder', $user_permission)) { ?>
                  <button type="button"  id="btnExport" name="btnExport"  class="btn btn-sm btn-info pull-right" style="display:none;">Excel</button>
               	<button type="submit" form="pdf" id="btnprint" name="btnprint" value="" class="btn btn-sm btn-info pull-right" style="display:none;">Print</button>
                  <?php } }?>
               </td>
               <td>
              

            </tr>








            </fieldset>
            </form>
            <form name="pdf" id="pdf" method="POST" action="<?php echo base_url('Quotation_order/print_pdf'); ?>" target="_blank"></form>
            </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="container">

   <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
   <!-- <div class="row tablehideshow" id="show_master">

   </div> -->

   <div class="row" id="show_master1" style="display:none;">
   <table id="tblexport">
      <thead>
         <tr><th colspan="4">Customer Info</th>
         <th colspan="4">Invoice Info</th></tr>
      </thead>
      <tbody id="tblexporttbl"></tbody>
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

<!-- Delete Modal -->




<!--  
    <script src='assets/src/tagcomplete.js'></script> -->




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script> -->
<!-- <script src="assets/js/tabletoexcle.js"></script>
<script src="assets/js/bootstrap-notify.min.js"></script> -->
<script src='<?php echo base_url(); ?>assets/js/tabletoexcle.js'></script>
<script src='<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js'></script>

<script src="<?php echo base_url(); ?>assets/js/myjs/quatation_order.js"></script>

<script type="text/javascript">
   // Table Append 
                       

   var base_url = "<?php echo base_url(); ?>";
  
  var quatationid = "<?php echo  $quotatopnid; ?>";

  var usertype="<?php echo $this->session->userdata('user_type') ?>";    
  var userrole="<?php echo $this->session->userdata('userrole') ?>";    
  var useruniqueid="<?php echo $this->session->userdata('useruniqueid') ?>"; 
  
  //var quatationid ="";
  
</script>
