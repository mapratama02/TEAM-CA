<div class="container-fluid">
  <h3><?= $title ?> > Edit User</h3>

  <form action="" method="post">
    <div class="form-group row">
      <label for="" class="col-form-label col-sm-3">Name</label>
      <div class="col-sm-9">
        <input type="text" name="" readonly value="<?= $users['name'] ?>" id="" class="form-control-plaintext">
      </div>
    </div>

    <div class="form-group row">
      <label for="" class="col-form-label col-sm-3">Email</label>
      <div class="col-sm-9">
        <input type="email" name="" readonly value="<?= $users['email'] ?>" id="user_email_edit" class="form-control-plaintext">
      </div>
    </div>

    <div class="form-group row">
      <label for="" class="col-form-label col-sm-3">Role</label>
      <div class="col-sm-9">
        <!-- <input type="text" name="" readonly value="<?= $users['name'] ?>" id="" class="form-control"> -->
        <select name="user_role_edit" id="user_role_edit" class="form-control">
          <?php foreach ($role as $r) : ?>
            <?php if ($r['id'] == $users['role']) : ?>
              <option selected value="<?= $r['id'] ?>"><?= $r['menu'] ?></option>
            <?php else : ?>
              <option value="<?= $r['id'] ?>"><?= $r['menu'] ?></option>
            <?php endif ?>
          <?php endforeach ?>
        </select>
      </div>
    </div>
  </form>
</div>