<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Export extends CI_Controller {
    // construct
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Funnelreportmodel', 'export');
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
 
$rowCount   =   4;

    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper('Customer 1'));
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper(''));
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper('Product 1:10:200','UTF-8'));
    $rowCount   =   5;
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper('Product 2: 30:30','UTF-8'));

    $rowCount   =   4;
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, mb_strtoupper('2019-10-12'));
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, mb_strtoupper('80'));
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, mb_strtoupper('10'));
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, mb_strtoupper('0'));
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, mb_strtoupper('2019-10-12'));
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, mb_strtoupper('1'));
    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, mb_strtoupper('a'));
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:B5');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B4:B5');

    //$objPHPExcel->setActiveSheetIndex(0)->mergeCells(cellsToMergeByColsRow(4,5,1))
   // $rowCount   =   3;
   
 
   
//    $objPHPExcel->getActiveSheet()
//    ->getStyle('A3:A4')
//    ->getAlignment()
//    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
 
//$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
 
 
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
}
