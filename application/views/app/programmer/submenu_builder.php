<div class="container-fluid">
  <h1 class="h3"><?= $title ?></h1>

  <div class="row mt-5">
    <div class="col-md-12">
      <a href="" data-toggle="modal" data-target="#modalAddSubMenu" class="btn btn-primary mb-3">Add new submenu</a>
      <table class="table">
        <thead>
          <th>#</th>
          <th>Title</th>
          <th>Menu</th>
          <th>URL</th>
          <th>Icon</th>
          <th>Active</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($sub_menu as $sm) : ?>
            <tr>
              <th><?= $no++ ?></th>
              <td><?= $sm['title'] ?></td>
              <td><?= $sm['menu'] ?></td>
              <td><?= $sm['url'] ?></td>
              <td><i class="<?= $sm['icon'] ?>"></i> <?= $sm['icon'] ?></td>
              <td>
                <?php if ($sm['is_active'] == 1) : ?>
                  <span class="badge badge-success">Active</span>
                <?php else : ?>
                  <span class="badge badge-danger">Not Active</span>
                <?php endif ?>
              </td>
              <td>
                <a href="<?= base_url('programmer/submenu_edit/') . $sm['id'] ?>" class="badge badge-success">Edit</a>
                <a href="" class="badge badge-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="modalAddSubMenu" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('programmer/submenu_builder') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Add New Submenu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="menu_id" id="" class="form-control">
              <?php foreach ($menu as $m) : ?>
                <option value="<?= $m['id'] ?>"><?= $m['id'] . " " . $m['menu'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="title" id="" placeholder="Name the submenu..." class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="url" id="" placeholder="URI of the submenu..." class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="icon" id="" placeholder="Add Icon of the submenu..." class="form-control">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label>
                <input type="checkbox" name="is_active" value="1" id="">
                Active?
              </label>
            </div>
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