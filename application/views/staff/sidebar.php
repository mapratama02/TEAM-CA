<?php
$sidebar = array(
  array(
    'title' => "Dashboard",
    'icon'  => "fa fa-fw fa-fire",
    'link'  => "staff/index"
  ),

  array(
    'title' => "Form Survey",
    'icon'  => "fab fa-fw fa-wpforms",
    'link'  => "staff/form"
  ),
)
?>

<ul class="navbar-nav sidebar sidebar-dark bg-dark accordion" style="" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
    <div class="sidebar-brand-icon">
      <!-- <img src="http://mncplaysurabaya99.id.tc/wp-content/uploads/sites/447/2016/03/MNC_Playmedia-home.png" height="35" alt=""> -->
    </div>
    <div class="sidebar-brand-text mx-3">STAFF TEAM</div>
  </a>

  <?php foreach ($sidebar as $item) :
    $link = explode('/', $item['link']);
    ?>
    <?php if ($this->uri->segment(2) == $link[1]) : ?>
      <li class="nav-item active">
        <a href="<?= base_url($item['link']) ?>" class="nav-link py-2"><i class="<?= $item['icon'] ?>"></i> <?= $item['title'] ?></a>
      </li>
    <?php else : ?>
      <li class="nav-item">
        <a href="<?= base_url($item['link']) ?>" class="nav-link py-2"><i class="<?= $item['icon'] ?>"></i> <?= $item['title'] ?></a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>

  <div class="text-center d-none mt-3 d-md-inline">
    <button class="rounded-circle border-0 shadow" id="sidebarToggle"></button>
  </div>

</ul>

<div id="content-wrapper" class="d-flex flex-column">

  <div id="content">