<link href="<?php echo base_url(); ?>assets/js/select2.min.css" rel="stylesheet">
<div class="container">
<style>
    textarea {
        resize: none;
    }
</style>

   <?php if ($user_permission) { ?>
      <?php if (in_array('createQuotation', $user_permission)) { ?>
         <br>
         <button class="btn btn-primary pull-right btnhide"><i class="fa fa-plus"></i>Add</button>

      <?php } ?>
      <button class="btn btn-primary pull-right closehide" style="display:none">Close</button>
      <h3>Quotation / Estimate</h3><br>


      <div class="btnhideshow" style="display:none;">

         <table id="btntable" class="table table-striped">
            <tbody>
               <tr>
                  <td colspan="1">
                     <form class="form-horizontal" id="quotation_form" name="quotation_form" method="POST">
                        <fieldset>

                           <div class="row">
                         
                              <div class="col-md-6">


                                 <div class="form-group">
                                    <label class="col-md-4 control-label">Customer Name*</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="cus_name" name="cus_name" placeholder="Customer Name" class="form-control " required="true" maxlength="20" type="text" >

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
                                       <?php if (($this->session->userdata('user_type') == "SalesRepresentative") && ($this->session->userdata('userrole') == "Sales")) { ?>
                                          <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="salesrepresentive1" name="salesrepresentive1" placeholder="Contact Person" class="form-control " maxlength="20" type="text">

                                          </div><span class="s_lname1"></span>
                                       <?php } else { ?>
                                          <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="salesrepresentive" id="salesrepresentive" class="form-control">
                                                <option value="">Select</option>

                                             </select></div>
                                       <?php } ?>

                                    </div>
                                 </div>

                              </div>

                              <div class="col-md-6">

                                 <div class="form-group">

                                    <label class="col-md-4 control-label">Quatation Number</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="bill_no" name="bill_no" placeholder="Quatation Number" class="form-control " required="true" maxlength="20" type="text" readonly>

                                       </div><span class="Bill_No"></span>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-md-4 control-label"> Ref Number*</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="refno" name="refno" placeholder="Ref Number" class="form-control " required="true" maxlength="20" type="text">

                                       </div><span class="BillRefNo"></span>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="col-md-4 control-label">Quotation Date</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                          <input type="date" id="o_date" name="o_date" class="form-control o_date" disabled></div><span class="o_date"></span>
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
                                    <label class="col-md-4 control-label">Order Due Date*</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group"><span class="adj_size input-group-addon"><i class="fa fa-calendar" style="font-size:14px;"></i></span>
                                          <input type="date" id="o_due_date" name="o_due_date" required="true" class="form-control o_date"></div><span class="o_date"></span>
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

                                          <th>Version</th>
                                          <th colspan="12">
                                             <div class="input-group"><span class="input-group-addon"><i class="fa fa-life-ring"></i></span><select name="search_version" id="search_version" class="form-control">
                                                   <option value="">Select</option>

                                                </select></div>
                                          </th>

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
                                             <input type="number" style="text-align:right;" class="form-control getmargindata"  id="finalordvalue" name="finalordvalue">
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
                                             <input type="number" style="text-align:right;" class="form-control getmargindata" value="0" id="lesstaxcst" name="lesstaxcst">
                                          </div>
                                       </div>

                                       <div class="form-group">
                                          <label class="col-sm-4"><b>Less Transporation(₹) </b></label>
                                          <div class="col-md-8 inputGroupContainer">
                                             <input type="number" style="text-align:right;" class="form-control getmargindata"  value="0"  id="lesstrasporation" name="lesstrasporation">
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
                                             <input type="number" style="text-align:right;"  value="0"  class="form-control " id="finalmargin" name="finalmargin">
                                          </div>
                                       </div>


                                      








                                    </div>
                                 </div>
                              </div>


               <tr>
                  <td><input id="btn_submit_quotation" type="submit" class="btn btn-primary" name="submit" value="Save">

                     <input type="hidden" id="save_update" name="save_update" value="">
                     <input type="hidden" id="customerid" name="customerid" value="">
                     <input type="hidden" id="quatationno" name="quatationno" value="">
                     <input type="reset" id="reset" class="btn btn-danger" name="reset" value="Reset">
                     <input type="button" id="btnmailsend" name="btnmailsend" class="btn  btn-success pull-left" value="send" style="display:none;">
                     <?php if ($user_permission){?>
                     <?php if (in_array('exportQuotation', $user_permission)) { ?>
                     <button type="button" id="btnExport" name="btnExport" class="btn btn-sm btn-info pull-right" style="display:none;">Excel</button>
                     <button type="submit" form="pdf" id="btnprint" name="btnprint" value="" class="btn btn-sm btn-info pull-right" style="display:none;">Print</button>
                     <?php } }?>
                  </td>
                  <td>


               </tr>








               </fieldset>
               </form>
               <form name="pdf" id="pdf" method="POST" action="<?php echo base_url('Quotation_Estimate/print_pdf'); ?>" target="_blank"></form>
               </td>
               </tr>
            </tbody>
         </table>
      </div>
</div>
<div class="container">

   <input type="hidden" name="alert_msg" id='alert_msg' value="<?php echo $this->session->flashdata('msglp'); ?>">
   <div class="col-md-12">
   <div id="wait6" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;display:none;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br>
									<center>
										<h5>Please Wait...</h5>
									</center>
								</div>
      <div class="row tablehideshow">
      <div class="col-md-2">
            <label>Status</label>
            <div class=" inputGroupContainer">
            <select name="quotation_status_info" id="quotation_status_info" class="form-control" >
                   <option value="">Select</option>
                   <option selected value="All">All</option>
                   <option value="1">Pending</option>
                   <option value="2">Confirm</option>
                   <option value="3">Cancel</option>
            </select>
            </div>
         </div>
         <div class="col-md-1">
           <br>
            <div class=" inputGroupContainer">
            <button type="button" class="btn btn-info pull-right" id="searchfilter">Search</button>
            </div>
         </div>
      </div>
    </div>
   <div class="row tablehideshow" id="show_master">

   </div>

   <div class="row" id="show_master1" style="display:none;">
      <table id="tblexport">
         <thead>
            <tr>
               <th colspan="4">Customer Info</th>
               <th colspan="4">Quatation Info</th>
            </tr>
         </thead>
         <tbody id="tblexporttbl"></tbody>
      </table>

   </div>
   <script>
      var arrayFromPHP = <?php echo json_encode($user_permission); ?>;
      console.log(arrayFromPHP);
   </script>
<?php } ?>
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

