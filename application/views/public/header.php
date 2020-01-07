<?php if ($user_permission) : ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/favicon_io/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/favicon_io/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/favicon_io/favicon-16x16.png">
<link rel="manifest" href="<?php echo base_url() ?>assets/favicon_io/site.webmanifest">

  <div id="header-area" class="header_area">

  <div  align="center" class="header_bottom">
  
   
    <a href="#" >
                <span  ><img  src="<?php echo base_url(); ?>images/whitelogo.png" alt="" height="5%" width="9%" style="margin-top:20px;"  /></span>
                <span class="text-toggle"> </span>
              </a><!-- /brand -->

              <div   class="header_bottom pull-right" style="margin-right:2%;margin-top:1%">
        <?php $email=$this->session->userdata('email');  
                    $u_type=$this->user_model->get_usertype($email);
                    $u=$u_type[0]['user_type'];
                   $uname=$u_type[0]['user_name'];
                   ?>

                   <a href="#"  style="color:white;" >
                   <span  ></span>
                   <span class="text-toggle"><? echo "Welcome ".$uname?> </span>
                 </a><!-- /brand -->
                 
        </div>
                  
        </div>
        
    <div class="header_bottom">
  
      <div class="container">
     
        <div class="row">
        
          <nav role="navigation" class="navbar navbar-default mainmenu">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              
            </div>
            
            <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
         
              <ul id="fresponsive" class="nav navbar-nav dropdown">
              
                <li class=""><a href="home_page"> Dashboard</a></li>
               

                  <!--  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>

            <ul class="dropdown-menu">
              <?php if (in_array('createLead', $user_permission)) : ?>
          <li><a href="lead_create">New Lead</a></li>
          <?php endif; ?>
           <?php if (in_array('editLead', $user_permission) || in_array('deleteLead', $user_permission)) : ?>
            <li><a href="managelead">Manage Lead</a></li> <?php endif; ?>
        </ul>

        </li> -->
                  <li ><a  href="<?php echo base_url() ?>account_create"  >All Account <span ></span></a>

                    <!-- <ul class="dropdown-menu">
                      <?php if (in_array('createLead', $user_permission)) : ?>
                        <li><a href="<?php echo base_url() ?>account_create">New Account</a></li>
                      <?php endif; ?>
                      <?php if (in_array('editLead', $user_permission) || in_array('deleteLead', $user_permission)) : ?> -->
                        <!-- <li><a href="<?php echo base_url() ?>managelead">Manage Account</a></li> <?php endif; ?> -->
                    <!-- </ul> --> 

                  </li>
               
                <?php if (in_array('createAppointment', $user_permission) || in_array('editAppointment', $user_permission) || in_array('deleteAppointment', $user_permission)) : ?>
                  <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Appointments <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php if (in_array('createAppointment', $user_permission)) : ?>
                        <li><a href="<?php echo base_url() ?>appointment">Book Appointment</a></li>
                      <?php endif; ?>
                      <?php if (in_array('editAppointment', $user_permission) || in_array('deleteAppointment', $user_permission)) : ?>
                        <li><a href="<?php echo base_url() ?>manage_appointment">Manage Appointment</a></li> <?php endif; ?>
                       <?php if (in_array('editAppointment', $user_permission) || in_array('deleteAppointment', $user_permission) || in_array('createAppointment', $user_permission)) : ?> 
                        <!--  <li class=""><a href="view_appointments">view appointments</a></li> -->
                        <li class=""><a href="<?php echo base_url() ?>google_appointments"> View Appointments</a></li>
                        <?php endif; ?>
                      </ul>
                  </li>
                <?php endif; ?>

                <?php if (in_array('createQuotation', $user_permission) || in_array('editQuotation', $user_permission) || in_array('deleteQuotation', $user_permission) || in_array('createOrder', $user_permission) || in_array('deleteOrder', $user_permission) || in_array('editOrder', $user_permission) )  : ?>
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Quotes & Orders<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <?php if (in_array('createQuotation', $user_permission) || in_array('editQuotation', $user_permission) || in_array('deleteQuotation', $user_permission)) :?>
                    <li><a href="<?php echo base_url() ?>quotation">Quotation</a></li>
                    <?php endif; ?>
                    <?php if(in_array('createOrder', $user_permission) || in_array('deleteOrder', $user_permission) || in_array('editOrder', $user_permission) )  :  ?>
                    <li><a href="<?php echo base_url() ?>manageorder">Order</a></li>
                    <?php endif; ?>

                    <!-- <li><a href="manage_appointment">Manage Appointment</a></li>  -->
                  </ul>
                </li>
                <?php endif; ?>

                <?php if (in_array('createFunnelReport', $user_permission) || in_array('exportFunnelReport', $user_permission) || in_array('createWonReport', $user_permission) || in_array('exportWonReport', $user_permission) || in_array('createLostReport', $user_permission) || in_array('exportLostReport', $user_permission) || in_array('createCustomerReport', $user_permission) || in_array('exportCustomerReport', $user_permission) )  : ?>
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <?php if (in_array('createFunnelReport', $user_permission) || in_array('exportFunnelReport', $user_permission)): ?>
                    <li><a href="<?php echo base_url() ?>funnelreport">Funnel</a></li>
                    <?php endif; ?>
                    <?php if (in_array('createWonReport', $user_permission) || in_array('exportWonReport', $user_permission)): ?>
                    <li><a href="<?php echo base_url() ?>wonreport">Won</a></li>
                    <?php endif; ?>
                    <?php if (in_array('createLostReport', $user_permission) || in_array('exportLostReport', $user_permission)): ?>
                    <li><a href="<?php echo base_url() ?>lostreport">Lost</a></li>
                    <?php endif; ?>
                    <?php if (in_array('createCustomerReport', $user_permission) || in_array('exportCustomerReport', $user_permission)): ?>
                    <li><a href="<?php echo base_url() ?>customerreport">Customer</a></li>
                    <?php endif; ?>

                    <!-- <li><a href="manage_appointment">Manage Appointment</a></li>  -->
                  </ul>
                </li>
                <?php endif; ?>

                <!-- manage -->
                <?php if (in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission) || in_array('createUser', $user_permission) || in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission) || in_array('createDealer', $user_permission) || in_array(
                    'editDealer',
                    $user_permission
                  ) || in_array('deleteDealer', $user_permission) || in_array('createPermissions', $user_permission) || in_array('editPermissions', $user_permission) || in_array('deletePermissions', $user_permission)) : ?>
                  <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Application <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <?php if (in_array('createUser', $user_permission) || in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission)) : ?>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"> User Creation<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <?php if (in_array('createUser', $user_permission)) : ?>
                              <li><a href="<?php echo base_url() ?>user_creation">Add User</a></li><?php endif; ?>
                            <?php if (in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission)) : ?>
                              <li><a href="<?php echo base_url() ?>user_dtl">Manage User</a></li><?php endif; ?>
                            <?php if (in_array('createPermissions', $user_permission) || in_array('editPermissions', $user_permission) || in_array(
                                    'deletePermissions',
                                    $user_permission
                                  )) : ?>
                              <li><a href="<?php echo base_url() ?>permissions">Permissions</a></li>
                            <?php endif; ?>
                          </ul>
                        </li>

                      <?php endif; ?>
                      <?php /*if (in_array('createRelationship', $user_permission) || in_array(
                            'editRelationship',
                            $user_permission
                          ) || in_array('deleteRelationship', $user_permission)) :*/ ?>
                       <!-- <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Relationship <span class="caret"></span> </a>-->
                        <!--  <ul class="dropdown-menu"> -->
                            <?php //if (in_array('createRelationship', $user_permission)) : ?>
                            <!--  <li><a href="<?php //echo base_url() ?>relationship">Add Relationship</a></li><?php// endif; ?>
                            <?php// if (in_array('editRelationship', $user_permission) || in_array('deleteRelationship', $user_permission)) : ?>
                            <!--  <li><a href="<?php// echo base_url() ?>managerelationship">Manage Relationship</a></li><?php //endif; ?>
                        <!--  </ul>-->
                       <!--</li> -->
                      <?php //endif; ?>
                      <!-- <?php if (in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)) : ?>
   <li ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Lead Types <span class="caret"></span></a>
     <ul class="dropdown-menu">
              <?php if (in_array('createLeadType', $user_permission)) : ?>
          <li><a href="newlead_type">Create Lead Types</a></li>
          <?php endif; ?>
           <?php if (in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)) : ?>
            <li><a href="display_lead_type">Manage Lead Types</a></li> <?php endif; ?>
        </ul>
   </li>
   <?php endif; ?>  -->
                      <?php if (in_array('createCustomerType', $user_permission) || in_array('editCustomerType', $user_permission) || in_array('deleteCustomerType', $user_permission)) : ?>
                        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Customer Types <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <?php if (in_array('createCustomerType', $user_permission) || in_array('editCustomerType', $user_permission) || in_array('deleteCustomerType', $user_permission) ) : ?>
                              <li><a href="<?php echo base_url() ?>newcustomer_type">Create Customer Types</a></li>
                            <?php endif; ?>
                            <?php if (in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)) : ?>
                              <!-- <li><a href="<?php echo base_url() ?>display_customer_type">Manage Customer Types</a></li> <?php endif; ?> -->
                          </ul>
                        </li>
                      <?php endif; ?>

                      <?php if (in_array('createCategoryType', $user_permission) || in_array('editCategoryType', $user_permission) || in_array('deleteCategoryType', $user_permission)) : ?>
                        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category Master <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <?php if (in_array('createCategoryType', $user_permission) || in_array('editCategoryType', $user_permission) || in_array('deleteCategoryType', $user_permission)) : ?>
                              <li><a href="<?php echo base_url() ?>newcategory_type">Create Category Types</a></li>
                            <?php endif; ?>
                            <?php if (in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)) : ?>
                              <!-- <li><a href="<?php echo base_url() ?>display_category_type">Manage Category Types</a></li> <?php endif; ?> -->
                          </ul>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <li><a href="<?php echo base_url(); ?>logout" class="nav-link"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                 

              
                
                <?php endif; ?>
              

              </ul>
           
            </div>
            
          </nav>
        </div>
      </div>
    </div><!-- /.header_bottom -->

  </div>
<?php endif; ?>

<script type="text/javascript">
  (function($) {
    $(document).ready(function() {
      $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
      });
    });
  })(jQuery);
</script>
