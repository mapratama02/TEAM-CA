<div class="container-fluid">
  <div class="card card-primary">

    <div class="card-body">

      <form action="<?= base_url('leader/summary_edit/') . $survey->id_report ?>" method="post" class="form-horizontal">

        <fieldset style="margin-bottom: 50px;">
          <legend>INFORMASI KABUPATEN/KOTA</legend>

          <div class="form-group row">
            <label class="col-form-label col-md-2">AREA ID</label>
            <div class="col-md-10">
              <input type="text" name="area_id" id="" value="<?= $survey->area_id ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">MAP ID</label>
            <div class="col-md-10">
              <input type="text" name="map_id" id="" value="<?= $survey->map_id ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Region</label>
            <div class="col-md-10">
              <input type="text" name="region" id="" value="<?= $survey->region ?>" readonly class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Regency</label>
            <div class="col-md-10">
              <input type="text" name="kota" id="" value="<?= $survey->kota ?>" readonly class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">District</label>
            <div class="col-md-10">
              <input type="text" name="kecamatan" id="" value="<?= $survey->kecamatan ?>" readonly class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Village</label>
            <div class="col-md-10">
              <input type="text" name="kelurahan" id="" value="<?= $survey->kelurahan ?>" readonly class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Cluster/Komplek</label>
            <div class="col-md-10">
              <input type="text" name="kompleks" id="" value="<?= $survey->kompleks ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Owner Type</label>
            <div class="col-md-10">
              <select name="owner_type" id="" class="form-control">
                <?php foreach ($owner_type as $ot) : ?>
                  <?php if ($ot == $survey->owner_type) : ?>
                    <option value="<?= $ot ?>" selected><?= $ot ?></option>
                  <?php else : ?>
                    <option value="<?= $ot ?>"><?= $ot ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">RW / Developer</label>
            <div class="col-md-10">
              <input type="text" name="rw" id="" value="<?= $survey->rw ?>" class="form-control">
            </div>
          </div>

        </fieldset>

        <fieldset style="margin-bottom: 50px;">
          <legend>DETAIL SURVEY AREA</legend>

          <?php
          $props = explode(', ', $survey->jenis_properti);
          $tipes = explode(', ', $survey->tipe_rumah);
          // $homepasss = explode('-', $survey->homepass);
          $metode_pems = explode(', ', $survey->metode_pembangunan);
          $access = explode('/', $survey->akses_penjualan);
          $komp = explode(', ', $survey->kompetitor);
          $provide = explode(', ', $survey->provider);
          // $home_a = explode('A', $homepasss[0]);
          // $home_b = explode('B', $homepasss[1]);
          // $home_c = explode('C', $homepasss[2]);
          // $home_d = explode('D', $homepasss[3]);
          // $home_soho = explode('SOHO', $homepasss[4]);
          $home_a = $survey->type_a;
          $home_b = $survey->type_b;
          $home_c = $survey->type_c;
          $home_d = $survey->type_d;
          $home_soho = $survey->type_soho;
          ?>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Jenis Properti Area</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($prop as $p) : ?>
                  <div class="checkbox">
                    <?php if (in_array($p, $props)) : ?>
                      <label>
                        <input type="checkbox" checked name="prop[]" value="<?= $p ?>" id="">
                        <?= $p ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="prop[]" value="<?= $p ?>" id="">
                        <?= $p ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <!-- <div class="form-group row">
            <label class="col-form-label col-md-2">
              Klasifikasi Tipe Rumah
            </label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($tipe_rumah as $tr => $key) : ?>
                  <div class="checkbox">
                    <?php if (in_array($tr, $tipes)) : ?>
                      <label>
                        <input type="checkbox" checked name="klasifikasi[]" value="<?= $tr ?>" id="klari-<?= $key ?>">
                        <?= $tr ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="klasifikasi[]" value="<?= $tr ?>" id="klari-<?= $key ?>">
                        <?= $tr ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div> -->

          <div class="form-group row">

            <label class="col-form-label col-md-2">
              Data Homepass
            </label>

            <div class="col-md-10">

              <div class="input-group mb-3" id="input-a">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">A <input type="hidden" name="abjad_klari[]" value="A"></span>
                </div>
                <input type="number" id="inp-a" min="0" class="form-control" name="input_klari[]" value="<?= $home_a ?>">
              </div>

              <div class="input-group mb-3" id="input-b">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">B <input type="hidden" name="abjad_klari[]" value="B"></span>
                </div>
                <input type="number" id="inp-b" min="0" class="form-control" name="input_klari[]" value="<?= $home_b ?>">
              </div>


              <div class="input-group mb-3" id="input-c">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">C <input type="hidden" name="abjad_klari[]" value="C"></span>
                </div>
                <input type="number" id="inp-c" min="0" class="form-control" name="input_klari[]" value="<?= $home_c ?>">
              </div>


              <div class="input-group mb-3" id="input-d">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">D <input type="hidden" name="abjad_klari[]" value="D"></span>
                </div>
                <input type="number" id="inp-d" min="0" class="form-control" name="input_klari[]" value="<?= $home_d ?>">
              </div>


              <div class="input-group mb-3" id="input-soho">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">SOHO <input type="hidden" name="abjad_klari[]" value="SOHO"></span>
                </div>
                <input type="number" id="inp-soho" min="0" class="form-control" name="input_klari[]" value="<?= $home_soho ?>">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Color <small id="result-potensi-label"></small></label>
            <div class="col-md-10">
              <div class="">
                <input type="text" name="tingkat_potensial" readonly class="form-control" id="result-potensi">
                <!-- <div class="potensi-range rounded mt-4" style="height: 5px; width: 100%"></div> -->
                <div class="progress" style="margin-top: 1rem">
                  <div class="progress-bar progress-bar-striped bg-success potensi-range potensi" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small id="result-potensi-label"></small>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">HP MAP</label>
            <div class="col-md-10">
              <input type="text" name="hp_map" id="" value="<?= $survey->hp_map ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Mayoritas Penghuni Memiliki?</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($kepemilikan_penghuni as $kp) : ?>
                  <div class="radio">
                    <?php if ($survey->kendaraan_penghuni == $kp) : ?>
                      <label>
                        <input type="radio" name="kepemilikan_penghuni" checked value="<?= $kp ?>" id="">
                        <?= $kp ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="radio" name="kepemilikan_penghuni" value="<?= $kp ?>" id="">
                        <?= $kp ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Metode Pembangunan</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($metode_pembangunan as $mp) : ?>
                  <div class="checkbox">
                    <?php if (in_array($mp, $metode_pems)) : ?>
                      <label>
                        <input type="checkbox" checked name="metode_pem[]" value="<?= $mp ?>" id="">
                        <?= $mp ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="metode_pem[]" value="<?= $mp ?>" id="">
                        <?= $mp ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Akses Penjualan</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($akses_penjualan as $ap) : ?>
                  <div class="checkbox">
                    <?php if (in_array($ap, $access)) : ?>
                      <label>
                        <input type="checkbox" checked name="akses[]" value="<?= $ap ?>" id="">
                        <?= $ap ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="akses[]" value="<?= $ap ?>" id="">
                        <?= $ap ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Kompetitor Yang Sudah Ada di Area Tersebut?</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($kompetitor as $kom) : ?>
                  <div class="checkbox">
                    <?php if (in_array($kom, $komp)) : ?>
                      <label>
                        <input type="checkbox" checked name="kompetitor[]" value="<?= $kom ?>" id="">
                        <?= $kom ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="kompetitor[]" value="<?= $kom ?>" id="">
                        <?= $kom ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Mayoritas Penghuni Menggunakan Provider DTH?</label>
            <div class="col-md-10">
              <div class="form-group">
                <?php foreach ($provider as $pro) : ?>
                  <div class="checkbox">
                    <?php if (in_array($pro, $provide)) : ?>
                      <label>
                        <input type="checkbox" checked name="provider[]" value="<?= $pro ?>" id="">
                        <?= $pro ?>
                      </label>
                    <?php else : ?>
                      <label>
                        <input type="checkbox" name="provider[]" value="<?= $pro ?>" id="">
                        <?= $pro ?>
                      </label>
                    <?php endif ?>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Berapa Rata-Rata Biaya Langganan Internet/PayTV Warga setempat?</label>
            <!-- <input type="number" name="biaya" id="" placeholder="contoh: 500000" class="form-control"> -->
            <div class="col-md-10">
              <input type="range" name="biaya" id="biaya" step="25000" min="100000" max="3000000" value="<?= $survey->biaya_langganan ?>" class="form-control-range">
              <label for="" id="display-biaya">Biaya: Rp100.000</label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">BOD Number</label>
            <div class="col-md-10">
              <input type="text" name="bod_number" id="" value="<?= $survey->bod_number ?>" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-2">Mitra Partnership</label>
            <div class="col-md-10">
              <input type="text" name="mitra_partnership" id="" value="<?= $survey->mitra_partnership ?>" class="form-control">
            </div>
          </div>

        </fieldset>

        <div class="form-group row">
          <div class="col-md-2"></div>
          <div class="col-md-10"><button type="submit" class="btn btn-block btn-primary">Submit</button></div>
        </div>

      </form>

    </div>
  </div>
</div>