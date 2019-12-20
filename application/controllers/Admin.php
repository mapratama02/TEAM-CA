<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  private $filename = "import_file";

  public function __construct()
  {
    parent::__construct();
    logged_in();
    $this->load->model('Import_model', 'import');
  }

  public function user()
  {
    $this->form_validation->set_rules('name', 'Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'Users';
      $data['role'] = $this->db->get_where('user_role', ['id !=' => 5])->result();
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

      $this->db->select('*');
      $this->db->from('user');
      $this->db->join('user_menu', 'user_menu.id = user.role');
      $this->db->where('role !=', 5);
      $this->db->where('email !=', $this->session->userdata('email'));
      $data['users'] = $this->db->get('')->result_array();

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

  public function import_upload_progress()
  {
    $upload = $this->import->upload_file($this->filename);
    if ($upload['result'] == "success") {
      include APPPATH . 'third_party/PHPExcel.php';
      $excelreader = new PHPExcel_Reader_Excel2007();
      $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
      $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $data = array();
      $numrows = 1;
      foreach ($sheet as $row) {
        if ($numrows > 1) {
          array_push($data, array(
            'timestamp' => $row['B'],
            'tanggal_survey' => $row['C'],
            'area_id' => $row['D'],
            'map_id' => $row['E'],
            'region' => $row['F'],
            'kota' => $row['G'],
            'kecamatan' => $row['H'],
            'kelurahan' => $row['I'],
            'kompleks' => $row['J'],
            'owner_type' => $row['K'],
            'rw' => $row['L'],
            'type_a' => $row['M'],
            'type_b' => $row['N'],
            'type_c' => $row['O'],
            'type_d' => $row['P'],
            'type_soho' => $row['Q'],
            'hp_all' => $row['R'],
            'hp_map' => $row['S'],
            'color' => $row['T'],
            'metode_pembangunan' => $row['U'],
            'kendaraan_penghuni' => $row['V'],
            'akses_penjualan' => $row['W'],
            'kompetitor' => $row['X'],
            'provider' => $row['Y'],
            'biaya_langganan' => $row['Z'],
            'nama_surveyor' => $row['AA'],
            'no_hp' => $row['AB'],
            'jenis_properti' => $row['AC'],
            'bod_number' => $row['AD'],
            'mitra_partnership' => $row['AE'],
            'uniq_combi' => $row['AF'],
          ));
        }
        $numrows++;
      }

      // print_r($data);

      $this->import->insert_multiple($data);
      $this->session->set_flashdata('message', '
        <div class="alert alert-success">
          <span>Inserted!</span>
        </div>
        ');
      redirect('admin/row_data');
    } else {
      print_r($upload);
      $this->session->set_flashdata('message', '
        <div class="alert alert-danger">
          <span>ERROR!</span>
        </div>
        ');
      redirect('admin/row_data');
    }
  }

  public function import_delete_progress()
  {
    $upload = $this->import->upload_file($this->filename);
    if ($upload['result'] == "success") {
      include APPPATH . 'third_party/PHPExcel.php';
      $excelreader = new PHPExcel_Reader_Excel2007();
      $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
      $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $numrows = 1;
      foreach ($sheet as $row) {
        if ($numrows > 1) {
          $this->db->delete('summary', ['id_report' => $row['A']]);
        }
        $numrows++;
      }

      $this->session->set_flashdata('message', '
        <div class="alert alert-success">
          <span>Deleted!</span>
        </div>
        ');
      redirect('admin/row_data');
    }
  }

  public function import_up_to_date_progress()
  {
    $upload = $this->import->upload_file($this->filename);
    if ($upload['result'] == "success") {
      include APPPATH . 'third_party/PHPExcel.php';
      $excelreader = new PHPExcel_Reader_Excel2007();
      $loadexcel = $excelreader->load('assets/excel/' . $this->filename . '.xlsx');
      $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

      $numrows = 1;
      foreach ($sheet as $row) {
        if ($numrows > 1) {
          $data = array(
            'timestamp' => $row['B'],
            'tanggal_survey' => $row['C'],
            'area_id' => $row['D'],
            'map_id' => $row['E'],
            'region' => $row['F'],
            'kota' => $row['G'],
            'kecamatan' => $row['H'],
            'kelurahan' => $row['I'],
            'kompleks' => $row['J'],
            'owner_type' => $row['K'],
            'rw' => $row['L'],
            'type_a' => $row['M'],
            'type_b' => $row['N'],
            'type_c' => $row['O'],
            'type_d' => $row['P'],
            'type_soho' => $row['Q'],
            'hp_all' => $row['R'],
            'hp_map' => $row['S'],
            'color' => $row['T'],
            'metode_pembangunan' => $row['U'],
            'kendaraan_penghuni' => $row['V'],
            'akses_penjualan' => $row['W'],
            'kompetitor' => $row['X'],
            'provider' => $row['Y'],
            'biaya_langganan' => $row['Z'],
            'nama_surveyor' => $row['AA'],
            'no_hp' => $row['AB'],
            'jenis_properti' => $row['AC'],
            'bod_number' => $row['AD'],
            'mitra_partnership' => $row['AE'],
            'uniq_combi' => $row['AF'],
          );

          $this->db->where('id_report', $row['A']);
          $this->db->update('summary', $data);
        }
        $numrows++;
      }

      $this->session->set_flashdata('message', '
        <div class="alert alert-success">
          <span>Updated!</span>
        </div>
        ');
      redirect('admin/row_data');
    } else {
      print_r($upload);
      $this->session->set_flashdata('message', '
        <div class="alert alert-danger">
          <span>ERROR!</span>
        </div>
        ');
      redirect('admin/row_data');
    }
  }

  public function row_data()
  {
    $data['title'] = "Row Data";
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('app/templates/header', $data);
    $this->load->view('app/templates/sidebar', $data);
    $this->load->view('app/templates/navbar', $data);
    $this->load->view('app/leader/row_data', $data);
    $this->load->view('app/templates/footer', $data);
  }
}

/* End of file Admin.php */
