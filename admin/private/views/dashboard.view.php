<?php
if (!AUTH::logged_in()) {
  $this->redirect('login');
}
?>
<?php $this->view('includes/header', ["title" => "Dashboard"]) ?>
<style>
  #img {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 100px;
    margin-right: 10px;
  }
</style>
<div class="container-scroller" style="min-height: 100vh !important;">
  <?php $this->view('includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-warning">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Users</p>
                        <h2 class="text-white"><?php echo $total_users; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account bg-inverse-icon-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
                <div class="card bg-danger">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Customers</p>
                        <h2 class="text-white"><?php echo $total_customers; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-account-multiple-outline bg-inverse-icon-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-primary">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Salons</p>
                        <h2 class="text-white"><?php echo $total_salons; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-content-cut bg-inverse-icon-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-12 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
                <div class="card bg-success">
                  <div class="card-body px-3 py-4">
                    <div class="d-flex justify-content-between align-items-start">
                      <div class="color-card">
                        <p class="mb-0 color-card-head">Requests</p>
                        <h2 class="text-white"><?php echo $total_requests; ?></h2>
                      </div>
                      <i class="card-icon-indicator mdi mdi-check bg-inverse-icon-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
            <div class="card">
              <div class="card-header ">
                Salon Requests
              </div>
              <div class="card-body">
                
                <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                  <?php if (is_array($salons) && count($salons) > 0) { ?>
                    <table class="table table-hover table-bordered table-responsive ">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Barber</th>
                          <th>Salon</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Certificate</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="salon_table">
                        <?php
                        $count = 0;
                        foreach ($salons as $salon) {
                          $count += 1;
                        ?>

                          <tr>
                            <td><?php echo $count; ?></td>
                            <td>
                              <?php
                              $image = $salon['barber_image'] != null && $salon['barber_image'] != "" ? DEFAULT_URL . "/" . $salon['barber_image'] : ROOT . "/images/faces/default.png";
                              ?>
                              <img src="<?= $image ?>" id="img" /> <?php echo ucfirst($salon['barber_name']); ?>
                            </td>
                            <td><?php echo ucfirst($salon['name']); ?></td>
                            <td><?php echo $salon['email']; ?></td>
                            <td><?php echo $salon['phone']; ?></td>
                            <td><?php echo $salon['address']; ?></td>
                            <td><?php echo ucfirst($salon['city']); ?></td>
                            <td>
                              <?php if ($salon['certificate'] != null && $salon['certificate'] != "") { ?>
                                <a href="<?= URL ?>/salon/view_certificate/<?= $salon['certificate'] ?>" target="_blank">
                                  <?php echo  $salon['certificate'] ?>
                                </a>
                              <?php } else { ?>
                                No certificate provided
                              <?php } ?>
                            </td>
                            <td>
                              <?php
                              if ($salon['verified'] == 1) {
                                $status_class = "success";
                                $status = "Verified";
                              } else if ($salon['cancelled'] == 1) {
                                $status_class = "danger";
                                $status = "Cancelled";
                              } else {
                                $status_class = "warning";
                                $status = "Pending";
                              }
                              ?>
                              <label class="badge badge-<?php echo $status_class; ?>"><?php echo $status; ?></label>
                            </td>
                            <td>
                              <a href="<?= URL ?>/salon/verify_request/<?= $salon['id'] ?>/<?= $salon['barber_id'] ?>"><i class="mdi mdi-check-circle text-success" style="font-size:28px; cursor:pointer"></i></a>
                              <a href="<?= URL ?>/salon/cancel_request/<?= $salon['id'] ?>/<?= $salon['barber_id'] ?>"><i class="mdi mdi-close-circle text-danger" style="font-size:28px;  cursor:pointer"></i></a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    No salon request exist
                  <?php } ?>
                </div>
                

              </div>
            </div>
          </div>
        </div>
        <!--row-end-->


      </div>

    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<?php $this->view('includes/footer') ?>
<script>
    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])) { ?>
      swal({
        text: "<?php echo $_SESSION['message']; ?>",
        icon: "<?php echo $_SESSION['message_type']; ?>",
        buttons: "Ok",
      }).then((value) => {

      });
    <?php
    }
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
    ?>
  </script>