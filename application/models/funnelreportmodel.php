<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Funnelreportmodel extends CI_Model{
    function data_insert($data,$table){
      
      
            $result = $this->db->insert($table,$data);
            return $result;
        
        
    }
    function data_update($data,$table,$colum,$id){
        $this->db->where($colum,$id);
        $result = $this->db->update($table,$data);
    return $result;
}

function getfunnel_report1($uid,$statdate,$productnm,$ovmnm,$fromdate,$to_date){
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('salesrepresentative',$uid);
    if($fromdate=="" && $to_date==""){
        $this->db->where('order_date >=',$statdate);
        $this->db->where('order_date <=', date('Y-m-d'));
    }
    else{
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
            foreach($hasil4->result_array() as $orderdata){
                $qutone_no=$orderdata['qutone_no'];

                $this->db->select('*');
                 $this->db->from('quotation_master');
                 $this->db->where('id',$qutone_no);
                
                $hasil10 = $this->db->get(); 
                 if($hasil10->num_rows() >0){
                    foreach($hasil10->result_array() as $quotaionorderdata){
                        $qid3=$quotaionorderdata['id'];
                        $customer_name=$quotaionorderdata['customer_name'];
                        $quotaion_no=$quotaionorderdata['quotaion_no'];
                        $order_due_date=$quotaionorderdata['order_due_date'];
                        $status=$quotaionorderdata['quote_status'];
                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $productinfo=array();
                        $c=1;
                        if($qid3 >0){
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
                            if($productnm !="All"){
                                $this->db->where('product_name',$productnm);
                            }
                            if($ovmnm !="All"){
                                $this->db->where('ovmnm',$ovmnm);
                            }
                            $this->db->where('quatation_id',$qid3);
                            $hasil2=$this->db->get();
                            if($hasil2->num_rows() >0){
                                $this->db->select('*');    
                                $this->db->from('quotation_detalis');
                                $this->db->where('quatation_id',$qid3);
                                $hasil2=$this->db->get();
                                $c=1;
                                foreach($hasil2->result_array() as $odetalis ){
                                   
                                    if($c==1){
                                        $product=$odetalis['product_name'];
                                    }
                                    $c=$c+1;
    
    
                                    $product_name=$odetalis['product_name'];
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
                                        'product_name'=>$product_name,
                                        'unit_transfor_price'=>$unit_transfor_price,
                                        'transfor_tax'=>$transfor_tax,
                                        'unit_order_value'=>$unit_order_value,
                                        'order_tax'=>$order_tax,
                                    );
                        
                                }
    
                            }
                            

                        }
                        if($c >1){
                            $result[]=array(
                                'qid1'=>$qid3,
                                'customer_name'=>$customer_name,
                                'quotaion_no'=>$quotaion_no,
                                'order_due_date'=>$order_due_date,
                                'orderdate'=>$orderdate,
                                'magin'=>$magin,
                                'totalordvalue'=>$totalordvalue,
                                'product'=>$product,
                                'status'=>"Invoice Generated",
                                'description'=>$description,
                                'probability'=>100,
                                'productinfo'=>$productinfo,
                            );
                        }
                      


                    }

                 }

            }





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
                
                $hasil9 = $this->db->get(); 
                 if($hasil9->num_rows() >0){
                     foreach($hasil9->result_array() as $qotationdata){
                        $qid1=$qotationdata['id'];
                        $c1=1;
                       
                        $customer_name=$qotationdata['customer_name'];
                        $quotaion_no=$qotationdata['quotaion_no'];
                        $order_due_date=$qotationdata['order_due_date'];
                        $status=$qotationdata['quote_status'];
                        $probability=0;
                        if($status==3){
                            $probability=0;
                        }else{
                            $probability=100;
                        }
                        $productinfo=array();
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
                            if($productnm !="All"){
                                $this->db->where('product_name',$productnm);
                            }
                            if($ovmnm !="All"){
                                $this->db->where('ovmnm',$ovmnm);
                            }
                            $hasil2=$this->db->get();
                            if($hasil2->num_rows()>0){
                                $c1=1;
                               
                                $this->db->select('*');    
                                $this->db->from('quotation_detalis');
                                $this->db->where('quatation_id',$qid1);
                                $hasil2=$this->db->get();
                                foreach($hasil2->result_array() as $odetalis ){
                                    //$product=$odetalis['product_name'];
    
                                  
                                    if($c1==1){
                                        $product=$odetalis['product_name'];
                                    }
                                    $c1=$c1+1;
                                    $product_name=$odetalis['product_name'];
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
                                        'product_name'=>$product_name,
                                        'unit_transfor_price'=>$unit_transfor_price,
                                        'transfor_tax'=>$transfor_tax,
                                        'unit_order_value'=>$unit_order_value,
                                        'order_tax'=>$order_tax,
                                    );
                        
                                }
                            }
                          
                           
                        }
                        if($c1 >1){
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
                   
                    $product='';
                    $qid2=$quotationdata2['id'];

                 
                        $this->db->select('*');
                        $this->db->from('quotation_master');
                        $this->db->where('id',$qid2);
                        
                       $hasil9 = $this->db->get(); 
                       foreach($hasil9->result_array() as $qotationdata3){
                        $customer_name=$qotationdata3['customer_name'];
                        $count=1; 
                       
                        $quotaion_no=$qotationdata3['quotaion_no'];
                        $order_due_date=$qotationdata3['order_due_date'];
                        $status=$qotationdata3['quote_status'];
                        $description=$qotationdata3['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $productinfo=array();
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
                if($hasil2->num_rows()>0){
                    $count=1;
                    $this->db->select('*');    
                    $this->db->from('quotation_detalis');
                    $this->db->where('quatation_id',$qid2);
                    $hasil2=$this->db->get();
                    foreach($hasil2->result_array() as $odetalis ){
                       
                        if($count==1){
                        $product=$odetalis['product_name'];
                        }
                        $count= $count+1;
                        $product_name=$odetalis['product_name'];
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
                            'product_name'=>$product_name,
                            'unit_transfor_price'=>$unit_transfor_price,
                            'transfor_tax'=>$transfor_tax,
                            'unit_order_value'=>$unit_order_value,
                            'order_tax'=>$order_tax,
                        );
            
                    }
                }
                
            }
            if($count >0){
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
function getfunnelproduct($id){
    $this->db->select('*');    
    $this->db->from('quotation_detalis');
    $this->db->where('quatation_id',$id);
    $hasil2=$this->db->get();
    return $hasil2->result();
}
function getsalespersonname($uid){
    $this->db->select('*');    
    $this->db->from('user_creation');
    $this->db->where('id',$uid);
    $hasil2=$this->db->get();
    return $hasil2->result();
}

function getfunnel_report($uid,$statdate){
    $sum=0;
    $summargin=0;
    $result=array();
    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('salesrepresentative',$uid);
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
            foreach($hasil4->result_array() as $orderdata){
                $qutone_no=$orderdata['qutone_no'];

                $this->db->select('*');
                 $this->db->from('quotation_master');
                 $this->db->where('id',$qutone_no);
                
                $hasil10 = $this->db->get(); 
                 if($hasil10->num_rows() >0){
                    foreach($hasil10->result_array() as $quotaionorderdata){
                        $qid3=$quotaionorderdata['id'];
                        $customer_name=$quotaionorderdata['customer_name'];
                        $quotaion_no=$quotaionorderdata['quotaion_no'];
                        $order_due_date=$quotaionorderdata['order_due_date'];
                        $status=$quotaionorderdata['quote_status'];
                        $description=$quotationdata['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $productinfo=array();

                        if($qid3 >0){
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
                            $this->db->where('quatation_id',$qid3);
                            $hasil2=$this->db->get();
                            $c=1;
                            foreach($hasil2->result_array() as $odetalis ){
                               
                                if($c==1){
                                    $product=$odetalis['product_name'];
                                }
                                $c=$c+1;


                                $product_name=$odetalis['product_name'];
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
                                    'product_name'=>$product_name,
                                    'unit_transfor_price'=>$unit_transfor_price,
                                    'transfor_tax'=>$transfor_tax,
                                    'unit_order_value'=>$unit_order_value,
                                    'order_tax'=>$order_tax,
                                );
                    
                            }


                        }
                        $result[]=array(
                            'qid1'=>$qid3,
                            'customer_name'=>$customer_name,
                            'quotaion_no'=>$quotaion_no,
                            'order_due_date'=>$order_due_date,
                            'orderdate'=>$orderdate,
                            'magin'=>$magin,
                            'totalordvalue'=>$totalordvalue,
                            'product'=>$product,
                            'status'=>"Invoice Generated",
                            'description'=>$description,
                            'probability'=>100,
                            'productinfo'=>$productinfo,
                        );


                    }

                 }

            }





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
                
                $hasil9 = $this->db->get(); 
                 if($hasil9->num_rows() >0){
                     foreach($hasil9->result_array() as $qotationdata){
                        $qid1=$qotationdata['id'];

                       
                        $customer_name=$qotationdata['customer_name'];
                        $quotaion_no=$qotationdata['quotaion_no'];
                        $order_due_date=$qotationdata['order_due_date'];
                        $status=$qotationdata['quote_status'];
                        $probability=0;
                        if($status==3){
                            $probability=0;
                        }else{
                            $probability=100;
                        }
                        $productinfo=array();
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
                            $c1=1;
                            foreach($hasil2->result_array() as $odetalis ){
                                //$product=$odetalis['product_name'];

                              
                                if($c1==1){
                                    $product=$odetalis['product_name'];
                                }
                                $c1=$c1+1;
                                $product_name=$odetalis['product_name'];
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
                                    'product_name'=>$product_name,
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
                        
                       $hasil9 = $this->db->get(); 
                       foreach($hasil9->result_array() as $qotationdata3){
                        $customer_name=$qotationdata3['customer_name'];

                       
                        $quotaion_no=$qotationdata3['quotaion_no'];
                        $order_due_date=$qotationdata3['order_due_date'];
                        $status=$qotationdata3['quote_status'];
                        $description=$qotationdata3['description'];
                        $magin=0;
                        $totalordvalue=0;
                        $orderdate='';
                        $productinfo=array();
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
                    $count= $count+1;
                    $product_name=$odetalis['product_name'];
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
                        'product_name'=>$product_name,
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


}

?>