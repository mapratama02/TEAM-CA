<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <title>Access Blocked</title>
  <style>
    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      width: 100%;
      padding: 0;
      margin: 0;
    }
  </style>
</head>

<body>

  <div class="h-100 d-flex justify-content-center align-items-center w-100">
    <div class="text-center" style="width: 600px">
      <h1 class="error mx-auto display-1" data-text="403">403</h1>
      <!-- <hr> -->
      <p class="lead">Access Blocked</p>
      <button onclick="window.history.back()" class="btn btn-primary">Go Back</button>
    </div>
  </div>

</body>

</html>