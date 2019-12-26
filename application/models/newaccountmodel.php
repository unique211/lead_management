<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class NewAccountmodel extends CI_Model{
    function data_insert($data,$table){
      
        if($table=="new_account"){
            $result = $this->db->insert($table,$data);
            $id=$this->db->insert_id();

            $data	= $this->input->post('studejsonObj');

            foreach($data as $studentinfo){
                $data1 = array(
                    'account_id' =>$id,
                    'contact_name' =>$studentinfo['contactname'] ,
                    'designation' => $studentinfo['designation'],
                    'email_id' =>$studentinfo['email'],
                    'mobile_no' =>$studentinfo['mobile'],
                    'lead_line' =>$studentinfo['landline']
        
                );
                $this->db->insert('contact_information',$data1);
            }
            return $result;
        }else{

            $result = $this->db->insert($table,$data);
            return $result;
        }

        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);

        $this->db->select('*');    
        $this->db->from('contact_information');
        $this->db->where('account_id',$id);
        $hasil4=$this->db->get(); 
        $num = $hasil4->num_rows();
        if($num >0){
            $this->db->where('account_id',$id);
           $this->db->delete("contact_information");
        }

        $data	= $this->input->post('studejsonObj');

        foreach($data as $studentinfo){
            $data1 = array(
                'account_id' =>$id,
                'contact_name' =>$studentinfo['contactname'] ,
                'designation' => $studentinfo['designation'],
                'email_id' =>$studentinfo['email'],
                'mobile_no' =>$studentinfo['mobile'],
                'lead_line' =>$studentinfo['landline']
    
            );
            $this->db->insert('contact_information',$data1);
        }
    return $result;
}
function checkcategoryexist($id,$catetype){
    $this->db->select('*');    
    $this->db->from('new_account');
    if($id >0){
        $this->db->where('id !=',$id);
    }
    $this->db->where('status',1);
    $this->db->where('customer_name',$catetype);
    $hasil4=$this->db->get(); 

    $num = $hasil4->num_rows();
    if($num >0){
        return '100';
    }else{
        return '0';
    }

}
function data_get($table,$fromdate,$todate){
    $this->db->select('new_account.*,category_type.category_type as categorytype,customer_type.customer_type as customertype');    
    $this->db->from('new_account');
    $this->db->join('category_type', 'category_type.id = new_account.category_id');
    $this->db->join('customer_type', 'customer_type.id = new_account.customer_type');
    if($fromdate !="" && $todate !=""){
        $this->db->where('date >=',$fromdate);
        $this->db->where('date <=',$todate);
       
    }
    $this->db->where('new_account.status',1);
    $hasil=$this->db->get();
    return $hasil->result();
}
function deletedata($id,$table){
    $data=array(
        'status'=>0,
    );

    $this->db->where('id',$id);
    $result = $this->db->update($table,$data);

    $this->db->where('account_id',$id);
    $this->db->delete("contact_information");
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
function getcontactdata($id,$table){
    $this->db->select('*');    
    $this->db->from('contact_information');
    $this->db->where('account_id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}

}
?>