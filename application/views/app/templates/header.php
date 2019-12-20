<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?= base_url('assets/') ?>owl/assets/owl.carousel.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>Croppie/croppie.css">
  <link rel="icon" href="http://mncplaysurabaya99.id.tc/wp-content/uploads/sites/447/2016/03/MNC_Playmedia-home.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.0.1/css/ol.css" type="text/css">

  <link rel="stylesheet" href="https://js.arcgis.com/4.13/esri/themes/light/main.css">

  <style>
    .sidebar::-webkit-scrollbar {
      display: none;
    }

    #map {
      height: 500px;
      width: 100%;
      overflow: hidden;
    }

    #capture {
      height: 250px;
      width: 100%;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    #capture {
      font-size: 1rem !important;
    }

    #loader {
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
    }

    #loader.complete {
      display: none;
    }
  </style>

</head>

<body id="page-top">

  <div id="loader" class="bg-white d-flex justify-content-center align-items-center">
    <div class="text-center">
      <!-- <img src="<?= base_url('assets/') ?>img/preloader.gif" alt="" width="200"> -->
      <h1 class="text-gray-900">Loading...</h1>
    </div>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">