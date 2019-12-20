<!-- Maaf Pak, untuk pencarian area dengan apa dan yang ditampilkan apa saja? -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer mt-4 bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <?= "TEAM CA" ?> <?= date('M Y') ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.js"></script>

<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/') ?>js/index.js"></script>

<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/swal.min.js"></script>
<script src="<?= base_url('assets/') ?>js/upup.js"></script>
<script src="<?= base_url('assets/') ?>Croppie/croppie.js"></script>
<script src="<?= base_url('assets/') ?>owl/owl.carousel.min.js"></script>
<script src="https://js.arcgis.com/4.13/"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqqCGbf0rY_CAO2MyTt6gJWKG84WKJUCU&callback=initMap"></script>

<script>
  UpUp.start({
    'cache-version': 'v2',
    'content-url': '<?= site_url($this->uri->segment(1)) ?>',
    'content': 'Cannot reach this site. Check your internet connection.',
    'service-worker-url': '/upup.sw.js'
  });
</script>

<script>
  $(window).on('load', function() {
    // alert("Loaded!");
    $("#loader").css({
      "transition": "1000ms ease",
      "opacity": "0",
    });

    setTimeout(() => {
      $("#loader").remove();
    }, 1000);
  });

  <?php if ($title == "Users") : ?>
    $(function() {
      var t = $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: '<?= base_url('admin/user_json') ?>',
        },
        scrollX: true,
        lengthMenu: [5, 10, 20, 50, 100],
        columns: [{
            data: 'user_id'
          },
          {
            data: 'name'
          },
          {
            data: 'email'
          },
          {
            data: 'image',
            render: function(data) {
              return '<img src="<?= base_url('assets/img/profile/') ?>' + data + '" alt="Image" width="75" class="shadow rounded-circle">'
            }
          },
          {
            data: 'menu'
          },
          {
            data: 'action',
            orderable: false
          },
          {
            data: 'delete',
            orderable: false
          },
        ],
      });
    })

    $(function() {
      $("#user_role_edit").on('change', function() {
        var email = $("#user_email_edit").val();
        var role = $(this).val();

        $.ajax({
          url: '<?= base_url('admin/edit_role_user') ?>',
          method: 'POST',
          data: {
            email: email,
            role: role
          },
          success: function() {
            alert("This user role has changed successfully!");
          }
        });
      });
    })
  <?php endif ?>

  <?php if ($title == 'Menu Builder') : ?>
    $('#modalEditMenu').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('name') // Extract info from data-* attributes
      var id = button.data('id') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      modal.find('.modal-body #namemenu').val(recipient)
      modal.find('.modal-body #idmenu').val(id)
    })
  <?php endif ?>

  <?php if ($title == "KML Viewer") : ?>
    $('#uploadKML button[type="submit"]').click(function() {
      $('.modal-footer-child').removeClass('d-none');
    });

    $('#dir').change(function() {
      var dir = $(this).val();
      var map;
      var src = `https://teamca.000webhostapp.com/kml/${dir}`;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-19.257753, 146.823688),
          zoom: 10,
          mapTypeId: 'terrain'
        });

        var kmlLayer = new google.maps.KmlLayer(src, {
          suppressInfoWindows: true,
          preserveViewport: false,
          map: map
        });

        kmlLayer.addListener('click', function(event) {
          var content = event.featureData.infoWindowHtml;
          var res = content.split('/');
          var tag = res[8].split('<');
          var testimonial = document.getElementById('capture');
          testimonial.innerHTML = `
          <ul class="list-unstyled">
            <li>${res[0]}</li>
            <li>${res[1]}</li>
            <li>${res[2]}</li>
            <li>${res[3]}</li>
            <li>${res[4]}</li>
            <li>${res[5]}</li>
            <li>RW ${res[6]}</li>
            <li>${res[7]}</li>
            <li>${tag[0]}</li>
          </ul>
          `;
        });
      }

      initMap();

      // $('#map').removeClass("d-none");
      // $('#map-item').attr("src", "http://osm.quelltextlich.at/viewer-js.html?kml_url=https://teamca.000webhostapp.com/kml/" + dir);

      // require([
      //   "esri/Map",
      //   "esri/views/MapView",
      //   "esri/layers/KMLLayer",
      //   "esri/widgets/ScaleBar",
      //   "esri/widgets/LayerList"
      // ], function(Map, MapView, KMLLayer, ScaleBar) {
      //   var layer = new KMLLayer({
      //     url: `https://teamca.000webhostapp.com/kml/${dir}`
      //   });

      //   var map = new Map({
      //     basemap: "topo-vector",
      //     layers: [layer]
      //   });

      //   var view = new MapView({
      //     container: "map",
      //     map: map,
      //     center: [107.6094, -6.90616],
      //     zoom: 6.5,
      //   });

      //   var layerList = new layerList({
      //     view: view
      //   });

      //   layer.then(function() {
      //     layer.watch("fullExtent", function(fullExtent) {
      //       view.extent = fullExtent
      //     });
      //   });
      // });
    });

  <?php endif ?>

  <?php if ($title == "Data Survey by Region") : ?>
    $(function() {
      $('#region').change(function() {
        var region = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kota",
          method: "POST",
          data: {
            region: region
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kota--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kota + '">' + data[i].kota + '</option>';
            }
            $('#kota').html(html);
            $('#kota').attr("autofocus");
            $('#kecamatan option').remove();
            $('#kelurahan option').remove();
          }
        });
      });

      $('#kota').change(function() {
        var kota = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kecamatan",
          method: "POST",
          data: {
            kota: kota
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kecamatan--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kecamatan + '">' + data[i].kecamatan + '</option>';
            }
            $('#kecamatan').html(html);
            $('#kelurahan option').remove();
          }
        });
      });

      $('#kecamatan').change(function() {
        var kecamatan = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kelurahan",
          method: "POST",
          data: {
            kecamatan: kecamatan
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kelurahan--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kelurahan + '">' + data[i].kelurahan + '</option>';
            }
            $('#kelurahan').html(html);

          }
        });
      });

      $('#kelurahan').change(function() {
        $('#summary_search').removeAttr("disabled");
      });



      $('#summary_search').on('click', function() {
        var kelurahan = $("#kelurahan").val();
        var region = $("#region").val();
        var kecamatan = $("#kecamatan").val();
        var kota = $("#kota").val();

        if (kecamatan == null) {
          kecamatan = '';
        }

        if (kelurahan == null) {
          kelurahan = '';
        }

        var t = $('#table_summary').DataTable({
          processing: true,
          serverSide: true,
          order: [],
          ajax: {
            url: '<?= base_url('user/data_json_survey_region') ?>',
            method: "POST",
            data: {
              region: region,
              kota: kota,
              kecamatan: kecamatan,
              kelurahan: kelurahan,
            }
          },
          scrollX: true,
          responsive: true,
          lengthMenu: [5, 10, 20, 50, 100],
          columns: [{
              data: 'id_report'
            },
            {
              data: 'map_id'
            },
            {
              data: 'tanggal_survey'
            },
            {
              data: 'region'
            },
            {
              data: 'kota'
            },
            {
              data: 'kecamatan'
            },
            {
              data: 'kelurahan'
            },
            {
              data: 'kompleks'
            },
            {
              data: 'owner_type'
            },
            {
              data: 'rw'
            },
            {
              data: 'type_a'
            },
            {
              data: 'type_b'
            },
            {
              data: 'type_c'
            },
            {
              data: 'type_d'
            },
            {
              data: 'type_soho'
            },
            {
              data: 'hp_all'
            },
            {
              data: 'hp_map'
            },
            {
              data: 'color'
            },
            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) : ?> {
                data: 'action',
                orderable: false,
                searchable: false
              },
              {
                data: 'delete',
                orderable: false,
                searchable: false
              },
            <?php endif ?> {
              data: 'attachment',
              orderable: false,
              searchable: false
            },
          ],
          columnDefs: [{
            "searchable": false,
            "orderable": true,
            "targets": 0
          }],
        });

        var kelurahan = $('#kelurahan').val();
        if (kelurahan == null) {
          kelurahan = '';
        }

        var kecamatan = $('#kecamatan').val();
        if (kecamatan == null) {
          kecamatan = '';
        }

        var kota = $('#kota').val();
        if (kota == null) {
          kota = '';
        }

        var region = $('#region').val();
        if (region == null) {
          region = '';
        }

        var link = kelurahan;
        var kec = kecamatan;
        var kot = kota;
        var reg = region;

        $(this).parents(".card").remove();

        var res_txt = '';
        res_txt += '<a class="btn btn-success" href="<?= base_url('leader/export') ?>?kelurahan=' + link + '&kecamatan=' + kec + '&kota=' + kot + '&region=' + reg + '">Export as Excel <i class="far fa-file-excel"></i></a>';

        $("#export").html(res_txt);

      });
    })
  <?php endif ?>

  <?php if ($title == "Search Area") : ?>
    $(function() {
      $('#region').change(function() {
        var region = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kota",
          method: "POST",
          data: {
            region: region
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kota--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kota + '">' + data[i].kota + '</option>';
            }
            $('#kota').html(html);
            $('#kota').attr("autofocus");
            $('#kecamatan option').remove();
            $('#kelurahan option').remove();
          }
        });
      });

      $('#kota').change(function() {
        var kota = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kecamatan",
          method: "POST",
          data: {
            kota: kota
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kecamatan--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kecamatan + '">' + data[i].kecamatan + '</option>';
            }
            $('#kecamatan').html(html);
            $('#kelurahan option').remove();
          }
        });
      });

      $('#kecamatan').change(function() {
        var kecamatan = $(this).val();
        $.ajax({
          url: "<?php echo base_url() ?>/user/get_kelurahan",
          method: "POST",
          data: {
            kecamatan: kecamatan
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            var html = '';
            var i;
            html += '<option value="">--Pilih Kelurahan--</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value="' + data[i].kelurahan + '">' + data[i].kelurahan + '</option>';
            }
            $('#kelurahan').html(html);

          }
        });
      });

      $('#kelurahan').change(function() {
        $('#summary_search').removeAttr("disabled");
      });
    })


    $('#search').click(function() {
      var region = $('#region').val();
      var kota = $('#kota').val();
      var kecamatan = $('#kecamatan').val();
      var kelurahan = $('#kelurahan').val();
      var rw = $('#rw').val();

      var tab = $('#table_search').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: '<?= base_url('user/data_json_search_area') ?>',
          method: "POST",
          data: {
            region: region,
            kota: kota,
            kecamatan: kecamatan,
            kelurahan: kelurahan,
            rw: rw,
          }
        },
        scrollX: true,
        responsive: true,
        lengthMenu: [10, 20, 50, 100],
        columns: [{
            data: 'id_report'
          },
          {
            data: 'area_id'
          },
          {
            data: 'map_id'
          },
          {
            data: 'region'
          },
          {
            data: 'kota'
          },
          {
            data: 'kecamatan'
          },
          {
            data: 'kelurahan'
          },
          {
            data: 'rw'
          }
        ]
      });

      $(this).parents(".card").remove();
    });
  <?php endif ?>

  <?php if ($title == "Data Survey by Color") : ?>
    $('#filter').click(function() {
      var color = [];

      $('input[name="color"]').each(function() {
        if ($(this).is(":checked")) {
          color.push($(this).val());
        }
      });

      $('input[name="color"]').attr('disabled', 'disabled');
      $(this).attr('disabled', 'disabled');

      color = color.join(" ");
      color = color.toString();

      var html = '';
      html += '<a class="btn btn-success" href="<?= base_url('leader/export_color') ?>?color=' + color + '">Export</a>';

      $("#export").html(html);

      var t = $('#table_summary_color').DataTable({
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
          url: '<?= base_url('user/data_json_survey_color') ?>',
          method: "POST",
          data: {
            color: color
          }
        },
        scrollX: true,
        responsive: true,
        lengthMenu: [5, 10, 20, 50, 100],
        columns: [{
            data: 'id_report'
          },
          {
            data: 'map_id'
          },
          {
            data: 'tanggal_survey'
          },
          {
            data: 'region'
          },
          {
            data: 'kota'
          },
          {
            data: 'kecamatan'
          },
          {
            data: 'kelurahan'
          },
          {
            data: 'kompleks'
          },
          {
            data: 'owner_type'
          },
          {
            data: 'rw'
          },
          {
            data: 'type_a'
          },
          {
            data: 'type_b'
          },
          {
            data: 'type_c'
          },
          {
            data: 'type_d'
          },
          {
            data: 'type_soho'
          },
          {
            data: 'hp_all'
          },
          {
            data: 'hp_map'
          },
          {
            data: 'color'
          },
          <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2 || $this->session->userdata('role') == 5) : ?> {
              data: 'action',
              orderable: false,
              searchable: false
            },
            {
              data: 'delete',
              orderable: false,
              searchable: false
            },
          <?php endif ?> {
            data: 'attachment',
            orderable: false,
            searchable: false
          },
        ],
        columnDefs: [{
          "searchable": false,
          "orderable": true,
          "targets": 0
        }],
      });
    });
  <?php endif ?>

  <?php if ($title == "Summary Edit") : ?>
    $(function() {
      var a = eval($("#inp-a").val());
      var b = eval($("#inp-b").val());
      var c = eval($("#inp-c").val());
      var d = eval($("#inp-d").val());
      var soho = eval($("#inp-soho").val());
      var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
      var enam_puluh_persen = eval(60 / 100);

      var result = total_rumah.toFixed(2);
      // $("#result-potensi-label").val(result);
      if (result >= enam_puluh_persen) {
        $("#result-potensi").val("BLUE");

        $(".potensi-range").addClass("progress-bar-success");
        $(".potensi-range").removeClass("progress-bar-danger");
      } else {
        $("#result-potensi").val("BROWN");

        $(".potensi-range").addClass("progress-bar-danger");
        $(".potensi-range").removeClass("progress-bar-success");
      }
      $(".potensi-range").css({
        "width": (result * 100) + "%"
      });
      $("#result-potensi-label").html((result * 100) + "%");
    })

    $(function() {
      $("#inp-a").on("input", function() {
        var a = eval($(this).val());
        var b = eval($("#inp-b").val());
        var c = eval($("#inp-c").val());
        var d = eval($("#inp-d").val());
        var soho = eval($("#inp-soho").val());
        var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
        var enam_puluh_persen = eval(60 / 100);
        var result = total_rumah.toFixed(2);
        // $("#result-potensi-label").val(result);
        if (result >= enam_puluh_persen) {
          $("#result-potensi").val("BLUE");

          $(".potensi-range").addClass("progress-bar-success");
          $(".potensi-range").removeClass("progress-bar-danger");
        } else {
          $("#result-potensi").val("BROWN");

          $(".potensi-range").addClass("progress-bar-danger");
          $(".potensi-range").removeClass("progress-bar-success");
        }
        $(".potensi-range").css({
          "width": (result * 100) + "%"
        });
        $("#result-potensi-label").html((result * 100) + "%");
        // $("#result-potensi").val(result);
      });
      $("#inp-b").on("input", function() {
        var a = eval($("#inp-a").val());
        var b = eval($(this).val());
        var c = eval($("#inp-c").val());
        var d = eval($("#inp-d").val());
        var soho = eval($("#inp-soho").val());
        var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
        var enam_puluh_persen = eval(60 / 100);
        var result = total_rumah.toFixed(2);
        // $("#result-potensi-label").val(result);
        if (result >= enam_puluh_persen) {
          $("#result-potensi").val("BLUE");

          $(".potensi-range").addClass("progress-bar-success");
          $(".potensi-range").removeClass("progress-bar-danger");
        } else {
          $("#result-potensi").val("BROWN");

          $(".potensi-range").addClass("progress-bar-danger");
          $(".potensi-range").removeClass("progress-bar-success");
        }
        $(".potensi-range").css({
          "width": (result * 100) + "%"
        });
        $("#result-potensi-label").html((result * 100) + "%");
        // $("#result-potensi").val(result);
      });
      $("#inp-c").on("input", function() {
        var a = eval($("#inp-a").val());
        var b = eval($("#inp-b").val());
        var c = eval($(this).val());
        var d = eval($("#inp-d").val());
        var soho = eval($("#inp-soho").val());
        var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
        var enam_puluh_persen = eval(60 / 100);
        var result = total_rumah.toFixed(2);
        // $("#result-potensi-label").val(result);
        if (result >= enam_puluh_persen) {
          $("#result-potensi").val("BLUE");

          $(".potensi-range").addClass("progress-bar-success");
          $(".potensi-range").removeClass("progress-bar-danger");
        } else {
          $("#result-potensi").val("BROWN");

          $(".potensi-range").addClass("progress-bar-danger");
          $(".potensi-range").removeClass("progress-bar-success");
        }
        $(".potensi-range").css({
          "width": (result * 100) + "%"
        });
        $("#result-potensi-label").html((result * 100) + "%");
        // $("#result-potensi").val(result);
      });
      $("#inp-d").on("input", function() {
        var a = eval($("#inp-a").val());
        var b = eval($("#inp-b").val());
        var c = eval($("#inp-c").val());
        var d = eval($(this).val());
        var soho = eval($("#inp-soho").val());
        var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
        var enam_puluh_persen = eval(60 / 100);
        var result = total_rumah.toFixed(2);
        // $("#result-potensi-label").val(result);
        if (result >= enam_puluh_persen) {
          $("#result-potensi").val("BLUE");

          $(".potensi-range").addClass("progress-bar-success");
          $(".potensi-range").removeClass("progress-bar-danger");
        } else {
          $("#result-potensi").val("BROWN");

          $(".potensi-range").addClass("progress-bar-danger");
          $(".potensi-range").removeClass("progress-bar-success");
        }
        $(".potensi-range").css({
          "width": (result * 100) + "%"
        });
        $("#result-potensi-label").html((result * 100) + "%");
        // $("#result-potensi").val(result);
      });
      $("#inp-soho").on("input", function() {
        var a = eval($("#inp-a").val());
        var b = eval($("#inp-b").val());
        var c = eval($("#inp-c").val());
        var d = eval($("#inp-d").val());
        var soho = eval($(this).val());
        var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
        var enam_puluh_persen = eval(60 / 100);
        var result = total_rumah.toFixed(2);
        // $("#result-potensi-label").val(result);
        if (result >= enam_puluh_persen) {
          $("#result-potensi").val("BLUE");

          $(".potensi-range").addClass("progress-bar-success");
          $(".potensi-range").removeClass("progress-bar-danger");
        } else {
          $("#result-potensi").val("BROWN");

          $(".potensi-range").addClass("progress-bar-danger");
          $(".potensi-range").removeClass("progress-bar-success");
        }
        $(".potensi-range").css({
          "width": (result * 100) + "%"
        });
        $("#result-potensi-label").html((result * 100) + "%");
        // $("#result-potensi").val(result);
      });
    });

    $(function() {
      $("#metode_pem").click(function() {
        var html = '';

        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="metode_pem[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
        html += '<div class="input-group-append">';
        html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
        html += '</div>';
        html += '</div>';
        $("#metode_pem_add").append(html);

        $(".button-addon").click(function() {
          $(this).parents(".input-group").remove();
        });
      });

      $("#akses").click(function() {
        var html = '';
        // html += '<input type="text" name="akses[]" id="" value="" placeholder="Lainnya:" class="form-control form-control-sm mt-1">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="akses[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
        html += '<div class="input-group-append">';
        html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
        html += '</div>';
        html += '</div>';
        $("#akses_add").append(html);

        $(".button-addon").click(function() {
          $(this).parents(".input-group").remove();
        });
      });

      $("#kompetitor").click(function() {
        var html = '';
        // html += '<input type="text" name="kompetitor[]" id="" value="" placeholder="Lainnya:" class="form-control form-control-sm mt-1">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="kompetitor[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
        html += '<div class="input-group-append">';
        html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
        html += '</div>';
        html += '</div>';
        $("#kompetitor_add").append(html);

        $(".button-addon").click(function() {
          $(this).parents(".input-group").remove();
        });
      });

      $("#provider").click(function() {
        var html = '';
        // html += '<input type="text" name="provider[]" id="" value="" placeholder="Lainnya:" class="form-control form-control-sm mt-1">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="provider[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
        html += '<div class="input-group-append">';
        html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
        html += '</div>';
        html += '</div>';
        $("#provider_add").append(html);

        $(".button-addon").click(function() {
          $(this).parents(".input-group").remove();
        });
      });
    });

    var first = $("#biaya").val();
    var second = new Intl.NumberFormat('id-ID', {
      maximumSignificantDigits: 5
    }).format(first);
    $("#display-biaya").html("Biaya: Rp" + second);

    $("#biaya").on('input', function() {
      var biaya = $(this).val();
      var output = new Intl.NumberFormat('id-ID', {
        maximumSignificantDigits: 5
      }).format(biaya);
      $("#display-biaya").html("Biaya: Rp" + output);
    });
  <?php endif ?>

  <?php if ($title == "Edit Profile") : ?>
    $('#user_email').on('click', function() {
      alert('You can\'t edit you\'re email!');
    });

    $('#user_name').on('keypress', function(e) {
      if (e.which == 13) {
        var value = $(this).val();
        $.ajax({
          url: '<?= base_url('user/edit_name') ?>',
          method: 'POST',
          data: {
            name: value
          },
          success: function() {
            // alert("You're name has changed!");
            Swal.fire(
              'Yeay!',
              'You\'re name has changed!',
              'success'
            );
            setTimeout(() => {
              document.location.href = "<?= base_url('user/edit') ?>";
            }, 1000);
          },
          error: function() {
            alert("Error while updating your name!");
          }
        });
      }
    });

    $('#uploadimageModal').hide();

    // Croppie
    $image_crop = $('#image_demo').croppie({
      enableExif: false,
      viewport: {
        width: 250,
        height: 250,
        type: 'square' //circle
      },
      boundary: {
        width: 250,
        height: 250
      }
    });

    $('#upload_image').on('change', function() {
      var reader = new FileReader();
      reader.onload = function(event) {
        $image_crop.croppie('bind', {
          url: event.target.result
        }).then(function() {
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadimageModal').show();
    });

    $('.crop_image').click(function(event) {
      $image_crop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
      }).then(function(response) {
        $.ajax({
          url: "<?= base_url('user/edit_image') ?>",
          type: "POST",
          data: {
            "image": response
          },
          success: function(data) {
            $('#uploadimageModal').hide();
            Swal.fire(
              'Yeay!',
              'Your Profile image is changed!',
              'success'
            );
            document.location.href = "<?= base_url('user') ?>";
            // alert("You're image profile has changed!");
          },
          error: function() {
            alert("Error while updating your profile");
          }
        });
      })
    });
  <?php endif ?>

  <?php if ($title == "Dashboard") : ?>
    $(".owl-carousel").owlCarousel({
      autoWidth: false,
      items: 1,
      loop: false
    });

    <?php if ($this->session->userdata('role') == 3) : ?>
      <?php foreach ($region as $reg) : ?>
        <?php $kt = $reg['region'] ?>
        <?php
              $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BLUE')")->row_array();
              $jml_aktif = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('RED')")->row_array();
              $jml_not = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BROWN')")->row_array();
              ?>
        var ctx = document.getElementById("dataRegional<?= str_replace(" ", "", $reg['region']) ?>");
        var myPieChart<?= str_replace(" ", "", $reg['region']) ?> = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Potensial", "Aktif", "Not Potensial"],
            datasets: [{
              data: [
                <?= $jml_pot['jml_potensial'] ?>,
                <?= $jml_aktif['jml_potensial'] ?>,
                <?= $jml_not['jml_potensial'] ?>,
              ],
              backgroundColor: ['#4e73df', '#e74a3b', '#ad6947'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
              borderWidth: 0.5,
            }],
          },
          options: {
            title: {
              display: true,
              text: '<?= $kt ?>'
            },
            maintainAspectRatio: false,
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 20,
              bodyFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#000000",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              callbacks: {
                label: function(tooltipItem, data) {
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  var dataLabel = data.labels[tooltipItem.index] || '';
                  var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                  });
                  var currentValue = dataset.data[tooltipItem.index];
                  var percentage = number_format(currentValue);

                  return dataLabel + ": " + percentage + " HP";
                }
              }
            },
            legend: {
              display: true,
              position: 'bottom',
              fontFamily: 'Comic Sans MS',
              fontSize: 20
            },
            cutoutPercentage: 70,
          },
        });
      <?php endforeach ?>

      var ctx = document.getElementById("dataProduction");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php foreach ($region as $reg) : ?>

              "<?= $reg['region'] ?>",

            <?php endforeach ?>
          ],
          datasets: [{
              label: "Blue",
              backgroundColor: "#4e73df",
              borderColor: "#4e73df",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BLUE') AND `area_id` = ''")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            },
            {
              label: "Brown",
              backgroundColor: "#ad6947",
              borderColor: "#ad6947",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BROWN') AND `area_id` = ''")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            }
          ],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 100,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                maxTicksLimit: 5,
                padding: 5,
                callback: function(value, index, values) {
                  return number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [10],
                zeroLineBorderDash: [10]
              }
            }],
          },
          legend: {
            display: true,
            position: 'bottom'
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
              }
            }
          },
        }
      });

      <?php $nama = $user['name'] ?>
      <?php foreach ($region_personal as $reg) : ?>
        <?php $kt = $reg['region'] ?>
        <?php
              $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BLUE') AND `nama_surveyor` = '$nama'")->row_array();
              $jml_aktif = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('RED') AND `nama_surveyor` = '$nama'")->row_array();
              $jml_not = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BROWN') AND `nama_surveyor` = '$nama'")->row_array();
              ?>
        var ctx = document.getElementById("data-region-personal-<?= str_replace(" ", "", $reg['region']) ?>");
        var myPieChart<?= str_replace(" ", "", $reg['region']) ?> = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Potensial", "Aktif", "Not Potensial"],
            datasets: [{
              data: [
                <?= $jml_pot['jml_potensial'] ?>,
                <?= $jml_aktif['jml_potensial'] ?>,
                <?= $jml_not['jml_potensial'] ?>,
              ],
              backgroundColor: ['#4e73df', '#e74a3b', '#ad6947'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
              borderWidth: 0.5,
            }],
          },
          options: {
            title: {
              display: true,
              text: '<?= $kt ?>'
            },
            maintainAspectRatio: false,
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 20,
              bodyFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#000000",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              callbacks: {
                label: function(tooltipItem, data) {
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  var dataLabel = data.labels[tooltipItem.index] || '';
                  var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                  });
                  var currentValue = dataset.data[tooltipItem.index];
                  var percentage = number_format(currentValue);

                  return dataLabel + ": " + percentage + " HP";
                }
              }
            },
            legend: {
              display: true,
              position: 'bottom',
              fontFamily: 'Comic Sans MS',
              fontSize: 20
            },
            cutoutPercentage: 70,
          },
        });
      <?php endforeach ?>

      var ctx = document.getElementById("data-production-personal");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php foreach ($region_personal as $reg) : ?>

              "<?= $reg['region'] ?>",

            <?php endforeach ?>
          ],
          datasets: [{
              label: "Blue",
              backgroundColor: "#4e73df",
              borderColor: "#4e73df",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BLUE') AND `area_id` = '' AND `nama_surveyor` = '$nama'")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            },
            {
              label: "Brown",
              backgroundColor: "#ad6947",
              borderColor: "#ad6947",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BROWN') AND `area_id` = '' AND `nama_surveyor` = '$nama'")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            }
          ],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 100,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                maxTicksLimit: 5,
                padding: 5,
                callback: function(value, index, values) {
                  return number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [10],
                zeroLineBorderDash: [10]
              }
            }],
          },
          legend: {
            display: true,
            position: 'bottom'
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
              }
            }
          },
        }
      });
    <?php else : ?>
      <?php foreach ($region as $reg) : ?>
        <?php $kt = $reg['region'] ?>
        <?php
              $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BLUE')")->row_array();
              $jml_aktif = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('RED')")->row_array();
              $jml_not = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$kt' AND `color` IN ('BROWN')")->row_array();
              ?>
        var ctx = document.getElementById("dataRegional<?= str_replace(" ", "", $reg['region']) ?>");
        var myPieChart<?= str_replace(" ", "", $reg['region']) ?> = new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ["Potensial", "Aktif", "Not Potensial"],
            datasets: [{
              data: [
                <?= $jml_pot['jml_potensial'] ?>,
                <?= $jml_aktif['jml_potensial'] ?>,
                <?= $jml_not['jml_potensial'] ?>,
              ],
              backgroundColor: ['#4e73df', '#e74a3b', '#ad6947'],
              hoverBorderColor: "rgba(234, 236, 244, 1)",
              borderWidth: 0.5,
            }],
          },
          options: {
            title: {
              display: true,
              text: '<?= $kt ?>'
            },
            maintainAspectRatio: false,
            tooltips: {
              titleMarginBottom: 10,
              titleFontColor: '#6e707e',
              titleFontSize: 20,
              bodyFontSize: 14,
              backgroundColor: "rgb(255,255,255)",
              bodyFontColor: "#000000",
              borderColor: '#dddfeb',
              borderWidth: 1,
              xPadding: 15,
              yPadding: 15,
              displayColors: false,
              caretPadding: 10,
              callbacks: {
                label: function(tooltipItem, data) {
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  var dataLabel = data.labels[tooltipItem.index] || '';
                  var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                  });
                  var currentValue = dataset.data[tooltipItem.index];
                  var percentage = number_format(currentValue);

                  return dataLabel + ": " + percentage + " HP";
                }
              }
            },
            legend: {
              display: true,
              position: 'bottom',
              fontFamily: 'Comic Sans MS',
              fontSize: 20
            },
            cutoutPercentage: 70,
          },
        });
      <?php endforeach ?>

      var ctx = document.getElementById("dataProduction");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php foreach ($region as $reg) : ?>

              "<?= $reg['region'] ?>",

            <?php endforeach ?>
          ],
          datasets: [{
              label: "Blue",
              backgroundColor: "#4e73df",
              borderColor: "#4e73df",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BLUE') AND `area_id` = ''")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            },
            {
              label: "Brown",
              backgroundColor: "#ad6947",
              borderColor: "#ad6947",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BROWN') AND `area_id` = ''")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            }
          ],
        },
        options: {
          maintainAspectRatio: false,
          layout: {
            padding: {
              left: 10,
              right: 25,
              top: 25,
              bottom: 0
            }
          },
          scales: {
            xAxes: [{
              time: {
                unit: 'month'
              },
              gridLines: {
                display: false,
                drawBorder: false
              },
              ticks: {
                maxTicksLimit: 6
              },
              maxBarThickness: 100,
            }],
            yAxes: [{
              ticks: {
                min: 0,
                maxTicksLimit: 5,
                padding: 5,
                callback: function(value, index, values) {
                  return number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [10],
                zeroLineBorderDash: [10]
              }
            }],
          },
          legend: {
            display: true,
            position: 'bottom'
          },
          tooltips: {
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
            callbacks: {
              label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
              }
            }
          },
        }
      });
    <?php endif ?>

  <?php endif ?>

  <?php if ($title == 'Form Survey') : ?>

    $('#home-next').on('click', function() {
      $('#home').addClass('d-none');
      $('#profile').removeClass('d-none');
      $('#messages').addClass('d-none');
    });

    $('#home-prev').on('click', function() {
      $('#home').removeClass('d-none');
      $('#profile').addClass('d-none');
      $('#messages').addClass('d-none');
    });

    $('#profile-next').on('click', function() {
      $('#home').addClass('d-none');
      $('#profile').addClass('d-none');
      $('#messages').removeClass('d-none');
    });

    $('#profile-prev').on('click', function() {
      $('#home').addClass('d-none');
      $('#profile').removeClass('d-none');
      $('#messages').addClass('d-none');
    });

    $('#region').change(function() {
      var region = $(this).val();
      $.ajax({
        url: "<?php echo base_url() ?>/staff/get_kota",
        method: "POST",
        data: {
          region: region
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html += '<option value="0">--Pilih Kota--</option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '.' + data[i].name + '">' + data[i].name + '</option>';
          }
          $('#kota').html(html);
          $('#kota').attr("autofocus");
          $('#kecamatan option').remove();
          $('#kelurahan option').remove();
        }
      });
    });

    $('#kota').change(function() {
      var kota = $(this).val();
      $.ajax({
        url: "<?php echo base_url() ?>/staff/get_kecamatan",
        method: "POST",
        data: {
          kota: kota
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html += '<option value="0">--Pilih Kecamatan--</option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '.' + data[i].name + '">' + data[i].name + '</option>';
          }
          $('#kecamatan').html(html);
          $('#kelurahan option').remove();
        }
      });
    });

    $('#kecamatan').change(function() {
      var kecamatan = $(this).val();
      $.ajax({
        url: "<?php echo base_url() ?>/staff/get_kelurahan",
        method: "POST",
        data: {
          kecamatan: kecamatan
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          html += '<option value="0">--Pilih Kelurahan--</option>';
          for (i = 0; i < data.length; i++) {
            html += '<option value="' + data[i].id + '.' + data[i].name + '">' + data[i].name + '</option>';
          }
          $('#kelurahan').html(html);

        }
      });
    });

    $(document).on({
      ajaxStart: function() {
        $("body").css({
          "background": "black"
        })
      },
      ajaxStop: function() {
        $("body").css({
          "background": "slateblue"
        });
      }
    });

    jQuery(function() {
      $("#input-a").hide();
      $("#input-b").hide();
      $("#input-c").hide();
      $("#input-d").hide();
      $("#input-soho").hide();

      $("#klari-a").click(function() {
        var html = '';
        if ($(this).is(":checked")) {

          $("#input-a").show();
        } else {
          $("#input-a").hide();
          $("#inp-a").val(0);
        }
      });

      $("#klari-b").click(function() {
        var html = '';
        if ($(this).is(":checked")) {
          $("#input-b").show();
        } else {
          $("#input-b").hide();
        }
      });

      $("#klari-c").click(function() {
        var html = '';
        if ($(this).is(":checked")) {
          $("#input-c").show();
        } else {
          $("#input-c").hide();
        }
      });

      $("#klari-d").click(function() {
        var html = '';
        if ($(this).is(":checked")) {
          $("#input-d").show();
        } else {
          $("#input-d").hide();
        }
      });

      $("#klari-soho").click(function() {
        var html = '';
        if ($(this).is(":checked")) {
          $("#input-soho").show();
        } else {
          $("#input-soho").hide();
        }
      });

      $(function() {
        $("#inp-a").on("input", function() {
          var a = eval($(this).val());
          var b = eval($("#inp-b").val());
          var c = eval($("#inp-c").val());
          var d = eval($("#inp-d").val());
          var soho = eval($("#inp-soho").val());
          var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
          var enam_puluh_persen = eval(60 / 100);
          var result = total_rumah;
          if (result >= enam_puluh_persen) {
            $("#result-potensi").val("BLUE");

            $(".potensi-range").addClass("bg-success");
            $(".potensi-range").removeClass("bg-danger");
          } else {
            $("#result-potensi").val("BROWN");

            $(".potensi-range").addClass("bg-danger");
            $(".potensi-range").removeClass("bg-success");
          }
          $(".potensi-range").css({
            "width": (result * 100) + "%"
          });
          $("#result-potensi-label").html((result * 100) + "%");
        });
        $("#inp-b").on("input", function() {
          var a = eval($("#inp-a").val());
          var b = eval($(this).val());
          var c = eval($("#inp-c").val());
          var d = eval($("#inp-d").val());
          var soho = eval($("#inp-soho").val());
          var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
          var enam_puluh_persen = eval(60 / 100);
          var result = total_rumah;
          if (result >= enam_puluh_persen) {
            $("#result-potensi").val("BLUE");

            $(".potensi-range").addClass("bg-success");
            $(".potensi-range").removeClass("bg-danger");
          } else {
            $("#result-potensi").val("BROWN");

            $(".potensi-range").addClass("bg-danger");
            $(".potensi-range").removeClass("bg-success");
          }
          $(".potensi-range").css({
            "width": (result * 100) + "%"
          });
          $("#result-potensi-label").html((result * 100) + "%");
        });
        $("#inp-c").on("input", function() {
          var a = eval($("#inp-a").val());
          var b = eval($("#inp-b").val());
          var c = eval($(this).val());
          var d = eval($("#inp-d").val());
          var soho = eval($("#inp-soho").val());
          var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
          var enam_puluh_persen = eval(60 / 100);
          var result = total_rumah;
          if (result >= enam_puluh_persen) {
            $("#result-potensi").val("BLUE");

            $(".potensi-range").addClass("bg-success");
            $(".potensi-range").removeClass("bg-danger");
          } else {
            $("#result-potensi").val("BROWN");

            $(".potensi-range").addClass("bg-danger");
            $(".potensi-range").removeClass("bg-success");
          }
          $(".potensi-range").css({
            "width": (result * 100) + "%"
          });
          $("#result-potensi-label").html((result * 100) + "%");
        });
        $("#inp-d").on("input", function() {
          var a = eval($("#inp-a").val());
          var b = eval($("#inp-b").val());
          var c = eval($("#inp-c").val());
          var d = eval($(this).val());
          var soho = eval($("#inp-soho").val());
          var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
          var enam_puluh_persen = eval(60 / 100);
          var result = total_rumah;
          if (result >= enam_puluh_persen) {
            $("#result-potensi").val("BLUE");

            $(".potensi-range").addClass("bg-success");
            $(".potensi-range").removeClass("bg-danger");
          } else {
            $("#result-potensi").val("BROWN");

            $(".potensi-range").addClass("bg-danger");
            $(".potensi-range").removeClass("bg-success");
          }
          $(".potensi-range").css({
            "width": (result * 100) + "%"
          });
          $("#result-potensi-label").html((result * 100) + "%");
        });
        $("#inp-soho").on("input", function() {
          var a = eval($("#inp-a").val());
          var b = eval($("#inp-b").val());
          var c = eval($("#inp-c").val());
          var d = eval($("#inp-d").val());
          var soho = eval($(this).val());
          var total_rumah = ((a + b + c + soho) / (a + b + c + d + soho));
          var enam_puluh_persen = eval(60 / 100);
          var result = total_rumah;
          if (result >= enam_puluh_persen) {
            $("#result-potensi").val("BLUE");

            $(".potensi-range").addClass("bg-success");
            $(".potensi-range").removeClass("bg-danger");
          } else {
            $("#result-potensi").val("BROWN");

            $(".potensi-range").addClass("bg-danger");
            $(".potensi-range").removeClass("bg-success");
          }
          $(".potensi-range").css({
            "width": (result * 100) + "%"
          });
          $("#result-potensi-label").html((result * 100) + "%");
        });
      });

      $(function() {
        $("#metode_pem").click(function() {
          var html = '';

          html += '<div class="input-group mb-3">';
          html += '<input type="text" name="metode_pem[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
          html += '<div class="input-group-append">';
          html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
          html += '</div>';
          html += '</div>';
          $("#metode_pem_add").append(html);

          $(".button-addon").click(function() {
            $(this).parents(".input-group").remove();
          });
        });

        $("#akses").click(function() {
          var html = '';

          html += '<div class="input-group mb-3">';
          html += '<input type="text" name="akses[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
          html += '<div class="input-group-append">';
          html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
          html += '</div>';
          html += '</div>';
          $("#akses_add").append(html);

          $(".button-addon").click(function() {
            $(this).parents(".input-group").remove();
          });
        });

        $("#kompetitor").click(function() {
          var html = '';

          html += '<div class="input-group mb-3">';
          html += '<input type="text" name="kompetitor[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
          html += '<div class="input-group-append">';
          html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
          html += '</div>';
          html += '</div>';
          $("#kompetitor_add").append(html);

          $(".button-addon").click(function() {
            $(this).parents(".input-group").remove();
          });
        });

        $("#provider").click(function() {
          var html = '';

          html += '<div class="input-group mb-3">';
          html += '<input type="text" name="provider[]" class="form-control" placeholder="Lainnya" aria-label="Recipient\'s username" aria-describedby="button-addon2">';
          html += '<div class="input-group-append">';
          html += '<button class="btn button-addon btn-outline-danger" type="button" id="button-addon2">&cross;</button>';
          html += '</div>';
          html += '</div>';
          $("#provider_add").append(html);

          $(".button-addon").click(function() {
            $(this).parents(".input-group").remove();
          });
        });
      });
    });

    $("#biaya").on('input', function() {
      var biaya = $(this).val();
      var output = new Intl.NumberFormat('id-ID', {
        maximumSignificantDigits: 5
      }).format(biaya);
      $("#display-biaya").html("Biaya: Rp" + output);
    });
  <?php endif ?>
</script>

</body>

</html>