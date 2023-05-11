<?php $this->view('barber/includes/header', ["title" => "Categories"]) ?>

<div class="container-scroller" style="min-height:100vh;">
    <?php $this->view('barber/includes/sidebar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php $this->view('barber/includes/navbar') ?>
        <div class="main-panel">
            <div class="content-wrapper pb-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 grid-margin stretch-card mx-auto">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <div class="d-flex align-items-center flex-row-reverse">
                                    <form method="post" class="mx-2">
                                        <input type="text" name="salon_id" value="<?php echo $_SESSION['SALON_ID']; ?>" id="salon_id" hidden>
                                        <input type="text" name="search" id="search" class="form-control form-control-sm w-100" placeholder="Search.." required />
                                    </form>
                                </div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_category_modal">Add Category</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($categories) && count($categories) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="category_table">
                                                <?php $count = 0; ?>
                                                <?php foreach (@$categories as $category) : ?>
                                                    <?php $count  = $count + 1; ?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo ucfirst($category['category']); ?></td>
                                                        <td>
                                                            <span  class="update_category" data-toggle="modal" data-target="#update_category_modal" data-id="<?php echo $category['id']; ?>"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer;"></i></span>
                                                            <span  class="delete_category" data-id="<?php echo $category['id']; ?>"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer;"></i></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No Category added yet!";
                                    }
                                    ?>
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
<!-- Modal -->
<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" id="add_category_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="category">Category*</label>
                                <input type="text" name="category" class="form-control" placeholder="Category" id="category" required>
                                <span class="text-danger error" id="error_category"></span>
                            </div>
                        </div>                    
                    </div>
                    <input type="text" name="salon_id" value="<?php echo $_SESSION['SALON_ID']; ?>" id="salon_id" hidden>
                    <button type="submit" class="btn btn-primary" id="add_category_btn">Save</button>
                </form>
            </div>
        </div>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" id="update_category_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="category">Category*</label>
                                <input type="text" name="category" class="form-control" placeholder="Category" id="update_category"  required>
                                <span class="text-danger error" id="update_error_category"></span>
                            </div>
                        </div>                    
                    </div>
                    <input type="text" name="id"  id="category_id" hidden>
                    <input type="text" name="salon_id"  id="update_salon_id" hidden>
                    <button type="submit" class="btn btn-primary" id="update_category_btn">Update</button>
                </form>
            </div>
        </div>
       
      </div>
    </div>
  </div>
</div>
<?php $this->view('barber/includes/footer') ?>
<script src="<?=DASHBOARD_ROOT?>/js/ajax/category.js"></script>