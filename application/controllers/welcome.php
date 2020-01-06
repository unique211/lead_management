<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	public function index()
	{
		/*$u_type='Secretary';
		$get=$this->user_model->get_permissions($u_type);
		
		$data['user_permission']=unserialize($get[0]['permissions']);*/
		
	$email=$this->session->userdata('email');
		if($email)
		{
			$data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
        $data['body']="static/user/user_appointment-booking";
		$data['lead_type']=$this->user_model->get_lead_type();
			
                $email=$this->session->userdata('email');
           
        $u_type=$this->user_model->get_usertype($email);
        
        $u=$u_type[0]['user_type'];
     
        $get=$this->user_model->get_permissions($u);
		
		$data['user_permission']=unserialize($get[0]['permissions']);
		  $data['records1']=$this->lead_management->dealer_display_data();
		//$data['cal_id']=$this->GoogleCalendar->GetCalendarsList();
			 $data['body']="static/user/appointment_booking1";
		
			 redirect('view_appointments');
		}
		else{
			$data['layout']="public/layout1";
		$data['body']="static/user/login";
		$this->load->view('welcome_message',$data);
		}	
	}
	function get_dealers_data($lead){
			$rec=$this->user_model->get_dealers_data($lead);
			//print_r($rec);exit;
		echo json_encode($rec);
	}
	function get_lead_data_appointment($lead){
		$rec=$this->user_model->get_lead_data_appointment($lead);
		echo json_encode($rec);
	}
	function login()
	{
		if($this->session->userdata('email'))
		{
			
  $email=$this->session->userdata('email');
           
	        $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
			$data['name']=$u_type[0]['user_name'];

			
			$get=$this->user_model->get_permissions($u);
		
			
			$data['user_permission']=unserialize($get[0]['permissions']);
	$data['layout']='public/layout';
	$data['header']='public/header';
	$data['footer']='public/footer';
	$data['body']='static/user/home_page';
	$this->load->view('welcome_message',$data);
		}else{
			$data['layout']="public/layout1";
			$data['body']="static/user/login";
			$this->load->view('welcome_message',$data);
		}
		//print_r("hbj");exit();
		
		
	}
	function view_local_appointments()
	{
			if($this->session->userdata('email')==''){redirect('/');}
			$email=$this->session->userdata('email');

			$u_type=$this->user_model->get_usertype($email);
		    
		    $u=$u_type[0]['user_type'];

		    $get=$this->user_model->get_permissions($u);

			$data['user_permission']=unserialize($get[0]['permissions']);
			$data['layout']="public/layout";
			$data['header']="public/header";
		    $data['footer']="public/footer";
			$data['body']="static/user/view_local_appointments";
			//$data['result'] = $this->db->get("events")->result();
          $data['result']=$this->user_model->get_appoinments();
      
     /*     foreach ( $data['result'] as $key) {
          	# code...
          	 $data['data'][$key]['title'] = 'appointment with '.$key['demo_dealer'].' and '.$key['ride_along'].' at '.$key['start_time'];
            $data['data'][$key]['start'] = $key['appointment_date'];
            //$data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
             
          }*/
        foreach ($data['result'] as $key => $value) {

            $data['data'][$key]['title'] = 'Appointment with'.$value['demo_dealer'].' and '.$value['ride_along'].' at '.$value['start_time'];
            $data['data'][$key]['start'] = $value['start_date'];
            //$data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
        }
           
       	$this->load->view('welcome_message',$data);
    }	
    public function home_page_view()
{
	$email=$this->session->userdata('email'); 
	if($email) {
		//print_r($email);exit();   
	        $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
			$data['name']=$u_type[0]['user_name'];
	        $get=$this->user_model->get_permissions($u);
			
			$data['user_permission']=unserialize($get[0]['permissions']);
			// $data['records']=$this->lead_management->display_data_home($email);
			//$data['records']=$this->lead_management->display_data();
			 //print_r($data['records']);exit();

	$data['layout']='public/layout';
	$data['header']='public/header';
	$data['footer']='public/footer';
	$data['body']='static/user/home_page';
	$this->load->view('welcome_message',$data);
}else{
	$data['layout']="public/layout1";
		$data['body']="static/user/login";
		$this->load->view('welcome_message',$data);
}
	
}
	public function delete_relationship($id)
	{
		$this->user_model->delete_relationship($id);
		
	}
function get_relationship_record($id){
	$rec=$this->user_model->get_relationship_record($id);
		echo json_encode($rec);
}

