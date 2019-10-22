<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Survey_model extends CI_Model
{
  public function gettAllData()
  {
    $this->db->select('id, region_name, kota_name, kecamatan_name, kelurahan_name');
    $this->db->from('summary');
    $this->db->join('region', 'summary.region = region.region_id', 'inner');
    $this->db->join('kota', 'summary.kota = kota.kota_id', 'inner');
    $this->db->join('kecamatan', 'summary.kecamatan = kecamatan.kecamatan_id', 'inner');
    $this->db->join('kelurahan', 'summary.kelurahan = kelurahan.kelurahan_id', 'inner');
    return $this->db->get();
  }

  public function getSummary($region, $kota, $kecamatan, $kelurahan)
  {
    $this->db->like('region', $region);
    $this->db->like('kota', $kota);
    $this->db->like('kecamatan', $kecamatan);
    $this->db->like('kelurahan', $kelurahan);
    $hasil = $this->db->get('summary');
    return $hasil->result();
  }

  public function getMap($kota, $color)
  {
    $hasil = $this->db->query("SELECT * FROM `data_color` WHERE `color` = '$color' AND `kota` = '$kota'");
    return $hasil->result();
  }

  public function getAllRegion()
  {
    return $this->db->query("SELECT * FROM `region`");
  }

  public function getKota($region)
  {
    $hasil = $this->db->query("SELECT `kota` FROM `summary` WHERE `region` = '$region' GROUP BY `kota`");
    return $hasil->result();
  }

  public function getKecamatan($kota)
  {
    $hasil = $this->db->query("SELECT `kecamatan` FROM `summary` WHERE `kota` = '$kota' GROUP BY `kecamatan`");
    return $hasil->result();
  }

  public function getKelurahan($kecamatan)
  {
    $hasil = $this->db->query("SELECT `kelurahan` FROM `summary` WHERE `kecamatan` = '$kecamatan' GROUP BY `kelurahan`");
    return $hasil->result();
  }

  public function getSubKota($id)
  {
    $hasil =  $this->db->query("SELECT * FROM `kota` WHERE `province_id` = '$id'");
    return $hasil->result();
  }

  public function getSubKecamatan($id)
  {
    $hasil =  $this->db->query("SELECT * FROM `kecamatan` WHERE `regency_id` = '$id'");
    return $hasil->result();
  }

  public function getSubKelurahan($id)
  {
    $hasil =  $this->db->query("SELECT * FROM `kelurahan` WHERE `district_id` = '$id'");
    return $hasil->result();
  }

  public function data_exists($region, $kota, $kecataman, $kelurahan, $rw)
  {
    $data = $this->db->get_where('summary', ['region' => $region, 'kecamatan' => $kecataman, 'kelurahan' => $kelurahan, 'rw' => $rw]);
    return $data->num_rows();
  }
}

/* End of file Survey_model.php */
