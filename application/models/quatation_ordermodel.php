<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quatation_ordermodel extends CI_Model{
    function data_insert($data,$table){
      
      
            $result = $this->db->insert($table,$data);
            $id=$this->db->insert_id();

        
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
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('status',1);
    $hasil=$this->db->get();
    return $hasil->result();
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


}

?>