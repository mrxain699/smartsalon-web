<?php
if (!AUTH::logged_in()) {
  $this->redirect('login');
}
?>
<?php $this->view('includes/header', ["title" => "Customer"]) ?>
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
                <div class="d-flex align-items-center flex-row-reverse">
                  <form method="post" class="mx-2">
                    <input type="text" name="search" id="search" class="form-control form-control-sm w-100 " placeholder="Search.." required style="border:1px solid #D3D3D3;" />
                  </form>
                </div>
              </div>
              <div class="card-body">
                <?php if (is_array(@$customers) && count(@$customers) > 0) { ?>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>City</th>
                        </tr>
                      </thead>
                      <tbody id="customer_table">
                        <?php
                        $count = 0;
                        foreach (@$customers as $customer) {
                          $count += 1;
                        ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td>
                              <?php
                              $image = $customer['image'] != null && $customer['image'] != "" ? DEFAULT_URL . "/" . $customer['image'] : ROOT . "/images/faces/default.png";
                              ?>
                              <img src="<?= $image ?>" id="img" /> <?php echo ucfirst($customer['name']); ?>
                            </td>
                            <td><?php echo $customer['email']; ?></td>
                            <td><?php echo $customer['phone']; ?></td>
                            <td><?php echo $customer['address']; ?></td>
                            <td><?php echo ucfirst($customer['city']); ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                <?php } else { ?>
                  <div>
                    No customer exist!
                  </div>
                <?php } ?>
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
<script type="text/javascript">
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
<script type="text/javascript" src="<?= ROOT ?>/js/ajax/customerrequest.js"></script>