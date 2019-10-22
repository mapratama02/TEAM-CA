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
      <th>id_report</th>
      <th>timestamp</th>
      <th>tanggal_survey</th>
      <th>area_id</th>
      <th>map_id</th>
      <th>region</th>
      <th>kota</th>
      <th>kecamatan</th>
      <th>kelurahan</th>
      <th>kompleks</th>
      <th>owner_type</th>
      <th>rw</th>
      <th>type_a</th>
      <th>type_b</th>
      <th>type_c</th>
      <th>type_d</th>
      <th>type_soho</th>
      <th>hp_all</th>
      <th>hp_map</th>
      <th>color</th>
      <th>kendaraan_penghuni</th>
      <th>metode_pembangunan</th>
      <th>akses_penjualan</th>
      <th>kompetitor</th>
      <th>provider</th>
      <th>biaya_langganan</th>
      <th>nama_surveyor</th>
      <th>no_hp</th>
      <th>bod_number</th>
      <th>mitra_partnership</th>
    </tr>
    <?php foreach ($survey as $sur) : ?>
      <tr>
        <td><?= $sur->id_report ?></td>
        <td><?= $sur->timestamp ?></td>
        <td><?= $sur->tanggal_survey ?></td>
        <td><?= $sur->area_id ?></td>
        <td><?= $sur->map_id ?></td>
        <td><?= $sur->region ?></td>
        <td><?= $sur->kota ?></td>
        <td><?= $sur->kecamatan ?></td>
        <td><?= $sur->kelurahan ?></td>
        <td><?= $sur->kompleks ?></td>
        <td><?= $sur->owner_type ?></td>
        <td><?= $sur->rw ?></td>
        <td><?= $sur->type_a ?></td>
        <td><?= $sur->type_b ?></td>
        <td><?= $sur->type_c ?></td>
        <td><?= $sur->type_d ?></td>
        <td><?= $sur->type_soho ?></td>
        <td><?= $sur->hp_all ?></td>
        <td><?= $sur->hp_map ?></td>
        <td><?= $sur->color ?></td>
        <td><?= $sur->kendaraan_penghuni ?></td>
        <td><?= $sur->metode_pembangunan ?></td>
        <td><?= $sur->akses_penjualan ?></td>
        <td><?= $sur->kompetitor ?></td>
        <td><?= $sur->provider ?></td>
        <td><?= $sur->biaya_langganan ?></td>
        <td><?= $sur->nama_surveyor ?></td>
        <td><?= $sur->no_hp ?></td>
        <td><?= $sur->bod_number ?></td>
        <td><?= $sur->mitra_partnership ?></td>
      </tr>
    <?php endforeach ?>
  </table>

</body>

</html>