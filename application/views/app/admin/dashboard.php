<?php $nama_surveyor = $user['name'] ?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard <?php if ($this->session->userdata('role') == 3) : ?> &mdash; <?= $nama_surveyor ?> &mdash; Swipe to see different Dashboard <?php endif ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <?php if ($this->session->userdata('role') == 3) : ?>
    <div class="owl-carousel">

      <div class="card">
        <div class="card-body">
        <h4>Personal</h4>
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

          <div class="row mb-4">

            <div class="col-md-12">
              <div class="card h-100 shadow mb-4">
                <div class="card-body">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-personal-tab" data-toggle="tab" href="#nav-home-personal" role="tab" aria-controls="nav-home-personal" aria-selected="true">Regional</a>
                      <a class="nav-item nav-link" id="nav-profile-personal-tab" data-toggle="tab" href="#nav-profile-personal" role="tab" aria-controls="nav-profile-personal" aria-selected="false">Production</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane show active" id="nav-home-personal" role="tabpanel" aria-labelledby="nav-home-personal-tab">
                      <div class="" style="">
                        <div class="row">
                          <?php foreach ($region_personal as $reg) : ?>
                            <div class="col-md-4 my-4">
                              <canvas height="250px" class="" id="data-region-personal-<?= str_replace(" ", "", $reg['region']) ?>"></canvas>
                            </div>
                          <?php endforeach ?>
                        </div>

                      </div>
                    </div>

                    <div class="tab-pane" id="nav-profile-personal" role="tabpanel" aria-labelledby="nav-profile-personal-tab">
                      <div class="chart-area" style="height: 600px">
                        <canvas id="data-production-personal"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 d-none col-lg-5">
              <div class="card h-100 shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">MAP Online</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
        <h4>TEAM</h4>
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

          <div class="row mb-4">

            <div class="col-md-12">
              <div class="card h-100 shadow mb-4">
                <div class="card-body">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Regional</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Production</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <div class="" style="">
                        <div class="row">
                          <?php foreach ($region as $reg) : ?>
                            <div class="col-md-4 my-4">
                              <canvas height="250px" class="" id="dataRegional<?= str_replace(" ", "", $reg['region']) ?>"></canvas>
                            </div>
                          <?php endforeach ?>
                        </div>

                      </div>
                    </div>

                    <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="chart-area" style="height: 600px">
                        <canvas id="dataProduction"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 d-none col-lg-5">
              <div class="card h-100 shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">MAP Online</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="card">
      <div class="card-body">
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

        <div class="row mb-4">

          <div class="col-md-12">
            <div class="card h-100 shadow mb-4">
              <div class="card-body">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Regional</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Production</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="" style="">
                      <div class="row">
                        <?php foreach ($region as $reg) : ?>
                          <div class="col-md-4 my-4">
                            <canvas height="250px" class="" id="dataRegional<?= str_replace(" ", "", $reg['region']) ?>"></canvas>
                          </div>
                        <?php endforeach ?>
                      </div>

                    </div>
                  </div>

                  <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="chart-area" style="height: 600px">
                      <canvas id="dataProduction"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pie Chart -->
          <div class="col-xl-4 d-none col-lg-5">
            <div class="card h-100 shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">MAP Online</h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                  <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

</div>