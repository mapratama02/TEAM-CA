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
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
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

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
<!-- <script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script> -->
<script src="<?= base_url('assets/') ?>Croppie/croppie.js"></script>

<script>
  $(document).ready(function() {
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
              html += '<option value="0">--Pilih Kota--</option>';
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
              html += '<option value="0">--Pilih Kecamatan--</option>';
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
              html += '<option value="0">--Pilih Kelurahan--</option>';
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

          var color = [];
          $('.get_value').each(function() {
            if ($(this).is(":checked")) {
              color.push($(this).val())
            }
          });

          color = color.toString();

          $.ajax({
            url: "<?= base_url('user/get_data') ?>",
            method: "POST",
            data: {
              kelurahan: kelurahan,
              region: region,
              kota: kota,
              kecamatan: kecamatan,
            },
            async: false,
            dataType: 'json',
            success: function(data) {
              var html = '';
              for (var i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td>' + data[i].id_report + '</td>';
                html += '<td>' + data[i].timestamp + '</td>';
                html += '<td>' + data[i].tanggal_survey + '</td>';
                html += '<td>' + data[i].region + '</td>';
                html += '<td>' + data[i].kota + '</td>';
                html += '<td>' + data[i].kecamatan + '</td>';
                html += '<td>' + data[i].kelurahan + '</td>';
                html += '<td>' + data[i].kompleks + '</td>';
                html += '<td>' + data[i].owner_type + '</td>';
                html += '<td>' + data[i].rw + '</td>';
                html += '<td>' + data[i].jenis_properti + '</td>';
                html += '<td>' + data[i].type_a + '</td>';
                html += '<td>' + data[i].type_b + '</td>';
                html += '<td>' + data[i].type_c + '</td>';
                html += '<td>' + data[i].type_d + '</td>';
                html += '<td>' + data[i].type_soho + '</td>';
                html += '<td>' + data[i].hp_all + '</td>';
                html += '<td>' + data[i].hp_map + '</td>';
                html += '<td>' + data[i].color + '</td>';
                <?php if ($this->session->userdata('role') != 3 && $this->session->userdata('role') != 4) : ?>
                  html += '<td> <a href="<?= base_url('leader/summary_edit/') ?>' + data[i].id_report + '">Edit</a>' + '</td>';
                  html += '<td> <a href="<?= base_url('leader/summary_delete/') ?>' + data[i].id_report + '">Delete</a>' + '</td>';
                <?php endif ?>

              }
              $("#table_summary tbody").html(html);
              var res = data.length;
              var kelurahan = $('#kelurahan').val();
              var kecamatan = $('#kecamatan').val();
              var kota = $('#kota').val();
              var region = $('#region').val();
              var link = kelurahan;
              var kec = kecamatan;
              var kot = kota;
              var reg = region;

              $('#kelurahan').attr("disabled", "disabled");
              $('#kecamatan').attr("disabled", "disabled");
              $('#kota').attr("disabled", "disabled");
              $('#region').attr("disabled", "disabled");
              $('#summary_search').attr("disabled", "disabled");

              var res_txt = ''
              res_txt += '<p>there is <b>' + res + '</b> data</p>';

              if (res > 0) {
                res_txt += '<a class="btn btn-success" href="<?= base_url('leader/export') ?>?kelurahan=' + link + '&kecamatan=' + kec + '&kota=' + kot + '&region=' + reg + '">Export as Excel <i class="far fa-file-excel"></i></a>';
              }
              $("#summary_result").html(res_txt);

            },
            error: function() {
              alert("Something went wrong");
            }
          });
        });
      })
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
        alert(color);

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
              data: 'timestamp'
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
            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5) : ?> {
                data: 'action',
                orderable: false,
                searchable: false
              },
              {
                data: 'delete',
                orderable: false,
                searchable: false
              }
            <?php endif ?>
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

        var result = total_rumah;
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
          var result = total_rumah;
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
          var result = total_rumah;
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
          var result = total_rumah;
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
          var result = total_rumah;
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
          var result = total_rumah;
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
              alert("You're name has changed!");
              document.location.href = "<?= base_url('user/edit') ?>";
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
          width: 512,
          height: 512,
          type: 'square' //circle
        },
        boundary: {
          width: 512,
          height: 512
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
              document.location.href = "<?= base_url('user') ?>";
              alert("You're image profile has changed!");
            },
            error: function() {
              alert("Error while updating your profile");
            }
          });
        })
      });
    <?php endif ?>

    <?php if ($title == "Dashboard") : ?>
      $(function() {
        $(".data-frame").on('click', function() {
          var response = $(this).data('frame');
          if (response == 0) {
            $(".response").addClass('d-none');
          } else {
            $(".response").removeClass('d-none');
            $("#response").attr("src", response);
          }
        });
      })

      var ctx = document.getElementById("dataRegional");
      var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
            <?php foreach ($region as $reg) : ?>

              "<?= $reg['region'] ?>",

            <?php endforeach ?>
          ],
          datasets: [{
              label: "Area Aktif",
              backgroundColor: "#e74a3b",
              borderColor: "#e74a3b",
              // data: [4215, 5312, 6251, 7841, 9821, 14984],
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('RED', 'BLACK', 'DEEPPINK')")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            },
            {
              label: "Area Potensial",
              backgroundColor: "#4e73df",
              borderColor: "#4e73df",
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BLUE', 'YELLOW', 'PURPLE', 'GREEN', 'OLIVE')")->row_array() ?>
                  <?= $jml_pot['jml_potensial'] ?>,

                <?php endforeach ?>
              ]
            },
            {
              label: "Area Not Potensial",
              backgroundColor: "#ad6947",
              borderColor: "#ad6947",
              // data: [4215, 5312, 6251, 7841, 9821, 14984],
              data: [
                <?php foreach ($region as $kt) : ?>
                  <?php $city = $kt['region'] ?>
                  <?php $jml_pot = $this->db->query("SELECT SUM(`hp_all`) AS `jml_potensial` FROM `summary` WHERE `region` = '$city' AND `color` IN ('BROWN')")->row_array() ?>
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
                unit: 'day'
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
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return number_format(value);
                }
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
              }
            }],
          },
          legend: {
            display: true,
            position: 'right'
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
              // data: [4215, 5312, 6251, 7841, 9821, 14984],
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
              // data: [4215, 5312, 6251, 7841, 9821, 14984],
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
              left: 0,
              right: 0,
              top: 0,
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
                // Include a dollar sign in the ticks
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
            position: 'right'
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

      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: [
            <?php foreach ($label_color as $label) : ?>

              '<?= $label['color'] ?>',

            <?php endforeach ?>
          ],
          datasets: [{
            data: [
              <?php foreach ($label_color as $label) : ?>
                <?php $color = $label['color'] ?>
                <?php $hp = $this->db->query("SELECT SUM(`hp_ca`) AS `hp` FROM `ca_report` WHERE `color` = '$color'")->row_array() ?>

                '<?= number_format($hp['hp'], 0, ',', '.') ?>',

              <?php endforeach ?>
            ],
            backgroundColor: ['black', 'blue', 'brown', 'deeppink', 'green', 'olive', 'purple', 'red', 'yellow'],
            // hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            borderWidth: 0
          }],
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
          },
          legend: {
            display: false
          },
          cutoutPercentage: 80,
        },
      });
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
            // html += '<div class="input-group input-group-sm mb-3" id="input-d">';
            // html += '<div class="input-group-prepend">';
            // html += '<span class="input-group-text">D <input type="hidden" name="abjad_klari[]" value="D"></span>';
            // html += '</div>';
            // html += '<input type="number" min="0" class="form-control" name="input_klari[]" value="0">';
            // html += '</div>';

            // $('#input-klari').append(html);
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
            // $("#result-potensi-label").val(result);
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
            var result = total_rumah;
            // $("#result-potensi-label").val(result);
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
            var result = total_rumah;
            // $("#result-potensi-label").val(result);
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
            var result = total_rumah;
            // $("#result-potensi-label").val(result);
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
            var result = total_rumah;
            // $("#result-potensi-label").val(result);
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
            // $("#result-potensi").val(result);
          });
        });

        $(function() {
          $("#metode_pem").click(function() {
            var html = '';
            // html += '<input type="text" name="metode_pem[]" id="" value="" placeholder="Lainnya:" class="form-control form-control-sm mt-1">';

            // html += '<div class="input-group input-group-sm mb-3">';
            // html += '<input type="text" name="metode_pem[]" id="" value="" placeholder="Lainnya:" class="form-control form-control-sm mt-1">';
            // html += '<div class="input-group-append">';
            // html += '<button class="btn button-addon btn-outline-danger" type="button" id="">&cross;</button>';
            // html += '</div>';
            // html += '</div>';

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
      });

      $("#biaya").on('input', function() {
        var biaya = $(this).val();
        var output = new Intl.NumberFormat('id-ID', {
          maximumSignificantDigits: 5
        }).format(biaya);
        $("#display-biaya").html("Biaya: Rp" + output);
      });
    <?php endif ?>
  });
</script>

</body>

</html>