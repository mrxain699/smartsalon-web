<?php $this->view('includes/header', ["title"=>"Forgot Password"]) ?>
<div class="register-wrapper">
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/login_salon.jpg" />
    </div>
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <h1 style="color:#000 !important;">Smart Salon</h1>
            <h6 style="color:#000 !important; font-size:0.8rem !important" class="mb-3">Please enter your email address you will receive  a  code  to create a new password via email.</h6>
            <?php if(@$alert) echo $alert; ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control" required value="<?php echo @$email; ?>">
                    <span class="text-danger error"><?php echo ucfirst(@$errors['email']); ?></span>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded">Send Code</button>
            </form>    
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>
<script type="text/javascript">
<?php if(isset($_SESSION['message']) && !empty($_SESSION['message'])){?>
swal({
    text: "<?php echo $_SESSION['message'];?>",
    icon: "<?php echo $_SESSION['message_type'];?>",
    buttons: "Ok",
}).then((value) => {
    if (value || value === null) {
        window.location.href = "http://localhost/smartsalon/public/verifycode";
    } 
});
<?php 
}
unset($_SESSION['message']);
unset($_SESSION['message_type']); 
?>
</script>