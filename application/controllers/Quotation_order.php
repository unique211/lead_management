<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_order extends CI_Controller {

	
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->model('quatation_ordermodel');
        $this->load->model('quatationmodel');
        
        $this->load->helper('url');
    }
	public function index()
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
                        // $data['body']="static/user/new_lead_type";
                        $data['body']="static/user/manageorder";
             

                        
             $this->load->view('welcome_message',$data);
        }else{
            redirect('login');
        }
      
		
    }
    public function get_master_product(){
      
		$data = $this->quatationmodel->get_data_get();
		echo json_encode($data);
    }
    public function get_product_detalis(){
        $val=$this->input->post('val');
        $data = $this->quatationmodel->get_productdetalis( $val);
		echo json_encode($data);
    }
    public function get_master_allcustomer(){
        $data = $this->quatationmodel->get_master_allcustomer();
		echo json_encode($data);
    }
    public function get_customer_detalis(){
        $customer=$this->input->post('customer');
        $data = $this->quatationmodel->get_customer_detalis( $customer);
		echo json_encode($data); 
    }
    public function save_settings()
	{
        $data1 = "";
        $id	= $this->input->post('id');
        $tablename	= $this->input->post('table_name');
       
        
      
        $email=$this->session->userdata('email');
        $user_id=$this->user_model->user_id($email);
        $data ="";

        $data = array(
            'customer_name' => $this->input->post('cus_name'),
            'contact_person' =>$this->input->post('cotactperson'),
          
            'mobile_no' => $this->input->post('phn'),
            'ref_number' => $this->input->post('refno'),
            'email_id' =>  $this->input->post('s_email'),
            'order_no' => $this->input->post('bill_no'),
            'order_date' =>$this->input->post('o_date'),
            'order_due_date' =>  $this->input->post('o_due_date'),
            'description' =>  $this->input->post('description'),
            'total_order_value' =>  $this->input->post('finalordervalue'),
            'total_trasfor_price' =>  $this->input->post('finaltrasforprice'),
            'less_input_tax' =>  $this->input->post('lesstaxcst'),
            'less_trasportion' =>  $this->input->post('lesstrasporation'),
            'less_bg' =>  $this->input->post('lessbg'),
            'less_others' =>  $this->input->post('lessother'),
            'margin' =>  $this->input->post('finalmargin'),
            'quote_lock_version' =>  $this->input->post('search_version'),
            'qutone_no' =>  $this->input->post('quatationidno'),
            'user_id'=> $user_id,
            
       
        );

        if ($id == "") {


            $data1 = $this->quatation_ordermodel->data_insert($data,$tablename);
            
           


		} else {
			$data1 = $this->quatation_ordermodel->data_update($data,$tablename, "id", $id);
		}

        echo json_encode($data1);
    
    
    }
    public function getallquatatyion(){
        $data = $this->quatationmodel->getall_quotation();
		echo json_encode($data);
    }
    public function getquatationdetalis(){
       $id= $this->input->post('id');
       
        $data = $this->quatationmodel->getquatation_details($id);
		echo json_encode($data);
    }

    public function delete_master(){
        $id	= $this->input->post('id');
        $table_name	= $this->input->post('table_name');
		$data = $this->quatation_ordermodel->deletedata($id,$table_name);
		echo json_encode($data);
    }
    public function getquotationversion(){
        $id	= $this->input->post('id');
        $data = $this->quatationmodel->getquotationversion($id);
		echo json_encode($data);
    }
    public function getquationversionwise(){
        $id	= $this->input->post('id');
        $version	= $this->input->post('version');
        $data = $this->quatationmodel->getquationversionwise($id,$version);
		echo json_encode($data);
    }
    public function print_pdf(){
        $this->load->library('codecanyon1/invoicr/invoicr');
      
         $where=$this->input->post('btnprint');

        //  /$where = explode('_', $where); 
        //  $id=$where[0];
        //  $version=$where[1];

         
        // $where=92;
        $data['customerinfo']=$this->quatation_ordermodel->getcustomerdetalis($where);

      
        $data['product_detalis']=$this->quatation_ordermodel->getquatation_details_withversion($where);
 // echo json_encode($data);
           
      $this->load->view('static/user/quation_orderpdf',$data);
       
    }
    public function getcustomerinfo(){
        $id	= $this->input->post('id');
        $data=$this->quatation_ordermodel->getcustomerdetalis($id);
        echo json_encode($data);
    }
    public function getproductdetalis(){
        $id	= $this->input->post('id');
       
        $data=$this->quatation_ordermodel->getquatation_details_withversion($id);
        echo json_encode($data);
    }
    public function updatequotestatus(){
        $id	= $this->input->post('id');
      
     

        $data = array(
            'quote_status' =>  $this->input->post('status'),
            'quote_lock_version' => $this->input->post('lversion')
        );


        $data=$this->quatationmodel->updatequotestatus($id,$data);
        echo json_encode($data);
    }
    public function getquotationselect(){
        $id	= $this->input->post('id');
     
        $data=$this->quatationmodel->getqutationversioninfo($id);
        echo json_encode($data);
    }
    public function SendEmailforgetpassword(){
		
        $to_email = $this->input->post('email'); 
        $id = $this->input->post('id'); 
        //$to_email ='smorvadiya931@rku.ac.in';
        $res='';
        /*$to_email='morvadiyasagar99@gmail.com';
        $vendorname ='Sagar';
        $mobile ='9913829299';*/
        $this->load->library('phpmailer_lib');
        
         if($to_email !='') { 
        
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'tls://smtp.gmail.com:587';
        $mail->SMTPAuth = true;
        $mail->Username = 'morvadiyasagar99@gmail.com';
        $mail->Password = 'rvmn prql amti illl';
    //	$mail->SMTPSecure = 'tls';
        //$mail->Port     = 587;
        //$mail->SMTPDebug = 2;
                      
        //$mail->SMTPDebug = 2;
        $mail->setFrom('morvadiyasagar99@gmail.com', 'Contiloe');
        //$mail->addReplyTo('morvadiyasagar99@gmail.com', 'Wadhwa Group');
        
        // Add a recipient
    
        $mail->addAddress($to_email);
        
        // Add cc or bcc 
        $mail->addCC('morvadiyasagar99@gmail.com');
    
        
        
        $mail->Subject = 'Forgot Password link';
        
        
        $mail->isHTML(true);
        
        $baseurl=base_url();
            $mailContent ="Dear Sir/Madam,<br/><br/> Please access following link to Reset Your Password: <br/>";
            $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            $res=false;
            
    
        }else{
            $res=true;
            
            
        }
            echo $res;
         }
        }

        public function getorderinfo(){
            $id	= $this->input->get('quotation_id');
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
           $data['quotatopnid']= $id;
         //  print_r($user_id);exit;
           $data['leads']=$this->user_model->get_leads($user_id);
           //print_r($this->user_model->get_leads($user_id));
          // exit;
             $data['records1']=$this->lead_management->dealer_display_data($user_id);
           $data['body']="static/user/quotation_order";
             // $this->session->set_flashdata('msg', ' data saved');
            

         $view=  $this->load->view('welcome_message',$data);

       
        }

        public function getquatationinfo(){
            $id	= $this->input->post('quatationid');

           // $id	=1;

            $data=$this->quatationmodel->getquatationalldata($id);
            echo json_encode($data);

           // echo $data;

        }
    public function get_insertid(){
            // $this->db->select_max($id);
            // $hasil=$this->db->get($table);
            // return $hasil->row()->$id;
    
            $query="SHOW TABLE STATUS LIKE 'order_master'";
         
            $hasil=$this->db->query($query);


            echo json_encode( $hasil->row()->Auto_increment);
        }
        public function getallorder(){
            $data = $this->quatation_ordermodel->getall_order();
            echo json_encode($data);
        }
        
       


}
	