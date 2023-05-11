<?php 
    if(!isset($_SESSION['HAS_SALON']) && !isset($_SESSION['BARBER_ID'])){
       $this->redirect('/register');
    }
?>
<?php $this->view('includes/header', ["title"=>"Register Salon"]) ?>
<div class="register-wrapper">
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <?php if(@$alert) echo $alert; ?>
            <h1 style="color:#000 !important;">Register Your Salon</h1>
            <h6 style="color:#000 !important;" class="mb-3">Manage & grow your business digitally and efficiently.</h6>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="salon_name">Salon Name*</label>
                    <input type="text" name="name" id="name" placeholder="Salon Name" class="form-control" required value="<?php echo @$data['name']; ?>">
                    <span class="text-danger error"><?php echo ucfirst(@$errors['name']); ?></span>
                </div>
                <div class="form-group">
                    <label for="address">Address*</label>
                    <input type="text" name="address" id="address" placeholder="Salon Address" class="form-control" required value="<?php echo @$data['address']; ?>">
                    <span class="text-dark help_text">Please provide valid address so customer can find you easily.</span>
                </div>
                <div class="form-group">
                    <label for="city">City*</label>
                    <input type="text" name="city" id="city" placeholder="City" class="form-control" required  value="<?php echo @$data['city']; ?>">
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['city']); ?></span>
                </div>
                <div class="form-group">
                    <label>Salon Certificate*</label>
                    <input type="file" name="img" accept="image/*"  class="file-upload-default" style="display: none;"  />
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Certificate" />
                        <span class="input-group-append">
                        <button class="file-upload-browse btn text-light" style="background-color: #101928;" type="button"> Upload </button>
                        </span>
                    </div>
                    <span class="text-dark help_text">Please provide valid certificate.</span>
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['certificate']); ?></span>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded" id="register_btn">Register</button>
            </form>    
        </div>
    </div>
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/salon.jpg" />
    </div>
</div>
<?php $this->view('includes/footer'); ?>
<script type="text/javascript">
<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){?>
swal({
    title: "Request Send!",
    text: "<?php echo $_SESSION['message'];?>",
    icon: "<?php echo $_SESSION['message_type'];?>",
    buttons: "Ok",
}).then((value) => {
    if (value || value === null) {
        window.location.href = "http://localhost/smartsalon/public";
    } 
});
<?php 
}
unset($_SESSION['message']);
unset($_SESSION['message_type']); 
?>
</script>