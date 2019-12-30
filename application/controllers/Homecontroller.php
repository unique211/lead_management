<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homecontroller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('newaccountmodel');
        $this->load->model('categorymodel');
        $this->load->model('homemodel');
		$this->load->helper('download');
		// $this->load->model('Settingsmodel');
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
    public function getfinicialamtdata(){
        $uid	= $this->input->post('uid'); 
        $data1 = $this->homemodel->getfinicialamt($uid);

        echo json_encode($data1);
    }
}