function managerelationship(){
	$email=$this->session->userdata('email');
   	if($email){
   		$u_type=$this->user_model->get_usertype($email);
				        $u=$u_type[0]['user_type'];
				        $get=$this->user_model->get_permissions($u);
						$user_id=$this->user_model->user_id($email);
						$data['user_permission']=unserialize($get[0]['permissions']);
						 $user_id=$this->user_model->user_id($email);
						  $data['layout']="public/layout";
				        $data['header']="public/header";
				        $data['footer']="public/footer";
				        $data['records']=$this->user_model->get_relations();
						 $data['body']="static/user/edit_relationship";

						$this->load->view('welcome_message',$data);
   	}
}
function relationship()
{
   			$email=$this->session->userdata('email');
   			if($email){
   					if($this->input->post('submit')){
    					$relation=$this->input->post('relationship');
    					$this->user_model->insert_relations($relation);
    					$this->session->set_flashdata('msg_relation', ' data saved');
    					redirect('relationship');
   					}else{
   						$u_type=$this->user_model->get_usertype($email);
				        $u=$u_type[0]['user_type'];
				        $get=$this->user_model->get_permissions($u);
						$user_id=$this->user_model->user_id($email);
						$data['user_permission']=unserialize($get[0]['permissions']);
						 $user_id=$this->user_model->user_id($email);
						  $data['layout']="public/layout";
				        $data['header']="public/header";
				        $data['footer']="public/footer";
						 $data['body']="static/user/relationship";

						$this->load->view('welcome_message',$data);
   					}
   			} else{
   				redirect('login');
   			}    
	        
}
function logincode()
{

	if($this->input->post('login'))
	{
		
		$e=$this->input->post('email');
		$p=$this->input->post('password');
		$password=md5($p);
	 $x=$this->user_model->log($e,$password);
		//print_r($x);exit();
		if($x)
		{
			 $data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
       
			//session declare
			   $usersession = array(
					'email' =>$x[0]['email'],
					'useruniqueid' =>$x[0]['id'],
					'userrole' =>$x[0]['user_role'],
					'first_name' =>$x[0]['first_name'],
					'last_name' =>$x[0]['last_name'],
					 'calendar_id'=>$x[0]['google_calendar_id'],
                    #'emp_id' =>$x[0]->emp_id
                    'user_type'=>$x[0]['user_type']
                                
                );

			   $this->session->set_userdata($usersession);
			   $this->subscribeUser();
                $email=$this->session->userdata('email');
         
		        $u_type=$this->user_model->get_usertype($email);

		         $user_id=$this->user_model->user_id($email);
		        $u=$u_type[0]['user_type'];
				$data['name']=$u_type[0]['user_name'];

			
		       
		        $get=$this->user_model->get_permissions($u);
				
					$data['user_permission']=unserialize($get[0]['permissions']);
				  $data['records1']=$this->lead_management->dealer_display_data($user_id);
					 $data['body']="static/user/home_page";
				$this->load->view('welcome_message',$data);
			 
		}
		else
		{
			//echo "login fail";
			$data['layout']="public/layout1";
		$data['body']="static/user/login";
		$this->load->view('welcome_message',$data);
		}
		

	}
}
public function logout()
{
	 $this->session->unset_userdata($usersession);
        $this->session->sess_destroy();
        redirect('login');
}
 public function check_lead_duplicate()
 {
 	$f_name=$this->input->post('f_name');
 	$l_name=$this->input->post('l_name');
 	$result=$this->user_model->check_lead($f_name,$l_name);
 	if($result>0)
 	{
 		echo "duplicate";
 	}
 }
function dashboard()
{
	//print_r($this->session->userdata('email'));exit();
	if($this->session->userdata('email')==''){redirect('/');}
	$email=$this->session->userdata('email');
	//print_r($email);exit();
	$u_type=$this->user_model->get_usertype($email);
    //print_r($u_type);exit();
    $u=$u_type[0]['user_type'];
    //print_r($u);exit();
    $get=$this->user_model->get_permissions($u);
	//print_r($get);exit();
	$data['user_permission']=unserialize($get[0]['permissions']);
	$data['layout']="public/layout";
	$data['header']="public/header";
    $data['footer']="public/footer";
      $data['records1']=$this->lead_management->dealer_display_data();
	$data['body']="static/user/appointment_booking1";
	$this->load->view('welcome_message',$data);
}

