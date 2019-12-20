<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function login()
  {
    if ($this->session->userdata('email')) {
      redirect('user/dashboard');
    }

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

        if ($this->session->userdata('role') == 3) {
          redirect('user/dashboard');
        } else {
          redirect('user/dashboard');
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

  public function not_found()
  {
    $this->load->view('not_found');
  }

  public function login_mobile()
  {
    $username = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $username])->row_array();

    if ($user) {
      if (password_verify($password, $user['password'])) {
        echo json_encode($user);
      } else {
        $message = "Wrong Password";
        echo json_encode($message);
      }
    } else {
      $message = "User Not Found";
      echo json_encode($message);
    }

    // echo json_encode($user);
  }
}
