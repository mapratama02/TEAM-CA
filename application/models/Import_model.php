<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{

  public function upload_file($filename)
  {
    $config['upload_path'] = './assets/excel/';
    $config['allowed_types'] = '*';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    } else {
      // Jika gagal :
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }

  public function insert_multiple($data)
  {
    $this->db->insert_batch('summary', $data);
  }

  public function update($data, $where)
  {
    $this->db->where('id_report', $where);
    $this->db->update('summary', $data);
  }
}

/* End of file Import_model.php */
