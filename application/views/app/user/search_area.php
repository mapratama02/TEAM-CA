<div class="container-fluid">
  <h3 class="text-gray-800"><?= $title ?></h3>
  <hr>

  <div class="row">
    <div class="col-md-12">
      <button onclick="window.location.reload()" class="btn btn-light border my-3 rounded-0">Reload</button>

      <div class="card border-left-info">
        <div class="card-body">

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

            <div class="col-md">
              <div class="form-group">
                <label>RW</label>
                <input type="text" name="rw" id="rw" class="form-control">
              </div>
            </div>
          </div>

          <button id="search" class="btn mt-3 btn-primary">Search</button>

        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <table class="table w-100" id="table_search">
            <thead>
              <tr>
                <th>ID Report</th>
                <th>Area ID</th>
                <th>MAP ID</th>
                <th>Region</th>
                <th>Kota</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>RW</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>