<?php

class ResetPassword extends Controller{
    private $message = '';
    private $errors = array();
    function index(){
        $barber = $this->load_model('Login');
        if(is_array($_POST) && count($_POST)){
            $password = $_POST['password'];
            $confirm_password = $_POST['cpass'];
            if(validate_password($password)){
                if($password == $confirm_password){
                    $id = $_SESSION['VERIFY_ID'];
                    $res = $barber->update(["password"=>md5($password)], $id);
                    if($res){
                        $_SESSION['message'] = "Password reset successfully!";
                        $_SESSION['message_type'] = "success";
                        unset($_SESSION["CODE"]);
                        unset($_SESSION["VERIFY_ID"]);
                        unset($_SESSION["VERIFY"]);
                    }
                    else{
                        $this->message = alert("error", "Sorry, somethign went wrong");
                    }
                }
                else{
                    $this->message = alert("error", "Passwords didn't match");
                }
            }
            else{
                $this->errors["password"] = "Password should be min 8 characters";
            }
           
        }
        $this->view('reset_password', ["alert"=>$this->message, "errors"=>$this->errors]);
    }
}

?>