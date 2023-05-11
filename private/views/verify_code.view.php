<?php 
if(!isset($_SESSION['VERIFY_ID'])){
    $this->redirect('/login');
}
?>
<?php $this->view('includes/header', ["title"=>"Verify Code"]) ?>
<div class="register-wrapper">
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/login_salon.jpg" />
    </div>
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <h3 style="color:#000 !important;">Reset Password Verification</h3>
            <h6 style="color:#000 !important; font-size:1rem !important" class="mb-3">Enter your 6-digit code here.</h6>
            <?php if(@$alert) echo $alert; ?>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="code" id="v_code" placeholder="6-digit code" class="form-control" required value="<?php echo @$code; ?>" maxlength="6">
                    <span class="text-danger error"><?php echo ucfirst(@$errors['code']); ?></span>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded" id="code_btn" disabled>Verify</button>
            </form>    
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>