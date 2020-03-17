<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quatationmodel extends CI_Model{
    function data_insert($data,$table,$quotationno){
      
      
            $result = $this->db->insert($table,$data);
            $id=$this->db->insert_id();

          
            $this->db->select('*');    
            $this->db->from('new_account');
            $this->db->where('customer_name',$this->input->post('cus_name'));
            $hasil5=$this->db->get(); 
             $num2 = $hasil5->num_rows();
             if($num2 > 0){
                $custid='';
                 foreach($hasil5->result_array() as $condata){
                    $custid=$condata['id'];
                 }
               
                $this->db->select('*');    
                 $this->db->from('contact_information');
                $this->db->where('email_id',$this->input->post('cus_name'));
                $this->db->where('mobile_no',$this->input->post('mobile_no'));
                $this->db->where('account_id',$custid);
                $hasil6=$this->db->get(); 
                 $num3 = $hasil6->num_rows();
                 if($num3 >0){

                 }else{
                    $data2 = array(
                        'account_id' =>$custid,
                        'contact_name' =>$this->input->post('cotactperson') ,
                        'designation' => '',
                        'email_id' =>$this->input->post('s_email'),
                        'mobile_no' =>$this->input->post('phn'),
                        'lead_line' =>'',
            
                    );
                    $this->db->insert('contact_information',$data2);
                 }


             }else{

                $data3=array(
                    'customer_name'=>$this->input->post('cus_name'),
                    'date'=>date("Y-m-d"),
                    'user_id'=> $this->session->userdata('useruniqueid'),
                );
                $result = $this->db->insert('new_account',$data3);
                $id1=$this->db->insert_id();
                $data2 = array(
                    'account_id' =>$id1,
                    'contact_name' =>$this->input->post('cotactperson') ,
                    'designation' => '',
                    'email_id' =>$this->input->post('s_email'),
                    'mobile_no' =>$this->input->post('phn'),
                    'lead_line' =>'',
        
                );
                $this->db->insert('contact_information',$data2);

                $data5=array(
                    'customer_id'=>$id1,
                );

                $this->db->where('id',$id);
                $result = $this->db->update('quotation_master',$data5);
             }
         

          
                
            

            $data	= $this->input->post('studejsonObj');

            foreach($data as $studentinfo){
                $data1 = array(
                    'quatation_id' =>$id,
                    'product_name' =>$studentinfo['productname'] ,
                    'qty' => $studentinfo['qty'],
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_tax' =>$studentinfo['ordertax'],
                    'version' =>'1',
                    'ovmnm'=>$studentinfo['ovmname'],

                    'quotation_date' =>$this->input->post('o_date'),
                    'salserepresentative' =>$this->input->post('salesrepresentive'),
                   
        
                );
                $this->db->insert('quotation_detalis',$data1);

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
                $data3 = array(
                    'ovmname'=>$studentinfo['ovmname']
                );
                $this->db->select('*');    
                $this->db->from('ovm_master');
                $this->db->where('ovmname',$studentinfo['ovmname']);
                $hasil4=$this->db->get(); 
                 $num = $hasil4->num_rows();
                if($num >0){
                   
                }else{
                    $this->db->insert('ovm_master',$data3);
                }

            }

        $this->db->select_max('version');
        $this->db->from('quotation_master');
        $this->db->where('quotaion_no',$quotationno);
        $hasil1 = $this->db->get(); 
        if($hasil1->num_rows()>0){
        foreach($hasil1->result_array() as $quotationdata){
            $version=$quotationdata['version'];

            $data3 = array(
                   
                'qutaionid' =>$id ,
                
                'version' =>$version,
                'userid' =>$this->session->userdata('useruniqueid'),
                'conformversion'=>0,
        
            ); 
            $this->db->insert('quotation_log',$data3);
        }
        }else{
            $data3 = array(
                   
                'qutaionid' =>$id ,
                'conformversion'=>0,
                'version' =>1,
                'userid' =>$this->session->userdata('useruniqueid'),
             
            ); 
            $this->db->insert('quotation_log',$data3);

            date_default_timezone_set('Asia/Kolkata');
            $date= date('Y-m-d h:i:s');
            $data3 = array(
                   
                'qid' =>$id ,
                'remark'=>'',
                'quote_status' =>1,
                'userid' =>$this->session->userdata('useruniqueid'),
                'created_at'=>$date
             
            ); 
            $this->db->insert('quotation_status',$data3);
        }
       
            return $id;
        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);
        
        $version1="";
      
        $this->db->select('version');    
        $this->db->from('quotation_detalis');
        $this->db->where('quatation_id',$id);
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $hasil=$this->db->get();
    
        if($hasil->num_rows()>0){
            foreach($hasil->result_array() as $quatationinfo){
                $version=$quatationinfo['version'];
                $version1=$version+1;
            }
        }

        $data	= $this->input->post('studejsonObj');

            foreach($data as $studentinfo){
                $data1 = array(
                    'quatation_id' =>$id,
                    'product_name' =>$studentinfo['productname'] ,
                    'qty' => $studentinfo['qty'],
                    'unit_transfor_price' =>$studentinfo['unitprice'],
                    'transfor_tax' =>$studentinfo['unittaxper'],
                    'unit_order_value' =>$studentinfo['orderunitvalue'],
                    'order_tax' =>$studentinfo['ordertax'],
                    'version' => $version1,
                    'ovmnm'=>$studentinfo['ovmname'],

                    'quotation_date' =>$this->input->post('o_date'),
                    'salserepresentative' =>$this->input->post('salesrepresentive'),
        
                );
                $this->db->insert('quotation_detalis',$data1);

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

                $data3 = array(
                    'ovmname'=>$studentinfo['ovmname']
                );
                $this->db->select('*');    
                $this->db->from('ovm_master');
                $this->db->where('ovmname',$studentinfo['ovmname']);
                $hasil4=$this->db->get(); 
                 $num = $hasil4->num_rows();
                if($num >0){
                   
                }else{
                    $this->db->insert('ovm_master',$data3);
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
    $result=array();
    $this->db->select('*');    
    $this->db->from($table);
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('user_id',$this->session->userdata('useruniqueid'));
    }
    $this->db->where('status',1);
    $hasil=$this->db->get();

    if($hasil->num_rows > 0){
        foreach($hasil->result_array() as $quatationdata){
            $id= $quatationdata['id'];
            $customer_name= $quatationdata['customer_name'];
            $quotaion_no= $quatationdata['quotaion_no'];
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
            $quote_status= $quatationdata['quote_status'];
            $quote_lock_version= $quatationdata['quote_lock_version'];
            $version=0;
            if($id >0){

                $this->db->select_max('version');
                $this->db->where('quatation_id',$id);
                 $result = $this->db->get('students'); 
                 foreach($result as $getdversion){
                    $version=$getdversion[''];
                 } 
           
                $this->db->select('*');    
                $this->db->from('quotation_detalis'); 
                $this->db->where('status',1);
                $this->db->where('quatation_id',$id);
                $this->db->limit(1);
                $hasil4=$this->db->get(); 
            
            }
        }
    }

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
            if($hasil1->num_rows()>0){
            return $hasil1->result();
            }else{
                return $custid;
            }
        }
    }else{
        return '0';
    }
   
}
function getall_quotation(){
    // $this->db->select('*');    
    // $this->db->from('quotation_master');
    // $this->db->where('status',1);
    // $hasil=$this->db->get();
    // return $hasil->result();

    $result1=array();

    $this->db->select('*');    
    $this->db->from('quotation_master');
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('user_id',$this->session->userdata('useruniqueid'));
    }
    $this->db->where('status',1);
    $this->db->group_by('quotaion_no');
    $this->db->order_by("id", "desc");
    $hasil1=$this->db->get();

    if($hasil1->num_rows()>0){
        foreach($hasil1->result_array() as $getquono){
            $qutationno=$getquono['quotaion_no'];
           // $quote_lock_version=$getquono['quote_lock_version'];
           // $id2=$getquono['id'];
           $this->db->select('*');
           $this->db->from('quotation_master');
           $this->db->where('quotaion_no',$qutationno);
           $this->db->where('quote_lock_version >',0);
          
           $hasil8 = $this->db->get(); 
           if($hasil8->num_rows() >0){
            foreach($hasil8->result_array() as $quotationdata1){
                $quote_lock_version=$quotationdata1['quote_lock_version'];
                $id2=$quotationdata1['id'];
             
                if($quote_lock_version >0){
                    
                    $this->db->select('quotation_master.*,user_creation.first_name,user_creation.last_name');     
                    $this->db->from('quotation_master');
                    $this->db->join('user_creation', 'user_creation.id = quotation_master.salesrepresentative');
                    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
                        $this->db->where('quotation_master.user_id',$this->session->userdata('useruniqueid'));
                    }
                    $this->db->where('quotation_master.id', $id2);
                    $this->db->where('quotaion_no',$qutationno);
                  
                   $this->db->where('quotation_master.status',1);
                    $hasil=$this->db->get();
                
                    if($hasil->num_rows > 0){
                        foreach($hasil->result_array() as $quatationdata){
                            $id= $quatationdata['id'];
                            $customer_name= $quatationdata['customer_name'];
                            $quotaion_no= $quatationdata['quotaion_no'];
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
                            $quote_status= $quatationdata['quote_status'];
                            $quote_lock_version= $quatationdata['quote_lock_version'];
                            $customer_id= $quatationdata['customer_id'];
                            $version=$quatationdata['version'];
                            $firstname=$quatationdata['first_name'];
                            $last_name=$quatationdata['last_name'];
                            $salesperson=$quatationdata['salesrepresentative'];
                            $remark='';

                             $this->db->select('*');
                            $this->db->from('quotation_status');
                            $this->db->where('qid',$quotaion_no);
                            $this->db->where('quote_status',$quote_status);
                            $hasil9 = $this->db->get(); 
                            if($hasil9->num_rows > 0){
                                foreach($hasil9->result_array() as $quotestatus){
                                  $remark= $quotestatus['remark'];
                                }
                            }
                         
                            $result1[]=array(
                                'id'=>$id,
                                'customer_name'=>$customer_name,
                                'quotaion_no'=>$quotaion_no,
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
                                'quote_status'=>$quote_status,
                                'quote_lock_version'=>$quote_lock_version,
                                'version'=>$version,
                                'firstname'=>$firstname,
                                'last_name'=>$last_name,
                                'salesperson'=>$salesperson,
                                'customer_id'=>$customer_id,
                                'remark'=>$remark,
                
                
                
                            );
                        }
                 }
           }
         

        }
            }else{
                $this->db->select_max('id');
                $this->db->from('quotation_master');
                $this->db->where('quotaion_no',$qutationno);
               
                $hasil1 = $this->db->get(); 
                foreach($hasil1->result_array() as $quotationdata){
                    $id1=$quotationdata['id'];

                $this->db->select('quotation_master.*,user_creation.first_name,user_creation.last_name');    
                $this->db->from('quotation_master');
                $this->db->join('user_creation', 'user_creation.id = quotation_master.salesrepresentative');
                if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
                    $this->db->where('quotation_master.user_id',$this->session->userdata('useruniqueid'));
                }
                $this->db->where('quotation_master.id',$id1);
                $this->db->where('quotation_master.status',1);
                $hasil=$this->db->get();
            
                if($hasil->num_rows > 0){
                    foreach($hasil->result_array() as $quatationdata){
                        $id= $quatationdata['id'];
                        $customer_name= $quatationdata['customer_name'];
                        $quotaion_no= $quatationdata['quotaion_no'];
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
                        $quote_status= $quatationdata['quote_status'];
                        $quote_lock_version= $quatationdata['quote_lock_version'];
                        $customer_id= $quatationdata['customer_id'];
                        $version=$quatationdata['version'];
                        $firstname=$quatationdata['first_name'];
                        $last_name=$quatationdata['last_name'];
                        $salesperson=$quatationdata['salesrepresentative'];
                        $remark='';
                        $this->db->select('*');
                        $this->db->from('quotation_status');
                        $this->db->where('qid',$quotaion_no);
                        $this->db->where('quote_status',$quote_status);
                        $hasil9 = $this->db->get(); 
                        if($hasil9->num_rows > 0){
                            foreach($hasil9->result_array() as $quotestatus){
                              $remark= $quotestatus['remark'];
                            }
                        }
                       
                        $result1[]=array(
                            'id'=>$id,
                            'customer_name'=>$customer_name,
                            'quotaion_no'=>$quotaion_no,
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
                            'quote_status'=>$quote_status,
                            'quote_lock_version'=>$quote_lock_version,
                            'version'=>$version,
                            'firstname'=>$firstname,
                            'last_name'=>$last_name,
                            'salesperson'=>$salesperson,
                            'customer_id'=>$customer_id,
                            'remark'=>$remark,
            
            
                        );
                    }
             }
            }
        }
    
        }
    }


