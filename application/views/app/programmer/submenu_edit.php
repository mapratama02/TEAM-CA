<div class="container-fluid">
  <h3><?= $title ?></h3>

  <div class="row justify-content-center">
    <div class="col-md-8">

      <form action="<?= base_url('programmer/submenu_edit/') . $submenu['id'] ?>" method="post">
        <div class="form-group">
          <select name="menu_id" id="" class="form-control">
            <?php foreach ($menu as $m) : ?>
              <?php if ($submenu['menu_id'] == $m['id']) : ?>
                <option value="<?= $m['id'] ?>" selected><?= $m['id'] . " " . $m['menu'] ?></option>
              <?php else : ?>
                <option value="<?= $m['id'] ?>"><?= $m['id'] . " " . $m['menu'] ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <input type="text" name="title" id="" value="<?= $submenu['title'] ?>" placeholder="Name the submenu..." class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="url" id="" value="<?= $submenu['url'] ?>" placeholder="URI of the submenu..." class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="icon" id="" value="<?= $submenu['icon'] ?>" placeholder="Add Icon of the submenu..." class="form-control">
        </div>
        <div class="form-group">
          <div class="form-check">
            <label>
              <?php if ($submenu['is_active'] == 1) : ?>
                <input type="checkbox" checked name="is_active" value="1" id="">
                Active?
              <?php else : ?>
                <input type="checkbox" name="is_active" value="1" id="">
                Active?
              <?php endif ?>
            </label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
      </form>

    </div>
  </div>
</div>