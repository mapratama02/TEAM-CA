<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{

  public function index()
  {
    $data['upload_max_filesize'] = ini_get('upload_max_filesize');
    $this->load->view('coba/form', $data);
  }

  public function submit()
  {
    echo $_FILES['file']['name'];
    echo "\n";
    echo $_FILES['file']['tmp_name'];
  }
}

/* End of file Coba.php */