function logoutcode()
{
	$this->session->sess_destroy();
    //redirect('login');
    redirect('login', 'refresh');
}
  public function appointment_booking()
   {
   		if($this->session->userdata('email')==''){redirect('/');}
        $email=$this->session->userdata('email'); 
         $user_id=$this->user_model->user_id($email);	    
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
		//print_r($get);exit();
		$data['user_permission']=unserialize($get[0]['permissions']);
   	    $data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
      //  print_r($user_id);exit;
		$data['leads']=$this->user_model->get_leads($user_id);
		
		$data['customer']=$this->user_model->getcustomername($user_id);

		$data['salesreprentative']=$this->user_model->getreprentative($user_id);
        //print_r($this->user_model->get_leads($user_id));
       // exit;
          $data['records1']=$this->lead_management->dealer_display_data($user_id);
        $data['body']="static/user/appointment_booking1";
          // $this->session->set_flashdata('msg', ' data saved');
		$this->load->view('welcome_message',$data); 
}

	public function app_booking()
	{
		
		if($this->input->post('ap_submit'))
		{
	       $date=$this->input->post('ap_date');
	       $gift=$this->input->post('gift');
	       $demo_dealer=$this->input->post('demo_dealer');
	       $ride=$this->input->post('ride');
	       $setby=$this->input->post('setby');
	       $addr=$this->input->post('ap_addr');
	       $notes=$this->input->post('ap_notes');
	        $reg = array(
     		'user_id'		=>'120',
     		 'appointment_date'		=>$date,
            'gift'		=>$gift,
           'demo_dealer'=> $demo_dealer,
            'ride_along'=> $ride,
            'set_by'		=>$setby,
            'appointment_address'		=>$addr,
            'appointment_notes'	=>$notes 
        ); 
	     $result=$this->user_model->app_info_insert($reg);
	     	$email=$this->session->userdata('email');     
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
		
		$data['user_permission']=unserialize($get[0]['permissions']);
		    $data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
        $data['body']="static/user/appointment_booking1";
        $this->session->set_flashdata('a_msg', 'data saved');
		$this->load->view('welcome_message',$data);
	  
	}
}
	public function managelead()
	{
				$email=$this->session->userdata('email'); 
				if($email){
					 $u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
		         $user_id=$this->user_model->user_id($email);	
				$data['user_permission']=unserialize($get[0]['permissions']);
				if($this->input->post('filter_submit')){
					$from_date=$this->input->post('min');
					$to_date=$this->input->post('max');
					$data['records']=$this->user_model->filter_lead_data($from_date,$to_date,$user_id);
				}
				else{
					$data['records']=$this->user_model->get_lead_data($user_id);
				}
				$data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/view_editlead";
				$this->load->view('welcome_message',$data);
			} else{
				redirect('login');
			}   
		          
	}
	public function dispaly_manage_appointment()
	{
		
			$email=$this->session->userdata('email');
			if($email){
					    $u_type=$this->user_model->get_usertype($email);
				        $u=$u_type[0]['user_type'];
				        $get=$this->user_model->get_permissions($u);
						
						$data['user_permission']=unserialize($get[0]['permissions']);

			            $user_id=$this->user_model->user_id($email);
			            if($u=='Admin')
			            {
			            	
			            	if($this->input->post('filter_submit')){
			            		$from=$this->input->post('min');
			            		$to=$this->input->post('max');
			            		$data['records']=$this->user_model->filter_appointment_data($from,$to,$user_id);
			            	}
			            	else{
			            		$data['records']=$this->user_model->get_admin_appointment_data();
			            	}
			            				            	
			            }
			            else
			            {
			            	if($this->input->post('filter_submit')){
			            		$from=$this->input->post('min');
			            		$to=$this->input->post('max');
			            		$data['records']=$this->user_model->filter_appointment_data($from,$to,$user_id);
			            	}
			            	else{
			            		$data['records']=$this->user_model->get_appointment_data($user_id);
			            	}
			            	 
			            }
						  $data['users']=$this->user_model->get_users_list($user_id);

						    $data['layout']="public/layout";
				        $data['header']="public/header";
				        $data['footer']="public/footer";
				        $data['body']="static/user/view_appointment";
						$this->load->view('welcome_message',$data);	
			}else{
				redirect('login');
			}     

	}
	public function addlead_type()
	{
	   $email=$this->session->userdata('email');
	   if($email){
	   	    if($this->input->post('submit'))
				{
					$email=$this->session->userdata('email');     
					$l_type=$this->input->post('lead_type');
					$l_source=$this->input->post('source');
					$l_dealer=$this->input->post('l_dealer');
					$sublead=$this->input->post('sublead');
					$user_id=$this->user_model->user_id($email);
					$rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
					 $this->session->set_flashdata('msglp', 'data saved');
				}
			$email=$this->session->userdata('email');     
	        $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
	        $get=$this->user_model->get_permissions($u);
			$user_id=$this->user_model->user_id($email);
			$data['user_permission']=unserialize($get[0]['permissions']);
			 $user_id=$this->user_model->user_id($email);
			// $data['lead_source']=$this->user_model->get_lead_users();
			   //$data['records']=$this->user_model->get_appointment_data($user_id);
			   $data['records1']=$this->lead_management->dealer_display_data($user_id);
			    $data['layout']="public/layout";
	        $data['header']="public/header";
	        $data['footer']="public/footer";
	        $data['body']="static/user/new_lead_type";
			$this->load->view('welcome_message',$data);
	   }else{
	   	redirect('login');
	   }
		
	}
	
	public function addcustomer_type()
	{
	   $email=$this->session->userdata('email');
	   if($email){
	   	    if($this->input->post('submit'))
				{
					$email=$this->session->userdata('email');     
					$l_type=$this->input->post('lead_type');
					$l_source=$this->input->post('source');
					$l_dealer=$this->input->post('l_dealer');
					$sublead=$this->input->post('sublead');
					$user_id=$this->user_model->user_id($email);
					$rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
					 $this->session->set_flashdata('msglp', 'data saved');
				}
			$email=$this->session->userdata('email');     
	        $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
	        $get=$this->user_model->get_permissions($u);
			$user_id=$this->user_model->user_id($email);
			$data['user_permission']=unserialize($get[0]['permissions']);
			 $user_id=$this->user_model->user_id($email);
			// $data['lead_source']=$this->user_model->get_lead_users();
			   //$data['records']=$this->user_model->get_appointment_data($user_id);
			   $data['records1']=$this->lead_management->dealer_display_data($user_id);
			    $data['layout']="public/layout";
	        $data['header']="public/header";
	        $data['footer']="public/footer";
	        $data['body']="static/user/new_customer_type";
			$this->load->view('welcome_message',$data);
	   }else{
	   	redirect('login');
	   }
		
	}
	
	public function addcategory_type()
	{
	   $email=$this->session->userdata('email');
	   if($email){
	   	    if($this->input->post('submit'))
				{
					$email=$this->session->userdata('email');     
					$l_type=$this->input->post('lead_type');
					$l_source=$this->input->post('source');
					$l_dealer=$this->input->post('l_dealer');
					$sublead=$this->input->post('sublead');
					$user_id=$this->user_model->user_id($email);
					$rec=$this->user_model->add_new_lead($user_id,$l_type,$l_source,$l_dealer,$sublead);
					 $this->session->set_flashdata('msglp', 'data saved');
				}
			$email=$this->session->userdata('email');     
	        $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
	        $get=$this->user_model->get_permissions($u);
			$user_id=$this->user_model->user_id($email);
			$data['user_permission']=unserialize($get[0]['permissions']);
			 $user_id=$this->user_model->user_id($email);
			// $data['lead_source']=$this->user_model->get_lead_users();
			   //$data['records']=$this->user_model->get_appointment_data($user_id);
			   $data['records1']=$this->lead_management->dealer_display_data($user_id);
			    $data['layout']="public/layout";
	        $data['header']="public/header";
	        $data['footer']="public/footer";
	        $data['body']="static/user/new_category_type";
			$this->load->view('welcome_message',$data);
	   }else{
	   	redirect('login');
	   }
		
	}
	/*public function view_lead_type()
	{
		if($this->session->userdata('email')!='')
		{
			     	$email=$this->session->userdata('email');     
		        $u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
				
				$data['user_permission']=unserialize($get[0]['permissions']);
				    $data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/new_lead_type";
				$this->load->view('welcome_message',$data);
		}
		else
	   {
	   	$this->session->sess_destroy();
        redirect('login');
	   }
	}*/
	public function get_leads(){
		$rec=$this->user_model->get_leads_data();
		echo json_encode($rec);
	}
	public function get_users(){
		$rec=$this->user_model->get_users();
		echo json_encode($rec);
	}
	public function get_lead_record($id)
	{
		$rec=$this->user_model->get_lead_record($id);
		echo json_encode($rec);
	}

	public function get_appointment_records($id)
	{
		$rec=$this->user_model->get_appointment_details($id);
		echo json_encode($rec);
	}
	public function lead_type_depdent()
	{

		$l_type=$_POST['l_type'];
		$rec=$this->user_model->get_lead_source($l_type);
		$r=json_encode($rec);
		echo $r;
		//exit();
		//echo json_encode($rec);
	}
	public function lead_source_depdent()
	{
		$l_type=$_POST['l_type'];
		$l_source=$_POST['l_source'];
		$rec=$this->user_model->get_lead_dealer($l_type,$l_source);
		$r=json_encode($rec);
		echo $r;
	}
	public function update_lead()
	{
     if($this->input->post('submit'))
     {
     	$id=$this->input->post('empid');

       $record=array('first_name'=>$this->input->post('f_name'),
       					'last_name'=>$this->input->post('l_name'),
       					'gender'=>$this->input->post('gender'),
       					'martial_status'=>$this->input->post('m_status'),
       					'email'=>$this->input->post('email'),
       					'mobile'=>$this->input->post('phone'),
       					'user_address'=>$this->input->post('address'),
       					'residence'=>$this->input->post('residence'),
       					'user_job'=>$this->input->post('job'),
       					'user_office_branchname'=>$this->input->post('branch'),

       					'lead_type'=>$this->input->post('l_type'),
       					'lead_source'=>$this->input->post('l_source'),

						'lead_dealer'=>$this->input->post('l_dealer'),
						'lead_date'=>$this->input->post('l_date'),
						'lead_status'=>$this->input->post('l_status'),
						'lead_note'=>$this->input->post('l_note'),
						'relation'=>$this->input->post('relationship')

   );
       	$rec=$this->user_model->set_lead_record($id,$record);
       	$this->session->set_flashdata('e_l_msg', ' data updated');
       	redirect('managelead');
     }
	}

	public function set_user_permissions()
	{
			      if ($this->input->post('submit')) {
		            // true case

		            $permission = serialize($this->input->post('permission'));
		            
		        	$data = array(
		        		
		        		'user_type' => $this->input->post('user_type'),
		        		'permissions' => $permission
		        	);
		        	$user_type=$this->input->post('user_type');
		        	$this->user_model->set_userpermissions($data,$user_type);
		        }
		         $this->session->set_flashdata('permissions_update', 'permissions updated');
		        redirect('permissions');	
}
	public function permission_page()
	{
			$email=$this->session->userdata('email');
			if($email){
				   $u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
				$data['pagename']=$this->user_model->get_pages();
				$data['user_permission']=unserialize($get[0]['permissions']);

				$data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/user_info";
				$this->load->view('welcome_message',$data);
			}else{
				redirect('login');
			}     
     
	}
	public function edit_reltionship_details(){
		if($this->input->post('submit')){
			$id=$this->input->post('relationid');
			$relation=$this->input->post('relation');
			$this->user_model->update_relationship($id,$relation);
			   $this->session->set_flashdata('msg_relation', 'data saved');
        redirect('managerelationship');
		}
	}
	public function user_info()
	{
	
			if($this->input->post('lead_submit'))
		{
			 $email=$this->session->userdata('email');  
			 $user_id=$this->user_model->user_id($email);   
		   $fname=$this->input->post('fname');
		   $lname=$this->input->post('lname');
		   $gender=$this->input->post('gender');
		   $email=$this->input->post('email');   
		   $phn=$this->input->post('phn');
		   $u_addr=$this->input->post('u_addr');
		   $residence=$this->input->post('residence');
		   $job=$this->input->post('job');
		   $br_name=$this->input->post('br_name');
		   $l_type=$this->input->post('l_type');
		   $l_source=$this->input->post('l_source');
		   $relation=$this->input->post('relation');
		   $l_dealer=$this->input->post('l_dealer');
		   $l_status=$this->input->post('l_status');
		   $l_note=$this->input->post('l_note');
		   $m_status=$this->input->post('m_status');
		   $l_date=$this->input->post('l_date');
		   $s_fname=$this->input->post('s_fname');
		   $f_lname=$this->input->post('s_lname');
		   $s_email=$this->input->post('s_email');
		   $s_phone=$this->input->post('s_phn');
		   $s_job=$this->input->post('s_job');
		   $s_age=$this->input->post('s_age');
		   $sec_fname=$this->input->post('sec_fname');
		   $sec_lname=$this->input->post('sec_lname');
		   $sec_email=$this->input->post('sec_email');
		   $sec_phone=$this->input->post('sec_phn');
		   $sec_job=$this->input->post('sec_job');
		   $reg = array(
     		 	'user_id'=>$user_id,
     		'first_name'		=>$fname,
     		 'last_name'		=>$lname,
            'gender'		=>$gender,
            'martial_status'=>$m_status,
           'email'=> $email,
            'mobile'=> $phn,
            'user_address'		=>$u_addr,
            'residence'		=>$residence,
            'user_job'	=>$job,
            'user_office_branchname'=>$br_name,
            'lead_date'=>$l_date,
            'lead_type'=>$l_type,
            'lead_source'=>$l_source,
            'relation'=>$relation,
            'lead_dealer'=>$l_dealer,
            'lead_status'=>$l_status,
            'lead_note'=>$l_note,
            'spouse_first_name'=>$s_fname,
            'spouse_last_name'=>$f_lname,
            'spouse_email'=>$s_email,
            'spouse_phone'=>$s_phone, 
            'spouse_job'=>$s_job,
            'spouse_age'=>$s_age,
            'sec_fname'=>$sec_fname,
            'sec_lname'=>$sec_lname,
            'sec_email'=>$sec_email, 
            'sec_phone'=>$sec_phone, 
            'sec_job'=>$sec_job
        ); 
		  
	/*	   if($m_status=='Married'){
		   		$reg = array(
     		 	'user_id'=>$user_id,
     		'first_name'		=>$fname,
     		 'last_name'		=>$lname,
            'gender'		=>$gender,
            'martial_status'=>$m_status,
           'email'=> $email,
            'mobile'=> $phn,
            'user_address'		=>$u_addr,
            'residence'		=>$residence,
            'user_job'	=>$job,
            'user_office_branchname'=>$br_name,
            'lead_date'=>$l_date,
            'lead_type'=>$l_type,
            'lead_source'=>$l_source,
            'relation'=>$relation,
            'lead_dealer'=>$l_dealer,
            'lead_status'=>$l_status,
            'lead_note'=>$l_note,
            'spouse_first_name'=>$s_fname,
            'spouse_last_name'=>$f_lname,
            'spouse_email'=>$s_email,
            'spouse_phone'=>$s_phone, 
            'spouse_job'=>$s_job,
            'spouse_age'=>$s_age     
        ); 
		   }else{
		   	     		 $reg = array(
     		 	'user_id'=>$user_id,
     		'first_name'		=>$fname,
     		 'last_name'		=>$lname,
            'gender'		=>$gender,
            'martial_status'=>$m_status,
           'email'=> $email,
            'mobile'=> $phn,
            'user_address'		=>$u_addr,
            'residence'		=>$residence,
            'user_job'	=>$job,
            'user_office_branchname'=>$br_name,
            'lead_date'=>$l_date,
            'lead_type'=>$l_type,
            'lead_source'=>$l_source,
            'relation'=>$relation,
            'lead_dealer'=>$l_dealer,
            'lead_status'=>$l_status,
            'lead_note'=>$l_note       
        ); 
		   }*/

		   
		    $result=$this->user_model->insert_userdata($reg);
		    	//$u_type='Secretary';
		 $email=$this->session->userdata('email');     
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
  
        $this->session->set_flashdata('lead1', 'data saved');
        redirect('user_information');
		//$this->load->view('welcome_message',$data);
		}
		else
		{
			//$u_type='Secretary';
			 $email=$this->session->userdata('email'); 
			 if($email){
			 	  $u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
		        $user_id=$this->user_model->user_id($email);
				//print_r($get);exit();
				   $data['lead_type']=$this->user_model->get_lead_type();
				$data['user_permission']=unserialize($get[0]['permissions']);
				$data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['leads']=$this->user_model->get_leads($user_id);
		        $data['relation']=$this->user_model->get_relations();
		        $data['records1']=$this->lead_management->dealer_display_data($user_id);
		        $data['body']="static/user/user_appointment-booking";
				$this->load->view('welcome_message',$data);
			 }else{
			 	redirect('login');
			 }    
      
		}     
	}
   
    function delete_lead_code($id)
    {

    	$this->user_model->delete_lead($id);
	$this->session->set_flashdata('l_msg', 'User data created');
	  
	  echo "success";
    }
   
    function edit_appointment_form()
    {

		    	if($this->input->post('app_details'))
		     {
		     	$id=$this->input->post('empid');

		       $record=array('user_id'=>$this->input->post('u_id'),
		       					'appointment_date'=>$this->input->post('app_date'),
		       					'demo_dealer'=>$this->input->post('demo_dealer'),
		       					'appointment_address'=>$this->input->post('app_addr'),

								'gift'=>$this->input->post('gift')
		   );
		      /* print_r($record);exit();*/
		       	$rec=$this->user_model->get_app_record($id,$record);
		       	/* print_r($rec);exit();*/
		       	redirect('manage_appointment');
		     }	
    }

    function edit_page_access($u_type)

    {
    	//print_r($u_type);exit();
    	$rec=$this->user_model->get_page_details($u_type);
  /*  	$j=json_encode($rec);
   	print_r($j);exit();*/
     $page=unserialize($rec[0]['permissions']);
     $x='';
    for($i=0;$i<count($page);$i++)
    {
     $x=$x.$page[$i].',';
    }
     

		echo $x;
    }
    function lead_type_details()
    {
				$email=$this->session->userdata('email');
				if($email){
				$u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
				$user_id=$this->user_model->user_id($email);
				$data['user_permission']=unserialize($get[0]['permissions']);
				$data['records']=$this->user_model->get_leadtype_data($user_id);
				    $data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/view_lead_type";
				$this->load->view('welcome_message',$data);
				}else{
					redirect('login');
				}     

	   
    }
	function customer_type_details()
    {
				$email=$this->session->userdata('email');
				if($email){
				$u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
				$user_id=$this->user_model->user_id($email);
				$data['user_permission']=unserialize($get[0]['permissions']);
				$data['records']=$this->user_model->get_leadtype_data($user_id);
				    $data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/view_customer_type";
				$this->load->view('welcome_message',$data);
				}else{
					redirect('login');
				}     

	   
    }
	
	function category_type_details()
    {
				$email=$this->session->userdata('email');
				if($email){
				$u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		        $get=$this->user_model->get_permissions($u);
				$user_id=$this->user_model->user_id($email);
				$data['user_permission']=unserialize($get[0]['permissions']);
				$data['records']=$this->user_model->get_leadtype_data($user_id);
				    $data['layout']="public/layout";
		        $data['header']="public/header";
		        $data['footer']="public/footer";
		        $data['body']="static/user/view_category_type";
				$this->load->view('welcome_message',$data);
				}else{
					redirect('login');
				}     

	   
    }
    public function get_leadtype_record($id)
	{
		$rec=$this->user_model->get_leadtype_record($id);
		echo json_encode($rec);
	}
	public function update_lead_type_details()
	{
		if($this->input->post('submit'))
     {
     	$id=$this->input->post('empid');

       $record=array('lead_type'=>$this->input->post('lead_type')
  	 );
       	$rec=$this->user_model->set_leadtype_record($id,$record);
       	redirect('display_lead_type');
     }
	}
	public function delete_lead_type($id)
	{
		$this->user_model->delete_lead_type($id);
		echo "success";
	}


	/*================- Admin pages functions -==========*/
	/*public function index()
	{

		$data['layout']='public/layout';
	   $data['header']='public/header';
	   $data['footer']='public/footer';
	   $data['records']=$this->lead_management->display_data();
	  $data['body']='static/admin/create_user';

		$this->load->view('welcome_message',$data);
	}*/
	public function create_user_data()
	{
		
		 $email=$this->session->userdata('email');  
		 if($email){

		if(isset($_POST['create_user']))
		{
			 $email=$this->session->userdata('email'); 
			 $user_id=$this->user_model->user_id($email);
		  $emp_id=$this->input->post('emp_id');
		  $user_name=$this->input->post('user_name');
		  $fisrt_name=$this->input->post('fisrt_name');
		  $last_name=$this->input->post('last_name');
		  $email=$this->input->post('email');
		  $password=$this->input->post('password');
		  $p=md5($password);
		  $phone_number=$this->input->post('phone_number');
		  $user_type=$this->input->post('user_type');
		  $gender=$this->input->post('gender');
		  $google_id=$this->input->post('google_id');
		  $title=$this->input->post('title');
		  $department=$this->input->post('department');
		  $comments=$this->input->post('comments');
		 // $this->load->model('lead_management');
		  $user_role=$this->input->post('user_role');
		  $region=$this->input->post('d_region');
		  $region_type=$this->input->post('d_region_type');
		  $company=$this->input->post('d_company_name');
		  $addr=$this->input->post('d_address');
		  $currentfcyearamt=$this->input->post('currentfcyearamt');
		 // print_r(expression)
		  $this->lead_management->insert_user_data($user_id,$emp_id,$user_name,$fisrt_name,$last_name,$email,$p,$phone_number,$user_type,$gender,$google_id,$title,$department,$comments,$user_role,$region,$region_type,$company,$addr,$currentfcyearamt);
		  $this->session->set_flashdata('msg', 'User data saved');
		  
		 redirect('user_creation');
		 
		}else{
				$u_type=$this->user_model->get_usertype($email);
		        $u=$u_type[0]['user_type'];
		         $user_id=$this->user_model->user_id($email);
		        $get=$this->user_model->get_permissions($u);
				//print_r($get);exit();
				$data['user_permission']=unserialize($get[0]['permissions']);
				$data['layout']='public/layout';
			   $data['header']='public/header';
			   $data['footer']='public/footer';
			   //$data['records']=$this->lead_management->display_data();
			  $data['body']='static/admin/create_user';
				$this->load->view('welcome_message',$data);
		}

		 }else{
		 	redirect('login');
		 }   
    

	}
	public function create_dealer_data()
	{
		 $email=$this->session->userdata('email');     
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
		//print_r($get);exit();
		$data['user_permission']=unserialize($get[0]['permissions']);
		 $data['layout']='public/layout';
			   $data['header']='public/header';
			   $data['footer']='public/footer';
			   //$data['records']=$this->lead_management->display_data();
			  $data['body']='static/admin/create_dealer';
			   $user_id=$this->user_model->user_id($email);
				$this->load->view('welcome_message',$data);
		if(isset($_POST['dealer_creation']))
		{
		  $dealer_id=$_POST['dealer_id'];
		  $d_first_name=$_POST['d_first_name'];
		  $d_last_name=$_POST['d_last_name'];
		  $d_email=$_POST['d_email'];
		  $d_phone_number=$_POST['d_phone_number'];
		  $d_company_name=$_POST['d_company_name'];
		  $d_region=$_POST['d_region'];
		  $d_region_type=$_POST['d_region_type'];
		  $d_address=$_POST['d_address'];
		 
		$this->load->model('lead_management');
		$this->lead_management->insert_dealer_data($user_id,$dealer_id,$d_first_name,$d_last_name,$d_email,$email,$d_phone_number,$d_company_name,$d_region,$d_region_type,$d_address);
				  echo "sussess";
				

		   $this->session->set_flashdata('msg2', 'Dealer data saved');
		 redirect('create_dealer');

		}
	}
	function display_data_emp()
{
	//print_r("kujhbkj");exit();
	$email=$this->session->userdata('email'); 
	if($email){
		     $u_type=$this->user_model->get_usertype($email);
	        $u=$u_type[0]['user_type'];
	        $get=$this->user_model->get_permissions($u);
			 $user_id=$this->user_model->user_id($email);
			$data['user_permission']=unserialize($get[0]['permissions']);
			  $data['records']=$this->lead_management->display_data($user_id);
			    $data['layout']="public/layout";
	        $data['header']="public/header";
	        $data['footer']="public/footer";
	        $data['body']='static/admin/edit_users';
			$this->load->view('welcome_message',$data);
		}else{
			redirect('login');
		}    
	   

	

}
function edit_data($id)
{
	$arr=$this->lead_management->sales_rep_view($id);

	$arr1=json_encode($arr);

	echo $arr1;
}
function edit_sales_rep_data()
{

		if($this->input->post('sales_rep_edit'))
	{

		 $id=$this->input->post('s_r_id');		
		$f_name=$this->input->post('f_name');
		$l_name=$this->input->post('l_name');
		$u_name=$this->input->post('user_name');
		$email=$this->input->post('email');
		$gender=$this->input->post('gender');
		$phone=$this->input->post('phone');
			$user_role=$this->input->post('user_role');
		$c_name=$this->input->post('c_name');
		$region=$this->input->post('region');
		$region_type=$this->input->post('region_type');
		$u_type=$this->input->post('u_type');
		$cal_id=$this->input->post('cal_id');
		$u_title=$this->input->post('u_title');
		$department=$this->input->post('department');
		$comments=$this->input->post('comments');
		$address=$this->input->post('address');
		$currentfcyearamt=$this->input->post('currentfcyearamt');
		$this->lead_management->edit_sales_rep_data_code($id,$f_name,$l_name,$u_name,$email,$gender,$phone,$user_role,$c_name,$region,$region_type,$u_type,$cal_id,$u_title,$department,$comments,$address,$currentfcyearamt);
		 $this->session->set_flashdata('edit_userdata', 'data updated ');
		redirect('user_dtl');
	}
}

