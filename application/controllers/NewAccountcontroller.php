<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NewAccountcontroller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('categorymodel');
        $this->load->model('newaccountmodel');
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
       
       if($tablename == "new_account"){
        $data = array(
            'date' => $this->input->post('l_date'),
            'customer_name' => $this->input->post('cname'),
            'customer_type' => $this->input->post('customer_type'),
            'category_id' => $this->input->post('category'),
            'no_of_employee' => $this->input->post('employees'),
            'requirement' => $this->input->post('requirement'),
            'remark' => $this->input->post('remark'),
            'address' => $this->input->post('u_addr'),
            'user_id'=> $user_id,
       
        );
       }
        
    
        
        if ($id == "") {


            $data1 = $this->newaccountmodel->data_insert($data,$tablename);
            
           


		} else {
			$data1 = $this->newaccountmodel->data_update($data,$tablename, "id", $id);
		}

        echo json_encode($data1);
    }
    public function checkcategorytypeexist(){
        $id	= $this->input->post('id');
        $category	= $this->input->post('category');

        $data1 = $this->newaccountmodel->checkcategoryexist($id,$category);

        echo json_encode($data1);
    }
    public function get_master()
	{
		//$table_name="project_master";
        $table_name	= $this->input->post('table_name');
        $fromdate	= $this->input->post('fromdate');
        $todate	= $this->input->post('todate');
		$data = $this->newaccountmodel->data_get($table_name,$fromdate,$todate);
		echo json_encode($data);
    }
    public function delete_master(){
        $id	= $this->input->post('id');
        $table_name	= $this->input->post('table_name');
		$data = $this->newaccountmodel->deletedata($id,$table_name);
		echo json_encode($data);
    }
    public function checkcustomer(){
        $id	= $this->input->post('id');
        $customer	= $this->input->post('customer');

        $data1 = $this->Categorymodel->checkcustomerexists($id,$customer);

        echo json_encode($data1);
    }
    public function get_master_where(){
        $table_name	= $this->input->post('table_name');
        $where	= $this->input->post('where');

        $data1 = $this->categorymodel->getdropdwn($table_name,$where);

        echo json_encode($data1);

    }
    public function getcontactinfo(){
        $id	= $this->input->post('id');
        $table_name	= $this->input->post('table_name');

        $data1 = $this->newaccountmodel->getcontactdata($id,$table_name);

        echo json_encode($data1);
    }
    public function checkemail(){
        $id	= $this->input->post('id');
        $email	= $this->input->post('email');

        $data1 = $this->newaccountmodel->checkemail($id,$email);

        echo json_encode($data1);
    }
    public function checkmoblino(){
        $id	= $this->input->post('id');
        $phn	= $this->input->post('phn');

        $data1 = $this->newaccountmodel->checkmoblino($id,$phn);

        echo json_encode($data1);
    }
    public function checklandline(){
        $id	= $this->input->post('id');
        $landline	= $this->input->post('landline');

        $data1 = $this->newaccountmodel->checklandline($id,$landline);

        echo json_encode($data1);
    }
    public function getaccountaddress(){
        $val	= $this->input->post('id');
     
      
        $data1 = $this->newaccountmodel->getac_addresss($val);

        echo json_encode($data1); 
    }
}