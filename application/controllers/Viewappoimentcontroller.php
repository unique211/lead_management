<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Viewappoimentcontroller extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $this->load->model('viewappoimentmodel');
      
		$this->load->helper('download');
		// $this->load->model('Settingsmodel');
    }

   
    public function save_notes(){
        $id	= $this->input->post('id');  
        $editid	= $this->input->post('editid');
        $notes	= $this->input->post('notes');
        
        date_default_timezone_set('Asia/Kolkata');
        $date= date('Y-m-d h:i:s');

        $email=$this->session->userdata('email');
        $user_id=$this->user_model->user_id($email);

        
        $data = array(
            'aid' => $this->input->post('editid'),
            'notes' =>$this->input->post('notes'),
            'user_id' =>$user_id,
            'created_at' =>$date,
        );
        if ($id == "") {


			$data1 = $this->viewappoimentmodel->data_insert($data,"demo_notes_entry");
		} else {
			$data1 = $this->viewappoimentmodel->data_update($data,"demo_notes_entry", "id", $id);
		}

        echo json_encode($data1);


	

    }

   
    public function get_master()
	{
		//$table_name="project_master";
		$table_name	= $this->input->post('table_name');
		$editid	= $this->input->post('editid');
		$data = $this->viewappoimentmodel->data_get($table_name,$editid);
		echo json_encode($data);
    }
    public function delete_master(){
        $id	= $this->input->post('id');
        $table_name	= $this->input->post('table_name');
		$data = $this->viewappoimentmodel->deletedata($id,$table_name);
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