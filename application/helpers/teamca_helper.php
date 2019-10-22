<?php

function logged_in()
{

  $ci = get_instance();

  if (!$ci->session->userdata('email')) {
    redirect('auth/login');
  } else {
    $role_id = $ci->session->userdata('role');
    $menu = $ci->uri->segment(1);

    $ci->db->like('menu', $menu);
    $query_menu = $ci->db->get('user_menu')->row_array();

    $menu_id = $query_menu['id'];
    $user_access = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    if ($user_access->num_rows() < 1) {
      redirect('auth/blocked');
    }
  }
}
