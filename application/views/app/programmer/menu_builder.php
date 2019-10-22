<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

  <div class="row">
    <div class="col-md-6">
      <h5>Menu Management</h5>
      <a href="#" data-toggle="modal" data-target="#modalAddMenu" class="btn btn-primary mb-3">Add new menu</a>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Menu</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id = 1;
          foreach ($menu as $m) : ?>
            <tr>
              <th><?= $id++ ?></th>
              <td><?= $m['menu'] ?></td>
              <td>
                <a href="" class="badge badge-success">Edit</a>
                <a href="" class="badge badge-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>


</div>

<!-- Modal for menu -->
<div class="modal fade" tabindex="-1" id="modalAddMenu" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('programmer/menu_builder') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Add New Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="menu" id="" placeholder="Name the menu..." class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>