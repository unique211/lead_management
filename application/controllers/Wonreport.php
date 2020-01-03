<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wonreport extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('wonreportmodel');
        $this->load->model('categorymodel');
		$this->load->helper('download');
		// $this->load->model('Settingsmodel');
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
                        $data['body']="static/user/wonreport";
             

                        
             $this->load->view('welcome_message',$data);
        }else{
            redirect('login');
        }
      
		
    }

   
    public function get_master()
	{
		//$table_name="project_master";
		$table_name	= $this->input->post('table_name');
		$data = $this->categorymodel->data_get($table_name);
		echo json_encode($data);
    }
    public function delete_master(){
        $id	= $this->input->post('id');
        $table_name	= $this->input->post('table_name');
		$data = $this->categorymodel->deletedata($id,$table_name);
		echo json_encode($data);
    }
    public function checkcustomer(){
        $id	= $this->input->post('id');
        $customer	= $this->input->post('customer');

        $data1 = $this->categorymodel->checkcustomerexists($id,$customer);

        echo json_encode($data1);
    }
    public function getinvoicewone(){
        $id	= $this->input->post('uid');
        $statdate	= $this->input->post('statdate');
        //$statdate="2019-12-01";
       // $id=19;;
        $data1 = $this->wonreportmodel->getwondata($id,$statdate);

        echo json_encode($data1);
    }
    public function getloss(){
        $id	= $this->input->post('uid');
         $statdate	= $this->input->post('statdate');
    //     $statdate="2019-12-01";
    //    $id=19;
        $data1 = $this->wonreportmodel->getlossreport($id,$statdate);

        echo json_encode($data1);
    }
    public function getlossproductinfo(){
        $id	= $this->input->post('id');
      
   
        $data1 = $this->wonreportmodel->getlossproductinfo($id);

        echo json_encode($data1); 
    }
    public function getwonproductinfo(){
        $id	= $this->input->post('id');
        $data1 = $this->wonreportmodel->getwonproductinfo($id);

        echo json_encode($data1); 
    }
}