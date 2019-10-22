<div class="container-fluid">
  <h1 class="h3"><?= $title ?></h1>

  <a href="#" data-toggle="modal" data-target="#modalAddUser" class="btn my-3 btn-success">Add new users</a>

  <table class="table w-100" id="table-user">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Profile</th>
        <th>Role</th>
        <th>Action</th>
        <th></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<div class="modal" tabindex="-1" id="modalAddUser" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('admin/user') ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Add New User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <select name="role" id="" class="form-control">
              <?php foreach ($role as $r) : ?>
                <option value="<?= $r->id ?>"><?= $r->role ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <input type="text" name="name" placeholder="Name" id="" class="form-control">
          </div>
          <div class="form-group">
            <input type="email" placeholder="Email" name="email" id="" class="form-control">
          </div>
          <div class="form-group">
            <input type="password" name="password" placeholder="Password" id="" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>