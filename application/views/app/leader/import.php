<div class="container-fluid">
  <h1 class="text-gray-900 h3"><?= $title ?></h1>

  <div class="row mt-3 justify-content-center">
    <div class="col-md-8">
      <?= $this->session->flashdata('message') ?>
      <div class="alert alert-warning">
        <p class="m-0">Make sure the extention of the file is <kbd>.csv</kbd></p>
      </div>

      <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update</a>
            </li>
          </ul>
        </div>
        <div class="card-body">

          <div class="tab-content">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <form action="<?= base_url('leader/import_progress') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <input type="file" name="file" accept=".csv" id="" class="form-control-file">
                  <!-- <p class="mt-3 text-info">Make sure the extention of the file is <kbd>.csv</kbd></p> -->
                </div>
                <button type="submit" class="btn btn-success rounded-0">submit</button>
              </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form action="<?= base_url('leader/import_update_progress') ?>" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <input type="file" name="file" accept=".csv" id="" class="form-control-file">
                  <!-- <p class="mt-3 text-info">Make sure the extention of the file is <kbd>.csv</kbd></p> -->
                </div>
                <button type="submit" class="btn btn-success rounded-0">submit</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>