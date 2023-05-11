<?php $this->view('barber/includes/header', ["title" => "Services"]) ?>

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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_service_modal">Add Service</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($services) && count($services) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Duration</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="service_table">
                                                <?php $count = 0;?>
                                                <?php foreach (@$services as $service) : ?>
                                                    <?php $count  = $count + 1;?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <td><?php echo ucfirst($service['name']); ?></td>
                                                        <td><?php echo $service['price']; ?></td>
                                                        <td><?php echo $service['duration']; ?></td>
                                                        <td><?php echo $service['category']; ?></td>
                                                        <td>
                                                            <span class="update_service" data-toggle="modal" data-target="#update_service_modal" data-id="<?php echo $service['id']; ?>"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer"></i></span>
                                                            <span  class="delete_service" data-id="<?php echo $service['id']; ?>"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer"></i></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No Service added yet!";
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
<div class="modal fade" id="add_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" id="add_service_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Service Name*</label>
                                <input type="text" name="name" class="form-control" placeholder="Service Name" id="service_name" required value="<?php echo @$data['name']; ?>">
                                <span class="text-danger error" id="error_name"></span>
                            </div>
                        </div> 
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="price">Service Price*</label>
                                <input type="number" name="price" class="form-control" placeholder="Service Price" id="service_price" required value="<?php echo @$data['price']; ?>">
                                <span class="text-danger error" id="error_price"></span>
                            </div>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Service Category*</label>
                                <select name="category" id="service_category" class="form-control" required>
                                    <option value="Select Category">Select Category</option>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category['category'];?>"><?php echo $category['category']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger error" id="error_category"></span>
                            </div>
                        </div> 
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="duration">Service Duration*</label>
                                <select name="duration" id="service_duration" class="form-control" required>
                                    <option value="Select Service Duration">Select Service Duration</option>
                                    <option value="15 Min">15 Min</option>
                                    <option value="20 Min">20 Min</option>
                                    <option value="25 Min">25 Min</option>
                                    <option value="30 Min">30 Min</option>
                                    <option value="35 Min">35 Min</option>
                                    <option value="40 Min">40 Min</option>
                                    <option value="45 Min">45 Min</option>
                                    <option value="50 Min">50 Min</option>
                                    <option value="55 Min">55 Min</option>
                                    <option value="1 Hour">1 Hour</option>
                                </select>
                                <span class="text-danger error" id="error_duration"></span>
                            </div>
                        </div>                     
                    </div>
                    <input type="text" name="salon_id" value="<?php echo $_SESSION['SALON_ID']; ?>" id="salon_id" hidden>
                    <button type="submit" class="btn btn-primary" id="add_service_btn">Save</button>
                </form>
            </div>
        </div>
       
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="update_service_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" id="update_service_form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">Service Name*</label>
                                <input type="text" name="name" class="form-control" placeholder="Service Name" id="update_service_name" required value="<?php echo @$data['name']; ?>">
                                <span class="text-danger error" id="update_error_name"></span>
                            </div>
                        </div> 
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="price">Service Price*</label>
                                <input type="number" name="price" class="form-control" placeholder="Service Price" id="update_service_price" required value="<?php echo @$data['price']; ?>">
                                <span class="text-danger error" id="update_error_price"></span>
                            </div>
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="category">Service Category*</label>
                                <select name="category" id="update_service_category" class="form-control" required>
                                    <option value="Select Category" selected>Select Category</option>
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category['category'];?>"></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger error" id="update_error_category"></span>
                            </div>
                        </div> 
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <label for="duration">Service Duration*</label>
                                <select name="duration" id="update_service_duration" class="form-control" required>
                                    <option value="Select Service Duration" selected>Select Service Duration</option>
                                    <option value="15">15 Minute</option>
                                    <option value="20">20 Minute</option>
                                    <option value="25">25 Minute</option>
                                    <option value="30">30 Minute</option>
                                    <option value="35">35 Minute</option>
                                    <option value="40">40 Minute</option>
                                    <option value="45">45 Minute</option>
                                    <option value="50">50 Minute</option>
                                    <option value="55">55 Minute</option>
                                    <option value="1 Hour">1 Hour</option>
                                </select>
                                <span class="text-danger error" id="update_error_duration"></span>
                            </div>
                        </div>                     
                    </div>
                    <input type="text" name="id"  id="service_id" hidden>
                    <input type="text" name="salon_id"  id="update_salon_id" hidden>
                    <button type="submit" class="btn btn-primary" id="update_service_btn">Update</button>
                </form>
            </div>
        </div>
       
      </div>
    </div>
  </div>
</div>
<?php $this->view('barber/includes/footer') ?>
<script src="<?=DASHBOARD_ROOT?>/js/ajax/service.js"></script>