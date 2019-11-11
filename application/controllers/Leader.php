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
    $kelurahan = $this->input->get('kelurahan');
    $kecamatan = $this->input->get('kecamatan');
    $kota = $this->input->get('kota');
    $region = $this->input->get('region');

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Region " . $region . ".xls");
    $data['survey'] = $this->survey->getSummary($region, $kota, $kecamatan, $kelurahan);
    $this->load->view('app/leader/export', $data);
  }

  public function export_color()
  {
    $color = $this->input->get('color');
    $filter = explode(' ', $color);

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Color " . $color . ".xls");

    for ($i = 0; $i < count($filter); $i++) {
      $this->db->or_like('color', $filter[$i]);
    }
    $data['survey'] = $this->db->get('summary')->result();
    $this->load->view('app/leader/export', $data);
  }

  public function import()
  {
    $data['title'] = "Row Data Update";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/import', $data);
    $this->load->view('app/templates/footer', $data);
  }

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
        // print_r($this->upload->data());
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

  public function import_progress()
  {
    $con_data = array();
    $allowed = array('csv');
    $filename = $_FILES['file']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $this->load->library('CSVReader');
    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

    if (in_array($ext, $allowed)) {
      if (!empty($csvData)) {
        foreach ($csvData as $row) {
          $con_data = array(
            'id_report'           => $row['id_report'],
            'timestamp'           => $row['timestamp'],
            'area_id'             => $row['area_id'],
            'map_id'              => $row['map_id'],
            'region'              => $row['region'],
            'kota'                => $row['kota'],
            'kecamatan'           => $row['kecamatan'],
            'kelurahan'           => $row['kelurahan'],
            'kompleks'            => $row['kompleks'],
            'owner_type'          => $row['owner_type'],
            'rw'                  => $row['rw'],
            'type_a'              => $row['type_a'],
            'type_b'              => $row['type_b'],
            'type_c'              => $row['type_c'],
            'type_d'              => $row['type_d'],
            'type_soho'           => $row['type_soho'],
            'hp_all'              => $row['hp_all'],
            'hp_map'              => $row['hp_map'],
            'color'               => $row['color'],
            'kendaraan_penghuni'  => $row['kendaraan_penghuni'],
            'metode_pembangunan'  => $row['metode_pembangunan'],
            'akses_penjualan'     => $row['akses_penjualan'],
            'kompetitor'          => $row['kompetitor'],
            'provider'            => $row['provider'],
            'biaya_langganan'     => $row['biaya_langganan'],
            'nama_surveyor'       => $row['nama_surveyor'],
            'no_hp'               => $row['no_hp'],
            'bod_number'          => $row['bod_number'],
            'mitra_partnership'   => $row['mitra_partnership'],
          );

          // $this->db->where('id_report', $row['id_report']);
          $this->db->insert('summary', $con_data);
        }

        $this->session->set_flashdata('message', '
          <div class="alert alert-success my-1">
          <p>Uploaded!</p>
          </div>
        ');
        redirect('leader/import');
      } else {
        $this->session->set_flashdata('message', '
          <div class="alert alert-danger my-1">
          <p>The file has no data!</p>
          </div>
        ');
        redirect("leader/import");
      }
    } else {
      $this->session->set_flashdata('message', '
          <div class="alert alert-danger my-1">
          <p>The Extension of file is not <kbd>.csv</kbd> !</p>
          <p class="m-0">Format you upload: <kbd>.' . $ext . '</kbd></p>
          </div>
        ');
      redirect("leader/import");
    }
  }

  public function import_update_progress()
  {
    $con_data = array();
    $allowed = array('csv');
    $filename = $_FILES['file']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $this->load->library('CSVReader');
    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

    if (in_array($ext, $allowed)) {
      if (!empty($csvData)) {
        foreach ($csvData as $row) {
          $con_data = array(
            // 'id_report'           => $row['id_report'],
            'timestamp'           => $row['timestamp'],
            'area_id'             => $row['area_id'],
            'map_id'              => $row['map_id'],
            'region'              => $row['region'],
            'kota'                => $row['kota'],
            'kecamatan'           => $row['kecamatan'],
            'kelurahan'           => $row['kelurahan'],
            'kompleks'            => $row['kompleks'],
            'owner_type'          => $row['owner_type'],
            'rw'                  => $row['rw'],
            'type_a'              => $row['type_a'],
            'type_b'              => $row['type_b'],
            'type_c'              => $row['type_c'],
            'type_d'              => $row['type_d'],
            'type_soho'           => $row['type_soho'],
            'hp_all'              => $row['hp_all'],
            'hp_map'              => $row['hp_map'],
            'color'               => $row['color'],
            'kendaraan_penghuni'  => $row['kendaraan_penghuni'],
            'metode_pembangunan'  => $row['metode_pembangunan'],
            'akses_penjualan'     => $row['akses_penjualan'],
            'kompetitor'          => $row['kompetitor'],
            'provider'            => $row['provider'],
            'biaya_langganan'     => $row['biaya_langganan'],
            'nama_surveyor'       => $row['nama_surveyor'],
            'no_hp'               => $row['no_hp'],
            'bod_number'          => $row['bod_number'],
            'mitra_partnership'   => $row['mitra_partnership'],
          );

          $this->db->where('id_report', $row['id_report']);
          $this->db->update('summary', $con_data);
        }

        $this->session->set_flashdata('message', '
          <div class="alert alert-success my-1">
          <p>Uploaded!</p>
          </div>
        ');
        redirect('leader/import');
      } else {
        $this->session->set_flashdata('message', '
          <div class="alert alert-danger my-1">
          <p>The file has no data!</p>
          </div>
        ');
        redirect("leader/import");
      }
    } else {
      $this->session->set_flashdata('message', '
          <div class="alert alert-danger my-1">
          <p>The Extension of file is not <kbd>.csv</kbd> !</p>
          <p class="m-0">Format you upload: <kbd>.' . $ext . '</kbd></p>
          </div>
        ');
      redirect("leader/import");
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

      // $this->form_validation->set_rules('prop[]', 'Property', 'required');
      // $this->form_validation->set_rules('klasifikasi[]', 'Klasifikasi Tipe Rumah', 'required');
      // $this->form_validation->set_rules('kepemilikan_penghuni', 'Kepemilikan Penghuni', 'required');
      // $this->form_validation->set_rules('metode_pem[]', 'Metode Pembangunan', 'required');
      // $this->form_validation->set_rules('akses[]', 'Akses Penjualan', 'required');
      // $this->form_validation->set_rules('kompetitor[]', 'Kompetitor', 'required');
      // $this->form_validation->set_rules('provider[]', 'Provider', 'required');

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
        // $klasifikasi = $this->input->post('klasifikasi');
        // $klasifikasis = implode(', ', $klasifikasi);
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

  public function ex_parsing_kml()
  {
    $this->load->helper('xml');
    $file = base_url() . 'assets/kml/test.kml';

    $xmlRaw = file_get_contents($file);
    $this->load->library('simplexml');

    $xmlData = $this->simplexml->xml_parse($xmlRaw);
    foreach ($xmlData['Folder']['Placemark'] as $key => $value) {
      $data = array();
      $string = "<?xml version='1.0'?> " . str_replace("<br>", "", $value['description']) . "</table>";

      $xml = simplexml_load_string($string);
      $data['name'] = $value['name'];
      $data['visibility'] = $value['visibility'];
      $data['open'] = $value['open'][0];
      $data['linestyle_color'] = $value['Style']['LineStyle']['color'];
      $data['linestyle_width'] = $value['Style']['LineStyle']['width'];
      $data['polystyle_fill'] = $value['Style']['PolyStyle']['fill'];
      $data['polystyle_outline'] = $value['Style']['PolyStyle']['outline'];
      $data['polystyle_color'] = $value['Style']['PolyStyle']['color'];
      $data['extrude'] = $value['Polygon']['extrude'];
      $data['altitudemode'] = $value['Polygon']['altitudeMode'];
      $data['tessellate'] = $value['Polygon']['tessellate'];
      $data['coordinates'] = $value['Polygon']['outerBoundaryIs']['LinearRing']['coordinates'];

      foreach ($xml->tr as $kunci => $isi) {
        $data2 = (string) $isi->td[1];
        $data['desc_' . strtolower($isi->td[0])] = $data2;
      }

      echo "<pre>";
      print_r($data);
      echo "</pre>";

      /* Remove comment if you want save to database (this is sample only for POSTGRE [postgis])
		$coor = $value['Polygon']['outerBoundaryIs']['LinearRing']['coordinates'];
		$coors = explode(',0', $coor);
		$coordinates = '';
		foreach ($coors as $c) {
			if(!empty($c)){
				$coorxy = explode(',', $c);
				$coordinates[] = $coorxy[1].' '.$coorxy[0];
			}
		};
		$this->db->set('coordinates',"ST_GeomFromText('POLYGON((".implode(',',$coordinates)."))',4326)",false);
		$this->db->insert('kml_pg', $data);
		*/
    }
  }
}

/* End of file Leader.php */
