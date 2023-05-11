
  <!-- plugins:js -->
  <script src="<?=DASHBOARD_ROOT?>/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?=DASHBOARD_ROOT?>/js/off-canvas.js"></script>
  <script src="<?=DASHBOARD_ROOT?>/js/misc.js"></script>
  <script src="<?=DASHBOARD_ROOT?>/js/file-upload.js"></script>
  <script src="<?=DASHBOARD_ROOT?>/vendors/cropper/dist/cropper.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Custom js for this page -->
  <script src="<?=DASHBOARD_ROOT?>/js/dashboard.js"></script>
  <script src="<?=DASHBOARD_ROOT?>/js/app.js"></script>

  <script type="text/javascript">
  <?php
    if(isset($_SESSION['message']) && $_SESSION['message'] != ""){ 
      $this->view("barber/includes/alert", 
      [
        "message"=>$_SESSION['message'], 
        "type"=>$_SESSION['message_type']
      ]);
    }
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
  ?>
</script>

  </body>
</html>