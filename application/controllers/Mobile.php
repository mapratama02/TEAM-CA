<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function user()
  {
    $user = $this->db->get('user')->result_array();

    echo json_encode($user);
  }
}
