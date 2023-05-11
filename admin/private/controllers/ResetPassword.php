<?php

class ResetPassword extends Controller{
    private $message = '';
    function index($id){
        $user = $this->load_model('User');
        if(is_array($_POST) && count($_POST)){
            $password = $_POST['password'];
            $confirm_password = $_POST['cpass'];
            if($password == $confirm_password){
                $res = $user->reset_password($id, $password);
                if($res){
                    $_SESSION['message'] = "Password has been reset successfullyl";
                    $_SESSION['message_type'] = "success";
                    $this->redirect('login');
                }
            }
            else{
                $this->message = alert("error", "Passwords didn't match");
            }
        }
        $this->view('reset_password', ["alert"=>$this->message]);
    }
}

?>