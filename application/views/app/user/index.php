<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-900">User</h1>
  </div>

  <div class="row mt-5 justify-content-center">
    <div class="col-md-8">
      <div class="card" style="">
        <div class="row">
          <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img" alt="">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title text-primary"><?= $user['name'] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted mb-4"><?= $user['email'] ?></h6>
              <a href="<?= base_url('user/edit') ?>" class="card-link btn btn-outline-dark rounded-0">Edit Profile</a>
              <a href="<?= base_url('user/change_password') ?>" class="card-link btn btn-outline-dark rounded-0">Change Password</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>