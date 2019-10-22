<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leader extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Survey_model', 'survey');
  }

  public function export()
  {
    $data['region'] = $this->input->get('region');
    $data['kota'] = $this->input->get('kota');
    $data['kecamatan'] = $this->input->get('kecamatan');
    $kelurahan = $this->input->get('kelurahan');
    $kecamatan = $this->input->get('kecamatan');
    $kota = $this->input->get('kota');
    $region = $this->input->get('region');
    $data['kelurahan'] = $this->input->get('kelurahan');

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

        redirect('user/data_survey_color');
      }
    }
  }
}

/* End of file Leader.php */
