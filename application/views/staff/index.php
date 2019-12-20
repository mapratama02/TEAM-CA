<?php $nama_surveyor = $user['name'] ?>

<div class="container-fluid">
  <h3 class="text-gray-800"><?= $title ?></h3>

  <div class="card">
    <ul class="nav card-header nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Dashboard &mdash; Personal</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Dashboard &mdash; TEAM</a>
      </li>
    </ul>
    <div class="card-body">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Region</div>
                      <?php $all_region = $this->db->query("SELECT `region` FROM `summary` WHERE `nama_surveyor` = '$nama_surveyor' GROUP BY `region`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_region, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kota</div>
                      <?php $all_kota = $this->db->query("SELECT `kota` FROM `summary` WHERE `nama_surveyor` = '$nama_surveyor' GROUP BY `kota`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kota, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kecamatan</div>
                      <?php $all_kecamatan = $this->db->query("SELECT `kecamatan` FROM `summary` WHERE `nama_surveyor` = '$nama_surveyor' GROUP BY `kecamatan`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kecamatan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kelurahan</div>
                      <?php $all_kelurahan = $this->db->query("SELECT `kelurahan` FROM `summary` WHERE `nama_surveyor` = '$nama_surveyor' GROUP BY `kelurahan`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kelurahan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Homepass Potensial</div>
                      <?php $tot_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` LIKE '%blue%' AND `nama_surveyor` = '$nama_surveyor'")->row_array() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tot_potensial['homepass_potensial'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Homepass Not Potensial</div>
                      <?php $not_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` LIKE '%brown%' AND `nama_surveyor` = '$nama_surveyor'")->row_array() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($not_potensial['homepass_potensial'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <?php foreach ($region_personal as $reg) : ?>

              <div class="col-md-4">
                <canvas id="my-4 regional-personal<?= " ", "", $reg['region'] ?>"></canvas>
              </div>

            <?php endforeach ?>
          </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Region</div>
                      <?php $all_region = $this->db->query("SELECT `region` FROM `summary` GROUP BY `region`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_region, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kota</div>
                      <?php $all_kota = $this->db->query("SELECT `kota` FROM `summary` GROUP BY `kota`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kota, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kecamatan</div>
                      <?php $all_kecamatan = $this->db->query("SELECT `kecamatan` FROM `summary` GROUP BY `kecamatan`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kecamatan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kelurahan</div>
                      <?php $all_kelurahan = $this->db->query("SELECT `kelurahan` FROM `summary` GROUP BY `kelurahan`")->num_rows() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($all_kelurahan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Homepass Potensial</div>
                      <?php $tot_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` LIKE '%blue%'")->row_array() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tot_potensial['homepass_potensial'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Homepass Not Potensial</div>
                      <?php $not_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` LIKE '%brown%'")->row_array() ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($not_potensial['homepass_potensial'], 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                      <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>