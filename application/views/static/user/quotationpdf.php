<?php
//Set default date timezone
$quotaion_no="";
$customer="";
$margin=0;
$less_others=0;
$less_bg=0;
$less_trasportion=0;
$less_input_tax=0;
$total_trasfor_price=0;
$total_order_value=0;
$order_due_date='';
$email_id='';
$order_date='';
$mobile_no='';
$ref_number='';
$contact_person='';
$symbol='Rs';
$margin=0;
$description="";
$prderdate="";
foreach($customerinfo as $value)
{
   
     $id=$value->id;
     $customer=$value->customer_name;
     $quotaion_no=$value->quotaion_no;
     $contact_person=$value->contact_person;
     $ref_number=$value->ref_number;
     $mobile_no=$value->mobile_no;
     $order_date=$value->order_date;
     $email_id=$value->email_id;
    $order_due_date=$value->order_due_date;
    $description=$value->description;
    $total_order_value=$value->total_order_value;
    $total_trasfor_price=$value->total_trasfor_price;
    $less_input_tax=$value->less_input_tax;
    $less_trasportion=$value->less_trasportion;
    $less_bg=$value->less_bg;
    $less_others=$value->less_others;
  
    $margin=$value->margin;
    $old_date = explode('-', $order_date); 
$order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];

   
}
foreach($quatationdate as $value1)
{
    $order_date=$value1->quotation_date;
    if($order_date !="0000-00-00" || $order_date !=""){
        $old_date = explode('-', $order_date); 
        $order_date = $old_date[2].'/'.$old_date[1].'/'.$old_date[0];
    }
   
}
date_default_timezone_set('America/Los_Angeles');
//Include Invoicr class
//include('../invoicr.php');
//Create a new instance
$invoice = new invoicr("A4",$symbol,"en");
//Set number format
$invoice->setNumberFormat(',','.');
//Set your logo
$invoice->setLogo("images/logo.png",180,100);
//Set theme color
$invoice->setColor("#f7540e");
//Set type
$invoice->setType("Quote");
//Set reference
$invoice->setReference($quotaion_no);
//Set date
$invoice->setDate($order_date);
//Set from
$invoice->setFrom(array("DCDR Infra Private Limited","23, West Road","West CIT Nagar","Chennai - 600 035",""));
//Set to
$invoice->setTo(array("Customer Name:".$customer,"Contact Person:".$contact_person, "Mobile No:".$mobile_no,"Email Id:".$email_id,""));
//Add items
//$invoice->addItem("Premium account",1,1,"21%",100,20,80,80);

$totalorderunit=0;
$totaltotalprice=0;
$totaltaxrs=0;
$totalorderpricewithtax=0;


foreach($product_detalis as $value1)
{

    $productname=$value1->product_name;
    $qty=$value1->qty;
    $unit_order_value=$value1->unit_order_value;

  


    $totalprice=0;
    if($qty >0 && $unit_order_value >0 ){
        $totalprice=$qty * $unit_order_value;
    }

    
    $order_tax=$value1->order_tax;
    $taxrs=$totalprice * $order_tax/100 ;
    $totalpricewithtax=$totalprice + $taxrs;

    $totalorderunit= $unit_order_value+$totalorderunit;
    $totaltotalprice= $totalprice+$totaltotalprice;
    $totaltaxrs= $totaltaxrs+$taxrs;
    $totalorderpricewithtax= $totalorderpricewithtax+$totalpricewithtax;

$invoice->addItem($productname,false,$qty,$unit_order_value,$totalprice,$order_tax."%",$taxrs,$totalpricewithtax);
//Add totals
}
$invoice->addItem("Total",false,"-",$totalorderunit,$totaltotalprice,"-",$totaltaxrs,$totalorderpricewithtax,true);

$invoice->addTotal("Total Order Value (without Tax)", $totaltotalprice);
// $invoice->addTotal("Total Transfer Price (without Tax)", $total_trasfor_price);
// $invoice->addTotal("Less Input Tax if CST ", $less_input_tax);
// $invoice->addTotal("Less Transporation", $less_trasportion);
// $invoice->addTotal("Less BG/Insurance Cost ",$less_bg);
// $invoice->addTotal("Less others (if any) ", $less_others);
// $invoice->addTotal("MARGIN", $margin);
//Add badge
//$invoice->addBadge("Copy");


//


//Add title
 $invoice->addTitle("Remarks");
// //Add paragraph
 $invoice->addParagraph($description);
// //Set footernote
// $invoice->setFooternote("http://www.soundcloud.com");
//Render
$invoice->render('Envato.pdf','I');
?>