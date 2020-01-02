<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class customerreportmodel extends CI_Model{
    function data_insert($data,$table){
      
      
            $result = $this->db->insert($table,$data);
            return $result;
        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);
    return $result;
}

function getcustomerdata($salesid){
    $result=array();
    $this->db->select('*');    
    $this->db->from('new_account');
    $this->db->where('user_id',$salesid);
    $this->db->or_where('`id` IN (SELECT `customer_id` FROM `quotation_master` where salesrepresentative='.$salesid.')', NULL, FALSE);
    $this->db->or_where('`id` IN (SELECT `customer_id` FROM `order_master` where salesrepresentative='.$salesid.')', NULL, FALSE);
     $hasil=$this->db->get();
     if($hasil->num_rows()>0){
         foreach($hasil->result_array() as $newacdata){
             $custname=$newacdata['customer_name'];
             $id=$newacdata['id'];
             $no_of_employee=$newacdata['no_of_employee'];
             $customer_type=$newacdata['customer_type'];
             $remark=$newacdata['remark'];
             $customertype='';
             $contactdata=array();
                if($customer_type >0){
                    $this->db->select('*');    
                    $this->db->from('customer_type');
                    $this->db->where('id',$customer_type);
                    $hasil1=$this->db->get();
                    foreach($hasil1->result_array() as $data){
                        $customertype=$data['customer_type'];
                    }
                }
                if($id >0){
                    $this->db->select('*');    
                    $this->db->from('contact_information');
                    $this->db->where('account_id',$id);
                    $hasil2=$this->db->get();
                    foreach($hasil2->result_array() as $contactinfo){
                       $contact_name=$contactinfo['contact_name'];
                       $designation=$contactinfo['designation'];
                       $email_id=$contactinfo['email_id'];
                       $mobile_no=$contactinfo['mobile_no'];

                       $contactdata[]=array(
                           'contact_name'=>$contact_name,
                           'designation'=>$designation,
                           'email_id'=>$email_id,
                           'mobile_no'=>$mobile_no,
                       );
                        
                    }
                }
                $result[]=array(
                    'custname'=>$custname,
                    'no_of_employee'=>$no_of_employee,
                    'customer_type'=>$customer_type,
                    'customertype'=>$customertype,
                    'remark'=>$remark,
                    'contactdata'=>$contactdata,
                );


         }
     }

    return $result;
}


}

?>