<!-- Delete Modal -->

<!-- Change Status Modal -->
<div id="myModal2" class=" modal fade " role="dialog">
   <form id="form_changestatus" name="form_changestatus">
      <div class="modal-dialog ">

         <div class="modal-content">
            <div class="modal-header">
          
            <div id="wait1" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;display:none;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br>
									<center>
										<h5>Please Wait...</h5>
									</center>
								</div>

               <h4 class="modal-title">Change Status</h4>
               <button type="button" class="close" style="margin-top: -1.5em;" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </div>
            <span id='cal_error'></span>

            <input type="hidden" name="status_id" id='status_id'>

            <div class="modal-body">

               <div class="col-md-12">

               
                  <div class="form-group">
                     <label class="col-sm-4"><b>Status </b></label>
                     <div class="col-md-6 inputGroupContainer">
                        <select name="quote_status" id="quote_status" class="form-control">
                           <option disabled>select</option>
                           <option value="1">Pending</option>
                           <option value="2" selected>Confirm</option>
                           <option value="3">Cancel</option>
                        </select>
                     </div>
                  </div>

               </div>

            </div>
            <div class="modal-footer">
               <button class="btn btn-primary" id="changestatuainfo">OK</button>

               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
         </div>

      </div>
   </form>
</div>
<!-- Change Status Modal -->

