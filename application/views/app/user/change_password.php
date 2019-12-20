<div class="container-fluid">
  <h3><?= $title ?></h3>

  <div class="card">
    <div class="card-body">

      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger">
          <?= validation_errors('<p class="my-2">', '</p>') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('user/change_password') ?>" method="post">
        <div class="form-group row">
          <label for="" class="col-form-label col-sm-3">Old Password</label>
          <div class="col-sm-9">
            <input type="password" name="old_password" id="old_password" class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-form-label col-sm-3">New Password</label>
          <div class="col-sm-9">
            <input type="password" name="new_password" id="new_password" class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <label for="" class="col-form-label col-sm-3">Retype Password</label>
          <div class="col-sm-9">
            <input type="password" name="retype_password" id="retype_password" class="form-control">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-9 offset-sm-3">
            <button type="submit" class="btn btn-outline-primary btn-block">Submit</button>
          </div>
        </div>
      </form>

    </div>
  </div>