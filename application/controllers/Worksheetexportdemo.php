<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Worksheetexportdemo extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('wonreportmodel');
        $this->load->model('funnelreportmodel');
    }    
 
    public function index() {
        //$data['export_list'] = $this->export->exportList();
        //$this->load->view('export', $data);

       
    }
    // create xlsx
   
function action()
{
    $total=0;
    $totalbottom=0;
 $this->load->model("wonreportmodel");
 $this->load->model('funnelreportmodel');
 $this->load->library("excel");
 $objPHPExcel = new PHPExcel();

 
 $where=$this->input->post('btnExport');

  $uid=19;
  $statdate='2019-04-01';
         

 $objPHPExcel->setActiveSheetIndex(0);

 $objPHPExcel->getActiveSheet()->setTitle('Loss Report');

 $objPHPExcel->getActiveSheet()->SetCellValue('A1','Sales Person');
 $salesdata=$this->funnelreportmodel->getsalespersonname($uid);
 foreach($salesdata as $sales){
   
    $objPHPExcel->getActiveSheet()->SetCellValue('B1',$sales->first_name."".$sales->last_name);
   
}

 

 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
 $objPHPExcel->getActiveSheet()->SetCellValue('D2','Total');



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
$objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getFont()->setBold(true);

 //$employee_data = $this->funnelreportmodel->fetch_data();
 $table_columns1 = array('A3', 'B3','C3','D3','E3','F3','G3','H3','I3','J3','K3');
 foreach($table_columns1 as $cl){
 $objPHPExcel->getActiveSheet()->getStyle($cl)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'40A756')));
}
 
 $employee_data = $this->wonreportmodel->getlossreport($uid,$statdate);

 $rowCount = 4;


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
        $statusinfo='Cancel'; 
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
      
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $productdata['product_name'].":".$productdata['qty'].":".$productdata['unit_transfor_price']);
        $rowCount++;
    }

$total=$total+$totalordvalue;
$totalbottom=$totalbottom+$magin;
   
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$count, $order_due_date);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$count, $totalordvalue);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$count,$magin);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$count,$probability);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$count,$orderdate);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$count,  $statusinfo);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$count,$description);

    if($probability==100){
    $objPHPExcel->getActiveSheet()->getStyle('H'.$count)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
    }
   
    $mergeid=$rowCount-1;
   
    foreach($table_columns as $field)
  {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($field."".$count.':'.$field."".$mergeid);
  }
  $objPHPExcel->getActiveSheet()->SetCellValue('F2',$total);
  $objPHPExcel->getActiveSheet()->SetCellValue('G2',$totalbottom);
 // $rowCount++;
 }
 

 $total1=0;
 $totalbottom1=0;
$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(1);

// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Second sheet');
$objPHPExcel->getActiveSheet()->SetCellValue('A1','Sales Person');
 $salesdata=$this->funnelreportmodel->getsalespersonname($uid);
 foreach($salesdata as $sales){
   
    $objPHPExcel->getActiveSheet()->SetCellValue('B1',$sales->first_name."".$sales->last_name);
   
}

 

 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
 $objPHPExcel->getActiveSheet()->SetCellValue('D2','Total');



 $column = 0;

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'SBU');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Customer');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Principal');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Product Description');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Opportunity Identification Date');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Top Line');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Bottom Line');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'PO recevied date');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Current Status');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'Remarks');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'Invoice No');
$objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getFont()->setBold(true);

 //$employee_data = $this->funnelreportmodel->fetch_data();
 $table_columns2 = array('A3', 'B3','C3','D3','E3','F3','G3','H3','I3','J3','K3');
 foreach($table_columns2 as $cl){
 $objPHPExcel->getActiveSheet()->getStyle($cl)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'40A756')));
}
 
 $employee_data1 = $this->wonreportmodel->getwondata($uid,$statdate);

 $rowCount1 = 4;


$table_columns3 = array('A', 'B','C','E','F','G','H','I','J','K');
$rowdata=0;
$count1=0;
 foreach($employee_data1 as $row)
 {
  
    $order_no=$row['order_no'];
    $customername=$row['customer_name'];
    $poorder_date=$row['poorder_date'];
    $description=$row['description'];
    $orderdate=$row['orderdate'];
    $magin=$row['magin'];
    $totalordvalue=$row['totalordvalue'];
    $product=$row['product'];
    $status=$row['status'];
    $oid=$row['oid'];
  
    $statusinfo='';
    if($status==1){
       $statusinfo='Pending';
    }else if($status==2){
        $statusinfo='Confirm'; 
    }else if($status==3){
        $statusinfo='Cancel'; 
    }else{
        $statusinfo='Invoice Generated'; 
    }
    $count1= $rowCount1;

     $productlength=sizeof($row['productinfo']);
  

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$count1, '');
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$count1, $customername);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$count1, '');
   
 
    foreach($row['productinfo'] as $productdata){
      
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount1, $productdata['product_name'].":".$productdata['qty'].":".$productdata['unit_transfor_price']);
        $rowCount1++;
    }

$total1=$total1+$totalordvalue;
$totalbottom=$totalbottom+$magin;
   
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$count1, $orderdate);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$count1, $totalordvalue);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$count1,$magin);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$count1,$poorder_date);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$count1,$statusinfo);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$count1,  $description);
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$count1,$oid);

   
   
    $mergeid=$rowCount1-1;
   
    foreach($table_columns3 as $field)
  {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($field."".$count1.':'.$field."".$mergeid);
  }
  $objPHPExcel->getActiveSheet()->SetCellValue('F2',$total);
  $objPHPExcel->getActiveSheet()->SetCellValue('G2',$totalbottom);
 // $rowCount++;
 }

 
// $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="name_of_file.xls"');
 header('Cache-Control: max-age=0');
 $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 $object_writer->save('php://output');


}






}
