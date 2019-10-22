<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Survey_model', 'survey');
  }

  public function index()
  { }

  public function survey()
  {
    $data['title'] = 'Form Survey';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['region'] = $this->survey->getAllRegion();
    $data['date'] = date('Y-m-d h:i:s', time());
    // $data['surveyor'] = $this->db->get('surveyor')->result_array();

    // $this->form_validation->set_rules('tanggal_survey', 'Tanggal Survey', 'required');
    $this->form_validation->set_rules('region', 'Region', 'required');
    $this->form_validation->set_rules('kota', 'Kota/Kabupaten', 'required');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
    $this->form_validation->set_rules('kompleks', 'Komplek', 'required');
    $this->form_validation->set_rules('rw', 'RW/Developer', 'required');
    $this->form_validation->set_rules('prop[]', 'Property', 'required');
    $this->form_validation->set_rules('klasifikasi[]', 'Klasifikasi Tipe Rumah', 'required');
    $this->form_validation->set_rules('kepemilikan_penghuni', 'Kepemilikan Penghuni', 'required');
    $this->form_validation->set_rules('metode_pem[]', 'Metode Pembangunan', 'required');
    $this->form_validation->set_rules('akses[]', 'Akses Penjualan', 'required');
    $this->form_validation->set_rules('kompetitor[]', 'Kompetitor', 'required');
    $this->form_validation->set_rules('provider[]', 'Provider', 'required');

    if ($this->form_validation->run() == false) {
      $data['title'] = "Form Survey";
      $data['region'] = $this->survey->getAllRegion();
      $data['date'] = date('Y-m-d h:i:s', time());

      $this->load->view('app/templates/header', $data);
      $this->load->view('app/templates/sidebar', $data);
      $this->load->view('app/templates/navbar', $data);
      $this->load->view('app/staff/form_survey', $data);
      $this->load->view('app/templates/footer', $data);
    } else {
      $timestamp = date('d/m/Y h.i.s', time());
      $tanggal_survey = $this->input->post('tanggal_survey');
      $region = explode('.', $this->input->post('region'));
      $kota = explode('.', $this->input->post('kota'));
      $kecamatan = explode('.', $this->input->post('kecamatan'));
      $kelurahan = explode('.', $this->input->post('kelurahan'));
      $kompleks = $this->input->post('kompleks');
      $rw = $this->input->post('rw');
      $prop = $this->input->post('prop');
      $props = implode(', ', $prop);
      // $klasifikasi = $this->input->post('klasifikasi');
      // $klasifikasis = implode(', ', $klasifikasi);
      $abjad_klari = $this->input->post('abjad_klari');
      $input_klari = $this->input->post('input_klari');
      $jumlah = ($input_klari[0] + $input_klari[1] + $input_klari[2] + $input_klari[3] + $input_klari[4]);
      $tingkat_potensial = $this->input->post('tingkat_potensial');
      $owner_type = $this->input->post('owner_type');

      $res = array();
      for ($i = 0; $i < count($abjad_klari); $i++) {
        $res[$i] = $abjad_klari[$i] . $input_klari[$i];
      }

      $result = implode("-", $res);
      // $hp_map = $this->input->post('hp_map');
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
      $surveyor = $this->input->post('surveyor');
      $telepon = $this->input->post('telepon');
      // $roll_out = $this->input->post('roll_out');

      $variable = $this->survey->data_exists($region[1], $kota[1], $kecamatan[1], $kelurahan[1], $rw);

      if ($variable > 0) {
        if (isset($_FILES['attachment']['name'])) {
          $config['upload_path']          = './assets/kml/';
          $config['allowed_types']        = 'kml|png|jpg|jpeg';

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('attachment')) {
            $data = [
              'timestamp' => $timestamp,
              'tanggal_survey' => $tanggal_survey,
              'region' => $region[1],
              'kota' => $kota[1],
              'kecamatan' => $kecamatan[1],
              'kelurahan' => $kelurahan[1],
              'kompleks' => $kompleks,
              'owner_type' => $owner_type,
              'rw' => $rw,
              'jenis_properti' => $props,
              'type_a' => $input_klari[0],
              'type_b' => $input_klari[1],
              'type_c' => $input_klari[2],
              'type_d' => $input_klari[3],
              'type_soho' => $input_klari[4],
              'hp_all' => $jumlah,
              'hp_map' => '',
              'color' => $tingkat_potensial,
              'kendaraan_penghuni' => $kepemilikan_penghuni,
              'metode_pembangunan' => $metode_pems,
              'akses_penjualan' => $aksess,
              'kompetitor' => $kompetitors,
              'provider' => $providers,
              'biaya_langganan' => $biaya,
              'nama_surveyor' => $surveyor,
              'no_hp' => $telepon,
              'uniq_combi' => $kompleks . '/' . $kelurahan[1] . '/' . $kelurahan[1] . '/' . $kota[1] . '/' . $rw . '/' . $tingkat_potensial . '/' . $jumlah
            ];
            $this->db->insert('data_temporary', $data);

            // Email Sender
            $this->load->library('email');

            $config = array();
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.googlemail.com';
            $config['smtp_user'] = 'mapratama02@gmail.com';
            $config['smtp_pass'] = 'Pratama02';
            $config['smtp_port'] = 465;
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $this->email->initialize($config);

            $this->email->set_newline("\r\n");

            $admin = $this->db->get_where('user', ['role' => 1])->result_array();

            foreach ($admin as $email) {
              $this->email->clear();

              $this->email->from($user['email']);
              $this->email->to($email['email']);

              $message = '
              <h1>Data Duplikat!</h1>
              <p>Kami baru saja mendapatkan ada salah satu dari staff anda yang memasukkan data yang sudah ada di dalam <i>database</i>.</p>
              <p>Kami ingin meminta konfirmasi anda untuk meng-<i>update</i> data lama dengan data baru, atau menghapus data baru.</p>
              <a href="' . base_url() . 'staff/verify_data?region=' . $region[1] . '&kota=' . $kota[1] . '&kecamatan=' . $kecamatan[1] . '&kelurahan=' . $kelurahan[1] . '&rw=' . $rw . '&owner_type=' . $owner_type . '">Update Data Lama</a> <br>
              <a href="' . base_url() . 'staff/delete_data?region=' . $region[1] . '&kota=' . $kota[1] . '&kecamatan=' . $kecamatan[1] . '&kelurahan=' . $kelurahan[1] . '&rw=' . $rw . '&owner_type=' . $owner_type . '">Delete Data Baru</a> <br>
            ';

              $this->email->subject('Duplicate Data!');
              $this->email->message($message);
              $this->email->send();
            }

            redirect('staff/survey');
          } else {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
          }
        }
      } else {
        if (isset($_FILES['attachment']['name'])) {
          $config['upload_path']          = './assets/kml/';
          $config['allowed_types']        = 'kml|png|jpg|jpeg';

          $this->load->library('upload', $config);

          if ($this->upload->do_upload('attachment')) {
            $data = [
              'timestamp' => $timestamp,
              'tanggal_survey' => $tanggal_survey,
              'region' => $region[1],
              'kota' => $kota[1],
              'kecamatan' => $kecamatan[1],
              'kelurahan' => $kelurahan[1],
              'kompleks' => $kompleks,
              'rw' => $rw,
              'owner_type' => $owner_type,
              'jenis_properti' => $props,
              'type_a' => $input_klari[0],
              'type_b' => $input_klari[1],
              'type_c' => $input_klari[2],
              'type_d' => $input_klari[3],
              'type_soho' => $input_klari[4],
              'hp_all' => $jumlah,
              'hp_map' => '',
              'color' => $tingkat_potensial,
              'kendaraan_penghuni' => $kepemilikan_penghuni,
              'metode_pembangunan' => $metode_pems,
              'akses_penjualan' => $aksess,
              'kompetitor' => $kompetitors,
              'provider' => $providers,
              'biaya_langganan' => $biaya,
              'nama_surveyor' => $surveyor,
              'no_hp' => $telepon,
              'uniq_combi' => $kompleks . '/' . $kelurahan[1] . '/' . $kelurahan[1] . '/' . $kota[1] . '/' . $rw . '/' . $tingkat_potensial . '/' . $jumlah
            ];
            $this->db->insert('summary', $data);

            // Email Sender

            $admin = $this->db->get_where('user', ['role' => 1])->result_array();

            $this->load->library('email');
            $config = array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_port' => 465,
              'smtp_user' => 'mapratama02@gmail.com',
              'smtp_pass' => 'Pratama02',
              'mailtype'  => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE,
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");

            foreach ($admin as $email) {
              $this->email->clear();
              $this->email->from($user['email'], $user['name']);
              $this->email->to($email['email']);

              $message = '
          <h1 align="center">Data Survey</h1>
          
          <table border="1" width="100%" cellpadding="3" style="border-collapse: collapse">
            <tr>
              <th>Tanggal Survey</th>
              <td>' . $tanggal_survey . '</td>
            </tr>
            <tr>
              <th>Region</th>
              <td>' . $region[1] . '</td>
            </tr>
            <tr>
              <th>Kota</th>
              <td>' . $kota[1] . '</td>
            </tr>
            <tr>
              <th>Kecamatan</th>
              <td>' . $kecamatan[1] . '</td>
            </tr>
            <tr>
              <th>Kelurahan</th>
              <td>' . $kelurahan[1] . '</td>
            </tr>
            <tr>
              <th>Kompleks</th>
              <td>' . $kompleks . '</td>
            </tr>
            <tr>
              <th>RW/Developer</th>
              <td>' . $owner_type . ' ' . $rw . '</td>
            </tr>
            <tr>
              <th>Jenis Properti</th>
              <td>' . $props . '</td>
            </tr>
            <tr>
              <th>Color</th>
              <td>' . $tingkat_potensial . '</td>
            </tr>
            <tr>
              <th>Kepemilikan Penghuni</th>
              <td>' . $kepemilikan_penghuni . '</td>
            </tr>
            <tr>
              <th>Metode Pembangunan</th>
              <td>' . $metode_pems . '</td>
            </tr>
            <tr>
              <th>Akses Penjualan</th>
              <td>' . $aksess . '</td>
            </tr>
            <tr>
              <th>Kompetitor</th>
              <td>' . $kompetitors . '</td>
            </tr>
            <tr>
              <th>Provider</th>
              <td>' . $providers . '</td>
            </tr>
            <tr>
              <th>Biaya Langganan</th>
              <td>' . $biaya . '</td>
            </tr>
            <tr>
              <th>Nama Surveyor</th>
              <td>' . $surveyor . '</td>
            </tr>
            <tr>
              <th>Nomor HP</th>
              <td>' . $telepon . '</td>
            </tr>
          </table>
          ';

              $this->email->subject('Data Survey Area');
              $this->email->message($message);
              $this->email->attach(FCPATH . 'assets/kml/' . $_FILES['attachment']['name']);
              $this->email->send();
            }

            // unlink(FCPATH . 'assets/kml/' . $this->upload->data('file_name'));

            redirect('staff/form_survey');
          } else {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
          }
        }
      }
    }
  }

  public function verify_data()
  {
    $region = $this->db->get('region');
    $kota = $this->db->get('kota');
    $kecamatan = $this->db->get('kecamatan');
    $kelurahan = $this->db->get('kelurahan');
    $rw = $this->db->get('rw');

    $data = $this->db->get_where('data_temporary', ['region' => $region, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'rw' => $rw])->row_array();

    $object = [
      'timestamp' => $data['timestamp'],
      'tanggal_survey' => $data['tanggal_survey'],
      'map_id' => $data['map_id'],
      'area_id' => $data['area_id'],
      'region' => $data['region'],
      'kota' => $data['kota'],
      'kecamatan' => $data['region'],
      'kelurahan' => $data['kelurahan'],
      'kompleks' => $data['kompleks'],
      'owner_type' => $data['owner_type'],
      'rw' => $data['rw'],
      'jenis_properti' => $data['jenis_properti'],
      'type_a' => $data['type_a'],
      'type_b' => $data['type_b'],
      'type_c' => $data['type_c'],
      'type_d' => $data['type_d'],
      'type_soho' => $data['type_soho'],
      'hp_all' => $data['hp_all'],
      'hp_map' => $data['hp_map'],
      'color' => $data['color'],
      'kendaraan_penghuni' => $data['kendaraan_penghuni'],
      'metode_pembangunan' => $data['metode_pembangunan'],
      'akses_penjualan' => $data['akses_penjualan'],
      'kompetitor' => $data['kompetitor'],
      'provider' => $data['provider'],
      'biaya_langganan' => $data['biaya_langganan'],
      'nama_surveyor' => $data['nama_surveyor'],
      'no_hp' => $data['no_hp'],
      'rekomendasi' => $data['rekomendasi'],
      'bod_number' => $data['bod_number'],
      'mitra_partnership' => $data['mitra_partnership'],
      'uniq_combi' => $data['uniq_combi'],
    ];

    $this->db->where('region', $region);
    $this->db->where('kecamatan', $kecamatan);
    $this->db->where('kelurahan', $kelurahan);
    $this->db->where('rw', $rw);
    $this->db->where('owner_type', $owner_type);
    $this->db->update('summary', $object);

    $this->db->delete('data_temporary', ['region' => $region, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'rw' => $rw]);

    echo "Data telah di<i>update</i>!";
  }

  public function delete_data()
  {
    $region = $this->input->get('region');
    $kota = $this->input->get('kota');
    $kecamatan = $this->input->get('kecamatan');
    $kelurahan = $this->input->get('kelurahan');
    $rw = $this->input->get('rw');
    $owner_type = $this->input->get('owner_type');

    $this->db->delete('data_temporary', ['region' => $region, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan, 'rw' => $rw]);
    echo "Data baru telah di<i>delete</i>!";
  }

  // AJAX Data
  public function get_kota()
  {
    $id = explode('.', $this->input->post('region'));
    $data = $this->survey->getSubKota($id[0]);
    echo json_encode($data);
  }

  public function get_kecamatan()
  {
    $id = explode('.', $this->input->post('kota'));
    $data = $this->survey->getSubKecamatan($id[0]);
    echo json_encode($data);
  }

  public function get_kelurahan()
  {
    $id = explode('.', $this->input->post('kecamatan'));
    $data = $this->survey->getSubKelurahan($id[0]);
    echo json_encode($data);
  }
}

/* End of file Staff.php */
