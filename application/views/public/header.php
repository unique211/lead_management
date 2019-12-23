
<?php if($user_permission): ?>
    <div id="header-area" class="header_area">
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
                            <li class=""><a href="home_page"> Home</a></li>  
      <?php if(in_array('createLead', $user_permission) || in_array('editLead', $user_permission) || in_array('deleteLead', $user_permission)): ?>
        <!--  <li class=""><a href="view_appointments">view appointments</a></li> -->
         <li class=""><a href="google_appointments"> View Appointments</a></li>
       
      <!--  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>

            <ul class="dropdown-menu">
              <?php if(in_array('createLead', $user_permission)): ?>
          <li><a href="lead_create">New Lead</a></li>
          <?php endif; ?>
           <?php if(in_array('editLead', $user_permission) || in_array('deleteLead', $user_permission)): ?>
            <li><a href="managelead">Manage Lead</a></li> <?php endif; ?>
        </ul>

        </li> -->
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Account <span class="caret"></span></a>

            <ul class="dropdown-menu">
              <?php if(in_array('createLead', $user_permission)): ?>
          <li><a href="account_create">New Account</a></li>
          <?php endif; ?>
           <?php if(in_array('editLead', $user_permission) || in_array('deleteLead', $user_permission)): ?>
            <li><a href="managelead">Manage Account</a></li> <?php endif; ?>
        </ul>

        </li>
        <?php endif; ?>
              <?php if(in_array('createAppointment', $user_permission) || in_array('editAppointment', $user_permission) || in_array('deleteAppointment', $user_permission)): ?>
   <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Appointments <span class="caret"></span></a>
     <ul class="dropdown-menu">
              <?php if(in_array('createAppointment', $user_permission)): ?>
          <li><a href="appointment">Book Appointment</a></li>
          <?php endif; ?>
           <?php if(in_array('editAppointment', $user_permission) || in_array('deleteAppointment', $user_permission)): ?>
            <li><a href="manage_appointment">Manage Appointment</a></li> <?php endif; ?>
        </ul>
   </li>
   <?php endif; ?>


   <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Create Quotation <span class="caret"></span></a>
     <ul class="dropdown-menu">
             
          <li><a href="quotation">Quotation</a></li>
          <li><a href="manageorder">Manage Order</a></li>
       
          
            <!-- <li><a href="manage_appointment">Manage Appointment</a></li>  -->
        </ul>
   </li>


         <!-- manage -->
   <?php if(in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)||in_array('createUser', $user_permission) || in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission)||in_array('createDealer', $user_permission) || in_array('editDealer', 
 $user_permission) || in_array('deleteDealer', $user_permission)||in_array('createPermissions', $user_permission) || in_array('editPermissions',$user_permission) || in_array('deletePermissions',$user_permission)): ?>
     <li class="dropdown">

      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Application <span class="caret"></span></a>
     <ul class="dropdown-menu">
        <?php if(in_array('createUser', $user_permission) || in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
   <li ><a href="#" class="dropdown-toggle" data-toggle="dropdown"> User Creation<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <?php if(in_array('createUser', $user_permission)): ?>
      <li><a href="user_creation">Add User</a></li><?php endif; ?>
      <?php if(in_array('editUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
       <li><a href="user_dtl">Manage User</a></li><?php endif; ?>
       <?php if(in_array('createPermissions', $user_permission) || in_array('editPermissions',$user_permission) || in_array('deletePermissions',
  $user_permission)): ?>
    <li><a  href="permissions">Permissions</a></li> 
    <?php endif; ?>
    </ul>
   </li>

 <?php endif; ?>
  <?php if(in_array('createRelationship', $user_permission) || in_array('editRelationship', 
 $user_permission) || in_array('deleteRelationship', $user_permission)): ?>
   <li ><a href="#" class="dropdown-toggle" data-toggle="dropdown">Relationship <span class="caret"></span> </a>
    <ul class="dropdown-menu">
      <?php if(in_array('createRelationship', $user_permission)): ?>
      <li><a href="relationship">Add Relationship</a></li><?php endif; ?>
      <?php if(in_array('editRelationship', $user_permission) || in_array('deleteRelationship', $user_permission)): ?>
       <li><a href="managerelationship">Manage Relationship</a></li><?php endif; ?>
    </ul>
   </li>
 <?php endif; ?> 
   <!-- <?php if(in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
   <li ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Lead Types <span class="caret"></span></a>
     <ul class="dropdown-menu">
              <?php if(in_array('createLeadType', $user_permission)): ?>
          <li><a href="newlead_type">Create Lead Types</a></li>
          <?php endif; ?>
           <?php if(in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
            <li><a href="display_lead_type">Manage Lead Types</a></li> <?php endif; ?>
        </ul>
   </li>
   <?php endif; ?>  -->
   <?php if(in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
   <li ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Customer Types <span class="caret"></span></a>
     <ul class="dropdown-menu">
              <?php if(in_array('createLeadType', $user_permission)): ?>
          <li><a href="newcustomer_type">Create Customer Types</a></li>
          <?php endif; ?>
           <?php if(in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
            <li><a href="display_customer_type">Manage Customer Types</a></li> <?php endif; ?>
        </ul>
   </li>
   <?php endif; ?> 
   
   <?php if(in_array('createLeadType', $user_permission) || in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
   <li ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Category Master <span class="caret"></span></a>
     <ul class="dropdown-menu">
              <?php if(in_array('createLeadType', $user_permission)): ?>
          <li><a href="newcategory_type">Create Category Types</a></li>
          <?php endif; ?>
           <?php if(in_array('editLeadType', $user_permission) || in_array('deleteLeadType', $user_permission)): ?>
            <li><a href="display_category_type">Manage Category Types</a></li> <?php endif; ?>
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
  (function($){
  $(document).ready(function(){
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
      event.preventDefault(); 
      event.stopPropagation(); 
      $(this).parent().siblings().removeClass('open');
      $(this).parent().toggleClass('open');
    });
  });
})(jQuery);
</script>