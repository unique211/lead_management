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
        $quotationno=$this->quatationmodel->getquatationno();
        if($id==""){
           
        $data = array(
            'customer_name' => $this->input->post('cus_name'),
            'contact_person' =>$this->input->post('cotactperson'),
          
            'mobile_no' => $this->input->post('phn'),
            'ref_number' => $this->input->post('refno'),
            'email_id' =>  $this->input->post('s_email'),
            'quotaion_no' => $quotationno,
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
            'customer_id' =>  $this->input->post('customerid'),
            'salesrepresentative' =>$this->input->post('salesrepresentive'),
            'version' => 1,
            'user_id'=> $user_id,
       
        );


    }else{
        $quotationno=$this->input->post('bill_no');
        $this->db->select_max('version');
        $this->db->from('quotation_master');
        $this->db->where('quotaion_no',$this->input->post('bill_no'));
        $hasil1 = $this->db->get(); 
        foreach($hasil1->result_array() as $quotationdata){
            $version=$quotationdata['version'];
            $version=$version+1;
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
                'customer_id' =>  $this->input->post('customerid'),
                'salesrepresentative' =>$this->input->post('salesrepresentive'),
                'version' => $version,
                'user_id'=> $user_id,
           
            );

        }


    }

       // if ($id == "") {


            $data1 = $this->quatationmodel->data_insert($data,$tablename,$quotationno);
            
           


		// } else {
		// 	$data1 = $this->quatationmodel->data_update($data,$tablename, "id", $id);
        // }
        
           
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
    public function getquotationversion(){
        $id	= $this->input->post('id');
        $data = $this->quatationmodel->getquotationversion($id);
		echo json_encode($data);
    }
    public function getquationversionwise(){
        $bill_no	= $this->input->post('bill_no');
        $version	= $this->input->post('version');
        $data = $this->quatationmodel->getquationversionwise($bill_no,$version);
		echo json_encode($data);
    }
    public function print_pdf(){
        $this->load->library('codecanyon/invoicr/invoicr');
      
         $where=$this->input->post('btnprint');

        //  $where = explode('_', $where); 
        //  $id=$where[0];
        //  $version=$where[1];

         
        // $where=92;
        $data['customerinfo']=$this->quatationmodel->getcustomerdetalis($where);

        $data['quatationdate']=$this->quatationmodel->getquatationdate($where);
        $data['product_detalis']=$this->quatationmodel->getquatation_details_withversion($where);
 // echo json_encode($data);
           
      $this->load->view('static/user/quotationpdf',$data);
       
    }
    public function getcustomerinfo(){
        $id	= $this->input->post('id');
        $data=$this->quatationmodel->getcustomerdetalis($id);
        echo json_encode($data);
    }
    public function getproductdetalis(){
        $id	= $this->input->post('id');
        //$version	= $this->input->post('version');
        $data=$this->quatationmodel->getquatation_details_withversion($id);
        echo json_encode($data);
    }
    public function updatequotestatus(){
       // $id	= $this->input->post('id');
        $id	= $this->input->post('qnoid');
       
      
     

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

        public function getorderinfo($id){
        //     $id	= $this->input->get('quotation_id');
        //     $email=$this->session->userdata('email'); 
        //     $user_id=$this->user_model->user_id($email);	    
        //    $u_type=$this->user_model->get_usertype($email);
        //    $u=$u_type[0]['user_type'];
        //    $get=$this->user_model->get_permissions($u);
        //    //print_r($get);exit();
        //    $data['user_permission']=unserialize($get[0]['permissions']);
        //       $data['layout']="public/layout";
        //    $data['header']="public/header";
        //    $data['footer']="public/footer";
        //    $data['quotatopnid']= $id;
        //  //  print_r($user_id);exit;
        //    $data['leads']=$this->user_model->get_leads($user_id);
        //    //print_r($this->user_model->get_leads($user_id));
        //   // exit;
        //      $data['records1']=$this->lead_management->dealer_display_data($user_id);
        //    $data['body']="static/user/quotation_order";
        //      // $this->session->set_flashdata('msg', ' data saved');
            

        //  $view=  $this->load->view('welcome_message',$data);

       // $id	= $this->input->get('quotation_id');
        $data1 = $this->quatationmodel->getcount($id);

            if($data1==0){

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
         //$id	= $this->input->get('quotation_id');
         $email=$this->session->userdata('email');     
         $u_type=$this->user_model->get_usertype($email);
         $u=$u_type[0]['user_type'];
         $get=$this->user_model->get_permissions($u);
         $user_id=$this->user_model->user_id($email);
         $data['user_permission']=unserialize($get[0]['permissions']);
         $user_id=$this->user_model->user_id($email);
         $data['quotatopnid']= $id;
         // $data['lead_source']=$this->user_model->get_lead_users();
         //$data['records']=$this->user_model->get_appointment_data($user_id);
         $data['records1']=$this->lead_management->dealer_display_data($user_id);
         $data['layout']="public/layout";
         $data['header']="public/header";
         $data['footer']="public/footer";
         // $data['body']="static/user/new_lead_type";
         $data['body']="static/user/quotation_order";
        $this->load->view('welcome_message1',$data);
        }
    }else{
       



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
        $id	= $data1;
        $email=$this->session->userdata('email');     
        $u_type=$this->user_model->get_usertype($email);
        $u=$u_type[0]['user_type'];
        $get=$this->user_model->get_permissions($u);
        $user_id=$this->user_model->user_id($email);
        $data['user_permission']=unserialize($get[0]['permissions']);
        $user_id=$this->user_model->user_id($email);
        $data['quotatopnid']= $data1;
        // $data['lead_source']=$this->user_model->get_lead_users();
        //$data['records']=$this->user_model->get_appointment_data($user_id);
        $data['records1']=$this->lead_management->dealer_display_data($user_id);
        $data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
        // $data['body']="static/user/new_lead_type";
        $data['body']="static/user/manageorder";
       $this->load->view('welcome_message1',$data);
       }
    }
       
        }

        public function getquatationinfo(){
            $id	= $this->input->post('quatationid');

           // $id	=1;

            $data=$this->quatationmodel->getquatationalldata($id);
            echo json_encode($data);

           // echo $data;

        }
    public function get_insertid($table,$id){
            // $this->db->select_max($id);
            // $hasil=$this->db->get($table);
            // return $hasil->row()->$id;
    
            $query="SHOW TABLE STATUS LIKE 'order_master'";
         
            $hasil=$this->db->query($query);
            return $hasil->row()->Auto_increment;
        }
        public function getquatationdate(){
            $id	= $this->input->post('id');
           // $version	= $this->input->post('version');
            $data=$this->quatationmodel->getquatationdate($id);
            echo json_encode($data);
        }

        public function getdropdown(){
            $table_name	= $this->input->post('table_name');
           
            $data=$this->quatationmodel->get_dropdown($table_name);
            echo json_encode($data);
        }
        public function getsalespersion(){
            $id	= $this->input->post('id');
            $version	= $this->input->post('version');
           
            $data=$this->quatationmodel->getsalesdata( $id,$version);
            echo json_encode($data); 
        }
        public function get_salespername(){
            $id	= $this->input->post('useruniqueid');
            $data=$this->quatationmodel->get_salespername($id);
            echo json_encode($data); 
        }
        public function getquatationno(){
          
            $data=$this->quatationmodel->getquatationno();
            echo json_encode($data); 
        }
        public function getquationvesiondata(){
            $version	= $this->input->post('version');
            $bill_no	= $this->input->post('bill_no');
           
            $data=$this->quatationmodel->getquatatinversiondata($bill_no,$version);
            echo json_encode($data); 
        }
        public function getquationversionwise1(){
            $qid	= $this->input->post('id');
         
            $data = $this->quatationmodel->getquationversionwise1($qid);
            echo json_encode($data);
        }
        public function getcustomerdata(){
            $qid	= $this->input->post('customerid');
         
            $data = $this->quatationmodel->getcustomer($qid);
            echo json_encode($data);
        }
        public function sendemailcustomer(){
            $to_email = $this->input->post('cto'); 

           // echo $to_email;
            $customercc = $this->input->post('customercc'); 
            $subject = $this->input->post('subject'); 
            $cmsg = $this->input->post('msg'); 
            $filenamepdf = $this->input->post('filenamepdf'); 
            $attchmentfile = $this->input->post('attchment'); 
            $bill_no = $this->input->post('bill_no'); 


            //$filepath=base_url()."/quatationpdf/".$filenamepdf;

          

          


        //     $this->load->library('codecanyon/invoicr/invoicr');
      
        //     $where=$this->input->post('btnprin');
   
        
        //    $customerinfo=$this->quatationmodel->getcustomerdetalis($where);
   
        //    $quatationdate=$this->quatationmodel->getquatationdate($where);
        //    $product_detalis=$this->quatationmodel->getquatation_details_withversion($where);

          
       
        //    $quotaion_no="";
        //    $customer="";
        //    $margin=0;
        //    $less_others=0;
        //    $less_bg=0;
        //    $less_trasportion=0;
        //    $less_input_tax=0;
        //    $total_trasfor_price=0;
        //    $total_order_value=0;
        //    $order_due_date='';
        //    $email_id='';
        //    $order_date='';
        //    $mobile_no='';
        //    $ref_number='';
        //    $contact_person='';
        //    $symbol="Rs";
        //    $margin=0;
        //    $description="";
        //    $prderdate="";
        //    foreach($customerinfo as $value)
        //    {
              
        //         $id=$value->id;
        //         $customer=$value->customer_name;
        //         $quotaion_no=$value->quotaion_no;
        //         $contact_person=$value->contact_person;
        //         $ref_number=$value->ref_number;
        //         $mobile_no=$value->mobile_no;
        //         $order_date=$value->order_date;
        //         $email_id=$value->email_id;
        //        $order_due_date=$value->order_due_date;
        //        $description=$value->description;
        //        $total_order_value=$value->total_order_value;
        //        $total_trasfor_price=$value->total_trasfor_price;
        //        $less_input_tax=$value->less_input_tax;
        //        $less_trasportion=$value->less_trasportion;
        //        $less_bg=$value->less_bg;
        //        $less_others=$value->less_others;
             
        //        $margin=$value->margin;
        //        $old_date = explode('-', $order_date); 
        //    $order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
           
              
        //    }
        //    foreach($quatationdate as $value1)
        //    {
        //        $order_date=$value1->quotation_date;
        //        if($order_date !="0000-00-00" || $order_date !=""){
        //            $old_date = explode('-', $order_date); 
        //            $order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
        //        }
              
        //    }
        //    date_default_timezone_set('America/Los_Angeles');
        //    //Include Invoicr class
        //    //include('../invoicr.php');
        //    //Create a new instance
        //    $invoice = new invoicr("A4",$symbol,"en");
        //    //Set number format
        //    $invoice->setNumberFormat(',','.');
        //    //Set your logo
        //    $invoice->setLogo("images/logo.png",180,100);
        //    //Set theme color
        //    $invoice->setColor("#f7540e");
        //    //Set type
        //    $invoice->setType("Quote");
        //    //Set reference
        //    $invoice->setReference($quotaion_no);
        //    //Set date
        //    $invoice->setDate($order_date);
        //    //Set from
        //    $invoice->setFrom(array("DCDR Infra Private Limited","23, West Road","West CIT Nagar","Chennai - 600 035",""));
        //    //Set to
        //    $invoice->setTo(array("Customer Name:".$customer,"Contact Person:".$contact_person, "Mobile No:".$mobile_no,"Email Id:".$email_id,""));
        //    //Add items
        //    //$invoice->addItem("Premium account",1,1,"21%",100,20,80,80);
           
        //    $totalorderunit=0;
        //    $totaltotalprice=0;
        //    $totaltaxrs=0;
        //    $totalorderpricewithtax=0;
           
           
        //    foreach($product_detalis as $value1)
        //    {
           
        //        $productname=$value1->product_name;
        //        $qty=$value1->qty;
        //        $unit_order_value=$value1->unit_order_value;
           
               

           
           
        //        $totalprice=0;
        //        if($qty >0 && $unit_order_value >0 ){
        //            $totalprice=$qty * $unit_order_value;
        //        }
           
               
        //        $order_tax=$value1->order_tax;
        //        $taxrs=$totalprice * $order_tax/100 ;
        //        $totalpricewithtax=$totalprice + $taxrs;
           
        //        $totalorderunit= $unit_order_value+$totalorderunit;
        //        $totaltotalprice= $totalprice+$totaltotalprice;
        //        $totaltaxrs= $totaltaxrs+$taxrs;
        //        $totalorderpricewithtax= $totalorderpricewithtax+$totalpricewithtax;
           
        //    $invoice->addItem($productname,false,$qty,$unit_order_value,$totalprice,$order_tax."%",$taxrs,$totalpricewithtax);
        //    //Add totals
        //    }
        //    $invoice->addItem("Total",false,"-",$totalorderunit,$totaltotalprice,"-",$totaltaxrs,$totalorderpricewithtax,true);
           
        //    $invoice->addTotal("Total Order Value (without Tax)", $totaltotalprice);
        //    // $invoice->addTotal("Total Transfer Price (without Tax)", $total_trasfor_price);
        //    // $invoice->addTotal("Less Input Tax if CST ", $less_input_tax);
        //    // $invoice->addTotal("Less Transporation", $less_trasportion);
        //    // $invoice->addTotal("Less BG/Insurance Cost ",$less_bg);
        //    // $invoice->addTotal("Less others (if any) ", $less_others);
        //    // $invoice->addTotal("MARGIN", $margin);
        //    //Add badge
        //    //$invoice->addBadge("Copy");
           
           
        //    //
           
           
        //    //Add title
        //     $invoice->addTitle("Remarks");
        //    // //Add paragraph
        //     $invoice->addParagraph($description);
        //    // //Set footernote
        //    // $invoice->setFooternote("http://www.soundcloud.com");
        //    //Render
          
        //    $invoice->render('Envato.pdf','I');
        //    $random = rand();

        // $root = $_SERVER['DOCUMENT_ROOT'] . "/lead_management/quatationpdf/invoice_" . $random . ".pdf";
        // $invoice->Output($root, "F");
          
           // $to_email ='smorvadiya931@rku.ac.in';
            // $customercc ='ajazkhanpathan14@gmail.com';

            $root =$_SERVER['DOCUMENT_ROOT'] . "/lead_management/quatationpdf/" .$filenamepdf;
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
       

          
                          
             // $mail->SMTPDebug = 2;
            $mail->setFrom('morvadiyasagar99@gmail.com', 'Lead Management');
            //$mail->addReplyTo('morvadiyasagar99@gmail.com', 'Wadhwa Group');
            
            // Add a recipient
           
            //$this->email->to($to_email);

            
          
            $mail->addAddress($to_email);
            
            
            //$mail->addAddress($to_email1);
            
            // Add cc or bcc 
            if($customercc !=""){
            foreach($customercc as $custdata){
                $mail->addCC($custdata);
            }
        }
           
        
            
            
            $mail->Subject = $subject;


            
            
         //   $mail->isHTML(true);
               
               
                $mail->Body = $cmsg;
                //$mail->attach($attachment);
                $mail->addAttachment($root);

                foreach($attchmentfile as $allattchfile){
                    $mail->addAttachment($allattchfile["file"]);

                }

       
            // Send email

           
            if(!$mail->send()){
                $res=false;
                
        
            }else{
                $res=true;
                
                
            }
          // unlink($root);
          $target_dir="./assets/".$this->session->userdata('useruniqueid').'_'.$bill_no.'/';

          delete_files($target_dir, true); // delete all files/folders
          rmdir($target_dir);

                echo $res;
               
             }
        }

        public function getsalesperson(){
            $data = $this->quatationmodel->getsalesperson();
            echo json_encode($data); 
        }
        public function getfilenameinfo(){
            $this->load->library('codecanyon/invoicr/invoicr');
      
            $where=$this->input->post('btnprin');
   
        
           $customerinfo=$this->quatationmodel->getcustomerdetalis($where);
   
           $quatationdate=$this->quatationmodel->getquatationdate($where);
           $product_detalis=$this->quatationmodel->getquatation_details_withversion($where);

          
       
           $quotaion_no="";
           $customer="";
           $margin=0;
           $less_others=0;
           $less_bg=0;
           $less_trasportion=0;
           $less_input_tax=0;
           $total_trasfor_price=0;
           $total_order_value=0;
           $order_due_date='';
           $email_id='';
           $order_date='';
           $mobile_no='';
           $ref_number='';
           $contact_person='';
           $symbol="Rs";
           $margin=0;
           $description="";
           $prderdate="";
           $quoteversion="";
           foreach($customerinfo as $value)
           {
              
                $id=$value->id;
                $customer=$value->customer_name;
                $quotaion_no=$value->quotaion_no;
                $contact_person=$value->contact_person;
                $ref_number=$value->ref_number;
                $mobile_no=$value->mobile_no;
                $order_date=$value->order_date;
                $email_id=$value->email_id;
               $order_due_date=$value->order_due_date;
               $description=$value->description;
               $total_order_value=$value->total_order_value;
               $total_trasfor_price=$value->total_trasfor_price;
               $less_input_tax=$value->less_input_tax;
               $less_trasportion=$value->less_trasportion;
               $less_bg=$value->less_bg;
               $less_others=$value->less_others;
               $quoteversion=$value->version;
             
               $margin=$value->margin;
               $old_date = explode('-', $order_date); 
           $order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
           
              
           }
           foreach($quatationdate as $value1)
           {
               $order_date=$value1->quotation_date;
               if($order_date !="0000-00-00" || $order_date !=""){
                   $old_date = explode('-', $order_date); 
                   $order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
               }
              
           }
           date_default_timezone_set('America/Los_Angeles');
           //Include Invoicr class
           //include('../invoicr.php');
           //Create a new instance
           $invoice = new invoicr("A4",$symbol,"en");
           //Set number format
           $invoice->setNumberFormat(',','.');
           //Set your logo
           $invoice->setLogo("images/logo.png",180,100);
           //Set theme color
           $invoice->setColor("#f7540e");
           //Set type
           $invoice->setType("Quote");
           //Set reference
           $invoice->setReference($quotaion_no);
           //Set date
           $invoice->setDate($order_date);
           //Set from
           $invoice->setFrom(array("DCDR Infra Private Limited","23, West Road","West CIT Nagar","Chennai - 600 035",""));
           //Set to
           $invoice->setTo(array("Customer Name:".$customer,"Contact Person:".$contact_person, "Mobile No:".$mobile_no,"Email Id:".$email_id,"Version:".$quoteversion));
           //Add items
           //$invoice->addItem("Premium account",1,1,"21%",100,20,80,80);
           
           $totalorderunit=0;
           $totaltotalprice=0;
           $totaltaxrs=0;
           $totalorderpricewithtax=0;
           
           
           foreach($product_detalis as $value1)
           {
           
               $productname=$value1->product_name;
               $qty=$value1->qty;
               $unit_order_value=$value1->unit_order_value;
           
               

           
           
               $totalprice=0;
               if($qty >0 && $unit_order_value >0 ){
                   $totalprice=$qty * $unit_order_value;
               }
           
               
               $order_tax=$value1->order_tax;
               $taxrs=$totalprice * $order_tax/100 ;
               $totalpricewithtax=$totalprice + $taxrs;
           
               $totalorderunit= $unit_order_value+$totalorderunit;
               $totaltotalprice= $totalprice+$totaltotalprice;
               $totaltaxrs= $totaltaxrs+$taxrs;
               $totalorderpricewithtax= $totalorderpricewithtax+$totalpricewithtax;
           
           $invoice->addItem($productname,false,$qty,$unit_order_value,$totalprice,$order_tax."%",$taxrs,$totalpricewithtax);
           //Add totals
           }
           $invoice->addItem("Total",false,"-",$totalorderunit,$totaltotalprice,"-",$totaltaxrs,$totalorderpricewithtax,true);
           
           $invoice->addTotal("Total Order Value (without Tax)", $totaltotalprice);
           // $invoice->addTotal("Total Transfer Price (without Tax)", $total_trasfor_price);
           // $invoice->addTotal("Less Input Tax if CST ", $less_input_tax);
           // $invoice->addTotal("Less Transporation", $less_trasportion);
           // $invoice->addTotal("Less BG/Insurance Cost ",$less_bg);
           // $invoice->addTotal("Less others (if any) ", $less_others);
           // $invoice->addTotal("MARGIN", $margin);
           //Add badge
           //$invoice->addBadge("Copy");
           
           
           //
           
           
           //Add title
            $invoice->addTitle("Remarks");
           // //Add paragraph
            $invoice->addParagraph($description);
           // //Set footernote
           // $invoice->setFooternote("http://www.soundcloud.com");
           //Render
          
           $invoice->render('Envato.pdf','I');
           $random = rand();

           $url= base_url();

        $root = $_SERVER['DOCUMENT_ROOT'] . "/lead_management/quatationpdf/quotation_" . $random . ".pdf";
        $invoice->Output($root, "F");

            echo $random;
        }

        public function getsearchfilter(){
            $status	= $this->input->post('status');
         
            $data = $this->quatationmodel->getsearchwisefilter($status);
            echo json_encode($data);
        }
        public  function getquotationnodata(){
            $id	= $this->input->post('id');
         
            $data = $this->quatationmodel->getquotationdata($id);
            echo json_encode($data);  
        }
        public function getqutation_status_info(){
            $id	= $this->input->post('qid');
         
            $data = $this->quatationmodel->getqutation_status_information($id);
            echo json_encode($data);  
        }
        public function get_master_ovm(){
            $data = $this->quatationmodel->getovm_detalis();
            echo json_encode($data);  
        }
       
        public  function fileuploaddata(){
            $_FILES	= $this->input->post('data');

            if(isset($_FILES)){
                print_r($_FILES);
                $i = 1;
                foreach($_FILES as $key => $data){
                       
                    if (move_uploaded_file($data['tmp_name'], __DIR__ . '/uploads/' . $i . '--' . $data['name'])) {
                        //echo "success";
                        print_r($data['name']);
                    } else {
                        //echo "error";
                    }
                   
                    $i++;
                }
        }
    }

    public function doc_upload()
	{
		$this->load->helper("file");	
		$this->load->library("upload");
		$id=$this->input->post('id');
		//echo json_encode($id);
		$size='';
		if($id == 'filename'){
			$size=$_FILES['filename']['size'];	
		}else if($id == 'docupload'){
			$size=$_FILES['docupload']['size'];	
		}
		
		if ($size > 0){
			$this->upload->initialize(array( 
		       "upload_path" => './assets/uploads/',
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "remove_spaces" => TRUE,
//		       "allowed_types" => 'jpg|jpeg|png|gif',
		       "allowed_types" => '*',
		       "max_size" => 1024*10,
		    ));
			
			 // if (!$this->upload->do_upload('attachreg_certy')) {
		   if (!$this->upload->do_upload($id)) {
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
		}

		    $data = $this->upload->data();
			$path = $data['file_name'];
			
			echo json_encode($path);	
		}else{
			//echo json_encode($id);	
			echo "no file"; 
		}
}
public function doc_upload1()
{
    $this->load->helper("file");	
    $this->load->library("upload");
    $id=$this->input->post('id');
 

    $F = array();
    $final_files_data=array();

 
    $action = $_POST['biiino'];  
    
   $target_dir="./assets/".$this->session->userdata('useruniqueid').'_'.$action.'/';
    if(!file_exists($target_dir)){
        mkdir($target_dir,0777);
    }
 
	$number_of_files_uploaded = count($_FILES['images']['name']);
	$config = array(
	    'allowed_types' => '*',
	 'max_size'      => 100000,
	    'overwrite'     => FALSE,
	    'upload_path'   => $target_dir
	  );
	 
	for ($i = 0; $i < $number_of_files_uploaded; $i++) :
	  	$_FILES['f']['name'] =  $_FILES['images']['name'][$i];
	    $_FILES['f']['type'] = $_FILES['images']['type'][$i];
	    $_FILES['f']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
	    $_FILES['f']['error'] = $_FILES['images']['error'][$i];
	    $_FILES['f']['size'] = $_FILES['images']['size'][$i];
	    $config['file_name'] = $_FILES['images']['name'][$i];
	   
	  $this->upload->initialize($config);
	      if($this->upload->do_upload('f')) :
	      	$data['error_code'] = 0;
	    	$data['msg'] = "uploaded";
	   		$final_files_data[] = $this->upload->data();
	      else :
	    	$data['error_code'] = 1;
	   		$data['msg'] = "invalid file type";	
	   		$data['status'] = $this->upload->display_errors();
	        $data['status']->success = FALSE;
	      endif;
	endfor;
          //  print_r($final_files_data);
       echo json_encode($final_files_data);	


}

}
	
