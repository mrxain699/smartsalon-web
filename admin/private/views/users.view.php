<?php
if (!AUTH::logged_in()) {
  $this->redirect('login');
}
?>
<?php $this->view('includes/header', ["title" => "Users"]) ?>
<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
    <?php $this->view('includes/navbar') ?>
    <div class="main-panel">
      <div class="content-wrapper pb-0">
        <div class="row">
          <?php if(isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == "admin" ): ?>
          <div class="col-sm-12 col-lg-12 col-md-12 d-flex justify-content-end">
            <a href="<?= URL ?>/user/add" class="btn btn-primary">Add User</a>
          </div>
          <?php endif; ?>
          <div class="col-lg-12 col-sm-12 col-md-12 mb-3 mt-3">
            <div class="row">
              <?php $this->view('includes/count_card', ["total" => $total_users, "class" => "success",  "heading" => "Total Users", "icon" => "account"]); ?>
              <?php $this->view('includes/count_card', ["total" => $total_admins, "class" => "info", "heading" => "Total Admins",  "icon" => "account-key"]) ?>
              <?php $this->view('includes/count_card', ["total" => $total_employees, "class" => "warning", "heading" => "Total Employess",  "icon" => "account-check"]) ?>
              <?php $this->view('includes/count_card', ["total" => $total_block_users, "class" => "danger", "heading" => "Block Users",  "icon" => "account-off"]) ?>
            </div>
          </div>
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
                      <option value="admin">Admin</option>
                      <option value="employee">Employees</option>
                      <option value="block">Block users</option>
                    </select>
                  </form>
                </div>
                <div class="d-flex align-items-center flex-row-reverse">
                  <form method="post" class="mx-2">
                    <input type="text" name="search" id="search" class="form-control form-control-sm w-100" placeholder="Search.." required style="border:1px solid #D3D3D3;"/>
                  </form>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <?php if (is_array($users) && count($users) > 1) { ?>
                    <table class="table table-hover table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Rank</th>
                          <th>Status</th>
                          <?php if(isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == "admin" ): ?>
                          <th>Action</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody id="user_table">
                        <?php
                        $count = 0;
                        foreach ($users as $user) {
                        ?>
                          <?php if ($user['id'] != $_SESSION['ID']) {
                            $count += 1;
                          ?>
                            <tr>
                              <td><?php echo $count; ?></td>
                              <td><?php echo ucfirst($user['firstname']) . " " . ucfirst($user['lastname']); ?></td>
                              <td><?php echo $user['email']; ?></td>
                              <td><?php echo $user['phone']; ?></td>
                              <td><?php echo $user['rank']; ?></td>
                              <td>
                                <?php
                                $status_class = $user['status'] == "active" ? 'success' : 'danger';
                                ?>
                                <label class="badge badge-<?php echo $status_class; ?>"><?php echo ucfirst($user['status']); ?></label>
                              </td>
                              <?php if(isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == "admin" ): ?>
                              <td>
                                <?php
                                $url = $user['status'] == "block" ? URL . "/user/unblock/" . $user['id'] : URL . "/user/block/" . $user['id'];
                                $icon = $user['status'] == "block" ? "mdi-account" : "mdi-account-off";
                                ?>
                                <a href="<?= $url ?>"><i class="mdi <?= $icon ?> text-warning" style="font-size:18px;"></i></a>
                                <a href="<?= URL ?>/user/update/<?= $user['id']; ?>" title="Update User"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px;"></i></a>
                                <a href="<?= URL ?>/user/delete/<?= $user['id']; ?>" title="Delete User"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px;"></i></a>
                              </td>
                              <?php endif; ?>
                            </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  <?php } else { ?>
                    No user exist
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
<script>
  <?php if (isset($_SESSION['ID'])) : ?>
    var user_id = <?php echo $_SESSION['ID']; ?>;
  <?php endif; ?>
</script>

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
<script type="text/javascript" src="<?= ROOT ?>/js/ajax/userrequest.js"></script>