<div class="container-fluid">
  <h3><?= $title ?></h3>

  <button onclick="window.location.reload()" class="btn btn-light border my-3 shadow rounded-0">Reload</button>

  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card border-left-primary">
        <div class="card-body">
          <?= $this->session->flashdata('msg') ?>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>Region</label>
                <select name="region" id="region" class="form-control">
                  <option value="">--Pilih Region--</option>
                  <?php foreach ($region as $reg) : ?>
                    <option value="<?= $reg->region ?>"><?= $reg->region ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="col-md">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <select name="kota" id="kota" class="form-control"></select>
              </div>
            </div>

            <div class="col-md">
              <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control"></select>
              </div>
            </div>

            <div class="col-md">
              <div class="form-group">
                <label>Kelurahan</label>
                <select name="kelurahan" id="kelurahan" class="form-control"></select>
              </div>
            </div>

          </div>
          <div class="form-group">
            <button id="summary_search" type="button" class="btn btn-primary">Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div id="export" class="mb-3"></div>
      <table id="table_summary" class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>ID</th>
            <th>Map ID</th>
            <th>Tanggal Survey</th>
            <th>Region</th>
            <th>Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Kompleks</th>
            <th>Owner Type</th>
            <th>RW</th>
            <th>Tipe A</th>
            <th>Tipe B</th>
            <th>Tipe C</th>
            <th>Tipe D</th>
            <th>Tipe SOHO</th>
            <th>HP All</th>
            <th>HP MAP</th>
            <th>Color</th>
            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) : ?>
              <th>Action</th>
              <th></th>
            <?php endif ?>
            <th>Attachment</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="summary_result"></div>
    </div>
  </div>
</div>