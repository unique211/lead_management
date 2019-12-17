<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_Estimate extends CI_Controller {

	
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
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
                        $data['body']="static/user/Quotation_Estimate";
             

                        
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
            'quotaion_no' => $this->input->post('bill_no'),
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
            'user_id'=> $user_id,
       
        );

        if ($id == "") {


            $data1 = $this->quatationmodel->data_insert($data,$tablename);
            
           


		} else {
			$data1 = $this->quatationmodel->data_update($data,$tablename, "id", $id);
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
		$data = $this->quatationmodel->deletedata($id,$table_name);
		echo json_encode($data);
    }

}
	