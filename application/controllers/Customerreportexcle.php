<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Customerreportexcle extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('customerreportmodel');
        $this->load->model('funnelreportmodel');
    }    
 
    public function index() {
        //$data['export_list'] = $this->export->exportList();
        //$this->load->view('export', $data);

       
    }
    // create xlsx
   
function action()
{
  
 $this->load->model("customerreportmodel");
 $this->load->model('funnelreportmodel');
 $this->load->library("excel");
 $objPHPExcel = new PHPExcel();

 
 $where=$this->input->post('btnExport');

    
         

 $objPHPExcel->setActiveSheetIndex(0);

 $objPHPExcel->getActiveSheet()->SetCellValue('A1','Sales Person');
 $salesdata=$this->funnelreportmodel->getsalespersonname($where);
 foreach($salesdata as $sales){
   
    $objPHPExcel->getActiveSheet()->SetCellValue('B1',$sales->first_name."".$sales->last_name);
   
}

 

 $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'FF1E1E')));
 $objPHPExcel->getActiveSheet()->SetCellValue('D2','Total Customers Met so far');
 $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:E2');


 $column = 0;

$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'S.No');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Customer Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Customer Type');
$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'No of employees');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'Contact Name');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Designation');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'Email id');
$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'Mobile no');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Remarks');

$objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getFont()->setBold(true);

 //$employee_data = $this->funnelreportmodel->fetch_data();
 $table_columns1 = array('A3', 'B3','C3','D3','E3','F3','G3','H3','I3');
 foreach($table_columns1 as $cl){
 $objPHPExcel->getActiveSheet()->getStyle($cl)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' =>'40A756')));
}
 
 $employee_data = $this->customerreportmodel->getcustomerdata($where);

 $rowCount = 4;


$table_columns = array('A', 'B','C','D');
$rowdata=0;
$sr=0;
 foreach($employee_data as $row)
 {
    $sr=$sr+1;
    $custname=$row['custname'];
    $no_of_employee=$row['no_of_employee'];
    $customer_type=$row['customer_type'];
    $customertype=$row['customertype'];
    $remark=$row['remark'];
  
  
    $count= $rowCount;

    
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];
    //  $cusomername=$row['customer_name'];

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$count, $sr);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$count, $custname);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$count, $customertype);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$count, $no_of_employee);
    
   
 
    foreach($row['contactdata'] as $contactdata){
      
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $contactdata['contact_name']);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $contactdata['designation']);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $contactdata['email_id']);
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $contactdata['mobile_no']);
        $rowCount++;
    }


   
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$count, $remark);
   
   
   
    $mergeid=$rowCount-1;
   
    foreach($table_columns as $field)
  {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($field."".$count.':'.$field."".$mergeid);
  }
//   $objPHPExcel->getActiveSheet()->SetCellValue('F2',$total);
//   $objPHPExcel->getActiveSheet()->SetCellValue('G2',$totalbottom);
 // $rowCount++;
 }
 
 $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="Customerreport.xls"');
 $object_writer->save('php://output');
}






}
