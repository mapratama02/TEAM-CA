<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    logged_in();
    $this->load->model('Survey_model', 'survey');
  }

  public function dashboard()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['region'] = $this->db->query("SELECT `id_report`, `region` FROM `summary` GROUP BY `region`")->result_array();

    $username = $data['user']['name'];
    $data['region_personal'] = $this->db->query("SELECT `id_report`, `region` FROM `summary` WHERE `nama_surveyor` = '$username' GROUP BY `region`")->result_array();
    $data['label_color'] = $this->db->query("SELECT `color` FROM `map_online` GROUP BY `color`")->result_array();

    $data['user_name'] = $data['user']['name'];

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/admin/dashboard', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function index()
  {
    $data['title'] = 'My Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/index', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function edit()
  {
    $data['title'] = 'Edit Profile';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/edit', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function edit_name()
  {
    $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $email = $user['email'];
    $name = $this->input->post('name');

    $query = "UPDATE `user` SET `name` = '$name' WHERE `email` = '$email'";
    $this->db->query($query);
  }

  public function edit_image()
  {
    $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $email = $user['email'];
    if (isset($_POST["image"])) {
      $data = $_POST["image"];
      $old_image = $user['image'];
      if ($old_image != 'default.png') {
        unlink(FCPATH . 'assets/img/profile/' . $old_image);
      }
      $image_array_1 = explode(";", $data);
      $image_array_2 = explode(",", $image_array_1[1]);
      $data = base64_decode($image_array_2[1]);
      $imageName = time() . '.png';
      file_put_contents('./assets/img/profile/' . $imageName, $data);

      $query = "UPDATE `user` SET `image` = '$imageName' WHERE `email` = '$email'";
      $this->db->query($query);

      echo base_url('assets/img/profile/') . $imageName;
    }
  }

  public function data_survey_region()
  {
    $data['title'] = 'Data Survey by Region';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['region'] = $this->db->query("SELECT `region` FROM `summary` GROUP BY `region`")->result();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/data_survey_region', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function data_survey_color()
  {
    $data['title'] = 'Data Survey by Color';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['region'] = $this->db->query("SELECT `region` FROM `summary` GROUP BY `region`")->result();
    $data['color'] = $this->db->query("SELECT `color` FROM `summary` GROUP BY `color`")->result();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/data_survey_color', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function data_json_survey_color()
  {
    $this->load->library('datatables');
    $this->datatables->select('id_report, map_id, tanggal_survey, region, kota, kecamatan, kelurahan, kompleks, owner_type, rw, tipe_rumah, type_a, type_b, type_c, type_d, type_soho, hp_all, hp_map, color, attachment');
    $this->datatables->from('summary');
    $filter = $this->input->post('color');
    if ($filter != '') {
      $color = explode(' ', $filter);
      for ($i = 0; $i < count($color); $i++) {
        $this->datatables->or_where('color', $color[$i]);
      }
    }
    if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
      $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
      $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
    }
    echo $this->datatables->generate();
  }

  public function data_json_survey_region()
  {
    $this->load->library('datatables');
    $this->datatables->select('id_report, map_id, tanggal_survey, region, kota, kecamatan, kelurahan, kompleks, owner_type, rw, tipe_rumah, type_a, type_b, type_c, type_d, type_soho, hp_all, hp_map, color, attachment');

    $this->datatables->from('summary');

    $region = $this->input->post('region');
    $kota = $this->input->post('kota');
    $kecamatan = $this->input->post('kecamatan');
    $kelurahan = $this->input->post('kelurahan');
 
    if ($region != '' && $kota != '' && $kecamatan != '' && $kelurahan != '') {
      $this->datatables->where('region =', $region);
      $this->datatables->where('kota =', $kota);
      $this->datatables->where('kecamatan =', $kecamatan);
      $this->datatables->where('kelurahan =', $kelurahan);
      if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
        $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
        $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
      }
      echo $this->datatables->generate();
    } elseif ($region != '' && $kota != '' && $kecamatan != '') {
      $this->datatables->where('region =', $region);
      $this->datatables->where('kota =', $kota);
      $this->datatables->where('kecamatan =', $kecamatan);
      if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
        $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
        $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
      }
      echo $this->datatables->generate();
    } elseif ($region != '' && $kota != '') {
      $this->datatables->where('region =', $region);
      $this->datatables->where('kota =', $kota);
      if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
        $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
        $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
      }
      echo $this->datatables->generate();
    } elseif ($region != '') {
      $this->datatables->where('region =', $region);
      if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
        $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
        $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
      }
      echo $this->datatables->generate();
    } else {
      if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) {
        $this->datatables->add_column('delete', anchor('leader/summary_delete/$1', 'Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Delete this Data?\')']), 'id_report');
        $this->datatables->add_column('action', anchor('leader/summary_edit/$1', 'Edit', ['class' => 'btn btn-info']), 'id_report');
      }
      echo $this->datatables->generate();
    }
  }

  public function change_password()
  {
    $data['title'] = "Change Password";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $email = $data['user']['email'];

    $this->form_validation->set_rules('old_password', 'old password', 'trim|required');
    $this->form_validation->set_rules('new_password', 'new password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('retype_password', 'retype password', 'trim|required|matches[new_password]');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('app/templates/header', $data);
      $this->load->view('app/templates/sidebar', $data);
      $this->load->view('app/templates/navbar', $data);
      $this->load->view('app/user/change_password', $data);
      $this->load->view('app/templates/footer', $data);
    } else {
      $old_password = $this->input->post('old_password');
      $new_password = $this->input->post('new_password');

      if (password_verify($old_password, $data['user']['password'])) {
        $data = [
          'password' => password_hash($new_password, PASSWORD_DEFAULT)
        ];

        $this->db->where('email', $email);
        $this->db->update('user', $data);

        $this->session->set_flashdata('msg', '<div class="alert alert-success">You\'re Password have changed successfully!</div>');
        redirect('user/change_password');
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger">Old password tidak sesuai dengan password yang anda gunakan sekarang!</div>');
        redirect('user/change_password');
      }
    }
  }

  public function kml_viewer($id)
  {
    $data['title'] = "KML Viewer";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['summary'] = $this->db->get_where('summary', ['id_report' => $id])->row_array();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/kml_viewer', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function get_kota()
  {
    $kota = $this->input->post('region');
    $data = $this->survey->getKota($kota);

    echo json_encode($data);
  }

  public function get_kecamatan()
  {
    $kecamatan = $this->input->post('kota');
    $data = $this->survey->getKecamatan($kecamatan);

    echo json_encode($data);
  }

  public function get_kelurahan()
  {
    $kelurahan = $this->input->post('kecamatan');
    $data = $this->survey->getKelurahan($kelurahan);

    echo json_encode($data);
  }

  public function get_data()
  {
    $kelurahan = $this->input->post('kelurahan');
    $region = $this->input->post('region');
    $kecamatan = $this->input->post('kecamatan');
    $kota = $this->input->post('kota');
    $data = $this->survey->getSummary($region, $kota, $kecamatan, $kelurahan);

    echo json_encode($data);
  }

  public function search_area()
  {
    $data['title'] = "Search Area";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $data['rw'] = $this->db->query("SELECT * FROM `summary` GROUP BY `rw`")->result_array();
    $data['region'] = $this->db->query("SELECT `region` FROM `summary` GROUP BY `region`")->result();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/user/search_area', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function data_json_search_area()
  {
    $region = $this->input->post('region');
    $kota = $this->input->post('kota');
    $kecamatan = $this->input->post('kecamatan');
    $kelurahan = $this->input->post('kelurahan');
    $rw = $this->input->post('rw');

    $this->load->library('datatables');
    $this->datatables->select('id_report, area_id, map_id, region, kota, kecamatan, kelurahan, rw');
    $this->datatables->from('summary');
    $this->datatables->where('region =', $region);
    $this->datatables->where('kota =', $kota);
    $this->datatables->where('kecamatan =', $kecamatan);
    $this->datatables->where('kelurahan =', $kelurahan);
    $this->datatables->where('rw =', $rw);

    echo $this->datatables->generate();
  }
}

/* End of file User.php */
