<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{
  private $filename = "import_file";

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Survey_model', 'survey');
    $this->load->model('Import_model', 'import');
    logged_in();
  }


  public function export()
  {
    include APPPATH . 'third_party/PHPExcel.php';
    $kelurahan = $this->input->get('kelurahan');
    $kecamatan = $this->input->get('kecamatan');
    $kota = $this->input->get('kota');
    $region = $this->input->get('region');

    $excel = new PHPExcel();

    $excel->getProperties()
      ->setCreator('TEAM CA')
      ->setLastModifiedBy('TEAM CA')
      ->setTitle("Data Region $region")
      ->setSubject("Region")
      ->setDescription("Report Data Region $region")
      ->setKeywords("Survey Area");

    // Header 
    $excel->setActiveSheetIndex(0)->setCellValue('A1', 'id_report');
    $excel->setActiveSheetIndex(0)->setCellValue('B1', 'timestamp');
    $excel->setActiveSheetIndex(0)->setCellValue('C1', 'tanggal_survey');
    $excel->setActiveSheetIndex(0)->setCellValue('D1', 'area_id');
    $excel->setActiveSheetIndex(0)->setCellValue('E1', 'map_id');
    $excel->setActiveSheetIndex(0)->setCellValue('F1', 'region');
    $excel->setActiveSheetIndex(0)->setCellValue('G1', 'kota');
    $excel->setActiveSheetIndex(0)->setCellValue('H1', 'kecamatan');
    $excel->setActiveSheetIndex(0)->setCellValue('I1', 'kelurahan');
    $excel->setActiveSheetIndex(0)->setCellValue('J1', 'kompleks');
    $excel->setActiveSheetIndex(0)->setCellValue('K1', 'owner_type');
    $excel->setActiveSheetIndex(0)->setCellValue('L1', 'rw');
    $excel->setActiveSheetIndex(0)->setCellValue('M1', 'type_a');
    $excel->setActiveSheetIndex(0)->setCellValue('N1', 'type_b');
    $excel->setActiveSheetIndex(0)->setCellValue('O1', 'type_c');
    $excel->setActiveSheetIndex(0)->setCellValue('P1', 'type_d');
    $excel->setActiveSheetIndex(0)->setCellValue('Q1', 'type_soho');
    $excel->setActiveSheetIndex(0)->setCellValue('R1', 'hp_all');
    $excel->setActiveSheetIndex(0)->setCellValue('S1', 'hp_map');
    $excel->setActiveSheetIndex(0)->setCellValue('T1', 'color');
    $excel->setActiveSheetIndex(0)->setCellValue('U1', 'metode_pembangunan');
    $excel->setActiveSheetIndex(0)->setCellValue('V1', 'kendaraan_penghuni');
    $excel->setActiveSheetIndex(0)->setCellValue('W1', 'akses_penjualan');
    $excel->setActiveSheetIndex(0)->setCellValue('X1', 'kompetitor');
    $excel->setActiveSheetIndex(0)->setCellValue('Y1', 'provider');
    $excel->setActiveSheetIndex(0)->setCellValue('Z1', 'biaya_langganan');
    $excel->setActiveSheetIndex(0)->setCellValue('AA1', 'nama_surveyor');
    $excel->setActiveSheetIndex(0)->setCellValue('AB1', 'no_hp');
    $excel->setActiveSheetIndex(0)->setCellValue('AC1', 'jenis_properti');
    $excel->setActiveSheetIndex(0)->setCellValue('AD1', 'bod_number');
    $excel->setActiveSheetIndex(0)->setCellValue('AE1', 'mitra_partnership');
    $excel->setActiveSheetIndex(0)->setCellValue('AF1', 'uniq_combi');

    $survey = $this->survey->getSummary($region, $kota, $kecamatan, $kelurahan);
    $numrows = 2;
    foreach ($survey as $data) {
      $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrows, $data->id_report);
      $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrows, $data->timestamp);
      $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrows, $data->tanggal_survey);
      $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrows, $data->area_id);
      $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrows, $data->map_id);
      $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrows, $data->region);
      $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrows, $data->kota);
      $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrows, $data->kecamatan);
      $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrows, $data->kelurahan);
      $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrows, $data->kompleks);
      $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrows, $data->owner_type);
      $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrows, $data->rw);
      $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrows, $data->type_a);
      $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrows, $data->type_b);
      $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrows, $data->type_c);
      $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrows, $data->type_d);
      $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrows, $data->type_soho);
      $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrows, $data->hp_all);
      $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrows, $data->hp_map);
      $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrows, $data->color);
      $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrows, $data->metode_pembangunan);
      $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrows, $data->kendaraan_penghuni);
      $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrows, $data->akses_penjualan);
      $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrows, $data->kompetitor);
      $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrows, $data->provider);
      $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrows, $data->biaya_langganan);
      $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrows, $data->nama_surveyor);
      $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrows, $data->no_hp);
      $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrows, $data->jenis_properti);
      $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrows, $data->bod_number);
      $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrows, $data->mitra_partnership);
      $excel->setActiveSheetIndex(0)->setCellValue('AF' . $numrows, $data->uniq_combi);
      $numrows++;
    }

    $excel->getActiveSheet(0)->setTitle("Data $region");
    $excel->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data Region ' . $region . '.xlsx"');
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

  public function export_color()
  {
    include APPPATH . 'third_party/PHPExcel.php';

    $color = $this->input->get('color');
    $filter = explode(' ', $color);

    $excel = new PHPExcel();

    $excel->getProperties()
      ->setCreator('TEAM CA')
      ->setLastModifiedBy('TEAM CA')
      ->setTitle("Data Color $color")
      ->setSubject("Color")
      ->setDescription("Report Data Color $color")
      ->setKeywords("Survey Area");

    // Header 
    $excel->setActiveSheetIndex(0)->setCellValue('A1', 'id_report');
    $excel->setActiveSheetIndex(0)->setCellValue('B1', 'timestamp');
    $excel->setActiveSheetIndex(0)->setCellValue('C1', 'tanggal_survey');
    $excel->setActiveSheetIndex(0)->setCellValue('D1', 'area_id');
    $excel->setActiveSheetIndex(0)->setCellValue('E1', 'map_id');
    $excel->setActiveSheetIndex(0)->setCellValue('F1', 'region');
    $excel->setActiveSheetIndex(0)->setCellValue('G1', 'kota');
    $excel->setActiveSheetIndex(0)->setCellValue('H1', 'kecamatan');
    $excel->setActiveSheetIndex(0)->setCellValue('I1', 'kelurahan');
    $excel->setActiveSheetIndex(0)->setCellValue('J1', 'kompleks');
    $excel->setActiveSheetIndex(0)->setCellValue('K1', 'owner_type');
    $excel->setActiveSheetIndex(0)->setCellValue('L1', 'rw');
    $excel->setActiveSheetIndex(0)->setCellValue('M1', 'type_a');
    $excel->setActiveSheetIndex(0)->setCellValue('N1', 'type_b');
    $excel->setActiveSheetIndex(0)->setCellValue('O1', 'type_c');
    $excel->setActiveSheetIndex(0)->setCellValue('P1', 'type_d');
    $excel->setActiveSheetIndex(0)->setCellValue('Q1', 'type_soho');
    $excel->setActiveSheetIndex(0)->setCellValue('R1', 'hp_all');
    $excel->setActiveSheetIndex(0)->setCellValue('S1', 'hp_map');
    $excel->setActiveSheetIndex(0)->setCellValue('T1', 'color');
    $excel->setActiveSheetIndex(0)->setCellValue('U1', 'metode_pembangunan');
    $excel->setActiveSheetIndex(0)->setCellValue('V1', 'kendaraan_penghuni');
    $excel->setActiveSheetIndex(0)->setCellValue('W1', 'akses_penjualan');
    $excel->setActiveSheetIndex(0)->setCellValue('X1', 'kompetitor');
    $excel->setActiveSheetIndex(0)->setCellValue('Y1', 'provider');
    $excel->setActiveSheetIndex(0)->setCellValue('Z1', 'biaya_langganan');
    $excel->setActiveSheetIndex(0)->setCellValue('AA1', 'nama_surveyor');
    $excel->setActiveSheetIndex(0)->setCellValue('AB1', 'no_hp');
    $excel->setActiveSheetIndex(0)->setCellValue('AC1', 'jenis_properti');
    $excel->setActiveSheetIndex(0)->setCellValue('AD1', 'bod_number');
    $excel->setActiveSheetIndex(0)->setCellValue('AE1', 'mitra_partnership');

    for ($i = 0; $i < count($filter); $i++) {
      $this->db->or_like('color', $filter[$i]);
    }

    $survey = $this->db->get('summary')->result();
    $numrows = 2;
    foreach ($survey as $data) {
      $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrows, $data->id_report);
      $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrows, $data->timestamp);
      $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrows, $data->tanggal_survey);
      $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrows, $data->area_id);
      $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrows, $data->map_id);
      $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrows, $data->region);
      $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrows, $data->kota);
      $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrows, $data->kecamatan);
      $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrows, $data->kelurahan);
      $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrows, $data->kompleks);
      $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrows, $data->owner_type);
      $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrows, $data->rw);
      $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrows, $data->type_a);
      $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrows, $data->type_b);
      $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrows, $data->type_c);
      $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrows, $data->type_d);
      $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrows, $data->type_soho);
      $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrows, $data->hp_all);
      $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrows, $data->hp_map);
      $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrows, $data->color);
      $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrows, $data->metode_pembangunan);
      $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrows, $data->kendaraan_penghuni);
      $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrows, $data->akses_penjualan);
      $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrows, $data->kompetitor);
      $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrows, $data->provider);
      $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrows, $data->biaya_langganan);
      $excel->setActiveSheetIndex(0)->setCellValue('AA' . $numrows, $data->nama_surveyor);
      $excel->setActiveSheetIndex(0)->setCellValue('AB' . $numrows, $data->no_hp);
      $excel->setActiveSheetIndex(0)->setCellValue('AC' . $numrows, $data->jenis_properti);
      $excel->setActiveSheetIndex(0)->setCellValue('AD' . $numrows, $data->bod_number);
      $excel->setActiveSheetIndex(0)->setCellValue('AE' . $numrows, $data->mitra_partnership);

      $numrows++;
    }

    $excel->getActiveSheet(0)->setTitle("Data $color");
    $excel->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Data Color ' . $color . '.xlsx"');
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

  // public function import()
  // {
  //   $data['title'] = "Row Data Update";
  //   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  //   $this->load->view('app/templates/header', $data);
  //   $this->load->view('app/templates/sidebar', $data);
  //   $this->load->view('app/templates/navbar', $data);
  //   $this->load->view('app/leader/import', $data);
  //   $this->load->view('app/templates/footer', $data);
  // }

  // public function import_upload_progress()
  // {
  //   $upload = $this->import->upload_file($this->filename);
  //   if ($upload['result'] == "success") {
  //     include APPPATH . 'third_party/PHPExcel.php';
  //     $excelreader = new PHPExcel_Reader_Excel2007();
  //     $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
  //     $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

  //     $data = array();
  //     $numrows = 1;
  //     foreach ($sheet as $row) {
  //       if ($numrows > 1) {
  //         array_push($data, array(
  //           'timestamp' => $row['B'],
  //           'tanggal_survey' => $row['C'],
  //           'area_id' => $row['D'],
  //           'map_id' => $row['E'],
  //           'region' => $row['F'],
  //           'kota' => $row['G'],
  //           'kecamatan' => $row['H'],
  //           'kelurahan' => $row['I'],
  //           'kompleks' => $row['J'],
  //           'owner_type' => $row['K'],
  //           'rw' => $row['L'],
  //           'type_a' => $row['M'],
  //           'type_b' => $row['N'],
  //           'type_c' => $row['O'],
  //           'type_d' => $row['P'],
  //           'type_soho' => $row['Q'],
  //           'hp_all' => $row['R'],
  //           'hp_map' => $row['S'],
  //           'color' => $row['T'],
  //           'metode_pembangunan' => $row['U'],
  //           'kendaraan_penghuni' => $row['V'],
  //           'akses_penjualan' => $row['W'],
  //           'kompetitor' => $row['X'],
  //           'provider' => $row['Y'],
  //           'biaya_langganan' => $row['Z'],
  //           'nama_surveyor' => $row['AA'],
  //           'no_hp' => $row['AB'],
  //           'jenis_properti' => $row['AC'],
  //           'bod_number' => $row['AD'],
  //           'mitra_partnership' => $row['AE'],
  //           'uniq_combi' => $row['AF'],
  //         ));
  //       }
  //       $numrows++;
  //     }

  //     $this->import->insert_multiple($data);
  //     $this->session->set_flashdata('message', '
  //       <div class="alert alert-success">
  //         <span>Inserted!</span>
  //       </div>
  //       ');
  //     redirect('leader/row_data');
  //   } else {
  //     print_r($upload);
  //     $this->session->set_flashdata('message', '
  //       <div class="alert alert-danger">
  //         <span>ERROR!</span>
  //       </div>
  //       ');
  //     redirect('leader/row_data');
  //   }
  // }

  // public function import_delete_progress()
  // {
  //   $upload = $this->import->upload_file($this->filename);
  //   if ($upload['result'] == "success") {
  //     include APPPATH . 'third_party/PHPExcel.php';
  //     $excelreader = new PHPExcel_Reader_Excel2007();
  //     $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
  //     $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

  //     $numrows = 1;
  //     foreach ($sheet as $row) {
  //       if ($numrows > 1) {
  //         $this->db->delete('summary', ['id_report' => $row['A']]);
  //       }
  //       $numrows++;
  //     }

  //     $this->session->set_flashdata('message', '
  //       <div class="alert alert-success">
  //         <span>Deleted!</span>
  //       </div>
  //       ');
  //     redirect('leader/row_data');
  //   }
  // }

  // public function import_up_to_date_progress()
  // {
  //   $upload = $this->import->upload_file($this->filename);
  //   if ($upload['result'] == "success") {
  //     include APPPATH . 'third_party/PHPExcel.php';
  //     $excelreader = new PHPExcel_Reader_Excel2007();
  //     $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
  //     $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

  //     $numrows = 1;
  //     foreach ($sheet as $row) {
  //       if ($numrows > 1) {
  //         $data = array(
  //           'timestamp' => $row['B'],
  //           'tanggal_survey' => $row['C'],
  //           'area_id' => $row['D'],
  //           'map_id' => $row['E'],
  //           'region' => $row['F'],
  //           'kota' => $row['G'],
  //           'kecamatan' => $row['H'],
  //           'kelurahan' => $row['I'],
  //           'kompleks' => $row['J'],
  //           'owner_type' => $row['K'],
  //           'rw' => $row['L'],
  //           'type_a' => $row['M'],
  //           'type_b' => $row['N'],
  //           'type_c' => $row['O'],
  //           'type_d' => $row['P'],
  //           'type_soho' => $row['Q'],
  //           'hp_all' => $row['R'],
  //           'hp_map' => $row['S'],
  //           'color' => $row['T'],
  //           'metode_pembangunan' => $row['U'],
  //           'kendaraan_penghuni' => $row['V'],
  //           'akses_penjualan' => $row['W'],
  //           'kompetitor' => $row['X'],
  //           'provider' => $row['Y'],
  //           'biaya_langganan' => $row['Z'],
  //           'nama_surveyor' => $row['AA'],
  //           'no_hp' => $row['AB'],
  //           'jenis_properti' => $row['AC'],
  //           'bod_number' => $row['AD'],
  //           'mitra_partnership' => $row['AE'],
  //           'uniq_combi' => $row['AF'],
  //         );

  //         $this->db->where('id_report', $row['A']);
  //         $this->db->update('summary', $data);
  //       }
  //       $numrows++;
  //     }

  //     $this->session->set_flashdata('message', '
  //       <div class="alert alert-success">
  //         <span>Updated!</span>
  //       </div>
  //       ');
  //     redirect('leader/row_data');
  //   } else {
  //     print_r($upload);
  //     $this->session->set_flashdata('message', '
  //       <div class="alert alert-danger">
  //         <span>ERROR!</span>
  //       </div>
  //       ');
  //     redirect('leader/row_data');
  //   }
  // }

  // public function row_data()
  // {
  //   $data['title'] = "Row Data";
  //   $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
  //   $this->load->view('app/templates/header', $data);
  //   $this->load->view('app/templates/sidebar', $data);
  //   $this->load->view('app/templates/navbar', $data);
  //   $this->load->view('app/leader/row_data', $data);
  //   $this->load->view('app/templates/footer', $data);
  // }

  public function progress_delete()
  {
    $dir = $this->input->post('dir');

    $this->load->library('ftp');
    $config['hostname'] = "files.000webhost.com";
    $config['username'] = "teamca";
    $config['password'] = "teamcamnc";
    $config['debug']    = TRUE;
    $this->ftp->connect($config);

    $this->ftp->delete_file('/public_html/kml/' . $dir);

    $this->ftp->close();

    $this->session->set_flashdata('message', '
        <div class="alert alert-success">
          <span>Deleted!</span>
        </div>
        ');
    redirect("leader/kml_viewer");
  }

  public function progress_upload()
  {

    $config = array(
      'upload_path'   => './assets/kml/',
      'allowed_types' => '*',
      'overwrite'     => true,
      'max_size'      => 30000
    );

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('upload_kml')) {
      if ($this->upload->data('file_ext') == '.kml') {
        $this->load->library('ftp');
        $config['hostname'] = "files.000webhost.com";
        $config['username'] = "teamca";
        $config['password'] = "teamcamnc";
        $config['debug']    = TRUE;
        $this->ftp->connect($config);

        $this->ftp->upload('./assets/kml/' . $this->upload->data('file_name'), '/public_html/kml/' . $this->upload->data('file_name'), 'ascii', 0775);

        $this->ftp->close();

        $this->session->set_flashdata('message', '
        <div class="alert alert-success">
          <span>Uploaded!</span>
        </div>
        ');
        redirect("leader/kml_viewer");
      } else {
        echo "Your file extension wan not .kml";
        $this->session->set_flashdata('message', '
        <div class="alert alert-danger">
          <span>Your file extension wan not .kml!</span>
        </div>
        ');
        unlink(FCPATH . 'assets/kml/' . $this->upload->data('file_name'));
        redirect("leader/kml_viewer");
      }
    } else {
      // echo "Error while uploading :(";
      print_r($this->upload->display_errors());
    }
  }

  public function summary_delete($id)
  {
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 5) {
      redirect('auth/blocked');
    } else {
      $this->db->delete('summary', ['id_report' => $id]);
      $this->session->set_flashdata('msg', '<div class="alert alert-success" style="margin: 10px 0;">Data successfully deleted from out record!</div>');
      redirect('user/data_survey_region');
    }
  }

  public function import_update()
  {
    $data['title'] = "Row Data Update";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/import_update', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function summary_edit($id)
  {
    if ($this->session->userdata('role') != 1 && $this->session->userdata('role') != 5) {
      redirect('auth/blocked');
    } else {
      $this->form_validation->set_rules('kompleks', 'Komplek', 'required');
      $this->form_validation->set_rules('rw', 'RW/Developer', 'required');

      if ($this->form_validation->run() == FALSE) {
        $data['title'] = "Summary Edit";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['survey'] = $this->db->get_where('summary', ['id_report' => $id])->row();

        $data['prop'] = ['Rumah Tinggal/Komplek/Cluster', 'Rumah Tinggal/Open Area', 'Rumah Tinggal/Kompleks/Cluster', 'Ruko/Rukan'];
        $data['owner_type'] = ['RW', 'Dev', 'Dusun'];
        $data['tipe_rumah'] = ['A' => 'a', 'B' => 'b', 'C' => 'c', 'D' => 'd', 'SOHO' => 'soho'];
        $data['kepemilikan_penghuni'] = ['Mobil dan Motor', 'Motor'];
        $data['metode_pembangunan'] = ['Kabel Udara', 'Underground', 'Sewer/Got', 'Sewer', 'Aerial', 'Aerial dan Underground', 'Belum ada karna sebagian masih belum ada yang nempatin'];
        $data['akses_penjualan'] = ['Door to Door', 'Direct Mail', 'Open Booth', 'Branding Car'];
        $data['kompetitor'] = ['First Media', 'Indihome', 'Biznet', 'MyRepublic', 'Indosat GIG'];
        $data['provider'] = ['Indovision/Oke/TOP TV', 'Transvision', 'Orange TV', 'Topas TV'];

        $this->load->view('app/templates/header', $data);
        $this->load->view('app/templates/sidebar', $data);
        $this->load->view('app/templates/navbar', $data);
        $this->load->view('app/leader/survey_edit', $data);
        $this->load->view('app/templates/footer', $data);
      } else {
        $kelurahan = $this->input->post('kelurahan');
        $kecamatan = $this->input->post('kecamatan');
        $kota = $this->input->post('kota');
        $kompleks = $this->input->post('kompleks');
        $map_id = $this->input->post('map_id');
        $area_id = $this->input->post('area_id');
        $rw = $this->input->post('rw');
        $prop = $this->input->post('prop');
        $props = implode(', ', $prop);
        $abjad_klari = $this->input->post('abjad_klari');
        $input_klari = $this->input->post('input_klari');
        $tingkat_potensial = $this->input->post('tingkat_potensial');
        $owner_type = $this->input->post('owner_type');
        $res = array();
        for ($i = 0; $i < count($abjad_klari); $i++) {
          $res[$i] = $abjad_klari[$i] . $input_klari[$i];
        }
        $hp_map = $this->input->post('hp_map');
        $hp_all = $input_klari[0] + $input_klari[1] + $input_klari[2] + $input_klari[3] + $input_klari[4];
        $result = implode("-", $res);
        $input_klaris = implode('-', $input_klari);
        $kepemilikan_penghuni = $this->input->post('kepemilikan_penghuni');
        $metode_pem = $this->input->post('metode_pem');
        $metode_pems = implode(', ', $metode_pem);
        $akses = $this->input->post('akses');
        $aksess = implode(', ', $akses);
        $kompetitor = $this->input->post('kompetitor');
        $kompetitors = implode(', ', $kompetitor);
        $provider = $this->input->post('provider');
        $providers = implode(', ', $provider);
        $biaya = $this->input->post('biaya');
        $bod_number = $this->input->post('bod_number');
        $mitra_partnership = $this->input->post('mitra_partnership');

        $data = [
          'area_id' => $area_id,
          'map_id' => $map_id,
          'kompleks' => $kompleks,
          'owner_type' => $owner_type,
          'rw' => $rw,
          'jenis_properti' => $props,
          'type_a' => $input_klari[0],
          'type_b' => $input_klari[1],
          'type_c' => $input_klari[2],
          'type_d' => $input_klari[3],
          'type_soho' => $input_klari[4],
          'hp_all' => $input_klari[0] + $input_klari[1] + $input_klari[2] + $input_klari[3] + $input_klari[4],
          'color' => $tingkat_potensial,
          'hp_map' => $hp_map,
          'kendaraan_penghuni' => $kepemilikan_penghuni,
          'metode_pembangunan' => $metode_pems,
          'akses_penjualan' => $aksess,
          'kompetitor' => $kompetitors,
          'provider' => $providers,
          'biaya_langganan' => $biaya,
          'bod_number' => $bod_number,
          'mitra_partnership' => $mitra_partnership,
          'uniq_combi' => $kompleks . '/' . $kelurahan . '/' . $kecamatan . '/' . $kota . '/' . $rw . '/' . $tingkat_potensial . '/' . $hp_all,
        ];

        $this->db->where('id_report', $id);
        $this->db->update('summary', $data);
        $this->session->set_flashdata('msg', '<div class="alert alert-success" style="margin: 10px 0;">Data for ' . anchor('leader/summary_view/' . $id, $id) . ' updated successfully!</div>');

        redirect('user/data_survey_region');
      }
    }
  }

  public function summary_view($id)
  {
    $data['title'] = "Summary View";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['summary'] = $this->db->get_where('summary', ['id_report' => $id])->row_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/summary_view', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function kml_viewer()
  {
    $data['title'] = "KML Viewer";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->library('ftp');

    $config['hostname'] = "files.000webhost.com";
    $config['username'] = "teamca";
    $config['password'] = "teamcamnc";
    $config['debug']    = TRUE;

    $this->ftp->connect($config);
    $data['dir'] = $this->ftp->list_files('/public_html/kml');
    $this->ftp->close();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/kml_viewer', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function file()
  {
    $data['title'] = "File Manajement";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/file', $data);
    $this->load->view('app/templates/footer', $data);
  }
}

/* End of file Leader.php */
