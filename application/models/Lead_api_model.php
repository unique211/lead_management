<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lead_api_model extends CI_Model{
    function data_insert($data,$table){
      
      
			 $this->db->insert($table,$data);
			$id=$this->db->insert_id();
            return $id;
        
        
    }
    function data_update($data,$table,$colum,$id){
		$this->db->select('*');    
		$this->db->from('check_in_out_summary');
		$this->db->where('check_in_id',$id);
		$hasil4=$this->db->get(); 
		if($hasil4->num_rows() >0){
			$this->db->where($colum,$id);
        $result = $this->db->update($table,$data);
    return $result;
		}else{
				return 0;
		}
	   
		
}
function logincheck($email,$pass){
    $this->db->select('*');    
    $this->db->from('user_creation');
    
    $this->db->where('email',$email);
    $this->db->where('password',$pass);
    $hasil4=$this->db->get(); 
    if($hasil4->num_rows() >0){
        $result=array();
        foreach($hasil4->result_array() as $getdata){
            $userid=$getdata['id'];
            $user_name=$getdata['user_name'];
            $first_name=$getdata['first_name'];
            $last_name=$getdata['last_name'];
            $phone_num=$getdata['phone_num'];
            $user_type=$getdata['user_type'];
            $gender=$getdata['gender'];
            $department =$getdata['department'];
            $user_role =$getdata['user_role'];
            $company_name =$getdata['company_name'];

            $result[]=array(
                'userid'=>$userid,
                'user_name'=>$user_name,
                'first_name'=>$first_name,
                'last_name'=>$last_name,
                'phone_num'=>$phone_num,
                'user_type'=>$user_type,
                'gender'=>$gender,
                'department'=>$department,
                'user_role'=>$user_role,
                'company_name'=>$company_name,
            );
        }
        return $result;     
    }else{
		return 0;
       
    }
    

}
function data_get($table){
    $this->db->select('*');    
    $this->db->from($table);
    $this->db->where('status',1);
$hasil=$this->db->get();

return $hasil->result();
}
function deletedata($id,$table){
    $data=array(
        'status'=>0,
    );

    $this->db->where('id',$id);
    $result = $this->db->update($table,$data);
    return $result;
}
function checkcustomerexists($id,$customer){
    $this->db->select('*');    
    $this->db->from('customer_type');
    if($id >0){
        $this->db->where('id !=',$id);
    }
    $this->db->where('status',1);
    $this->db->where('customer_type',$customer);
    $hasil4=$this->db->get(); 

    $num = $hasil4->num_rows();
    if($num >0){
        return '100';
    }else{
        return '0';
    }
}
function getdropdwn($table,$where){
    $this->db->select('*');    
    $this->db->from($table);
    $this->db->where('status',1);
    $hasil=$this->db->get();

return $hasil->result();
}
function getoutlookdata(){
    $result=[];
    $this->db->select('*');    
    $this->db->from('appointment_information');
    $this->db->where('synchronize','local');
    $this->db->or_where('synchronize','outlook');
    $hasil=$this->db->get();
    foreach($hasil->result_array() as $getdata){
        $id=$getdata['id'];
        $event_id=$getdata['event_id'];
        $subname=$getdata['appointment_notes'];
        $content=$getdata['appointment_address'];
        $startdate=$getdata['start_date'];
        $enddate=$getdata['end_date'];
        $color='';
        $resudeal_date=$getdata['resudeal_date'];
        $reschedultime=$getdata['reschedultime'];
        if($reschedultime !="" && $resudeal_date !=""){
            $color="#FF0000";
            $startdate=$getdata['resudeal_date'];
            $enddate=$getdata['resudeal_date'];
        }else{
            $color="#2a9df4";
        }
       

        $timestamp = strtotime($startdate);
        $fromdate = date("Y-m-d", $timestamp);

        $timestamp = strtotime($enddate);
        $todate = strtotime("+1 day", $timestamp);

        $todate = date("Y-m-d", $todate);

        $result[]=array(
            'id'=> $id,
            'title'=>$subname,
            'start'=>$fromdate,
            'end'=>$todate,
            'color'=>$color,

        );
    }


    return $result;
}
function getresechudelapp($id){
    $this->db->select('*');    
    $this->db->from('resechedul_appoiment');
    $this->db->where('appid',$id);
    $hasil=$this->db->get();
    return $hasil->result();

}
function getappoimentnotes($id){
    $this->db->select('*,user_creation.first_name,user_creation.last_name');    
    $this->db->from('demo_notes_entry');
    $this->db->join('user_creation', 'user_creation.id = demo_notes_entry.user_id');

    $this->db->where('aid',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function geteventinfo($id){
    $this->db->select('*');    
    $this->db->from('appointment_information');
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
}

?>
