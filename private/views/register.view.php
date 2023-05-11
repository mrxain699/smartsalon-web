<?php $this->view('includes/header', ["title"=>"Register"]) ?>
<div class="register-wrapper">
    <div class="auth-form d-flex flex-column  justify-content-center align-items-start">
        <div class="form w-100 px-4">
            <h1 style="color:#000 !important;">Smart Salon</h1>
            <h6 style="color:#000 !important;" class="mb-3">Create an account or login to manage  your salon business.</h6>
            <?php if(@$alert) echo $alert; ?>
            <form method="post" action="<?=URL?>/register">
                <div class="form-group">
                    <label for="name">Full Name*</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" class="form-control" required value="<?php echo @$data['name']; ?>">
                    <span class="text-danger error"><?php echo ucfirst(@$errors['name']); ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control" required value="<?php echo @$data['email']; ?>">
                    <span class="text-danger error"><?php echo ucfirst(@$errors['email']); ?></span>
                </div>
                <div class="form-group">
                    <label for="phone">Phone*</label>
                    <input type="text" name="phone" id="phone" placeholder="030xxxxxxxx" class="form-control" required maxlength="11" value="<?php echo @$data['phone']; ?>">
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['phone']); ?></span>
                </div>
                <div class="form-group">
                    <label for="cnic">CNIC*</label>
                    <input type="text" name="cnic" id="cnic" placeholder="1234512345671" class="form-control" required maxlength="13" value="<?php echo @$data['cnic']; ?>">
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['cnic']); ?></span>
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required value="<?php echo @$data['password']; ?>">
                    <span class="text-danger error"><?php echo  ucfirst(@$errors['password']); ?></span>
                </div>
                <button type="submit" class="form-btn w-100 mb-2 py-2 rounded" id="register_btn">Sign Up</button>
            </form>    
            <p style="color:#000 !important; font-size:0.8rem !important">Already have an account? <a href="<?=URL?>/login" style="color:#000 !important; font-size:0.9rem !important">Login</a></p>          
        </div>
    </div>
    <div class="register-salon-image">
        <div class="overlay"></div>
        <img src="<?=ROOT?>/images/mensalon.jpg" />
    </div>
</div>

<?php $this->view('includes/footer') ?>