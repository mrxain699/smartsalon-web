<?php
if (!AUTH::logged_in()) {
  $this->redirect('login');
}
?>
<?php $this->view('includes/header', ["title" => "Salons"]) ?>
<style>
  #img {
    width: 30px;
    height: 30px;
    overflow: hidden;
    border-radius: 100px;
    margin-right: 10px;
  }
</style>
<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
            <div class="card">
              <div class="card-header justify-content-between d-flex align-items-center">
                <div class="d-flex align-items-center">
                  Filter By:
                  <form method="post" class="mx-2">
                    <select class="form-control form-control-sm" name="filter" id="filter" style="border:1px solid #D3D3D3;">
                      <?php
                      if (!empty(@$data['filter'])) :
                      ?>
                        <option value="<?php echo @$data['filter']; ?>" selected><?php echo @$data['filter']; ?></option>
                      <?php endif; ?>
                      <option value="all">All</option>
                      <option value="verified">Verified</option>
                      <option value="rejected">Rejected</option>
                      <option value="pending">Pending</option>
                    </select>
                  </form>
                </div>
              </div>
              <div class="card-body">
                
                <div class="table-responsive table-responsive-md table-responsive-lg table-responsive-sm">
                  <?php if (is_array($salons) && count($salons) > 0) { ?>
                    <table class="table table-hover table-bordered table-responsive-lg">
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
                          
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    No salon exist
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
<script type="text/javascript" src="<?= ROOT ?>/js/ajax/salonrequest.js"></script>