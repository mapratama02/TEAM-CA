<div class="container-fluid">
  <h1 class="h3 text-gray-900"><?= $title ?></h1>

  <div class="row mt-5 justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('programmer/import_progress') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input type="file" name="file" id="" accept=".xls" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-success btn-block">Submit</button>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>