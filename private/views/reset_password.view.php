<?php 
if(!isset($_SESSION['VERIFY'])){
    $this->redirect('/login');
}
?>
<?php $this->view('includes/header', ["title"=>"Login"]) ?>
<div class="register-wrapper">
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/login_salon.jpg" />
    </div>
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <h2 style="color:#000 !important;">Reset Your Password</h2>
            <?php if(@$alert) echo $alert; ?>
            <form method="post">
                <div class="form-group">
                    <label for="new_password">New Password*</label>
                    <input type="password" name="password" id="password" placeholder="New password" class="form-control" required>
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['password']); ?></span>
                </div>
            
                <div class="form-group">
                    <label for="confirm_password">Confirm Password*</label>
                    <input type="password" name="cpass" id="confirm_password" placeholder="Confirm Password" class="form-control" required>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded mb-2">Reset Password</button>
            </form>    
        </div>
    </div>
</div>
<?php $this->view('includes/footer') ?>