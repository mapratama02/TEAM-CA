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
<script src="https://js.arcgis.com/4.13/"></script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqqCGbf0rY_CAO2MyTt6gJWKG84WKJUCU&callback=initMap"></script>

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
</script>