<?php $this->view('includes/header', ["title"=>"Login"]) ?>
<div class="register-wrapper">
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/login_salon.jpg" />
    </div>
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <h1 style="color:#000 !important;">Smart Salon</h1>
            <h6 style="color:#000 !important;" class="mb-3">Sign into your account</h6>
            <?php if(@$alert) echo $alert; ?>
            <form method="post" action="<?=URL?>/login">
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control" required>
                </div>
            
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded mb-2 ">Login</button>
            </form>    
            <p style="color:#000 !important; font-size:0.8rem !important">Forgot your password? <a href="<?=URL?>/forgotpassword" style="color:#000 !important; font-size:0.9rem !important">Click here</a></p>          
        </div>
    </div>
</div>
<?php $this->view('includes/footer'); ?>
<?php $this->view('includes/alert');?>
