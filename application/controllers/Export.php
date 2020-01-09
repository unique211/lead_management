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
   
function action()
{
    $total=0;
    $totalbottom=0;
 $this->load->model("funnelreportmodel");
 $this->load->library("excel");
 $objPHPExcel = new PHPExcel();

 
 $where=$this->input->post('btnExport');

     $where = explode('_', $where); 
          $uid=$where[0];
          $statdate=$where[1];

 

 $objPHPExcel->setActiveSheetIndex(0);

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
 
 $employee_data = $this->funnelreportmodel->getfunnel_report($uid,$statdate);

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

$totalordvalue=$totalordvalue/100000;
$magin=$magin/100000;

$totalordvalue=round($totalordvalue,2);
  $magin=round($magin,2);
   
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
  
 // $rowCount++;
 }
 $total=$total/100000;
  $totalbottom=$totalbottom/100000;
  $total=round($total,2);
  $totalbottom=round($totalbottom,2);
  $objPHPExcel->getActiveSheet()->SetCellValue('F2',$total);
  $objPHPExcel->getActiveSheet()->SetCellValue('G2',$totalbottom);
 
 $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="Employee Data.xls"');
 $object_writer->save('php://output');
}






}
