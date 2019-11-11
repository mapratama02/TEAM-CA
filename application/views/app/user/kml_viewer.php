<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <code>
    <pre>
      <?= base_url('assets/kml/') . $summary['attachment'] ?>
    </pre>
  </code>

  <!-- <div class="embed-responsive embed-responsive-16by9">
    <iframe src="https://kmlviewer.com/" allowfullscreen class="embed-responsive-item"></iframe>
  </div> -->

  <div class="embed-responsive embed-responsive-16by9">
    <!-- <iframe src="http://localhost/teamca/user/kml_viewer/18886" id="iframe" allowfullscreen class="embed-responsive-item"></iframe> -->
    <!-- <iframe src="http://kmlviewer.nsspot.net/" id="iframe" allowfullscreen class="embed-responsive-item"></iframe> -->
  </div>
</div>