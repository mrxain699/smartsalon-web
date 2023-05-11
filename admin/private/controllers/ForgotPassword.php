<?php

class ForgotPassword extends Controller{
    private $message = '';
    function index(){
        $user = $this->load_model('User');
        if(is_array($_POST) && count($_POST)){
            $email = $_POST['email'];
            $user_id = $user->where('email', $email);
            $user_id = is_array($user_id) ? $user_id[0]['id'] : 0;
            if($user_id > 0){
                $to = $email;
                $subject = "Reset Password Link";
                $message =  "link: ".URL."/resetpassword/".$user_id;
                $header = "From:". EMAIL ."\r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                if(send_mail($to, $subject, $message)){
                    $_SESSION['message'] = "Reset Password link has been sent to your mail";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('login');
                }
                else{
                    $this->message = alert("error", "Sorry! something went wrong!");
                }
            }
            else{
                $this->message = alert("error", "Sorry! This email address doesn't exist");
            }
        }

        $this->view('forgot_password', ["alert"=>$this->message]);
    }
}

?>