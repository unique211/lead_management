<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homemodel extends CI_Model{
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
function getfinicialamt($uid){
    $this->db->select('finicialyear_amt');    
    $this->db->from('user_creation');
    $this->db->where('status',1);
    $this->db->where('id',$uid);
    $hasil=$this->db->get();

return $hasil->result();
}
function getachiveamt($startyear,$endyear,$uid){
    
   
    $result1=array();

// $uid=19;
// $startyear=2019;
// $endyear=2020;

 for($i=4;$i<=12;$i++){

  

   $firstdate = strtotime("{$startyear}-{$i}-01");
   $firstdate= date('Y-m-d', $firstdate);
   $enddate = strtotime("{$startyear}-{$i}-01");
    $result = strtotime('-1 second', strtotime('+1 month', $enddate));
    $enddate= date('Y-m-d', $result);


    
  
    $sum=0;
   

    $this->db->select('*');    
    $this->db->from('order_master');
    $this->db->where('order_date >=',$firstdate);
    $this->db->where('order_date <=', $enddate);
    if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
        $this->db->where('salesrepresentative',$this->session->userdata('useruniqueid'));
    }else{
        $this->db->where('salesrepresentative',$uid);
    }
        $hasil=$this->db->get();
        foreach($hasil->result_array() as $getdata){
            $id=$getdata['id'];

            if($id >0){
                $this->db->select('*');    
                $this->db->from('order_detalis');
                $this->db->where('order_id',$id);
                $hasil2=$this->db->get();
                foreach($hasil2->result_array() as $getdata1){
                    $qty=$getdata1['qty'];
                    $unit_order_value=$getdata1['unit_order_value'];
                    $order_tax=$getdata1['order_tax'];

                    $total=$qty * $unit_order_value;
                    $taxamt=$total *$order_tax/100;
                    $sum=$sum+$total+$taxamt;

                    //echo $total."".$taxamt."".$sum;


            }
        }

  
}

$result1[]=array(
    'sum'=>$sum,
);
 }
 for($i=1;$i<=3;$i++){

  

    $firstdate = strtotime("{$endyear}-{$i}-01");
    $firstdate= date('Y-m-d', $firstdate);
    $enddate = strtotime("{$endyear}-{$i}-01");
     $result = strtotime('-1 second', strtotime('+1 month', $enddate));
     $enddate= date('Y-m-d', $result);
 
 
     
   
     $sum=0;
    
 
     $this->db->select('*');    
     $this->db->from('order_master');
     $this->db->where('order_date >=',$firstdate);
     $this->db->where('order_date <=', $enddate);
     if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
         $this->db->where('salesrepresentative',$this->session->userdata('useruniqueid'));
     }else{
         $this->db->where('salesrepresentative',$uid);
     }
         $hasil=$this->db->get();
         foreach($hasil->result_array() as $getdata){
             $id=$getdata['id'];
 
             if($id >0){
                 $this->db->select('*');    
                 $this->db->from('order_detalis');
                 $this->db->where('order_id',$id);
                 $hasil2=$this->db->get();
                 foreach($hasil2->result_array() as $getdata1){
                     $qty=$getdata1['qty'];
                     $unit_order_value=$getdata1['unit_order_value'];
                     $order_tax=$getdata1['order_tax'];
 
                     $total=$qty * $unit_order_value;
                     $taxamt=$total *$order_tax/100;
                     $sum=$sum+$total+$taxamt;
 
                     //echo $total."".$taxamt."".$sum;
 
 
             }
         }
 
   
 }
 
 $result1[]=array(
     'sum'=>$sum,
 );
  }

 return $result1;
