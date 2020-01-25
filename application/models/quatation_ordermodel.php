<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quatation_ordermodel extends CI_Model{
    function data_insert($data,$table){
      
      
            $result = $this->db->insert($table,$data);
            $id=$this->db->insert_id();

            $usertype=$this->session->userdata('user_type');
          
            if($usertype !="Admin"){
                $data5 = array(
                    'order_status'=>1,
                );
                $this->db->where('id',$id);
                $result = $this->db->update('order_master',$data5);
            }else{
                $data5 = array(
                    'order_status'=>2,
                );
                $this->db->where('id',$id);
                $result = $this->db->update('order_master',$data5); 
            }

        
            $data	= $this->input->post('studejsonObj');

            foreach($data as $studentinfo){
                $data1 = array(
                    'order_id' =>$id,
                    'product_name' =>$studentinfo['productname'] ,
                    'qty' => $studentinfo['qty'],
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_tax' =>$studentinfo['ordertax'],
                    'version' =>$this->input->post('search_version'),
                   
        
                );
                $this->db->insert('order_detalis',$data1);

                //for new product insert
                $data2 = array(
                   
                    'product_name' =>$studentinfo['productname'] ,
                    
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_value_tax' =>$studentinfo['ordertax'],
                
                );


                $this->db->select('*');    
                $this->db->from('product_master');
                $this->db->where('product_name',$studentinfo['productname']);
                $hasil4=$this->db->get(); 
                 $num = $hasil4->num_rows();
                if($num >0){
                   
                }else{
                    $this->db->insert('product_master',$data2);
                }


            }
            return $id;
        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);
        
       
      

        $this->db->select('*');    
        $this->db->from('order_detalis');
        $this->db->where('order_id',$id);
        $hasil4=$this->db->get(); 
        $num = $hasil4->num_rows();
        if($num >0){
            $this->db->where('order_id',$id);
           $this->db->delete("order_detalis");
        }
       

        $data	= $this->input->post('studejsonObj');

            foreach($data as $studentinfo){
                $data1 = array(
                    'order_id' =>$id,
                    'product_name' =>$studentinfo['productname'] ,
                    'qty' => $studentinfo['qty'],
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_tax' =>$studentinfo['ordertax'],
                    'version' => $this->input->post('search_version'),
                   
        
                );
                $this->db->insert('order_detalis',$data1);

                //for new product insert
                $data2 = array(
                   
                    'product_name' =>$studentinfo['productname'] ,
                    
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_value_tax' =>$studentinfo['ordertax'],
                
                );


                $this->db->select('*');    
                $this->db->from('product_master');
                $this->db->where('product_name',$studentinfo['productname']);
                $hasil4=$this->db->get(); 
                 $num = $hasil4->num_rows();
                if($num >0){
                   
                }else{
                    $this->db->insert('product_master',$data2);
                }
            }
    return $result;
}
function checkcategoryexist($id,$catetype){
    $this->db->select('*');    
    $this->db->from('category_type');
    if($id >0){
        $this->db->where('id !=',$id);
    }
    $this->db->where('status',1);
    $this->db->where('category_type',$catetype);
    $hasil4=$this->db->get(); 

    $num = $hasil4->num_rows();
    if($num >0){
        return '100';
    }else{
        return '0';
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
function get_data_get(){
    $this->db->select('product_name');    
    $this->db->from('product_master');
    $this->db->where('status',1);
    $hasil=$this->db->get();
    return $hasil->result();
}
function get_productdetalis($val){
    $this->db->select('*');    
    $this->db->from('product_master');
    $this->db->where('status',1);
    $this->db->where('product_name',$val);
    $hasil=$this->db->get();
    return $hasil->result();
}
function get_master_allcustomer(){
    $this->db->select('customer_name');    
    $this->db->from('new_account');
    $this->db->where('status',1);
    $hasil=$this->db->get();
    return $hasil->result();
}
function get_customer_detalis($customer){
    $result=array();
    $this->db->select('*');    
    $this->db->from('new_account');
    $this->db->where('status',1);
    $this->db->where('customer_name',$customer);
    $hasil=$this->db->get();

    if($hasil->num_rows()>0){
        foreach($hasil->result_array() as $customerinfo)
        {
            $custid=$customerinfo['id'];

            $this->db->select('*');    
            $this->db->from('contact_information');
            $this->db->where('status',1);
            $this->db->where('account_id',$custid);
            $this->db->order_by("id", "asc");
            $this->db->limit(1);
            $hasil1=$this->db->get();
            return $hasil1->result();
        }
    }else{
        return '0';
    }
   
}
function getall_order(){
    $result=array();
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('order_master.status',1);
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('user_id',$this->session->userdata('useruniqueid'));
    }
    $hasil=$this->db->get();
    if($hasil->num_rows() >0){
        foreach($hasil->result_array() as $quatationdata){
            $id= $quatationdata['id'];
            $customer_name= $quatationdata['customer_name'];
            $order_no= $quatationdata['order_no'];
            $contact_person= $quatationdata['contact_person'];
            $ref_number= $quatationdata['ref_number'];
            $mobile_no= $quatationdata['mobile_no'];
            $order_date= $quatationdata['order_date'];
            $email_id= $quatationdata['email_id'];
            $order_due_date= $quatationdata['order_due_date'];
            $description= $quatationdata['description'];
            $total_order_value= $quatationdata['total_order_value'];
            $total_trasfor_price= $quatationdata['total_trasfor_price'];
            $less_input_tax= $quatationdata['less_input_tax'];
            $less_trasportion= $quatationdata['less_trasportion'];
            $less_bg= $quatationdata['less_bg'];
            $user_id= $quatationdata['user_id'];
            $less_others= $quatationdata['less_others'];
            $margin= $quatationdata['margin'];
            //$quote_status= $quatationdata['quote_status'];
            $quote_lock_version= $quatationdata['quote_lock_version'];
            $qutone_no= $quatationdata['qutone_no'];
            $quotation_no= $quatationdata['quotation_no'];
            $salesrepresentative= $quatationdata['salesrepresentative'];
            $customer_id= $quatationdata['customer_id'];
            $remark= $quatationdata['remark'];
            $order_status= $quatationdata['order_status'];
            $firstname='';
            $last_name='';
            $salesperson='';

            if($salesrepresentative >0){
                $this->db->select('*');    
                $this->db->from('user_creation');
                $this->db->where('user_creation.id',$salesrepresentative);
                $hasil1=$this->db->get();
                foreach($hasil1->result_array() as $userdata){
                    $firstname= $userdata['first_name'];
                    $last_name= $userdata['last_name'];
                   
                }
            }

            $result[]=array(
                'id'=>$id,
                'customer_name'=>$customer_name,
                'order_no'=>$order_no,
                'contact_person'=>$contact_person,
                'ref_number'=>$ref_number,
                'mobile_no'=>$mobile_no,
                'order_date'=>$order_date,
                'email_id'=>$email_id,
                'order_due_date'=>$order_due_date,
                'description'=>$description,
                'total_order_value'=>$total_order_value,
                'total_trasfor_price'=>$total_trasfor_price,
                'less_input_tax'=>$less_input_tax,
                'less_trasportion'=>$less_trasportion,
                'less_bg'=>$less_bg,
                'user_id'=>$user_id,
                'less_others'=>$less_others,
                'margin'=>$margin,
              
                'quote_lock_version'=>$quote_lock_version,
              
                'firstname'=>$firstname,
                'last_name'=>$last_name,
                'salesrepresentative'=>$salesrepresentative,
                'qutone_no'=>$qutone_no,
                'quotation_no'=>$quotation_no,
                'customer_id'=>$customer_id,
                'remark'=>$remark,
                'order_status'=>$order_status,


            );
        }
    }
    return $result;
   
}
function getquatation_details($id){
    $this->db->select_max('version');  
    $this->db->from('quotation_detalis');
    $this->db->where('status',1);
    $this->db->where('quatation_id',$id);
    $hasil1=$this->db->get();
    if ($hasil1->num_rows() > 0)
    {
        $res2 = $hasil1->result_array();
        $version = $res2[0]['version'];

        $this->db->select('*');    
        $this->db->from('quotation_detalis');
        $this->db->where('status',1);
        $this->db->where('quatation_id',$id);
        $this->db->where('version',$version);
        $hasil=$this->db->get();
        return $hasil->result();

    }
 
}
function getquotationversion($id){
    $this->db->select('*');    
    $this->db->from('quotation_detalis');
    $this->db->where('status',1);
    $this->db->where('quatation_id',$id);
    $this->db->group_by('version');
    $this->db->order_by('version','DESC');
    $hasil=$this->db->get();
    return $hasil->result();
}
function getquationversionwise($id,$version){

    //echo $id."".$version;
    $this->db->select('*');    
    $this->db->from('quotation_detalis');
    $this->db->where('status',1);
    $this->db->where('quatation_id',$id);
    $this->db->where('version',$version);
    $hasil=$this->db->get();
    return $hasil->result();
}
function getcustomerdetalis($id){

  
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('status',1);
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function getquatation_details_withversion($id){
          $this->db->select('*');    
        $this->db->from('order_detalis');
        $this->db->where('status',1);
        $this->db->where('order_id',$id);
      //  $this->db->where('version',$version);
        $hasil=$this->db->get();
        return $hasil->result();
}
function updatequotestatus($id,$data){
    $this->db->where('id',$id);
    $result = $this->db->update('quotation_master',$data);
    return $result;
}
function getqutationversioninfo($id){
    $this->db->select('quote_lock_version');    
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function getquatationalldata($id){
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function checkorderstatus($id){

    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('order_status',1);
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    if($hasil->num_rows() >0){
   foreach ($hasil->result_array() as $custdata) {
       $id=$custdata['id'];
       $user_id=$custdata['user_id'];


    $this->db->select('*');    
    $this->db->from('user_creation');
    $this->db->where('id',$user_id);
    $this->db->where('user_type !=','Admin');
    $hasil2=$this->db->get();
    if($hasil2->num_rows() >0){
        return '100';
    }
     
   }
}else{
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('id',$id);
    $hasil3=$this->db->get();
    return $hasil3->result();
}

}


public function updatordertatus($id,$data){
    $this->db->where('id',$id);
    $result = $this->db->update('order_master',$data);
    return $result;
}
public function getorderemark($id){
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('id',$id);
    $hasil3=$this->db->get();
    return $hasil3->result();
}
public function checkquotationno($id){

    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('qutone_no',$id);
    $hasil3=$this->db->get();
    
    if ($hasil3->num_rows() > 0)
    {
        return '100';
    }else{
        return '0';
    }
}
public function save_insertpayment(){
  

  $result=0;
  $id=$this->input->post('id');
  $data	= $this->input->post('studejsonObj');
  
  $this->db->select('*');    
  $this->db->from('payment_master');
  $this->db->where('order_id',$id);
  $hasil3=$this->db->get();
  
  if ($hasil3->num_rows() > 0)
  {
    $this->db->where('order_id', $id);
    $this->db->delete('payment_master');
  }
  

    foreach($data as $studentinfo){
        $data1 = array(
            'order_id' =>$id,
            'payment_description' =>$studentinfo['paymentname'] ,
            'amount' =>$studentinfo['amount'],
            'paymenttype' =>$studentinfo['amt'],
          

        );
        $result=$this->db->insert('payment_master',$data1);
    }
    return $result;
}
function getmilestoneinfo($id){
    $this->db->select('*');    
    $this->db->from('payment_master');
    $this->db->where('order_id',$id);
    $hasil3=$this->db->get();
    return $hasil3->result();
}


}

?>