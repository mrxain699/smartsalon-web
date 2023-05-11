<?php

class ForgotPassword extends Controller{
    private $message = '';
    private $errors = array();
    function index(){
        $barber = $this->load_model('Register');
        if(is_array($_POST) && count($_POST) > 0){
            $email = $_POST['email'];
            if(validate_email($email)){
                $get_barber = $barber->where("email",$email);
                if(is_array($get_barber) && count($get_barber) > 0){
                    $barber_id = $get_barber[0]['id'];
                    $code = random_int(100000, 999999);
                    $_SESSION['VERIFY_ID'] = $barber_id;
                    $_SESSION['CODE'] = $code;
                    $to = $email;
                    $subject = "Email verification code : ".$code;
                    $message =  "Your verification code is : <b>".$code."</b>";
                    $header = "From:".EMAIL."\r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    if(send_mail($to, $subject, $message)){
                        $_SESSION['message'] = "Verification code has been sent to your email.";
                        $_SESSION['message_type'] = 'success';
                    //   $this->redirect('/verifycode');
                    }
                    else{
                        $this->message = alert("error", "Sorry! something went wrong!");
                    }
                    
                }
                else{
                    $this->errors['email'] = "This email address dosn't exist!";
                }
            }
            else{
                $this->errors['email'] = "Invalid email address!";
            }

        }
        $this->view('forgot_password', 
        [   
            "email"=>@$email,
            "alert"=>$this->message,
            "errors"=>$this->errors,
        ]);
    }
}

?>