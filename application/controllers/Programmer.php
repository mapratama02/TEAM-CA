<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Programmer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    logged_in();
  }

  public function menu_builder()
  {
    $data['title'] = 'Menu Builder';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['menu'] = $this->db->get('user_menu')->result_array();

    $this->db->select('user_sub_menu.*, user_menu.menu');
    $this->db->from('user_sub_menu');
    $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id', 'inner');
    $data['sub_menu'] = $this->db->get()->result_array();

    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/programmer/menu_builder', $data);
    $this->load->view('app/templates/footer', $data);
  }

  public function submenu_edit($id)
  {
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('url', 'URL', 'trim|required');
    $this->form_validation->set_rules('icon', 'Icon', 'trim|required');


    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Submenu Builder';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['menu'] = $this->db->get('user_menu')->result_array();

      $data['submenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

      $this->load->view('app/templates/header', $data);
      $this->load->view('app/templates/sidebar', $data);
      $this->load->view('app/templates/navbar', $data);
      $this->load->view('app/programmer/submenu_edit', $data);
      $this->load->view('app/templates/footer', $data);
    } else {
      if ($this->input->post('is_active')) {
        $data = array(
          'menu_id' => $this->input->post('menu_id'),
          'title' => $this->input->post('title'),
          'url' => $this->input->post('url'),
          'icon' => $this->input->post('icon'),
          'is_active' => $this->input->post('is_active'),
        );
      } else {
        $data = array(
          'menu_id' => $this->input->post('menu_id'),
          'title' => $this->input->post('title'),
          'url' => $this->input->post('url'),
          'icon' => $this->input->post('icon'),
          'is_active' => 0,
        );
      }
      $this->db->where('id', $id);
      $this->db->update('user_sub_menu', $data);
      redirect('programmer/submenu_builder');
    }
  }

  public function submenu_builder()
  {
    $this->form_validation->set_rules('title', 'title', 'trim|required');
    $this->form_validation->set_rules('url', 'URL', 'trim|required');
    $this->form_validation->set_rules('icon', 'Icon', 'trim|required');


    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Submenu Builder';
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
      $data['menu'] = $this->db->get('user_menu')->result_array();

      $this->db->select('user_sub_menu.*, user_menu.menu');
      $this->db->from('user_sub_menu');
      $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id', 'inner');
      $data['sub_menu'] = $this->db->get()->result_array();

      $this->load->view('app/templates/header', $data);
      $this->load->view('app/templates/sidebar', $data);
      $this->load->view('app/templates/navbar', $data);
      $this->load->view('app/programmer/submenu_builder', $data);
      $this->load->view('app/templates/footer', $data);
    } else {
      if ($this->input->post('is_active')) {
        $data = array(
          'menu_id' => $this->input->post('menu_id'),
          'title' => $this->input->post('title'),
          'url' => $this->input->post('url'),
          'icon' => $this->input->post('icon'),
          'is_active' => $this->input->post('is_active'),
        );
      } else {
        $data = array(
          'menu_id' => $this->input->post('menu_id'),
          'title' => $this->input->post('title'),
          'url' => $this->input->post('url'),
          'icon' => $this->input->post('icon'),
          'is_active' => 0,
        );
      }

      $this->db->insert('user_sub_menu', $data);
      redirect('programmer/submenu_builder');
    }
  }
}

/* End of file Programmer.php */
