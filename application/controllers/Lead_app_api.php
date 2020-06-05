<?php
defined('BASEPATH') or exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH.'/libraries/REST_Controller.php';

class Lead_app_api extends REST_Controller
{
    function __construct($config = 'rest'){
        parent::__construct($config);
    }
    public function login_check_post()
    {
       
       
        $e=$this->input->post('email');
		$p=$this->input->post('password');
		$deviceno=$this->input->post('deviceno');
        $password=md5($p);

		$this->load->model('Lead_api_model');


        if(($e !="") && ($p !="")){
		
      
        $x=$this->Lead_api_model->logincheck($e,$password);

        if($x==0){
            $json['response'] = [
                'status'     => 'Error',
                'data'   => ' Wrong User Email Or Password Require',
            ];
        }else{
            $json['response'] = [
                'status'     => 'OK',
                'data'   => $x,
            ];
        }
    }else{
        $json['response'] = [
            'status'     => 'Error',
            'data'   => 'User Email Or Password Require',
        ];  
    }
           
       
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
	}
	public function checkinuser_post()
    {
		$user_id=$this->input->post('user_id');
		$check_in_latitude=$this->input->post('check_in_latitude');
		$check_in_longitude=$this->input->post('check_in_longitude');
		$check_in_loc=$this->input->post('check_in_loc');
		$device_idetification=$this->input->post('deviceno');
		$this->load->model('Lead_api_model');

		date_default_timezone_set('Asia/Kolkata');
		$checkouttime= date('Y-m-d H:i');

		if(($check_in_latitude !="") && ($check_in_longitude !="")){
			$data1=array(
				'user_id'=>$user_id,
				'check_in_latitude'=>$check_in_latitude,
				'check_in_longitude'=>$check_in_longitude,
				'check_in_loc'=>$check_in_loc,
				'device_idetification'=>$device_idetification,
				'check_in_date_time'=>$checkouttime,
			);
			$x=$this->Lead_api_model->data_insert($data1,'check_in_out_summary');

			$data2=array(
				'user_id'=>$user_id,
				
				'activity'=>'Check in User',
				'device_identification_num'=>$device_idetification,
			);
			$this->Lead_api_model->data_insert($data2,'app_user_logs');

			$json['response'] = [
				'status'     => 'OK',
				'data'   => $x,
			]; 

	

		}else{
			$json['response'] = [
				'status'     => 'Error',
				'data'   => 'check in latitude  Or check in longitude Require',
			]; 
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	}
	public function checkinupdateuser_post(){
		$user_id=$this->input->post('user_id');
		$check_in_id=$this->input->post('check_in_id');
		$check_in_latitude=$this->input->post('check_in_latitude');
		$check_in_longitude=$this->input->post('check_in_longitude');
		$check_in_loc=$this->input->post('check_in_loc');
		$device_idetification=$this->input->post('deviceno');
		$this->load->model('Lead_api_model');

		if(($check_in_latitude !="") && ($check_in_longitude !="") &&  ($check_in_id !="")){
			$data1=array(
				'check_in_id'=>$check_in_id,
				'user_id'=>$user_id,
				'check_in_latitude'=>$check_in_latitude,
				'check_in_longitude'=>$check_in_longitude,
				'check_in_loc'=>$check_in_loc,
				'device_idetification'=>$device_idetification,
			);
			$x=$this->Lead_api_model->data_insert($data1,'location_update');

			$data2=array(
				'user_id'=>$user_id,
				
				'activity'=>'Location Update in User',
				'device_identification_num'=>$device_idetification,
			);
			$this->Lead_api_model->data_insert($data2,'app_user_logs');
			$json['response'] = [
				'status'     => 'OK',
				'data'   => $x,
			]; 
		}else{
			$json['response'] = [
				'status'     => 'Error',
				'data'   => 'check in latitude  Or check in longitude  Or Check in Id Require',
			]; 
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);
	}
	public function checkoutuser_post(){
		$user_id=$this->input->post('user_id');
		$check_in_id=$this->input->post('check_in_id');
		$check_out_latitude=$this->input->post('check_out_latitude');
		$check_out_longitude=$this->input->post('check_out_longitude');
		$check_out_loc=$this->input->post('check_out_loc');
		$device_idetification=$this->input->post('deviceno');
		$this->load->model('Lead_api_model');

		date_default_timezone_set('Asia/Kolkata');
		$checkouttime= date('Y-m-d H:i');
		$checkintime="";
	
		if(($check_out_latitude !="") && ($check_out_longitude !="") &&  ($check_in_id !="")){

			$this->db->select('*');    
			$this->db->from('check_in_out_summary');
			$this->db->where('check_in_id',$check_in_id);
			$hasil4=$this->db->get(); 
			if($hasil4->num_rows() >0){
				$result=array();
				foreach($hasil4->result_array() as $getdata){
					$checkintime=$getdata['check_in_date_time'];
				}
			
			$ctime= (explode(" ",$checkouttime));
			$cintime= (explode(" ",$checkintime));
	
				//print_r($cintime[1]);
		
	
				$time1 = new DateTime($ctime[1]);
				$time2 = new DateTime($cintime[1]);
				$interval = $time1->diff($time2);
	
				$s= $interval->format('%s');
				$h= $interval->format('%h');
				$i= $interval->format('%i');
				$diff=$h.":".$i.":".$s;
	
			$data2=array(
				
				'user_id'=>$user_id,
				'check_out_latitude'=>$check_out_latitude,
				'check_out_longitude'=>$check_out_longitude,
				'check_out_loc'=>$check_out_loc,
				'device_idetification'=>$device_idetification,
				'check_out_date_time'=>$checkouttime,
				'total_time'=>$diff,
			);
		
		$x=	$this->Lead_api_model->data_update($data2,'check_in_out_summary','check_in_id',$check_in_id);
		
		$data3=array(
			'user_id'=>$user_id,
			
			'activity'=>'Check Out By  User',
			'device_identification_num'=>$device_idetification,
		);
		$this->Lead_api_model->data_insert($data3,'app_user_logs');
		$json['response'] = [
			'status'     => 'OK',
			'data'   => $x,
		]; 
	}else{
		$json['response'] = [
			'status'     => 'Error ',
			'data'   => 'Check in Id Not Found',
		]; 
	}
		}else{
			$json['response'] = [
				'status'     => 'Error',
				'data'   => 'check in latitude  Or check in longitude  Or Check in Id Require',
			]; 
		}
		echo json_encode($json, JSON_UNESCAPED_UNICODE);

	}
	

  

}
