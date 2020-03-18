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
    $hasil=$this->db->get();//for gettting  order between date

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
            $productinfo=array();
            $product='';

            if($quotation_no >0){
                $this->db->select('*');    
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotation_no);
            $this->db->where('version',1);//for first qutation date
            $hasil1=$this->db->get();
            foreach($hasil1->result_array() as $qutationdata){
                $orderdate=$qutationdata['order_date'];
            }
         
            }

            $this->db->select('*');    
            $this->db->from('order_detalis');
            $this->db->where('order_id',$oid);
            $hasil2=$this->db->get();
            $c=0;
            foreach($hasil2->result_array() as $odetalis ){
                if($c==0){
                    $product=$odetalis['product_name'];
                }
                $c=$c+1;
                $productname=$odetalis['product_name'];
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

                $productinfo[]=array(
                    'qty'=>$qty,
                    'product_name'=>$productname,
                    'unit_transfor_price'=>$unit_transfor_price,
                    'transfor_tax'=>$transfor_tax,
                    'unit_order_value'=>$unit_order_value,
                    'order_tax'=>$order_tax,
                );

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
                'status'=>'Invoice Generated',
                'oid'=>$oid,
                'productinfo'=>$productinfo,
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
       

        $this->db->select('*');    
        $this->db->from('order_master');
        $this->db->where('quotation_no',$quotaion_no);//for checking quotation is exist in oreder
         $hasil4=$this->db->get();
        if($hasil4->num_rows()>0){

        }else{
            $this->db->select('*');
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotaion_no);
            $this->db->where('quote_lock_version >',0);//for conform quotation
            $hasil8 = $this->db->get(); 
            if($hasil8->num_rows() >0){
             foreach($hasil8->result_array() as $quotationdata1){
                 $quote_lock_version=$quotationdata1['quote_lock_version'];
                 $id2=$quotationdata1['id'];
                 $quote_status=$quotationdata1['quote_status'];

                 $this->db->select('*');
                 $this->db->from('quotation_master');
                 $this->db->where('id',$id2);
                 if($quote_status==2){
                    $this->db->where('order_due_date <', date('Y-m-d'));
                 }
                $hasil9 = $this->db->get(); 
                 if($hasil9->num_rows() >0){
                     foreach($hasil9->result_array() as $qotationdata){
                        $qid1=$qotationdata['id'];
                        $customer_name=$qotationdata['customer_name'];
                        $quotaion_no=$qotationdata['quotaion_no'];
                        $order_due_date=$qotationdata['order_due_date'];
                        $status=$qotationdata['quote_status'];
                        $productinfo=array();
                        $probability=0;
                        if($status==3){
                            $probability=0;
                        }else{
                            $probability=100;
                        }

                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        if($qid1 >0){
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
                                $productinfo[]=array(
                                    'qty'=>$qty,
                                    'product_name'=>$product,
                                    'unit_transfor_price'=>$unit_transfor_price,
                                    'transfor_tax'=>$transfor_tax,
                                    'unit_order_value'=>$unit_order_value,
                                    'order_tax'=>$order_tax,
                                );
                    
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
                            'probability'=>$probability,
                            'productinfo'=>$productinfo,
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
                        $this->db->where('id',$qid2);
                        $this->db->where('order_due_date <', date('Y-m-d'));
                       $hasil9 = $this->db->get(); 
                       foreach($hasil9->result_array() as $qotationdata3){
                        $customer_name=$qotationdata3['customer_name'];

                       
                        $quotaion_no=$qotationdata3['quotaion_no'];
                        $order_due_date=$qotationdata3['order_due_date'];
                        $status=$qotationdata3['quote_status'];
                        $description=$qotationdata3['description'];
                        $productinfo=array();
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
                $count=1;
                foreach($hasil2->result_array() as $odetalis ){
                  
                    if($count==1){
                    $product=$odetalis['product_name'];
                    }
                    $count++;

                    $productname=$odetalis['product_name'];
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
                    $productinfo[]=array(
                        'qty'=>$qty,
                        'product_name'=>$productname,
                        'unit_transfor_price'=>$unit_transfor_price,
                        'transfor_tax'=>$transfor_tax,
                        'unit_order_value'=>$unit_order_value,
                        'order_tax'=>$order_tax,
                    );
        
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
                'probability'=>0,
                'productinfo'=>$productinfo,
            );
        } 
        }

       

    }

    }
}
return $result;
}

public function getlossproductinfo($qid){
    $this->db->select('*');    
    $this->db->from('quotation_detalis');
    $this->db->where('quatation_id',$qid);
    $hasil2=$this->db->get();
    return $hasil2->result();
}
public function getwonproductinfo($id){
    $this->db->select('*');    
    $this->db->from('order_detalis');
    $this->db->where('order_id',$id);
    $hasil2=$this->db->get();
    return $hasil2->result();
}
public function getsalespersonname($uid){
    $this->db->select('*');    
    $this->db->from('user_creation');
    $this->db->where('id',$uid);
    $hasil2=$this->db->get();
    return $hasil2->result();
}
public function getwondata1($id,$statdate,$ovmnm,$productnm, $fromdate,$to_date){
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('order_master');
    if($id >0){
        $this->db->where('salesrepresentative',$id);

    }
    if($fromdate=="" && $to_date==""){
        $this->db->where('order_date >=',$statdate);
        $this->db->where('order_date <=', date('Y-m-d'));
    }else{
        $this->db->where('order_date >=',$fromdate);
        $this->db->where('order_date <=', $to_date);
    }
   
    $hasil=$this->db->get();//for gettting  order between date

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
            $productinfo=array();
            $product='';
            $c=0;
            if($quotation_no >0){
                $this->db->select('*');    
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotation_no);
            $this->db->where('version',1);//for first qutation date
            $hasil1=$this->db->get();
            foreach($hasil1->result_array() as $qutationdata){
                $orderdate=$qutationdata['order_date'];
            }
         
            }

            $this->db->select('*');    
            $this->db->from('order_detalis');
            $this->db->where('order_id',$oid);
            if($productnm !="All"){
                $this->db->where('product_name',$productnm);
            }
            if($ovmnm !="All"){
                $this->db->where('ovmnm',$ovmnm);
            }
            $hasil2=$this->db->get();
            if($hasil2->num_rows()>0){
                $c=0;
                foreach($hasil2->result_array() as $odetalis ){
                    if($c==0){
                        $product=$odetalis['product_name'];
                    }
                    $c=$c+1;
                    $productname=$odetalis['product_name'];
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
    
                    $productinfo[]=array(
                        'qty'=>$qty,
                        'product_name'=>$productname,
                        'unit_transfor_price'=>$unit_transfor_price,
                        'transfor_tax'=>$transfor_tax,
                        'unit_order_value'=>$unit_order_value,
                        'order_tax'=>$order_tax,
                    );
    
                }
    
            }
          
            if($c >0){
            $result[]=array(
                'order_no'=>$order_no,
                'customer_name'=>$customer_name,
                'poorder_date'=>$poorder_date,
                'description'=>$description,
                'orderdate'=>$orderdate,
                'magin'=>$magin,
                'totalordvalue'=>$totalordvalue,
                'product'=>$product,
                'status'=>'Invoice Generated',
                'oid'=>$oid,
                'productinfo'=>$productinfo,
            );
        }
           
        }
    }
    return $result;
}
public function getlossreport1($id,$statdate,$ovmnm,$productnm, $fromdate,$to_date){
    
 

  
  
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('quotation_master');
    if($id >0){
        $this->db->where('salesrepresentative',$id);

    }
    if($fromdate=="" && $to_date==""){
        $this->db->where('order_date >=',$statdate);
        $this->db->where('order_date <=', date('Y-m-d'));
    }else{
        $this->db->where('order_date >=',$fromdate);
        $this->db->where('order_date <=', $to_date);
    }
   
    $this->db->group_by('quotaion_no');
    $hasil=$this->db->get();
    foreach($hasil->result_array() as $quotationdata){
       
       
        $quotaion_no=$quotationdata['quotaion_no'];
       

        $this->db->select('*');    
        $this->db->from('order_master');
        $this->db->where('quotation_no',$quotaion_no);//for checking quotation is exist in oreder
         $hasil4=$this->db->get();
        if($hasil4->num_rows()>0){

        }else{
            $this->db->select('*');
            $this->db->from('quotation_master');
            $this->db->where('quotaion_no',$quotaion_no);
            $this->db->where('quote_lock_version >',0);//for conform quotation
            $hasil8 = $this->db->get(); 
            if($hasil8->num_rows() >0){
             foreach($hasil8->result_array() as $quotationdata1){
                 $quote_lock_version=$quotationdata1['quote_lock_version'];
                 $id2=$quotationdata1['id'];
                 $quote_status=$quotationdata1['quote_status'];

                 $this->db->select('*');
                 $this->db->from('quotation_master');
                 $this->db->where('id',$id2);
                 if($quote_status==2){
                    $this->db->where('order_due_date <', date('Y-m-d'));
                 }
                $hasil9 = $this->db->get(); 
                 if($hasil9->num_rows() >0){
                     foreach($hasil9->result_array() as $qotationdata){
                        $qid1=$qotationdata['id'];
                        $customer_name=$qotationdata['customer_name'];
                        $quotaion_no=$qotationdata['quotaion_no'];
                        $order_due_date=$qotationdata['order_due_date'];
                        $status=$qotationdata['quote_status'];
                        $productinfo=array();
                        $probability=0;
                        if($status==3){
                            $probability=0;
                        }else{
                            $probability=100;
                        }

                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $cnt=0;
                        if($qid1 >0){
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
                            $this->db->where('quatation_id',$qid1);
                            if($productnm !="All"){
                                $this->db->where('product_name',$productnm);
                            }
                            if($ovmnm !="All"){
                                $this->db->where('ovmnm',$ovmnm);
                            }
                            $hasil2=$this->db->get();
                            if($hasil2->num_rows()>0){
                                $this->db->select('*');    
                                $this->db->from('quotation_detalis');
                                $this->db->where('quatation_id',$qid1);
                                $hasil2=$this->db->get();
                                foreach($hasil2->result_array() as $odetalis ){
                                    $cnt=$cnt+1;
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
                                    $productinfo[]=array(
                                        'qty'=>$qty,
                                        'product_name'=>$product,
                                        'unit_transfor_price'=>$unit_transfor_price,
                                        'transfor_tax'=>$transfor_tax,
                                        'unit_order_value'=>$unit_order_value,
                                        'order_tax'=>$order_tax,
                                    );
                        
                                }
                            }
                           
                        }
                            if($cnt >0){
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
                                    'probability'=>$probability,
                                    'productinfo'=>$productinfo,
                                );
                            }
                            

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
                        $this->db->where('id',$qid2);
                        $this->db->where('order_due_date <', date('Y-m-d'));
                       $hasil9 = $this->db->get(); 
                       foreach($hasil9->result_array() as $qotationdata3){
                        $customer_name=$qotationdata3['customer_name'];

                       
                        $quotaion_no=$qotationdata3['quotaion_no'];
                        $order_due_date=$qotationdata3['order_due_date'];
                        $status=$qotationdata3['quote_status'];
                        $description=$qotationdata3['description'];
                        $productinfo=array();
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $count=0;
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
                if($productnm !="All"){
                    $this->db->where('product_name',$productnm);
                }
                if($ovmnm !="All"){
                    $this->db->where('ovmnm',$ovmnm);
                }
                $hasil2=$this->db->get();
                $count=1;
                if($hasil2->num_rows()>0){
                    $this->db->select('*');    
                $this->db->from('quotation_detalis');
                $this->db->where('quatation_id',$qid2);
                $hasil2=$this->db->get();
                foreach($hasil2->result_array() as $odetalis ){
                  
                    if($count==1){
                    $product=$odetalis['product_name'];
                    }
                    $count++;

                    $productname=$odetalis['product_name'];
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
                    $productinfo[]=array(
                        'qty'=>$qty,
                        'product_name'=>$productname,
                        'unit_transfor_price'=>$unit_transfor_price,
                        'transfor_tax'=>$transfor_tax,
                        'unit_order_value'=>$unit_order_value,
                        'order_tax'=>$order_tax,
                    );
        
                }
                }
                
            }
            if($count >1){
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
                    'probability'=>0,
                    'productinfo'=>$productinfo,
                );
            }
           
        } 
        }

       

    }

    }
}
return $result;
}


}
