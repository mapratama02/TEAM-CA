<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <div>
      <a href="#" data-toggle="modal" data-target="#uploadKML" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> Upload KML</a>
      <a href="#" data-toggle="modal" data-target="#deleteKML" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Delete KML</a>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-6">

      <?= $this->session->flashdata('message') ?>

      <select name="dir" id="dir" class="form-control">
        <option value="">Select KML File</option>
        <?php for ($i = 2; $i < count($dir); $i++) : ?>
          <option value="<?= $dir[$i] ?>"><?= $dir[$i] ?></option>
        <?php endfor; ?>
      </select>

    </div>
  </div>

  <!-- <div class="embed-responsive d-none embed-responsive-16by9" id="map">
    <iframe src="" allowfullscreen id="map-item" class="embed-responsive-item"></iframe>
  </div> -->

  <div id="display">
    <div id="map"></div>
    <div id="capture"></div>
  </div>

</div>

<div class="modal fade" id="uploadKML" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('leader/progress_upload') ?>" enctype="multipart/form-data" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload KML</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="file" name="upload_kml" accept=".kml" id="" class="form-control-file">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">&cross; Close</button>
          <button type="submit" class="btn btn-success">&check; Submit</button>
        </div>
        <div class="modal-footer d-none text-center modal-footer-child">
          <div class="w-100">
            <p class="text-center">It's gonna take a while...</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteKML" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('leader/progress_delete') ?>" enctype="multipart/form-data" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload KML</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="dir" class="form-control">
              <option value="">Select KML File you want delete</option>
              <?php for ($i = 2; $i < count($dir); $i++) : ?>
                <option value="<?= $dir[$i] ?>"><?= $dir[$i] ?></option>
              <?php endfor; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">&cross; Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure wanna dlete this file? \nThis action can\'t be undo.')">&check; Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>