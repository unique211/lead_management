<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Funnelreport extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('newaccountmodel');
        $this->load->model('categorymodel');
        $this->load->model('funnelreportmodel');
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
                        $data['body']="static/user/funnelreport";
             

                        
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
    
    
    public function getfunnelreportdata(){
        $uid	= $this->input->post('uid');
        $statdate	= $this->input->post('statdate');
      
        $data = $this->funnelreportmodel->getfunnel_report($uid,$statdate);
		echo json_encode($data);

    }
    public function getfunnelproductinfo(){
        $id	= $this->input->post('id');
      
        $data = $this->funnelreportmodel->getfunnelproduct($id);
		echo json_encode($data);
    }
    public function getfunnelreportdata1(){
        $uid	= $this->input->post('uid');
        $statdate	= $this->input->post('statdate');
        $productnm	= $this->input->post('productnm');
        $ovmnm	= $this->input->post('ovmnm');
        $fromdate	= $this->input->post('fromdate');
        $to_date	= $this->input->post('to_date');
      
        $data = $this->funnelreportmodel->getfunnel_report1($uid,$statdate,$productnm,$ovmnm,$fromdate,$to_date);
		echo json_encode($data);

    }
}