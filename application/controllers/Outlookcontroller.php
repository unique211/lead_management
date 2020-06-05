<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Outlookcontroller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('newaccountmodel');
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
        $data['flag']=1;
        $data['calendardata']="";
        
        // $data['lead_source']=$this->user_model->get_lead_users();
        //$data['records']=$this->user_model->get_appointment_data($user_id);
        $data['records1']=$this->lead_management->dealer_display_data($user_id);
        $data['layout']="public/layout";
        $data['header']="public/header";
        $data['footer']="public/footer";
       
        // $data['body']="static/user/new_lead_type";
        $data['body']="static/user/addoutlookdemo";


        
$this->load->view('welcome_message',$data);
}else{
redirect('login');
}


    }
    public function save_settings()
	{
        $data1 = "";
        $id	= $this->input->post('id');
        $email=$this->session->userdata('email');
        $category	= $this->input->post('category');
        $tablename	= $this->input->post('table_name');
        $user_id=$this->user_model->user_id($email);
        $data ="";
       
       if($tablename == "category_type"){
        $data = array(
            'category_type' => $this->input->post('category'),
            'user_id'=> $user_id,
       
        );
       }else if($tablename == "customer_type"){
        $data = array(
            'customer_type' => $this->input->post('customer'),
            'user_id'=> $user_id,
       
        );
       }
        
    
        
        if ($id == "") {


			$data1 = $this->categorymodel->data_insert($data,$tablename);
		} else {
			$data1 = $this->categorymodel->data_update($data,$tablename, "id", $id);
		}

        echo json_encode($data1);
    }
    public function checkcategorytypeexist(){
        $id	= $this->input->post('id');
        $category	= $this->input->post('category');

        $data1 = $this->categorymodel->checkcategoryexist($id,$category);

        echo json_encode($data1);
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
    public function getoutlookdata(){
        $data1 = $this->categorymodel->getoutlookdata();

        echo json_encode($data1); 
    }
    public function geteventinfo(){
        $id	= $this->input->post('eventid');
        $data1 = $this->categorymodel->geteventinfo($id);

        echo json_encode($data1); 
    }
}