// for($i=1;$i<=3;$i++){
//     $firstdate= firstDay($i,$endyear);
//     $enddate= lastday($i,$endyear);
// }


  
     
}
function lastday($month = '', $year = '') {
    // if (empty($month)) {
    //    $month = date('m');
    // }
    // if (empty($year)) {
    //    $year = date('Y');
    // }
    $result = strtotime("{$year}-{$month}-01");
    $result = strtotime('-1 second', strtotime('+1 month', $result));
    return date('Y-m-d', $result);
 }

 function firstDay($month = '', $year = '')
{
    if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   return date('Y-m-d', $result);
} 
function getfunnelchartdata($uid,$statdate){//function for data of funnel chart
$result1=array();

$qutationsum=0;
$conformsum=0;
$ordersum=0;



    $this->db->select('*');    
    $this->db->from('quotation_master');
    $this->db->where('order_date >=',$statdate);
    $this->db->where('order_date <=', date('Y-m-d'));
    $hasil=$this->db->get();

    if($hasil->num_rows()>0){
        foreach($hasil->result_array() as $qutationdata){
            $qid=$qutationdata['id'];
            $version=0;
            if($qid >0){

                $this->db->select_max('version');
                $this->db->where('quatation_id',$qid);
                 $result = $this->db->get('quotation_detalis'); 
                 foreach($result->result_array() as $getdversion){
                    $version=$getdversion['version'];
                 }
               if($qid > 0 && $version > 0){
                $this->db->select('*');    
                $this->db->from('quotation_detalis');
                $this->db->where('quatation_id',$qid);
                $this->db->where('version',$version);
                $this->db->where('salserepresentative',$uid);
                $hasil2=$this->db->get();
                foreach($hasil2->result_array() as $getdata1){
                    $qty=$getdata1['qty'];
                    $unit_order_value=$getdata1['unit_order_value'];
                    $order_tax=$getdata1['order_tax'];

                    $total=$qty * $unit_order_value;
                    $taxamt=$total *$order_tax/100;
                    $qutationsum=$qutationsum+$total+$taxamt;

                    //echo $total."".$taxamt."".$sum;


            }
               }
        }
    }
  }

  $this->db->select('*');    
  $this->db->from('quotation_master');
  $this->db->where('order_date >=',$statdate);
  $this->db->where('order_date <=', date('Y-m-d'));
  $cqhasil=$this->db->get();

  if($cqhasil->num_rows()>0){
      foreach($cqhasil->result_array() as $qutationdata){
          $qid=$qutationdata['id'];
          $version=$qutationdata['quote_lock_version'];
         

              
             if($qid > 0 && $version > 0){
              $this->db->select('*');    
              $this->db->from('quotation_detalis');
              $this->db->where('quatation_id',$qid);
              $this->db->where('version',$version);
              $this->db->where('salserepresentative',$uid);
              $cqhasil2=$this->db->get();
              foreach($cqhasil2->result_array() as $getdata1){
                  $qty=$getdata1['qty'];
                  $unit_order_value=$getdata1['unit_order_value'];
                  $order_tax=$getdata1['order_tax'];

                  $total=$qty * $unit_order_value;
                  $taxamt=$total *$order_tax/100;
                  $conformsum=$conformsum+$total+$taxamt;

                  


          }
             }
      
  }
}

     $this->db->select('*');    
     $this->db->from('order_master');
     $this->db->where('order_date >=',$statdate);
     $this->db->where('order_date <=', date('Y-m-d'));
     if(($this->session->userdata('user_type')=="SalesRepresentative") && ($this->session->userdata('userrole')=="Sales") ){
         $this->db->where('salesrepresentative',$this->session->userdata('useruniqueid'));
     }else{
         $this->db->where('salesrepresentative',$uid);
     }
         $orderhasil=$this->db->get();
         if($orderhasil->num_rows() >0){
         foreach($orderhasil->result_array() as $getdata1){
             $id=$getdata1['id'];
 
             if($id >0){
                 $this->db->select('*');    
                 $this->db->from('order_detalis');
                 $this->db->where('order_id',$id);
                 $hasil2=$this->db->get();
                 foreach($hasil2->result_array() as $getdata1){
                     $qty=$getdata1['qty'];
                     $unit_order_value=$getdata1['unit_order_value'];
                     $order_tax=$getdata1['order_tax'];
 
                     $total=$qty * $unit_order_value;
                     $taxamt=$total *$order_tax/100;
                     $ordersum=$ordersum+$total+$taxamt;
 
                     //echo $total."".$taxamt."".$sum;
 
 
             }
         }
 }
}

$result1[]=array(
'ordersum'=>$ordersum,
'conformsum'=>$conformsum,
'qutationsum'=>$qutationsum,

);
 
return $result1;
}
function getjoing_date($uid){
    $this->db->select('*');    
    $this->db->from('user_creation');
    $this->db->where('id',$uid);
    $hasil=$this->db->get();
    return $hasil->result();
    
}

}



?>