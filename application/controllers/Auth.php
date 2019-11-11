<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  public function login()
  {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == TRUE) {
      $this->_login();
    } else {
      $data['title'] = "TEAM CA";
      $this->load->view('auth/header', $data);
      $this->load->view('auth/login', $data);
      $this->load->view('auth/footer', $data);
    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        $array = array(
          'email' => $email,
          'role' => $user['role']
        );
        $this->session->set_userdata($array);

        if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) {
          redirect('admin');
        } else {
          redirect('user');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Wrong password!</div>');
        redirect('auth/login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Email not found!</div>');
      redirect('auth/login');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role');
    $this->session->set_flashdata('message', '<div class="alert alert-success">Logout!</div>');
    redirect('auth/login');
  }

  public function blocked()
  {
    $this->load->view('blocked');
  }
}
