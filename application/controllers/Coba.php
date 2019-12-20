<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

  public function index()
  {
    $user = $this->db->get('user')->result();

    echo json_encode($user);
  }

  public function submit()
  {
    echo $_FILES['file']['name'];
    echo "\n";
    echo $_FILES['file']['tmp_name'];
  }

  public function generate()
  {
    $fileName = 'data-' . time() . '.xlsx';
    $this->load->library('excel');

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->setActiveSheetIndex(0);

    // set Header
    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');

    $rowCount = 2;

    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, 'Pratama');
    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Anugrah');
    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, 'mecinkari@gmail.com');

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Holla.csv"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $objWriter->save('php://output');
  }
}

/* End of file Coba.php */
