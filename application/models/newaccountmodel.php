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
    $result=array();
    $this->db->select('new_account.*');    
    $this->db->from('new_account');
    //$this->db->join('category_type', 'category_type.id = new_account.category_id');
   // $this->db->join('customer_type', 'customer_type.id = new_account.customer_type');
    if($fromdate !="" && $todate !=""){
        $this->db->where('date >=',$fromdate);
        $this->db->where('date <=',$todate);
       
    }
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('new_account.user_id',$this->session->userdata('useruniqueid'));
    }
    $this->db->where('new_account.status',1);
    $hasil=$this->db->get();
    if($hasil->num_rows() > 0){
        foreach($hasil->result_array() as $newacdata){
            $id=$newacdata['id'];
            $date=$newacdata['date'];
            $category_id=$newacdata['category_id'];
            $customer_name=$newacdata['customer_name'];
            $no_of_employee=$newacdata['no_of_employee'];
            $customer_type=$newacdata['customer_type'];
            $requirement=$newacdata['requirement'];
            $remark=$newacdata['remark'];
            $address=$newacdata['address'];
            $customertype='';
            $categorytype='';

            if($customer_type >0){
                $this->db->select('customer_type as customertype');    
                $this->db->from('customer_type');
                $this->db->where('id',$customer_type);
                $hasil1=$this->db->get();
                if($hasil1->num_rows() >0){
                    foreach($hasil1->result_array() as $customertypedata){
                        $customertype=$customertypedata['customertype'];
                    }
                }

            }
            if($category_id >0){
                $this->db->select('category_type');    
                $this->db->from('category_type');
                $this->db->where('id',$category_id);
                $hasil1=$this->db->get();
                if($hasil1->num_rows() >0){
                    foreach($hasil1->result_array() as $categorydata){
                        $categorytype=$categorydata['category_type'];
                    }
                }

            }

           $result[]=array(
            'id'=>$id,
            'date'=>$date,
            'category_id'=>$category_id,
            'customer_name'=>$customer_name,
            'no_of_employee'=>$no_of_employee,
            'customer_type'=>$customer_type,
            'requirement'=>$requirement,
            'remark'=>$remark,
            'customertype'=>$customertype,
            'categorytype'=>$categorytype,
            'address'=>$address,
           );
        
        }
    }
    return $result;
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

}
?>