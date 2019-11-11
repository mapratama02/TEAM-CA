<div class="container-fluid">



  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
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
              <?php $tot_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` = 'BLUE'")->row_array() ?>
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
              <?php $tot_potensial = $this->db->query("SELECT SUM(`hp_all`) AS `homepass_potensial` FROM `summary` WHERE `color` != 'BLUE'")->row_array() ?>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($tot_potensial['homepass_potensial'], 0, ',', '.') ?></div>
            </div>
            <div class="col-auto">
              <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

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
            <!-- <span class="mr-2">
              <i class="fas fa-circle" style="color: black"></i> Black
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: blue"></i> Blue
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: brown"></i> Brown
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: deeppink"></i> DeepPink
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: green"></i> Green
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: olive"></i> Olive
            </span>
            <span class="mr-2">
              <i class="fas fa-circle" style="color: purple"></i> Purple
            </span> -->
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- <div class="card shadow">
    <div class="card-body">

      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="dropdown">
            <button type="button" data-toggle="dropdown" data-target="#hasil-survey" class="btn btn-primary btn-block">SURVEY AREA NASIONAL</button>
            <div class="dropdown-menu" style="min-width: 100%">
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1817793032&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Sumedang Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=610415634&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Batu Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1694783022&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Salatiga Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=418649541&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Magelang Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1979342601&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Mojokerto Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=694522348&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Madiun Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=556855345&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Brebes Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=46317453&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Kendal Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1495962451&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Cirebon Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=146758479&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Karawang Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1869472113&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Bali Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=703459338&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Sleman Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1893034012&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">DIY Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=714291119&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Surakarta Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=700691268&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Sukoharjo Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=1586093114&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Karanganyar Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=484907995&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Kab Gresik Reporting</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=297247004&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">PNL Calculation</span>
              <span data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8wvQB92AGEY5-E77R1ypNnnEyP_2A1SnWh4NJryG469NnzvMqT_n3FwiR-tNzenCuSNh8XpIFO1jp/pubhtml?gid=207519194&amp;single=true&amp;widget=true&amp;headers=false" class="data-frame dropdown-item">Summary</span>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dropdown">
            <button type="button" class="btn btn-primary btn-block" data-toggle="dropdown">SURVEY AREA JABODETABEK</button>
            <div class="dropdown-menu" style="min-width: 100%">
              <span class="dropdown-item data-frame" style="cursor: pointer" data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vTNr57OK1dueYMmtMxjrbesZQI9Gh00gXdHEILOCVm2S0e7Tx2-53s9q7qRtCVBCWPYpZIKvrHGeDq6/pubhtml?gid=1667951128&amp;single=true&amp;widget=true&amp;headers=false">Form Response</span>
              <span class="dropdown-item data-frame" style="cursor: pointer" data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vTNr57OK1dueYMmtMxjrbesZQI9Gh00gXdHEILOCVm2S0e7Tx2-53s9q7qRtCVBCWPYpZIKvrHGeDq6/pubhtml?gid=2101948016&amp;single=true&amp;widget=true&amp;headers=false">Kab Bogor Reporting</span>
              <span class="dropdown-item data-frame" style="cursor: pointer" data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vTNr57OK1dueYMmtMxjrbesZQI9Gh00gXdHEILOCVm2S0e7Tx2-53s9q7qRtCVBCWPYpZIKvrHGeDq6/pubhtml?gid=870064974&amp;single=true&amp;widget=true&amp;headers=false">Kab Tanggerang Reporting</span>
              <span class="dropdown-item data-frame" style="cursor: pointer" data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vTNr57OK1dueYMmtMxjrbesZQI9Gh00gXdHEILOCVm2S0e7Tx2-53s9q7qRtCVBCWPYpZIKvrHGeDq6/pubhtml?gid=1944306401&amp;single=true&amp;widget=true&amp;headers=false">Kab Bekasi Reporting</span>
              <span class="dropdown-item data-frame" style="cursor: pointer" data-frame="https://docs.google.com/spreadsheets/d/e/2PACX-1vTNr57OK1dueYMmtMxjrbesZQI9Gh00gXdHEILOCVm2S0e7Tx2-53s9q7qRtCVBCWPYpZIKvrHGeDq6/pubhtml?gid=1140518535&amp;single=true&amp;widget=true&amp;headers=false">Summary</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div> -->

  <div class="row response d-none">
    <div class="col-md-12">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe src="" id="response" class="embed-responsive-item" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe src="https://kmlviewer.com/" class="embed-responsive-item" allowfullscreen></iframe>
  </div> -->

</div>