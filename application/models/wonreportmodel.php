<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Wonreportmodel extends CI_Model{
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
public function getwondata($id,$statdate){
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('salesrepresentative',$id);
    $this->db->where('order_date >=',$statdate);
    $this->db->where('order_date <=', date('Y-m-d'));
    $hasil=$this->db->get();

    if($hasil->num_rows() >0){
        foreach($hasil->result_array() as $data){
            $oid=$data['id'];
            $order_no=$data['order_no'];
            $customer_name=$data['customer_name'];
            $quotation_no=$data['quotation_no'];
            $poorder_date=$data['order_date'];
            $description=$data['description'];
            $orderdate='';
            $magin=0;
            $totalordvalue=0;
            $product='';

            if($quotation_no >0){
                $this->db->select('*');    
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotation_no);
            $this->db->where('version',1);
            $hasil1=$this->db->get();
            foreach($hasil1->result_array() as $qutationdata){
                $orderdate=$qutationdata['order_date'];
            }
         
            }

            $this->db->select('*');    
            $this->db->from('order_detalis');
            $this->db->where('order_id',$oid);
            $hasil2=$this->db->get();
            foreach($hasil2->result_array() as $odetalis ){
                $product=$odetalis['product_name'];
                $qty=$odetalis['qty'];
                $unit_order_value=$odetalis['unit_order_value'];
                $unit_transfor_price=$odetalis['unit_transfor_price'];
                $transfor_tax=$odetalis['transfor_tax'];
                $order_tax=$odetalis['order_tax'];

                $total= $qty * $unit_order_value;
                $total1= $qty * $unit_transfor_price;
                $otax=($total * $order_tax)/100;

                $magin= $magin+( $total- $total1);
                $totalordvalue= $totalordvalue+$total+$otax;

                $summargin=$magin+$summargin;
                $sum=$totalordvalue+$sum;

            }

            $result[]=array(
                'order_no'=>$order_no,
                'customer_name'=>$customer_name,
                'poorder_date'=>$poorder_date,
                'description'=>$description,
                'orderdate'=>$orderdate,
                'magin'=>$magin,
                'totalordvalue'=>$totalordvalue,
                'product'=>$product,
                'status'=>'Invoice Generated'
            );
           
        }
    }
    return $result;

}
function getlossreport($id,$statdate){
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('salesrepresentative',$id);
    $this->db->where('order_date >=',$statdate);
    $this->db->where('order_date <=', date('Y-m-d'));
    $this->db->group_by('quotaion_no');
    $hasil=$this->db->get();
    foreach($hasil->result_array() as $quotationdata){
       
       
        $quotaion_no=$quotationdata['quotaion_no'];
        //echo $quotaion_no;

        $this->db->select('*');    
        $this->db->from('order_master');
        $this->db->where('quotation_no',$quotaion_no);
         $hasil4=$this->db->get();
        if($hasil4->num_rows()>0){

        }else{
            $this->db->select('*');
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotaion_no);
            $this->db->where('quote_lock_version >',0);
            $hasil8 = $this->db->get(); 
            if($hasil8->num_rows() >0){
             foreach($hasil8->result_array() as $quotationdata1){
                 $quote_lock_version=$quotationdata1['quote_lock_version'];
                 $id2=$quotationdata1['id'];

                 $this->db->select('*');
                 $this->db->from('quotation_master');
                 $this->db->where('id',$id2);
                    $hasil9 = $this->db->get(); 
                 if($hasil9->num_rows() >0){
                     foreach($hasil9->result_array() as $qotationdata){
                        $qid1=$qotationdata['id'];
                        $customer_name=$quotationdata['customer_name'];
                        $quotaion_no=$quotationdata['quotaion_no'];
                        $order_due_date=$quotationdata['order_due_date'];
                        $status=$quotationdata['quote_status'];
                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        if($qid1 >0){
                            $this->db->select('*');    
                            $this->db->from('quotation_master');
                            $this->db->where('quotaion_no',$qid1);
                            $this->db->where('version',1);
                            $hasil1=$this->db->get();
                            foreach($hasil1->result_array() as $qutationdata){
                                $orderdate=$qutationdata['order_date'];
                            }
                    
                            $this->db->select('*');    
                            $this->db->from('quotation_detalis');
                            $this->db->where('quatation_id',$qid1);
                            $hasil2=$this->db->get();
                            foreach($hasil2->result_array() as $odetalis ){
                                $product=$odetalis['product_name'];
                                $qty=$odetalis['qty'];
                                $unit_order_value=$odetalis['unit_order_value'];
                                $unit_transfor_price=$odetalis['unit_transfor_price'];
                                $transfor_tax=$odetalis['transfor_tax'];
                                $order_tax=$odetalis['order_tax'];
                    
                                $total= $qty * $unit_order_value;
                                $total1= $qty * $unit_transfor_price;
                                $otax=($total * $order_tax)/100;
                    
                                $magin= $magin+( $total- $total1);
                                $totalordvalue= $totalordvalue+$total+$otax;
                    
                                $summargin=$magin+$summargin;
                                $sum=$totalordvalue+$sum;
                    
                            }
                        }

                        $result[]=array(
                            'qid1'=>$qid1,
                            'customer_name'=>$customer_name,
                            'quotaion_no'=>$quotaion_no,
                            'order_due_date'=>$order_due_date,
                            'orderdate'=>$orderdate,
                            'magin'=>$magin,
                            'totalordvalue'=>$totalordvalue,
                            'product'=>$product,
                            'status'=>$status,
                            'description'=>$description,
                        );

                     }
                 }
                

             }
            }else{
                $this->db->select_max('id');
                $this->db->from('quotation_master');
                $this->db->where('quotaion_no',$quotaion_no);
                $hasil1 = $this->db->get(); 
                foreach($hasil1->result_array() as $quotationdata2){
                   
                        
                    $qid2=$quotationdata2['id'];
                    $this->db->select('*');
                    $this->db->from('quotation_master');
                    $this->db->where('id',$id2);
                       $hasil9 = $this->db->get(); 
                       foreach($hasil9->result_array() as $qotationdata){
                        $customer_name=$quotationdata['customer_name'];
                        $quotaion_no=$quotationdata['quotaion_no'];
                        $order_due_date=$quotationdata['order_due_date'];
                        $status=$quotationdata['quote_status'];
                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                if($qid2 >0){
                $this->db->select('*');    
                $this->db->from('quotation_master');
                $this->db->where('quotaion_no',$quotaion_no);
                $this->db->where('version',1);
                $hasil1=$this->db->get();
                foreach($hasil1->result_array() as $qutationdata){
                    $orderdate=$qutationdata['order_date'];
                }
        
                $this->db->select('*');    
                $this->db->from('quotation_detalis');
                $this->db->where('quatation_id',$qid2);
                $hasil2=$this->db->get();
                foreach($hasil2->result_array() as $odetalis ){
                    $product=$odetalis['product_name'];
                    $qty=$odetalis['qty'];
                    $unit_order_value=$odetalis['unit_order_value'];
                    $unit_transfor_price=$odetalis['unit_transfor_price'];
                    $transfor_tax=$odetalis['transfor_tax'];
                    $order_tax=$odetalis['order_tax'];
        
                    $total= $qty * $unit_order_value;
                    $total1= $qty * $unit_transfor_price;
                    $otax=($total * $order_tax)/100;
        
                    $magin= $magin+( $total- $total1);
                    $totalordvalue= $totalordvalue+$total+$otax;
        
                    $summargin=$magin+$summargin;
                    $sum=$totalordvalue+$sum;
        
                }
            }
            $result[]=array(
                'qid1'=>$qid2,
                'customer_name'=>$customer_name,
                'quotaion_no'=>$quotaion_no,
                'order_due_date'=>$order_due_date,
                'orderdate'=>$orderdate,
                'magin'=>$magin,
                'totalordvalue'=>$totalordvalue,
                'product'=>$product,
                'status'=>$status,
                'description'=>$description,
            );
        } 
        }

       

    }

    }
}
return $result;
}


}
