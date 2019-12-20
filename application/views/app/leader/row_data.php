<div class="container-fluid">
  <h3 class="text-gray-800"><?= $title ?></h3>

  <div class="row mt-5 justify-content-center">
    <div class="col-md-8">

      <?= $this->session->flashdata('message') ?>

      <div class="card shadow">
        <div class="card-header">
          <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Insert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">Delete</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <form action="<?= base_url('admin/import_upload_progress') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" name="file" accept=".xlsx" class="form-control-file" id="">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <form action="<?= base_url('admin/import_up_to_date_progress') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" name="file" accept=".xlsx" class="form-control-file" id="">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>
            <div class="tab-pane" id="about" role="tabpanel" aria-labelledby="about-tab">
              <form action="<?= base_url('admin/import_delete_progress') ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" name="file" accept=".xlsx" class="form-control-file" id="">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>