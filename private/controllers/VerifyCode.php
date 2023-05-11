<?php

class VerifyCode extends Controller{
    private $message = '';
    function index(){
        if(is_array($_POST) && count($_POST)){
            $code = $_POST['code'];
            if(isset($_SESSION['CODE']) && $code == $_SESSION['CODE']){
                $_SESSION['VERIFY'] = "verify";
                $this->redirect('/resetpassword');
            }
            else{
                $this->message = alert("error", "Invalid Code!");
            }
        }
        
        $this->view('verify_code', 
        [
            "alert"=>$this->message
        ]);
    }
}

?>