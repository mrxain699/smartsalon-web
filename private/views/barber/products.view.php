<?php $this->view('barber/includes/header', ["title" => "Products"]) ?>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_product_modal">Add Product</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if (is_array($products) && count($products) > 0) { ?>
                                        <table class="table table-hover table-bordered table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="product_table">
                                                <?php $count = 0; ?>
                                                <?php foreach (@$products as $product) : ?>
                                                    <?php $count = $count + 1;?>
                                                    <tr>
                                                        <td><?php echo $count; ?></td>
                                                        <?php if($product['image'] == "" || $product['image'] == null){
                                                            $image = DASHBOARD_ROOT."/images/faces/default.png";
                                                        }
                                                        else{
                                                            $image = URL."/".$product['image'];
                                                        } ?>
                                                        <td><img class="product_image" src="<?= $image; ?>"></td>
                                                        <td><?php echo $product['name']; ?></td>
                                                        <td><?php echo $product['p_desc']; ?></td>
                                                        <td><?php echo $product['price']; ?></td>
                                                        <td><?php echo $product['quantity']; ?></td>
                                                        <td>
                                                            <span class="update_product" data-toggle="modal" data-target="#update_product_modal" data-id="<?php echo $product['id']; ?>"><i class="mdi mdi-pencil-circle text-success" style="font-size:18px; cursor:pointer"></i></span>
                                                            <span class="delete_product" data-id="<?php echo $product['id']; ?>"><i class="mdi mdi-delete text-danger" style="font-size:18px; padding-top:2px; cursor:pointer"></i></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php
                                    } else {
                                        echo "No product added yet!";
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
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <form method="post" id="add_product_form">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Product Name*</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" id="name" required>
                                        <span class="text-danger error" id="error_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price*</label>
                                        <input type="text" name="price" class="form-control" placeholder="Price" id="price" maxlength="4" required>
                                        <span class="text-danger error" id="error_price"></span>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity*</label>
                                        <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity" maxlength="4" required>
                                        <span class="text-danger error" id="error_quantity"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Image*</label>
                                        <input type="file" name="img" accept="image/*" class="file-upload-default profile_img" style="display: none;"  />
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" id="file-upload-info" disabled placeholder="Upload image" />
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn text-light" style="background-color: #101928;" type="button"> Upload </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="description">Description*</label>
                                        <textarea type="text" name="description" class="form-control"  rows="5" placeholder="Description" id="description" required></textarea>
                                        <span class="text-danger error" id="error_desc"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="file"  id="new_image" hidden>
                            <input type="text" name="temp"  id="old_image" hidden>
                            <input type="text" name="salon_id" value="<?php echo $_SESSION['SALON_ID']; ?>" id="salon_id" hidden>
                            <button type="submit" class="btn btn-primary" id="add_product_btn">Save</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="update_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <form method="post" id="update_product_form">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Product Name*</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" id="update_name" required>
                                        <span class="text-danger error" id="update_error_name"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="price">Price*</label>
                                        <input type="text" name="price" class="form-control" placeholder="Price" id="update_price" maxlength="4" required>
                                        <span class="text-danger error" id="update_error_price"></span>
                                    </div>
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="quantity">Quantity*</label>
                                        <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="update_quantity" maxlength="4" required>
                                        <span class="text-danger error" id="update_error_quantity"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Image*</label>
                                        <input type="file" name="img" accept="image/*" class="file-upload-default profile_img" style="display: none;"  />
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control update_file-upload-info" id="update_file-upload-info" disabled placeholder="Upload image" />
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn text-light" style="background-color: #101928;" type="button"> Upload </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                               
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="description">Description*</label>
                                        <textarea type="text" name="description" class="form-control"  rows="5" placeholder="Description" id="update_description" required></textarea>
                                        <span class="text-danger error" id="update_error_desc"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="text" name="file"  id="update_new_image" hidden>
                            <input type="text" name="temp"  id="update_old_image" hidden>
                            <input type="text" name="id"  id="product_id" hidden>
                            <input type="text" name="salon_id" value="<?php echo $_SESSION['SALON_ID']; ?>" id="update_salon_id" hidden>
                            <button type="submit" class="btn btn-primary" id="update_product_btn">Update</button>
                        </form>
                           
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="profile_image_container">
          <img id="image">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary crop" id="crop">Save</button>
      </div>
    </div>
  </div>
</div>

<?php $this->view('barber/includes/footer') ?>
<script src="<?= DASHBOARD_ROOT ?>/js/ajax/product.js"></script>
<script>
  var bs_modal = $('#modal');
  var image = document.getElementById('image');
  var cropper,reader,file;
  $(document).on("change", ".profile_img", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };
    if (files && files.length > 0) {
      file = files[0];
      if(URL) {
        done(URL.createObjectURL(file));
      } 
      else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

  $(document).on("change", "#profile_img", function(e) {
    var files = e.target.files;
    var done = function(url) {
      image.src = url;
      bs_modal.modal('show');
    };
    if (files && files.length > 0) {
      file = files[0];
      if(URL) {
        done(URL.createObjectURL(file));
      } 
      else if (FileReader) {
        reader = new FileReader();
        reader.onload = function(e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

bs_modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
    aspectRatio: 1,
    viewMode: 3,
    });
}).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
});

$(document).on("click", ".crop", function() {
    canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var directory = "uploads/";
            var base64data = reader.result;
            var image =  base64data.split(";base64,");
            var image_type_aux =  image[0].split("image/");
            var image_type = image_type_aux[1];
            var base64data = image[1];
            var uniqueid = Math.floor(Math.random() * Date.now());
            var file = directory + uniqueid  + "." + image_type;
            var new_image = [file, base64data];
            $("#new_image").val(file);
            $("#old_image").val(base64data);
            bs_modal.modal('hide');

        };  
    });
});

$("#crop").on("click", function() {
    canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var directory = "uploads/";
            var base64data = reader.result;
            var image =  base64data.split(";base64,");
            var image_type_aux =  image[0].split("image/");
            var image_type = image_type_aux[1];
            var base64data = image[1];
            var uniqueid = Math.floor(Math.random() * Date.now());
            var file = directory + uniqueid  + "." + image_type;
            var new_image = [file, base64data];
            $("#update_new_image").val(file);
            $("#update_old_image").val(base64data);
            bs_modal.modal('hide');

        };  
    });

    


});

</script>