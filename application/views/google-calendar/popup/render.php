  <?php

  	//print_r($eventData);
  /*	exit;*/
  foreach ($eventData as $key => $element) {
  	$synchronize = "";
  	if(!empty($element['synchronize'])){
  		$synchronize = $element['synchronize'];
  	}
    if($synchronize =='local'||$synchronize=='google')
    {
      if($element['resudeal_date'] !="" && $element['reschedultime'] !=""){
        echo '<div class="card-hover marg-bot22" style="border:1px dashed #cecccc; background: #f8f8f8;padding: 6px;" id="google-cal1"><div> Appointment with '.$element['demo_dealer'].' and '.$element['ride_along'].'</div><div> Place: 
        <a target="_blank" href="'.$element['add_url'].' " rel="noopener noreferrer">  '.$element['appointment_address']. '</a></div><div > Reschedual Time : '.$element['reschedultime'].'</div>
       
        <span>'.date('l, F d', strtotime($element['resudeal_date'])).'</span>
        <div > Actual Time : '.$element['start_time'].'</div>
        <span>'.date('l, F d', strtotime($element['start_date'])).'</span>
       
      </div>';
      }else{
    	echo '<div class="card-hover marg-bot22" style="border:1px dashed #cecccc; background: #f8f8f8;padding: 6px;" id="google-cal1"><div> Appointment with '.$element['demo_dealer'].' and '.$element['ride_along'].'</div><div> Place: 
      <a target="_blank" href="'.$element['add_url'].' " rel="noopener noreferrer">  '.$element['appointment_address']. '</a></div><div > Time : '.$element['start_time'].'</div>
     
      <span>'.date('l, F d', strtotime($element['start_date'])).'</span>
    </div>';
      }
    }
    else{
    	// $adr=str_replace(' ', '', $element['location']);
    	echo '<div class="card-hover marg-bot22" style="border:1px dashed #cecccc; background: #f8f8f8;padding: 6px;" id="google-cal1"><div>Google Calendar Appointment</div><div>'.$element['summary'].'</div>
     <div> Place: <a target="_blank" href="https://maps.google.com/?q='.$element['location'].' " rel="noopener noreferrer" >'.$element['location'].'</a> </div><div>Date and Time : '.$element['start_date'].'</div>
     
      <span>'.date('l, F d', strtotime($element['start_date'])).'</span>
    </div>';
    }
    
    //if($element['location']){
      
    	  /*echo'<div class="card-hover marg-bot22" style="border:1px dashed #cecccc; background: #f8f8f8;padding: 6px;" id="google-cal1"><div> '.$element['description'].'</div><div> Date and Time : '.$element['location'].'
      <a target="_blank" href=" " rel="noopener noreferrer"> </a></div><div >Time : '.$element['start_date'].'</div>
     
      <span>'.date('l, F d', strtotime($element['start_date'])).'</span>
    </div>';*/
   // }
  
  }
  ?>