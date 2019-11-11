<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark bg-primary accordion" style="" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
    <div class="sidebar-brand-icon">
      <img src="http://mncplaysurabaya99.id.tc/wp-content/uploads/sites/447/2016/03/MNC_Playmedia-home.png" height="35" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">TEAM CA</div>
  </a>

  <?php
  $role_id = $this->session->userdata('role');
  $query_menu =   "SELECT `user_menu`.`id`, `menu`
                   FROM `user_menu` JOIN `user_access_menu`
                   ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                   WHERE `user_access_menu`.`role_id` = '$role_id'
                   ORDER BY `user_access_menu`.`menu_id` ASC";
  $menu = $this->db->query($query_menu)->result_array();
  ?>

  <?php foreach ($menu as $m) : ?>
    <!-- <div class="sidebar-heading">
      <?= $m['menu'] ?>
    </div> -->

    <?php
      $menu_id = $m['id'];
      $query_sub_menu =   "SELECT * FROM `user_sub_menu`
                         WHERE `menu_id` = '$menu_id'
                         AND `is_active` = 1";
      $sub_menu = $this->db->query($query_sub_menu)->result_array();
      ?>

    <?php foreach ($sub_menu as $sm) : ?>
      <?php if ($title == $sm['title']) : ?>
        <li class="nav-item active">
        <?php else : ?>
        <li class="nav-item">
        <?php endif ?>
        <a class="nav-link py-2" href="<?= base_url($sm['url']) ?>">
          <i class="<?= $sm['icon'] ?>"></i>
          <span><?= $sm['title'] ?></span></a>
        </li>
      <?php endforeach ?>
      <hr class="sidebar-divider my-2">

    <?php endforeach ?>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider my-2"> -->
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<div id="content-wrapper" class="d-flex flex-column">

  <div id="content">