<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    logged_in();
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['region'] = $this->db->query("SELECT `region` FROM `summary` GROUP BY `region`")->result_array();
    $data['label_color'] = $this->db->query("SELECT `color` FROM `map_online` GROUP BY `color`")->result_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/admin/dashboard', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function user()
  {
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Users';
      $data['role'] = $this->db->get('user_role')->result();
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $this->load->view('app/templates/header', $data);
      $this->load->view('app/templates/sidebar', $data);
      $this->load->view('app/templates/navbar', $data);
      $this->load->view('app/admin/users', $data);
      $this->load->view('app/templates/footer', $data);
    } else {
      $data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'image' => 'default.png',
        'role' => $this->input->post('role')
      );

      $this->db->insert('user', $data);
      redirect('admin/user');
    }
  }

  // Generate data for datatables
  public function user_json()
  {
    $this->load->library('datatables');

    $this->datatables->select('user.user_id, user.name, user.email, user.image, user_menu.menu');
    $this->datatables->from('user');
    $this->datatables->join('user_menu', 'user_menu.id = user.role');
    $this->datatables->where('email !=', $this->session->userdata('email'));
    $this->datatables->where('role !=', 5);
    $this->datatables->add_column('delete', anchor('admin/user_delete/$1', 'Delete User', ['class' => 'btn btn-link text-danger', 'onclick' => 'return confirm(\'Delete this User?\n$2\')']), 'user_id, name');
    $this->datatables->add_column('action', anchor('admin/user_edit/$1', 'Edit User Role', ['class' => 'btn btn-link text-primary']), 'user_id');
    echo $this->datatables->generate();
  }

  public function user_edit($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['users'] = $this->db->get_where('user', ['user_id' => $id])->row_array();
    $data['role'] = $this->db->get('user_menu')->result_array();

    $data['title'] = "Users";

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/admin/user_edit', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function edit_role_user()
  {
    $email = $this->input->post('email');
    $role = $this->input->post('role');

    $object = [
      'role' => $role
    ];

    $this->db->where('email', $email);
    $this->db->update('user', $object);
  }

  public function user_delete($id)
  {
    $this->db->delete('user', ['user_id' => $id]);
    redirect('admin/user');
  }
}

/* End of file Admin.php */
