<div class="container-fluid">

  <div class="row justify-content-center">
    <div class="col-md-12">
      <form action="<?= base_url('staff/survey') ?>" enctype="multipart/form-data" class="mt-5" method="post">
        <div class="card rounded-0 mb-4">
          <div class="card-body p-5">

            <div class="d-block text-center">
              <img src="https://www.mncplay.id/wp-content/uploads/2013/10/COLOR_Logo-MNC-Play-Mendatar.png" width="200" alt="">
              <hr>
              <h3 class="text-center font-weight-normal">Informasi Survey Area</h3>
            </div>

          </div>
        </div>

        <div class="row">

          <div class="col-md-12">
            <div class="pane" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="card rounded-0 mb-5">
                <div class="card-header">INFORMASI KABUPATEN/KOTA</div>
                <div class="card-body p-5">
                  <div class="form-group">
                    <label for="" class="h6">Tanggal Survey Area</label>
                    <input type="date" name="tanggal_survey" value="<?= set_value('tanggal_survey') ?>" id="" class="form-control">

                    <?= form_error('tanggal_survey', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="region" class="h6">Region</label>
                      <select name="region" id="region" class="form-control">
                        <option value="0">--SELECT--</option>
                        <?php foreach ($region->result() as $reg) : ?>
                          <option value="<?= $reg->id . '.' . $reg->name ?>"><?= $reg->name ?></option>
                        <?php endforeach ?>
                      </select>
                      <?= form_error('region', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="col-md-6">
                      <label for="kota" class="h6">Kabupaten/Kota</label>
                      <select name="kota" id="kota" class="form-control">
                      </select>
                      <?= form_error('kota', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label for="kecamatan" class="h6">Kecamatan</label>
                      <select name="kecamatan" id="kecamatan" class="form-control">
                      </select>
                      <?= form_error('kecamatan', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="col-md-6">
                      <label for="kelurahan" class="h6">Kelurahan</label>
                      <select name="kelurahan" id="kelurahan" class="form-control">
                      </select>
                      <?= form_error('kelurahan', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="" class="h6">Nama Kompleks/ Cluster</label>
                      <input type="text" name="kompleks" id="" class="form-control">
                      <?= form_error('kompleks', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="col-md-4">
                      <label for="" class="h6">Owner Type</label>
                      <select name="owner_type" id="" class="form-control">
                        <option value="RW">RW</option>
                        <option value="Dev">Dev</option>
                        <option value="Dusun">Dusun</option>
                      </select>
                    </div>

                    <div class="col-md-4">
                      <label for="" class="h6">RW/Developer</label>
                      <input type="text" name="rw" id="" class="form-control">
                      <?= form_error('rw', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="clearfix">
                    <button id="home-next" type="button" class="btn btn-primary profile-next float-right">NEXT</button>
                  </div>

                </div>
              </div>
            </div>
            <div class="pane d-none" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="card rounded-0 mb-5">
                <div class="card-header">INFORMASI DETAIL SURVEY AREA</div>
                <div class="card-body p-5">
                  <div class="form-group">
                    <label for="" class="h6">Jenis Properti Area</label>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="prop[]" <?= set_checkbox('prop[]', 'Rumah Tinggal/Open Area') ?> value="Rumah Tinggal/Open Area" class="custom-control-input" id="prop-1">
                      <label class="custom-control-label" for="prop-1">Rumah Tinggal/Open Area</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="prop[]" <?= set_checkbox('prop[]', 'Rumah Tinggal/Kompleks/Cluster') ?> value="Rumah Tinggal/Kompleks/Cluster" class="custom-control-input" id="prop-2">
                      <label class="custom-control-label" for="prop-2">Rumah Tinggal/Kompleks/Cluster</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="prop[]" <?= set_checkbox('prop[]', 'Ruko/Rukan') ?> value="Ruko/Rukan" class="custom-control-input" id="prop-3">
                      <label class="custom-control-label" for="prop-3">Ruko/Rukan</label>
                    </div>
                    <?= form_error('prop[]', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="" class="h6">Klasifikasi Tipe Rumah</label>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="A" name="klasifikasi[]" <?= set_checkbox('klasifikasi[]', 'A') ?> id="klari-a" class="custom-control-input">
                        <label for="klari-a" class="custom-control-label">A</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="B" name="klasifikasi[]" <?= set_checkbox('klasifikasi[]', 'B') ?> id="klari-b" class="custom-control-input">
                        <label for="klari-b" class="custom-control-label">B</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="C" name="klasifikasi[]" <?= set_checkbox('klasifikasi[]', 'C') ?> id="klari-c" class="custom-control-input">
                        <label for="klari-c" class="custom-control-label">C</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="D" name="klasifikasi[]" <?= set_checkbox('klasifikasi[]', 'D') ?> id="klari-d" class="custom-control-input">
                        <label for="klari-d" class="custom-control-label">D</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" value="SOHO" name="klasifikasi[]" <?= set_checkbox('klasifikasi[]', 'SOHO') ?> id="klari-soho" class="custom-control-input">
                        <label for="klari-soho" class="custom-control-label">SOHO</label>
                      </div>
                      <?= form_error('klasifikasi[]', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="form-group" id="input-klari">
                    <label for="" class="h6">Data Homepass Berdasarkan Tipe Rumah</label>
                    <div class="input-group input-group-sm mb-3" id="input-a">
                      <div class="input-group-prepend">
                        <span class="input-group-text">A <input type="hidden" name="abjad_klari[]" value="A"></span>
                      </div>
                      <input type="number" id="inp-a" min="0" class="form-control" name="input_klari[]" value="0">
                    </div>

                    <div class="input-group input-group-sm mb-3" id="input-b">
                      <div class="input-group-prepend">
                        <span class="input-group-text">B <input type="hidden" name="abjad_klari[]" value="B"></span>
                      </div>
                      <input type="number" id="inp-b" min="0" class="form-control" name="input_klari[]" value="0">
                    </div>

                    <div class="input-group input-group-sm mb-3" id="input-c">
                      <div class="input-group-prepend">
                        <span class="input-group-text">C <input type="hidden" name="abjad_klari[]" value="C"></span>
                      </div>
                      <input type="number" id="inp-c" min="0" class="form-control" name="input_klari[]" value="0">
                    </div>

                    <div class="input-group input-group-sm mb-3" id="input-d">
                      <div class="input-group-prepend">
                        <span class="input-group-text">D <input type="hidden" name="abjad_klari[]" value="D"></span>
                      </div>
                      <input type="number" id="inp-d" min="0" class="form-control" name="input_klari[]" value="0">
                    </div>

                    <div class="input-group input-group-sm mb-3" id="input-soho">
                      <div class="input-group-prepend">
                        <span class="input-group-text">SOHO <input type="hidden" name="abjad_klari[]" value="SOHO"></span>
                      </div>
                      <input type="number" id="inp-soho" min="0" class="form-control" name="input_klari[]" value="0">
                    </div>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6">Potensi <small id="result-potensi-label"></small></label>
                    <input type="text" name="tingkat_potensial" readonly class="form-control" id="result-potensi">
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-success potensi-range potensi" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small id="result-potensi-label"></small>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6">Mayoritas Penghuni Memiliki?</label>
                    <div class="custom-control custom-radio">
                      <input type="radio" <?= set_radio('kepemilikan_penghuni', 'Mobil dan Motor') ?> value="Mobil dan Motor" name="kepemilikan_penghuni" id="mobil" class="custom-control-input">
                      <label for="mobil" class="custom-control-label">Mobil dan Motor</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" <?= set_radio('kepemilikan_penghuni', 'Motor') ?> value="Motor" name="kepemilikan_penghuni" id="motor" class="custom-control-input">
                      <label for="motor" class="custom-control-label">Motor</label>
                    </div>
                    <?= form_error('kepemilikan_penghuni', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6">Metode Pembangunan</label>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Kabel Udara" <?= set_checkbox('metode_pem[]', 'Kabel Udara') ?> name="metode_pem[]" id="kabel-udara" class="custom-control-input">
                      <label for="kabel-udara" class="custom-control-label">Kabel Udara</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Underground" <?= set_checkbox('metode_pem[]', 'Underground') ?> name="metode_pem[]" id="underground" class="custom-control-input">
                      <label for="underground" class="custom-control-label">Underground</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Sewer/Got" <?= set_checkbox('metode_pem[]', 'Sewer/Got') ?> name="metode_pem[]" id="sewer-got" class="custom-control-input">
                      <label for="sewer-got" class="custom-control-label">Sewer/Got</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Sewer" <?= set_checkbox('metode_pem[]', 'Sewer') ?> name="metode_pem[]" id="sewer" class="custom-control-input">
                      <label for="sewer" class="custom-control-label">Sewer</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Aerial" <?= set_checkbox('metode_pem[]', 'Aerial') ?> name="metode_pem[]" id="aerial" class="custom-control-input">
                      <label for="aerial" class="custom-control-label">Aerial</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Aerial dan Underground" <?= set_checkbox('metode_pem[]', 'Aerial dan Underground') ?> name="metode_pem[]" id="aerial-dan-underground" class="custom-control-input">
                      <label for="aerial-dan-underground" class="custom-control-label">Aerial dan Underground</label>
                    </div>
                    <small>Tidak ada dalam list? <button type="button" id="metode_pem" class="btn-link badge btn">Tambah data</button></small>
                    <div id="metode_pem_add">

                    </div>
                    <?= form_error('metode_pem[]', '<small class="text-danger">', '</small>') ?>
                  </div>

                  <div class="form-group">
                    <label for="" class="h6">Akses Untuk Melakukan Penjualan?</label>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Direct Mail" name="akses[]" id="direct-mail" class="custom-control-input">
                      <label for="direct-mail" class="custom-control-label">Direct Mail</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Open Booth" name="akses[]" id="open-booth" class="custom-control-input">
                      <label for="open-booth" class="custom-control-label">Open Booth</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Branding Car" name="akses[]" id="branding-car" class="custom-control-input">
                      <label for="branding-car" class="custom-control-label">Branding Car</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" value="Door to Door" name="akses[]" id="door-to-door" class="custom-control-input">
                      <label for="door-to-door" class="custom-control-label">Door to Door</label>
                    </div>
                    <small>Tidak ada dalam list? <button type="button" id="akses" class="btn-link badge btn">Tambah data</button></small>
                    <div id="akses_add">

                    </div>
                    <?= form_error('akses[]', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6">Kompetitor Yang Sudah Ada di Area Tersebut?</label>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="kompetitor[]" value="First Media" id="first-media" class="custom-control-input">
                      <label for="first-media" class="custom-control-label">First Media</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="kompetitor[]" value="Indihome" id="indihome" class="custom-control-input">
                      <label for="indihome" class="custom-control-label">Indihome</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="kompetitor[]" value="Biznet" id="biznet" class="custom-control-input">
                      <label for="biznet" class="custom-control-label">Biznet</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="kompetitor[]" value="MyRepublic" id="myrepublic" class="custom-control-input">
                      <label for="myrepublic" class="custom-control-label">MyRepublic</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="kompetitor[]" value="Indosat GIG" id="indosat-gig" class="custom-control-input">
                      <label for="indosat-gig" class="custom-control-label">Indosat GIG</label>
                    </div>
                    <small>Tidak ada dalam list? <button type="button" id="kompetitor" class="btn-link badge btn">Tambah data</button></small>
                    <div id="kompetitor_add">

                    </div>
                    <?= form_error('kompetitor[]', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6"><span style="text-transform: capitalize">Mayoritas Penghuni Menggunakan Provider DTH?</span></label>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="provider[]" value="Indovision/Oke/TOP TV" id="indovision" class="custom-control-input">
                      <label for="indovision" class="custom-control-label">Indovision/Oke/TOP TV</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="provider[]" value="Transvision" id="transvision" class="custom-control-input">
                      <label for="transvision" class="custom-control-label">Transvision</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="provider[]" value="Orange TV" id="orangetv" class="custom-control-input">
                      <label for="orangetv" class="custom-control-label">Orange TV</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="provider[]" value="Topas TV" id="topas" class="custom-control-input">
                      <label for="topas" class="custom-control-label">Topas TV</label>
                    </div>
                    <small>Tidak ada dalam list? <button type="button" id="provider" class="btn-link badge btn">Tambah data</button></small>
                    <div id="provider_add">

                    </div>
                    <?= form_error('provider[]', '<small class="text-danger">', '</small>') ?>
                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="" class="h6">Berapa Rata-Rata Biaya Langganan Internet/PayTV Warga setempat?</label>
                    <input type="range" name="biaya" id="biaya" step="25000" min="100000" max="3000000" value="100000" class="form-control-range">
                    <label for="" id="display-biaya">Biaya: Rp100.000</label>
                  </div>

                  <div class="clearfix">
                    <button id="home-prev" type="button" class="btn btn-primary profile-next float-left">PREV</button>
                    <button id="profile-next" type="button" class="btn btn-primary profile-next float-right">NEXT</button>
                  </div>

                </div>
              </div>
            </div>
            <div class="pane d-none" id="messages" role="tabpanel" aria-labelledby="messages-tab">
              <div class="card rounded-0 mb-5">
                <div class="card-header">IDENTITAS SURVEYOR</div>
                <div class="card-body p-5">

                  <div class="form-group">
                    <label for="" class="h6">Nama Surveyor</label>
                    <input type="text" name="surveyor" value="<?= $user['name'] ?>" id="" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="" class="h6">Nomor Telepon</label>
                    <input type="tel" name="telepon" class="form-control" id="">
                    <?= form_error('telepon', '<small class="text-danger">', '</small>') ?>
                  </div>

                  <div class="form-group">
                    <label for="" class="h6">Atachment File Map</label>
                    <input type="file" name="attachment" class="form-control-file" accept="image/*, .kml" id="">
                  </div>

                  <button type="submit" class="btn btn-outline-success btn-block" style="border-radius: 100px">Submit <i class="fab fa-telegram-plane"></i></button>
                  <div class="alert alert-warning mt-3">
                    <h2 class="alert-heading">Attention!</h2>
                    <div class="media mt-3">
                      <i class="fas mr-3 align-self-start fa-2x fa-fw fa-exclamation-triangle"></i>
                      <div class="media-body">
                        <p class="m-0"> Pastikan kembali tidak ada data yang kosong! Jika ada data yang kosong, maka anda harus mengisi ulang form ini.</p>
                      </div>
                    </div>

                  </div>

                  <div class="clearfix">
                    <button id="profile-prev" type="button" class="btn btn-primary profile-next float-left">PREV</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </form>
    </div>
  </div>

</div>