<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Export extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('funnelreportmodel');
    }    
 
    public function index() {
        //$data['export_list'] = $this->export->exportList();
        //$this->load->view('export', $data);

       
    }
    // create xlsx
    public function generateXls() {

       
      
      

        // create file name
        $fileName = 'data-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
       
        $objPHPExcel = new PHPExcel();
       
       //$data1 =;

     
     
       
        // $objPHPExcel->setActiveSheetIndex(0);
        // // set Header
        // $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
        // $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
        // $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
        // // set Row
        // $rowCount = 2;
        // foreach ($listInfo as $list) {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $list->first_name);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $list->last_name);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $list->email);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $list->dob);
        //     $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $list->contact_no);
        //     $rowCount++;
        // }
        // $filename = "tutsmake". date("Y-m-d-H-i-s").".csv";
        // header('Content-Type: application/vnd.ms-excel'); 
        // header('Content-Disposition: attachment;filename="'.$filename.'"');
        // header('Cache-Control: max-age=0'); 
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');  
        // $objWriter->save('php://output'); 

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1','Sales Person');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1','Sager Morvadiya');

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
        $objPHPExcel->getActiveSheet()->SetCellValue('D2','Total');

        $objPHPExcel->getActiveSheet()->SetCellValue('F2','218.80');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2','10.00');

           

 
$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'SBU');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Customer');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Principal');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Product Description');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Opportunity Identification Date');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Top Line');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Bottom Line');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Probability');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Projected Closure date');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Current Status');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Remarks');
 
$objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getFont()->setBold(true);

$rowCount   =   3;
foreach( $this->generateXls1() as $funneldata){
    $rowCount=$rowCount+1;
    $coustomername=$funneldata['customer_name'];
   
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'r');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $coustomername);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'e');
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, );
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, '2019-10-12');
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, '80');
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,'10');
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,'0');
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, '2019-10-12');
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, '1');
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,'a');
   
}
 

 
  
    // $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper(''));
    // $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper('Product 1:10:200','UTF-8'));
    // $rowCount   =   5;
    // $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper('Product 2: 30:30','UTF-8'));

    // $rowCount   =   4;
    // $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, mb_strtoupper('2019-10-12'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, mb_strtoupper('80'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper('10'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, mb_strtoupper('0'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, mb_strtoupper('2019-10-12'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, mb_strtoupper('1'));
    // $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, mb_strtoupper('a'));
    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:B5');
  
 
$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
    
 
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="you-file-name.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');

}

//for merging cell --for dynamice 
function cellsToMergeByColsRow($start = -1, $end = -1, $row = -1){
    $merge = 'A1:A1';
    if($start>=0 && $end>=0 && $row>=0){
        $start = PHPExcel_Cell::stringFromColumnIndex($start);
        $end = PHPExcel_Cell::stringFromColumnIndex($end);
        $merge = "$start{$row}:$end{$row}";
    }
    return $merge;
   
}
public function generateXls1() {

    $uid='19';
    $statdate='2019-04-01';
    $data = $this->funnelreportmodel->getfunnel_report($uid,$statdate);
 
    
    echo json_encode($data);
}
function action()
{
    $total=0;
 $this->load->model("funnelreportmodel");
 $this->load->library("excel");
 $objPHPExcel = new PHPExcel();

 $objPHPExcel->setActiveSheetIndex(0);

 $objPHPExcel->getActiveSheet()->SetCellValue('A1','Sales Person');
 $objPHPExcel->getActiveSheet()->SetCellValue('B1','Sager Morvadiya');

 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
 $objPHPExcel->getActiveSheet()->SetCellValue('D2','Total');

 $objPHPExcel->getActiveSheet()->SetCellValue('F2',$total);
 $objPHPExcel->getActiveSheet()->SetCellValue('G2','10.00');

 $column = 0;

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'SBU');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Customer');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Principal');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Product Description');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Opportunity Identification Date');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Top Line');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Bottom Line');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Probability');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Projected Closure date');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Current Status');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Remarks');

 //$employee_data = $this->funnelreportmodel->fetch_data();

 $uid='19';
 $statdate='2019-04-01';
 $employee_data = $this->funnelreportmodel->getfunnel_report($uid,$statdate);

 $rowCount = 4;

//  $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'r');
//  $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'sd');
//  $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'e');
//  $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, );
//  $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, '2019-10-12');
//  $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, '80');
//  $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount,'10');
//  $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount,'0');
//  $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, '2019-10-12');
//  $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, '1');
//  $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount,'a');
$table_columns = array('A', 'B','C','E','F','G','H','I','J','K');
$rowdata=0;

 foreach($employee_data as $row)
 {
  
    $cusomername=$row['customer_name'];
    $quotaion_no=$row['quotaion_no'];
    $order_due_date=$row['order_due_date'];
    $orderdate=$row['orderdate'];
    $magin=$row['magin'];
    $totalordvalue=$row['totalordvalue'];
    $product=$row['product'];
    $status=$row['status'];
    $description=$row['description'];
    $probability=$row['probability'];
    $statusinfo='';
    if($status==1){
       $statusinfo='Pending';
    }else if($status==2){
        $statusinfo='Confirm'; 
    }else if($status==3){
        $statusinfo='Cancle'; 
    }else{
        $statusinfo='Invoice Generated'; 
    }
    $count= $rowCount;

     $productlength=sizeof($row['productinfo']);
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$count, '');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$count, $cusomername);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$count, '');
   
 
    foreach($row['productinfo'] as $productdata){
      
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $productdata['product_name']."".$productdata['qty']."".$productdata['unit_transfor_price']);
        $rowCount++;
    }

$total=$total+$totalordvalue;
   
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$count, $order_due_date);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$count, $totalordvalue);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$count,$magin);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$count,$probability);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$count,$orderdate);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$count,  $statusinfo);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$count,$description);
   
   
    $mergeid=$rowCount-1;
   
    foreach($table_columns as $field)
  {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($field."".$count.':'.$field."".$mergeid);
  }
   
 // $rowCount++;
 }
 
 $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="Employee Data.xls"');
 $object_writer->save('php://output');
}




}