return $result1;
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
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('quotaion_no',$id);
    //$this->db->group_by('version');
    $this->db->order_by('version','DESC');
    $hasil=$this->db->get();
    return $hasil->result();
}
function getquationversionwise($id,$version){
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('quotaion_no',$id);
    $this->db->where('version',$version);
    $hasil=$this->db->get();
    if($hasil->num_rows() >0){
        foreach($hasil->result_array() as $data){
            $id=$data['id'];

            $this->db->select('*');    
            $this->db->from('quotation_detalis');
            $this->db->where('status',1);
            $this->db->where('quatation_id',$id);
          //  $this->db->where('version',$version);
            $hasil=$this->db->get();
            return $hasil->result();
        }
    }
    
   
}
function getcustomerdetalis($id){
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('id',$id);
    $hasil=$this->db->get();
    return $hasil->result();
}
function getquatation_details_withversion($id){
          $this->db->select('*');    
        $this->db->from('quotation_detalis');
        $this->db->where('status',1);
        $this->db->where('quatation_id',$id);
        //$this->db->where('version',$version);
        $hasil=$this->db->get();
        return $hasil->result();
}
function updatequotestatus($id,$data){
    $this->db->where('quotaion_no',$id);
    $this->db->where('version',$this->input->post('lversion'));
    $result = $this->db->update('quotation_master',$data);


    $data3 = array(
                   
        'qutaionid' =>$id ,
        
        'version' =>$this->input->post('lversion'),
        'userid' =>$this->session->userdata('useruniqueid'),
        'conformversion'=> $this->input->post('status'),
       
    ); 
    $this->db->insert('quotation_log',$data3);

    date_default_timezone_set('Asia/Kolkata');
    $date= date('Y-m-d h:i:s');
    $data3 = array(
           
        'qid' =>$id ,
        'remark'=>$this->input->post('stutusremark'),
        'quote_status' =>$this->input->post('status'),
        'user_id' =>$this->session->userdata('useruniqueid'),
        'created_at'=>$date
     
    ); 
    $this->db->insert('quotation_status',$data3);
    return $result;
}
function getqutationversioninfo($id){
    $this->db->select('quote_lock_version');    
    $this->db->from('quotation_master');
    $this->db->where('status',1);
    $this->db->where('quotaion_no',$id);
    $this->db->where('quote_lock_version >',0);
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
function getcount($id){
    $this->db->select('*');  
    $this->db->from('order_master');
    $this->db->where('status',1);
    $this->db->where('qutone_no',$id);
    $hasil1=$this->db->get();
    if ($hasil1->num_rows() > 0)
    {
        $orderid="";
            foreach($hasil1->result_array() as $data){
                $orderid=$data['id'];
            }
            return $orderid;
    }else{
        return 0;
    }
}
function getquatationdate($id){
    $this->db->select('*');  
    $this->db->from('quotation_detalis');
    $this->db->where('status',1);
    $this->db->where('quatation_id',$id);
    //$this->db->where('version',$version);
    $this->db->limit(1);
    $hasil1=$this->db->get();
    return $hasil1->result();
}
function get_dropdown($table){
    $this->db->select('*');  
    $this->db->from('user_creation');
    $this->db->where('status',1);
    $this->db->where('user_type','SalesRepresentative');
    $this->db->where('user_role','Sales');
    $hasil1=$this->db->get();
    return $hasil1->result();
}
function getsalesdata($id,$version){
    $this->db->select('*','user_creation.first_name,user_creation.last_name,user_creation.id');    
                    $this->db->from('quotation_detalis'); 
                    $this->db->join('user_creation', 'user_creation.id = quotation_detalis.salserepresentative');
                    $this->db->where('quotation_detalis.status',1);
                    $this->db->where('version',$version);
                    $this->db->where('quatation_id',$id);
                    $this->db->limit(1);
                    $hasil4=$this->db->get(); 
                   return $hasil4->result();
}
function get_salespername($id){
    $this->db->select('*');  
    $this->db->from('user_creation');

    $this->db->where('id',$id);
   
    $hasil1=$this->db->get();
    return $hasil1->result();
}
function getquatationno(){
              $quatation=0;
                  $this->db->select_max('quotaion_no');
                 $result = $this->db->get('quotation_master'); 
                 if($result->num_rows() >0){
                    foreach($result->result_array() as $data){
                        $quatation=$data['quotaion_no'];
                        $quatation=$quatation+1;
                    }
                    return $quatation;
                    
                 }else{
                    return 1;  
                 }
}
function getquatatinversiondata($bill_no,$version){
    $this->db->select('quotation_master.*,user_creation.first_name,user_creation.last_name');    
    $this->db->from('quotation_master');
    $this->db->join('user_creation', 'user_creation.id = quotation_master.salesrepresentative');
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('quotation_master.user_id',$this->session->userdata('useruniqueid'));
    }
    $this->db->where('quotation_master.quotaion_no',$bill_no);
    $this->db->where('quotation_master.version',$version);
    $this->db->where('quotation_master.status',1);
    $hasil=$this->db->get();
   // echo $this->db->last_query();
    return $hasil->result();

}
function getquationversionwise1($id){
    $this->db->select('*');    
    $this->db->from('quotation_detalis');
    $this->db->where('status',1);
    $this->db->where('quatation_id',$id);
 
    $hasil=$this->db->get();
    return $hasil->result();
}
function getcustomer($id){
    $this->db->select('*');    
    $this->db->from('contact_information');
    $this->db->where('status',1);
    $this->db->where('account_id',$id);
 
    $hasil=$this->db->get();
    return $hasil->result();
}
function getsalesperson(){
    $this->db->select('*');    
    $this->db->from('user_creation');
    $this->db->where('user_type','SalesRepresentative');
    $this->db->where('user_role','Sales');
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('id !=',$this->session->userdata('useruniqueid'));
    }
   
    $hasil=$this->db->get();
    return $hasil->result();
}
function getsearchwisefilter($qsstatus){
    $result1=array();

    $this->db->select('*');    
    $this->db->from('quotation_master');
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('user_id',$this->session->userdata('useruniqueid'));
    }
    
    $this->db->where('status',1);
    $this->db->group_by('quotaion_no');
    $this->db->order_by("id", "desc");
    $hasil1=$this->db->get();

    if($hasil1->num_rows()>0){
        foreach($hasil1->result_array() as $getquono){
            $qutationno=$getquono['quotaion_no'];
           // $quote_lock_version=$getquono['quote_lock_version'];
           // $id2=$getquono['id'];
           $this->db->select('*');
           $this->db->from('quotation_master');
           $this->db->where('quotaion_no',$qutationno);
           $this->db->where('quote_lock_version >',0);
           if($qsstatus >0){
            $this->db->where('quote_status',$qsstatus);  
        }
       
           $hasil8 = $this->db->get(); 
           if($hasil8->num_rows() >0){
            foreach($hasil8->result_array() as $quotationdata1){
                $quote_lock_version=$quotationdata1['quote_lock_version'];
                $id2=$quotationdata1['id'];
             
                if($quote_lock_version >0){
                    
                    $this->db->select('quotation_master.*,user_creation.first_name,user_creation.last_name');     
                    $this->db->from('quotation_master');
                    $this->db->join('user_creation', 'user_creation.id = quotation_master.salesrepresentative');
                    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
                        $this->db->where('quotation_master.user_id',$this->session->userdata('useruniqueid'));
                    }
                    $this->db->where('quotation_master.id', $id2);
                    $this->db->where('quotaion_no',$qutationno);
                   
                   $this->db->where('quotation_master.status',1);
                    $hasil=$this->db->get();
                
                    if($hasil->num_rows > 0){
                        foreach($hasil->result_array() as $quatationdata){
                            $id= $quatationdata['id'];
                            $customer_name= $quatationdata['customer_name'];
                            $quotaion_no= $quatationdata['quotaion_no'];
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
                            $quote_status= $quatationdata['quote_status'];
                            $quote_lock_version= $quatationdata['quote_lock_version'];
                            $customer_id= $quatationdata['customer_id'];
                            $version=$quatationdata['version'];
                            $firstname=$quatationdata['first_name'];
                            $last_name=$quatationdata['last_name'];
                            $salesperson=$quatationdata['salesrepresentative'];

                            $remark='';

                             $this->db->select('*');
                            $this->db->from('quotation_status');
                            $this->db->where('qid',$quotaion_no);
                            $this->db->where('quote_status',$quote_status);
                            $hasil9 = $this->db->get(); 
                            if($hasil9->num_rows > 0){
                                foreach($hasil9->result_array() as $quotestatus){
                                  $remark= $quotestatus['remark'];
                                }
                            }
                            
                            $result1[]=array(
                                'id'=>$id,
                                'customer_name'=>$customer_name,
                                'quotaion_no'=>$quotaion_no,
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
                                'quote_status'=>$quote_status,
                                'quote_lock_version'=>$quote_lock_version,
                                'version'=>$version,
                                'firstname'=>$firstname,
                                'last_name'=>$last_name,
                                'salesperson'=>$salesperson,
                                'customer_id'=>$customer_id,
                                'remark'=>$remark,
                
                
                
                            );
                        }
                 }
           }
         

        }
            }else{
                $this->db->select_max('id');
                $this->db->from('quotation_master');
                $this->db->where('quotaion_no',$qutationno);
                if($qsstatus >0){
                    $this->db->where('quote_status',$qsstatus);  
                }
                $this->db->order_by("id", "desc");
                $hasil1 = $this->db->get(); 
                foreach($hasil1->result_array() as $quotationdata){
                    $id1=$quotationdata['id'];

                $this->db->select('quotation_master.*,user_creation.first_name,user_creation.last_name');    
                $this->db->from('quotation_master');
                $this->db->join('user_creation', 'user_creation.id = quotation_master.salesrepresentative');
                if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
                    $this->db->where('quotation_master.user_id',$this->session->userdata('useruniqueid'));
                }
                $this->db->where('quotation_master.id',$id1);
                $this->db->where('quotation_master.status',1);
                $hasil=$this->db->get();
            
                if($hasil->num_rows > 0){
                    foreach($hasil->result_array() as $quatationdata){
                        $id= $quatationdata['id'];
                        $customer_name= $quatationdata['customer_name'];
                        $quotaion_no= $quatationdata['quotaion_no'];
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
                        $quote_status= $quatationdata['quote_status'];
                        $quote_lock_version= $quatationdata['quote_lock_version'];
                        $customer_id= $quatationdata['customer_id'];
                        $version=$quatationdata['version'];
                        $firstname=$quatationdata['first_name'];
                        $last_name=$quatationdata['last_name'];
                        $salesperson=$quatationdata['salesrepresentative'];

                        $remark='';

                        $this->db->select('*');
                       $this->db->from('quotation_status');
                       $this->db->where('qid',$quotaion_no);
                       $this->db->where('quote_status',$quote_status);
                       $hasil9 = $this->db->get(); 
                       if($hasil9->num_rows > 0){
                           foreach($hasil9->result_array() as $quotestatus){
                             $remark= $quotestatus['remark'];
                           }
                       }
                       
                        $result1[]=array(
                            'id'=>$id,
                            'customer_name'=>$customer_name,
                            'quotaion_no'=>$quotaion_no,
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
                            'quote_status'=>$quote_status,
                            'quote_lock_version'=>$quote_lock_version,
                            'version'=>$version,
                            'firstname'=>$firstname,
                            'last_name'=>$last_name,
                            'salesperson'=>$salesperson,
                            'customer_id'=>$customer_id,
                            'remark'=>$remark,
            
            
                        );
                    }
             }
            }
        }
    
        }
    }


return $result1;
}
public function getquotationdata($id){
    $this->db->select('quotaion_no');
    $this->db->from('quotation_master');
    $this->db->where('id',$id);
     $hasil=$this->db->get();
    return $hasil->result();
}
public function getqutation_status_information($id){
    $this->db->select('quotation_status.*,user_creation.first_name,user_creation.last_name');    
    $this->db->from('quotation_status');
    $this->db->join('user_creation', 'user_creation.id = quotation_status.user_id');
    $this->db->where('quotation_status.qid',$id);
    $this->db->order_by("quotation_status.id", "desc");
    $hasil=$this->db->get();
   // echo $this->db->last_query();
    return $hasil->result();
}
public function getovm_detalis(){
    $this->db->select('*');
    $this->db->from('ovm_master');
    $hasil=$this->db->get();
    return $hasil->result();
}

}
