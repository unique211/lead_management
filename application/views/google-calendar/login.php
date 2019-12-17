<?php $this->load->view('templates/header');?>
<div id="myModal" class=" custom-modal modal fade " role="dialog">
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
         <a href="<?php print $loginUrl; ?>" id="contact-send-a" class="btn btn-primary"> YES</a>
         <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
      </div>
    </div>

  </div></form>
</div>
<div class="container">
  <div class="row">
      <div class="col-md-3">
        
        </div>
        <div class="col-md-6 sec_css" style="">
          <div class=" border-bottom col-md-12">
            <div class="tag_css"><h2>To access google calendar </h2></div>
                    
                </div> 
                 <div class="card-body col-md-7">                
                    <div class="text-center">
                        <a href="<?php print $loginUrl; ?>" id="contact-send-a" class="btn btn-primary ex_css  btn-block rounded-0 "> Login with Google</a>
                    </div>
                    
                </div>
        </div>
  </div>
</div>
 
 <?php $this->load->view('templates/footer');?>        
<!--  <script type="text/javascript">
    $(window).load(function(){        
   $('#myModal').modal('show');
    }); 
 </script> -->