</div>
<div class="container" id="sendemail_div" style="display:none;">
   <!DOCTYPE html>
   <html>

   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
         body {
            font-family: Arial;
         }

         /* Style the tab */
         .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
         }

         /* Style the buttons inside the tab */
         .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
         }

         /* Change background color of buttons on hover */
         .tab button:hover {
            background-color: #ddd;
         }

         /* Create an active/current tablink class */
         .tab button.active {
            background-color: #000000;
            color: #fff;
         }

         /* Style the tab content */
         .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
         }
      </style>
   </head>

   <body>



      <div class="tab">
         <button id="tbcustomer" class="tablinks active" onclick="openCity(event, 'Customer')">Customer</button>
         <button id="tbsalesperson" class="tablinks" onclick="openCity(event, 'SalesPerson')">SalesRepresentative</button>

      </div>

      <div id="Customer" class="tabcontent">
         <div class="row">
            <div class="col-md-6">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">To:</label>
                        <input type="text" class="form-control" id="cto" name="cto[]">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">CC(Select Customer From Dropdown):</label>
                        <select name="customercc[]" multiple="multiple" id="customercc" style="width:100%" class="form-control select-box"></select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub:</label>
                        <input type="text" class="form-control" id="cSubject" name="cSubject">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Message:</label>
                        <textarea type="text" class="form-control" id="cmsg" name="cmsg"></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1custnm" class="col-form-label">Customer Name:</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1quotationno" class="col-form-label">Quotation Number:</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1salespr" class="col-form-label">Sales Representative:</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1refno" class="col-form-label">Ref Number:</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1version" class="col-form-label">Version:</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <br>
                        <label id="lbl1quotationdate" class="col-form-label">Quotation Date:</label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                     <br>
                        <label id="lbl1orderduedate" class="col-form-label">Order Due Date:</label>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                     <br>
                        <label id="lbl1totalordvalue" class="col-form-label">Total Order Value :</label>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class="col-md-6">
               <button class="btn btn-info btnfilenmshow" id="btnfilenmshow1"> <a  id="getdfieename" href=""><i class="fa fa-paperclip"></i></a></button><label id="filenamepdf1">Qutation.pdf</label>
               </div>
               </div>
            </div>
         </div>
         <div class="row">
         <div id="wait3" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;display:none;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br>
									<center>
										<h5>Please Wait...</h5>
									</center>
								</div>
            <div class="col-md-6">

               <div class="form-group">
                  <button class="btn btn-primary" id="csend">Send</button>
               </div>
            </div>
            <div class="col-md-6">

               <div class="form-group">
                  
                  <label id="lblcsend" class="col-form-label"></label>
               </div>
            </div>
         </div>

      </div>

      <div id="SalesPerson" class="tabcontent">
         <div class="row">
            <div class="col-md-6">

               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">To:</label>
                  <input type="text" class="form-control" id="sto" name="sto">
               </div>
            </div>
            <div class="col-md-3">
               
               <div class="form-group">
               <br>
                  <label id="lblcustfirstname" class="col-form-label">Customer Name:</label>
               </div>
            </div>



            <div class="col-md-3">
           
               <div class="form-group">
               <br>
                  <label id="lblQuotationno" class="col-form-label">Quotation Number:</label>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">

               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">CC(Select SalesRepresentative From Dropdown):</label>
                  <select name="scc[]" id="scc" multiple="multiple" style="width:100%" class="form-control select-box"></select>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
               <br>
                  <label id="lblsalesrepresentative" class="col-form-label">Sales Representative:</label>
               </div>
            </div>
            <div class="col-md-3">
            <br>
               <div class="form-group">
               <br>
                  <label id="lblrefnumber" class="col-form-label">Ref Number:</label>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">

               <div class="form-group">
                  
                  <label for="recipient-name" class="col-form-label">Sub:</label>
                  <input type="text" class="form-control" id="sSubject" name="sSubject">
               </div>
            </div>
            <div class="col-md-3">
           
               <div class="form-group">
               <br>
                  <label id="lblversion" class="col-form-label">Version:</label>
               </div>
            </div>
            <div class="col-md-3">
          
               <div class="form-group">
               <br>
                  <label id="lblquotationdate" class="col-form-label">Quotation Date:</label>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">

               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Message:</label>
                  <textarea type="text" class="form-control" id="smsg" name="smsg"></textarea>
               </div>
            </div>
            <div class="col-md-3">
           
               <div class="form-group">
               <br>
                  <label id="lblorderduedate" class="col-form-label">Order Due Date:</label>
               </div>
            </div>
            <div class="col-md-3">
          
               <div class="form-group">
               <br>
                  <label id="lbltotalordervalue" class="col-form-label">Total Order Value:</label>
               </div>
            </div>
         </div>
         <div class="row">
         <div class="col-md-6"></div>
               <div class="col-md-6">
               <button class="btn btn-info btnfilenmshow" id="btnfilenmshow2"> <a  id="getdfieename" href=""><i class="fa fa-paperclip"></i></a></button><label id="filenamepdf2">Qutation.pdf</label>
               </div>
               </div>
         <div class="row">
         <div id="wait4" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;display:none;"><img src="<?php echo base_url('assets/images/loader.gif'); ?>" width="100" height="100" /><br>
									<center>
										<h5>Please Wait...</h5>
									</center>
								</div>
            <div class="col-md-6">

               <div class="form-group right">
                  <button class="btn btn-primary" id="ssend">Send</button>
               </div>
            </div>
         </div>
      </div>
      </div>
      <script>
function openCity(evt, cityName) {
 
   
  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");
  
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  
 
  
  if(cityName=="SalesPerson"){
  
  
   $('#tbsalesperson').addClass("active");
  }else{
  
   $('#tbcustomer').addClass("active");
  }
  //evt.currentTarget.className += " active";

}
</script>


      <!-- <script>
        
    function openCity(evt, cityName) {

var i, tabcontent, tablinks;
if (cityName == "Customer") {
    $("#tbcustomer").css({ "background-color": "0071ba" });
    $("#tbsalesperson").css({ "background-color": "" });
} else {
    $("#tbsalesperson").css({ "background-color": "0071ba" });
    $("#tbcustomer").css({ "background-color": "" });
}
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
 $('#'+cityName).style.display = "block";
 evt.currentTarget.className += " active";
}
      </script> -->

   </body>

   </html>

</div>





<!--  
    <script src='assets/src/tagcomplete.js'></script> -->
<script src='<?php echo base_url('assets/js/main.js') . APPVER; ?>'></script>

<script src="<?php echo base_url(); ?>assets/js/myjs/quatation.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- jQuery UI library -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="https://rawgit.com/unconditional/jquery-table2excel/master/src/jquery.table2excel.js"></script> -->
<script src="assets/js/tabletoexcle.js"></script>
<script src="assets/js/bootstrap-notify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
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

<script type="text/javascript">
   // Table Append 


   var base_url = "<?php echo base_url(); ?>";

   var usertype = "<?php echo $this->session->userdata('user_type') ?>";
   var userrole = "<?php echo $this->session->userdata('userrole') ?>";
   var useruniqueid = "<?php echo $this->session->userdata('useruniqueid') ?>";




   $(document).ready(function() {

      $('.select-box').select2();

   });
</script>


<script>


</script>