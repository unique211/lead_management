<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Viewappoimentmodel extends CI_Model{
    function data_insert($data,$table){
      
        

            $result = $this->db->insert($table,$data);
            return $result;
        

        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);

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
function data_get($table,$editid){
    $result=array();
    $this->db->select('demo_notes_entry.*,user_creation.first_name,user_creation.last_name,demo_notes_entry.id as id');    
    $this->db->from('demo_notes_entry');
    $this->db->join('user_creation', 'user_creation.id = demo_notes_entry.user_id');
    $this->db->where('demo_notes_entry.aid',$editid);
    $this->db->order_by("demo_notes_entry.id", "desc");
    $hasil=$this->db->get();
    return $hasil->result();
   // $this->db->join('customer_type', 'customer_type.id = new_account.customer_type');
  
}
public function data_get_resdata($table,$eid){
    $this->db->select('*');    
    $this->db->from('resechedul_appoiment');
    $this->db->where('appid',$eid);
    $hasil4=$this->db->get(); 
    return $hasil4->result();


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
function getcontactdata($id,$table){
    $this->db->select('*');    
    $this->db->from('contact_information');
    $this->db->where('account_id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function data_get_1($table,$fromdate,$todate){
    $result=array();
    $this->db->select('new_account.*,category_type.category_type as categorytype,customer_type.customer_type as customertype');    
    $this->db->from('new_account');
    $this->db->join('category_type', 'category_type.id = new_account.category_id');
    $this->db->join('customer_type', 'customer_type.id = new_account.customer_type');
    if($fromdate !="" && $todate !=""){
        $this->db->where('date >=',$fromdate);
        $this->db->where('date <=',$todate);
       
    }
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('new_account.user_id',$this->session->userdata('useruniqueid'));
    }
    $this->db->where('new_account.status',1);
    $hasil=$this->db->get();
    return $hasil->result();
}
function checkemail($id,$email){
    $this->db->select('*');    
    $this->db->from('contact_information');
    if($id >0){
        $this->db->where('account_id !=',$id);
    }
    $this->db->where('email_id',$email);
    $hasil=$this->db->get();
   if($hasil->num_rows() >0){
       return '100';
   }else{
    return '0';
   }
}
function checkmoblino($id,$mobile){
    $this->db->select('*');    
    $this->db->from('contact_information');
    if($id >0){
        $this->db->where('account_id !=',$id);
    }
    $this->db->where('mobile_no',$mobile);
    $hasil=$this->db->get();
   if($hasil->num_rows() >0){
       return '100';
   }else{
    return '0';
   }
}
function checklandline($id,$landline){
    $this->db->select('*');    
    $this->db->from('contact_information');
    if($id >0){
        $this->db->where('account_id !=',$id);
    }
    $this->db->where('lead_line',$landline);
    $hasil=$this->db->get();
   if($hasil->num_rows() >0){
       return '100';
   }else{
    return '0';
   }
}
function getac_addresss($nm){
   
        $this->db->select('*');    
    $this->db->from('new_account');
    $this->db->where('id',$nm);
    $hasil=$this->db->get(); 
   return $hasil->result();
}

}
?>