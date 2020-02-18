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

    if (date('m') <= 6) {//Upto June 2014-2015
        $financial_year = date('Y')-1;
        $financial_year1= date('Y');
    } else {//After June 2015-2016
        $financial_year = date('Y');
        $financial_year1= date('Y') + 1;
    }
    $stratdate='1-04-'.$financial_year;
    $enddarte='31-03-'.$financial_year1;


 
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
             $qutationcount='';
             $ordercount='';
             $orderamt=0;
             $qutationamt=0;
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

                    $this->db->select('*');    
                    $this->db->from('quotation_master');
                    $this->db->where('salesrepresentative',$salesid);
                    $this->db->where('customer_id',$id);
                    $this->db->where('quote_status != ',2);
                    $this->db->where('order_date >=',$stratdate);
                    $this->db->where('order_date <=', date('Y-m-d'));
                    $hasil=$this->db->get();
                    $qutationcount=$hasil->num_rows();


                    $this->db->select('*');    
                    $this->db->from('order_master');
                    $this->db->where('salesrepresentative',$salesid);
                    $this->db->where('customer_id',$id);
                    $this->db->where('order_date >=',$stratdate);
                    $this->db->where('order_date <=', date('Y-m-d'));
                    $hasil1=$this->db->get();
                    $ordercount=$hasil1->num_rows();

                    $this->db->select('SUM(total_order_value) AS total_order_value');
                   
                    $this->db->where('salesrepresentative',$salesid);
                    $this->db->where('customer_id',$id);
                    $this->db->where('order_date >=',$stratdate);
                    $this->db->where('order_date <=', date('Y-m-d'));
                    $qwer = $this->db->get('quotation_master');
                    foreach($qwer->result_array() as $sumamt){
                        $qutationamt=$sumamt['total_order_value'];
                    }

                    $this->db->select('SUM(total_order_value) AS total_order_value');
                    $this->db->where('salesrepresentative',$salesid);
                    $this->db->where('customer_id',$id);
                    $this->db->where('order_date >=',$stratdate);
                    $this->db->where('order_date <=', date('Y-m-d'));
                    $hasil2=$this->db->get('order_master');
                   
                    foreach($hasil2->result_array() as $sumamt1){
                        $orderamt=$sumamt1['total_order_value'];
                    }
                    if($orderamt ==null){
                        $orderamt=0; 
                    } 
                    if($qutationamt ==null){
                        $qutationamt=0; 
                    } 
                }
                $result[]=array(
                    'custname'=>$custname,
                    'no_of_employee'=>$no_of_employee,
                    'customer_type'=>$customer_type,
                    'customertype'=>$customertype,
                    'remark'=>$remark,
                    'contactdata'=>$contactdata,
                    'qutationcount'=>$qutationcount,
                    'ordercount'=>$ordercount,
                    'orderamt'=>$orderamt,
                    'qutationamt'=>$qutationamt,

                );


         }
     }

    return $result;
}


}

?>