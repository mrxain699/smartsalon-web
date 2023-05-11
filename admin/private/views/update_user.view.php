<?php
if (!AUTH::logged_in() && $_SESSION['ROLE'] != "admin") {
  $this->redirect('login');
}
?>
<?php $this->view('includes/header', ["title"=>"Update User"]) ?>
<div class="container-scroller" style="min-height:100vh;">
  <?php $this->view('includes/sidebar') ?>
  <div class="container-fluid page-body-wrapper">
  <?php $this->view('includes/navbar') ?>
    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <div class="row">
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update User</h4>
                            <form class="forms-sample mt-3" method="post" action="<?=URL?>/user/update" enctype="multipart/form-data">
                            <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$data['id']; ?>" hidden />
                                <div class="row mt-2">
                                    <div class="col col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo @$data['firstname']; ?>" required />
                                            <span class="text-danger text-small"><?php echo @$errors['firstname'];?></span>
                                        </div>
                                    </div>  
                                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname" value="<?php echo @$data['lastname']; ?>"  />
                                            <span class="text-danger text-small"><?php echo @$errors['lastname'];?></span>
                                        </div>  
                                    </div>  
                                </div>
                               
                                <div class="row">
                                    <div class="col col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="<?php echo @$data['email']; ?>" required />
                                            <span class="text-danger text-small"><?php echo @$errors['email'];?></span>
                                        </div>
                                    </div>  
                                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="eg:03075313442" value="<?php echo @$data['phone']; ?>" maxlength="11" required />
                                            <span class="text-danger text-small"><?php echo @$errors['phone'];?></span>
                                        </div>  
                                    </div>  
                                </div>

                                <div class="row">
                                    <div class="col col-sm-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control form-control-sm" name="status">
                                                <?php if(!empty(@$data['status'])): ?>
                                                    <option value="<?php echo @$data['status'];?>" selected><?php echo ucfirst(@$data['status']);?></option>
                                                <?php endif;?> 
                                                <option value="active">Active</option>
                                                <option value="block">Block</option>
                                            </select>
                                        </div>
                                    </div>   
                                    <div class="col col-sm-12 col-md-12 col-lg-6 ">
                                        <div class="form-group">
                                            <label for="rank">Rank</label>
                                            <select class="form-control form-control-sm" name="rank">
                                                <?php if(!empty(@$data['rank'])): ?>
                                                    <option value="<?php echo @$data['rank']; ?>" selected><?php echo ucfirst(@$data['rank']); ?></option>
                                                <?php endif; ?> 
                                                <option value="admin">Admin</option>
                                                <option value="employee">Employee</option>
                                            </select>
                                        </div>  
                                    </div>  
                                </div>
                                <button type="submit" class="btn btn-primary mr-2"> Update </button>
                            </form>
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