function delete_sales_representatives($id)
{
	
	$this->lead_management->delete_sales_rep_data_code($id);
	echo "success";
}

function dealer_detail_display()
{
	 $email=$this->session->userdata('email');     
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
         $user_id=$this->user_model->user_id($email);
		//print_r($get);exit();
		$data['user_permission']=unserialize($get[0]['permissions']);
	$data['records']=$this->lead_management->dealer_display_data_edit($user_id);
	$data['layout']='public/layout';
	$data['header']='public/header';
	$data['footer']='public/footer';
	$data['body']='static/admin/dealer_details';
	$this->load->view('welcome_message',$data);
}
function dealer_edit_data($id)
{
	$arr=$this->lead_management->dealer_rep_view($id);

	$arr1=json_encode($arr);

	echo $arr1;
}
function edit_dealer_rep_data()
{
	if($this->input->post('dealer_rep_edit'))
	{
		 $id=$this->input->post('d_r_id');
		
		$d_r_f_name=$this->input->post('d_r_f_name');
		$d_r_email=$this->input->post('d_r_email');
		$d_phone_num=$this->input->post('d_phone_num');
		$this->lead_management->edit_dealer_rep_data_code($id,$d_r_f_name,$d_r_email,$d_phone_num);
		redirect('dealer_dtl');
	}
}
function delete_dealer_rep($id)
{
	$this->lead_management->delete_dealer_rep_data_code($id);
	echo "success";
}

