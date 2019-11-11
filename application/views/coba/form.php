<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Form</title>
</head>

<body>

  <form action="<?= base_url('coba/submit') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="">
    <input type="submit">
  </form>

  <h1><?= $upload_max_filesize ?></h1>

</body>

</html>