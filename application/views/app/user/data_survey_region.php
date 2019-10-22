<div class="container-fluid">
  <h3><?= $title ?></h3>

  <button onclick="window.location.reload()" class="btn btn-light border my-3 shadow rounded-0">Reload</button>

  <div class="row mb-3">
    <div class="col-md-12">
      <div class="card border-left-primary">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
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

            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <select name="kota" id="kota" class="form-control"></select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control"></select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <select name="kelurahan" id="kelurahan" class="form-control"></select>
              </div>
            </div>
          </div>
          <button id="summary_search" disabled type="button" class="btn btn-primary">Search</button>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <table id="table_summary" class="table table-hover table-responsive">
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
            <!-- <th>Kepemilikan Penghuni</th>
                    <th>Metode Pembangunan</th>
                    <th>Akses Penjualan</th>
                    <th>Kompetitor</th>
                    <th>Provider</th>
                    <th>Biaya Langganan</th>
                    <th>Nama Surveyor</th>
                    <th>Nomor HP</th>
                    <th>BOD Number</th>
                    <th>Mitra Partnership</th> -->
            <!-- <th>Rekomendasi Roll-Back</th> -->
            <?php if ($this->session->userdata('role') != 3 && $this->session->userdata('role') != 4) : ?>
              <th colspan="2">Action</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="summary_result"></div>
    </div>
  </div>
</div>