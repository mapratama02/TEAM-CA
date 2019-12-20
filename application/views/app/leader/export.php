<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Export Data</title>
</head>

<body>

  <table border="1" cellpadding="8">
    <tr>
      <th style="">id_report</th>
      <th style="">timestamp</th>
      <th style="">tanggal_survey</th>
      <th style="background:orange">area_id</th>
      <th style="background:orange">map_id</th>
      <th style="background:yellow">region</th>
      <th style="background:yellow">kota</th>
      <th style="background:yellow">kecamatan</th>
      <th style="background:yellow">kelurahan</th>
      <th style="background:yellow">kompleks</th>
      <th style="">owner_type</th>
      <th style="background:yellow">rw</th>
      <th style="background:orange">type_a</th>
      <th style="background:orange">type_b</th>
      <th style="background:orange">type_c</th>
      <th style="background:orange">type_d</th>
      <th style="background:orange">type_soho</th>
      <th style="background:orange">hp_all</th>
      <th style="background:orange">hp_map</th>
      <th style="background:orange">color</th>
      <th style="">metode_pembangunan</th>
      <th style="">kendaraan_penghuni</th>
      <th style="">akses_penjualan</th>
      <th style="">kompetitor</th>
      <th style="">provider</th>
      <th style="">biaya_langganan</th>
      <th style="">nama_surveyor</th>
      <th style="">no_hp</th>
      <th style="">jenis_properti</th>
      <th style="background:orange">bod_number</th>
      <th style="background:orange">mitra_partnership</th>
    </tr>
    <?php foreach ($survey as $sur) : ?>
      <tr>
        <td style=""><?= $sur->id_report ?></td>
        <td style=""><?= $sur->timestamp ?></td>
        <td style=""><?= $sur->tanggal_survey ?></td>
        <td style=""><?= $sur->area_id ?></td>
        <td style=""><?= $sur->map_id ?></td>
        <td style=""><?= $sur->region ?></td>
        <td style=""><?= $sur->kota ?></td>
        <td style=""><?= $sur->kecamatan ?></td>
        <td style=""><?= $sur->kelurahan ?></td>
        <td style=""><?= $sur->kompleks ?></td>
        <td style=""><?= $sur->owner_type ?></td>
        <td style=""><?= $sur->rw ?></td>
        <td style=""><?= $sur->type_a ?></td>
        <td style=""><?= $sur->type_b ?></td>
        <td style=""><?= $sur->type_c ?></td>
        <td style=""><?= $sur->type_d ?></td>
        <td style=""><?= $sur->type_soho ?></td>
        <td style=""><?= $sur->hp_all ?></td>
        <td style=""><?= $sur->hp_map ?></td>
        <td style=""><?= $sur->color ?></td>
        <td style=""><?= $sur->metode_pembangunan ?></td>
        <td style=""><?= $sur->kendaraan_penghuni ?></td>
        <td style=""><?= $sur->akses_penjualan ?></td>
        <td style=""><?= $sur->kompetitor ?></td>
        <td style=""><?= $sur->provider ?></td>
        <td style=""><?= $sur->biaya_langganan ?></td>
        <td style=""><?= $sur->nama_surveyor ?></td>
        <td style=""><?= $sur->no_hp ?></td>
        <td style=""><?= $sur->jenis_properti ?></td>
        <td style=""><?= $sur->bod_number ?></td>
        <td style=""><?= $sur->mitra_partnership ?></td>
      </tr>
    <?php endforeach ?>
  </table>

</body>

</html>