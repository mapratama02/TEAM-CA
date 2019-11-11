<div class="container-fluid">
  <h3><?= $title ?></h3>

  <button onclick="window.location.reload()" class="btn btn-light border my-3 shadow rounded-0">Reload</button>

  <div class="card">
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-9">
          <div class="form-group">
            <?php foreach ($color as $clr) : ?>
              <div class="form-check-inline">
                <label>
                  <input type="checkbox" name="color" value="<?= $clr->color ?>" id="">
                  <?= $clr->color ?>
                </label>
              </div>
            <?php endforeach ?>
            <div class="form-group">
              <button id="filter" class="btn btn-primary">Filter Data</button>
              <div id="export" class="mt-3"></div>
            </div>
          </div>
        </div>
      </div>

      <table id="table_summary_color" class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>ID</th>
            <th>TimeStamp</th>
            <th>Tanggal Survey</th>
            <th>Region</th>
            <th>Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Kompleks</th>
            <th>Owner Type</th>
            <th>RW</th>
            <th>Jenis Properti</th>
            <th>Tipe A</th>
            <th>Tipe B</th>
            <th>Tipe C</th>
            <th>Tipe D</th>
            <th>Tipe SOHO</th>
            <th>HP All</th>
            <th>HP MAP</th>
            <th>Color</th>
            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) : ?>
              <th>Action</th>
              <th></th>
            <?php endif ?>
            <th>Attachment</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <!-- <div id="summary_result"></div> -->
    </div>
  </div>
</div>