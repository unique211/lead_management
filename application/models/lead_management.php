<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lead_management extends CI_Model
{

  function insert_user_data($user_id,$emp_id,$user_name,$fisrt_name,$last_name,$email,$password,$phone_number,$user_type,$gender,$google_id,$title,$department,$comments,$user_role,$region,$region_type,$company,$addr,$currentfcyearamt)
  {
  	$s="INSERT into user_creation (user_id,emp_id,user_name,first_name,last_name,email,password,
  		phone_num,user_type,gender,title,department,comments,google_calendar_id,user_role,region,region_type,company_name,address,finicialyear_amt) 
		values('$user_id','$emp_id','$user_name','$fisrt_name','$last_name','$email','$password','$phone_number','$user_type','$gender','$title','$department','$comments','$google_id','$user_role','$region','$region_type','$company','$addr','$currentfcyearamt')";
  $this->db->query($s);
  }
  function insert_dealer_data($user_id,$dealer_id,$d_first_name,$d_last_name,$d_email,$email,$d_phone_number,$d_company_name,$d_region,$d_region_type,$d_address)
  {
  	$s1="INSERT into dealer_creation(user_id,dealer_id,d_first_name,d_last_name,d_email,d_phone_num,company_name,
  d_region,d_region_type,d_address) 
  values('$user_id','$dealer_id','$d_first_name','$d_last_name','$d_email','$d_phone_number','$d_company_name','$d_region','$d_region_type','$d_address')";
  $this->db->query($s1);
  }
  function display_data($user_id)
	{
     $user_type=$this->session->userdata('user_type');
    if($user_type=="Admin")
    {
      $s="SELECT * from user_creation where status='1' ";
    }
    else{
      $s="SELECT * from user_creation where status='1' and user_id='$user_id'";
    }
		
		$d=$this->db->query($s);
		return $d->result_array();
	}
  function sales_rep_view($id)
  {
    $s="SELECT * from user_creation where id='$id'";
    $q=$this->db->query($s);
    return $q->result_array();

  }
  function edit_sales_rep_data_code($id,$f_name,$l_name,$u_name,$email,$gender,$phone,$user_role,$c_name,$region,$region_type,$u_type,$cal_id,$u_title,$department,$comments,$address,$finicialamt)
  {
    $s="UPDATE  user_creation SET first_name='$f_name',last_name='$l_name',email='$email',user_name='$u_name',phone_num='$phone',user_type='$u_type',gender='$gender',title='$u_title',department='$department',comments='$comments',google_calendar_id='$cal_id',user_role='$user_role',region='$region',region_type='$region_type',company_name='$c_name',address='$address',finicialyear_amt='$finicialamt' where emp_id='$id'";
    $this->db->query($s);
  }
  function delete_sales_rep_data_code($id)
  {
    $s="UPDATE  user_creation SET status='0' where id='$id'";
    $this->db->query($s);
  }
  function dealer_display_data_edit($id)
  {
     $user_type=$this->session->userdata('user_type');
    if($user_type=="Admin")
    {
      $s="SELECT * from dealer_creation where status='1' ";
    }else{
      $s="SELECT * from dealer_creation where status='1' and user_id='$id'";
    }
     $d=$this->db->query($s);
    return $d->result_array();
  }
  function dealer_display_data($user_id)
  {
    
      $s="SELECT * from user_creation where status='1' and id!='$user_id' and user_role='Dealer'";
   
    $d=$this->db->query($s);
    return $d->result_array();
  }
  function dealer_rep_view($id)
  {
    $s="SELECT * from dealer_creation where id='$id'";
    $q=$this->db->query($s);
    return $q->result_array();

  }
  function edit_dealer_rep_data_code($id,$d_r_f_name,$d_r_email,$d_phone_num)
  {
    $s="UPDATE  dealer_creation SET d_first_name='$d_r_f_name',d_email='$d_r_email',d_phone_num='$d_phone_num' where dealer_id='$id'";
    $this->db->query($s);
    
  }
  function delete_dealer_rep_data_code($id)
  {
    $s="UPDATE  dealer_creation SET status='0' where id='$id'";
    $this->db->query($s);
  }
  function set_userpermissions($data,$email)
  {
    $p=$data['permissions'];
    $u_type=$data['user_type'];
     $s="UPDATE  page_access SET permissions='$p' where user_type='$u_type'";
    $this->db->query($s);
    
  }
  /*function get_permissions($val)
  {
    $query="SELECT permissions from user_type where user_type='$val'";

    $fetch=$this->db->query($query);
    return $fetch->result_array();

  }*/
}
?>