//call the 

function getAccessTokenEmail($email)
    {
        $this->config->load('calendar');
        $client_id = $this->config->item('client_id');
        $client_secret = $this->config->item('client_secret');
        $refresh_token = $this->user_model->get_refresh_token($email);
        if (isset($refresh_token) && !empty($refresh_token)) {
            print_r($refresh_token[0]['refresh_token']);
            $refresh_token = $refresh_token[0]['refresh_token'];
            $tokenURL = 'https://accounts.google.com/o/oauth2/token';
            $postData = array(
                'client_secret' => $client_secret,
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $client_id
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $tokenURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //need this otherwise you get an ssl error
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tokenReturn = curl_exec($ch);
            $token = json_decode($tokenReturn);
            // var_dump($tokenReturn);

            $accessToken = isset($token->access_token) ? $token->access_token : "";

            return ($accessToken);
        } else {
            return "";
        }
    }

	public function subscribeUser()
    {
        $currenttime = time();
        $enddate = strtotime("+7 days", time());
        $user = $this->session->userdata('email');
        $subscription_details = $this->user_model->getSubscriptionDetals($user);
        $channel_id = explode("@", $user);
        $channel_id = $currenttime;
        $details  = array(
            "user_id" => $user,
            "valid_from" => $currenttime,
            "valid_till" => $enddate,
            "channel_name" => $channel_id
        );
        // print_r($details);
        // echo "<br/>";
        if (empty($subscription_details)) {
            $access_token = $this->getAccessTokenEmail($user);
            if ($access_token != "") {
                if ($this->pushnotify($user, $access_token, $channel_id) == 200) {
                    $this->user_model->addSubscriptionDetails($details);
                }
            }
        } else {
            foreach ($subscription_details as $userwise) {
                // print_r($userwise);
                if ($userwise['valid_till'] < $currenttime) {
                    $access_token = $this->getAccessTokenEmail($user);
                    if ($access_token != "") {
                        if ($this->pushnotify($user, $access_token, $channel_id) == 200) {
                            $this->user_model->addSubscriptionDetails($details);
                        }
                    }
                }
            }
        }
    }
    public function pushnotify($calendar_id, $access_token, $channel_id)
    {
        $url_events = 'https://www.googleapis.com/calendar/v3/calendars/' . $calendar_id . '/events/watch';
        $duration = strtotime("+7 days", time());

        $curlPost = array(
            "id" => $channel_id,
            "type" => "web_hook",
            "address" => "https://bca82c78.ngrok.io/UAT/googlecalendar/handleNotification",
            // "expiration" => $duration,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_events);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token, 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curlPost));
        $data = json_decode(curl_exec($ch), true);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return  $http_code;
        // if ($http_code != 200)
        //     throw new Exception('Error : Failed to create event');
        // else
        //     ret;
    }

/*public function set_user_permissions()
	{
		

        if ($this->input->post('submit')) {
            // true case

            $permission = serialize($this->input->post('permission'));
           $email= $this->session->userdata('email');
        	$data = array(
    
        		'user_type' => $this->input->post('user_type'),
        		'permissions' => $permission
        	);
        	$this->lead_management->set_userpermissions($data,$email);
        }
        redirect('page_access');
	}
*/


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */