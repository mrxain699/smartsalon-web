<?php
if (!AUTH::logged_in()) {
  $this->redirect('login');
}
?>
<style>
    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 100px;
        overflow: hidden;
        position: relative;
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .profile_img_btn {
        position: absolute;
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 50px;
        left: 0;
        bottom: -100px;
        transition: all .2s linear;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .profile-image:hover .profile_img_btn {
        bottom: -8px;
        left: 0;
    }
</style>
<?php $this->view('includes/header',  ["title" => "Profile"]) ?>
<div class="container-scroller" style="min-height:100vh;">
    <?php $this->view('includes/sidebar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php $this->view('includes/navbar') ?>
        <div class="main-panel">
            <div class="content-wrapper pb-0">
                <div class="row">
                    <div class="col col-sm-12 col-md-6 col-lg-8">
                        <div class="card">
                            <div class="card-header">Profile</div>
                            <div class="card-body">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <div class="profile_card d-flex align-items-center justify-content-center">
                                            <div class="profile-image border">
                                                <img src="<?php echo isset($data['image']) && !empty(@$data['image']) ? URL . '/uploads/' . @$data['image'] : ROOT . '/images/faces/default.png'; ?>" id="p_image">
                                                <label class="profile_img_btn" data-toggle="modal" data-target="#imageModal">
                                                    <i class="mdi mdi-camera" style="font-size: 32px; color:#ffffff;"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="forms-sample mt-3" method="post" action="<?= URL ?>/profile/update" enctype="multipart/form-data">
                                    <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$data['id']; ?>" hidden />
                                    <div class="row mt-3">
                                        <div class="col col-sm-12 col-md-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo @$data['firstname']; ?>" required />
                                                <span class="text-danger text-small"><?php echo @$errors['firstname']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col col-sm-12 col-md-12 col-lg-6 ">
                                            <div class="form-group">
                                                <label for="lastname">Lastname</label>
                                                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname" value="<?php echo @$data['lastname']; ?>" required />
                                                <span class="text-danger text-small"><?php echo @$errors['lastname']; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col col-sm-12 col-md-12 col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="<?php echo @$data['email']; ?>" />
                                                <span class="text-danger text-small"><?php echo @$errors['email']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col col-sm-12 col-md-12 col-lg-6 ">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="eg:03075313442" value="<?php echo @$data['phone']; ?>" maxlength="11" required />
                                                <span class="text-danger text-small"><?php echo @$errors['phone']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" id="profile_save"> Save </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-4">
                        <div class="card rounded">
                            <div class="card-header">Change Password</div>

                            <div class="card-body">
                                <form class="forms-sample mt-3" method="post" action="<?= URL ?>/profile/change_password" enctype="multipart/form-data">
                                    <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$data['id']; ?>" hidden />
                                    <?php if (@$message) echo $message; ?>
                                    <div class="form-group mt-2">
                                        <label for="newpassword">New Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required />
                                        <span class="text-danger text-small mt-2"><?php echo @$errors['change_password']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpass">Confirm Password</label>
                                        <input type="password" name="cpass" class="form-control" id="cpass" placeholder="Confirm Password" required />
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2"> Save </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="profile_card d-flex align-items-center justify-content-center">
                        <div class="profile-image border">
                            <img src="<?php echo isset($data['image']) && !empty(@$data['image']) ? URL . '/uploads/' . @$data['image'] : ROOT . '/images/faces/default.png'; ?>" id="upload_image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <form method="post" action="<?= URL ?>/profile/upload_image" enctype="multipart/form-data">
                <input type="text" class="form-control" name="id" id="id" placeholder="id" value="<?php echo @$data['id']; ?>" hidden />
                    <label class="btn btn-success" style="margin-top:7px">
                        <input type="file" name="img" id="profile_img" accept="image/*" hidden value="<?php echo @$data['image']; ?>" onchange="uploadFile(event)">
                        <i class="mdi mdi-camera" style="font-size: 16px; color:#ffffff;"></i> Upload Image
                    </label>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('includes/footer'); ?>
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
        let uploadFile = (event) => {
        let image = document.getElementById('upload_image');
        image.src = URL.createObjectURL(event.target.files[0]);
        image.onload = function() {
            URL.revokeObjectURL(image.src)
        }
    };
</script>