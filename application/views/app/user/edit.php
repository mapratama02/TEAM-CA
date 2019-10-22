<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-900">Edit User</h1>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('user/edit') ?>" method="post" class="form-horizontal">
            <div class="form-group row">
              <label for="" class="col-form-label col-md-3">Name</label>
              <div class="col-md-9">
                <input type="text" name="full_name" value="<?= $user['name'] ?>" id="user_name" class="form-control">
                <small class="form-text text-info">Press Enter if you done!</small>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-md-3">Email</label>
              <div class="col-md-9">
                <input type="email" name="email" value="<?= $user['email'] ?>" readonly id="user_email" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-form-label col-md-3">Image Profile</label>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-md-12">
                  </div>
                  <div class="col-md-12">
                    <input type="file" accept="image/*" name="" id="upload_image">
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="form-group row">
                  <label for="" class="col-form-label col-md-3">Image Profile</label>
                  <div class="col-md-9">
                    <div class="row">
                      <div class="col-sm-3">
                        <img src="<?= $grav_url ?>" class="img-thumbnail img-circle" alt="">
                        <p>This pitcure is from <a href="http://" target="_blank" rel="noopener noreferrer"></a></p>
                      </div>
                      <div class="col-sm-9">
                      </div>
                    </div>
                  </div>
                </div> -->
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card" id="uploadimageModal">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex justify-content-center">
                <div id="image_demo" style="width: 512px; margin-top: 30px"></div>
              </div>
            </div>
            <div class="col-md-12 text-center" style="padding-top:30px;">
              <button class="btn btn-success btn-block crop_image">Crop & Upload Image</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>