<?php
    class Login extends Controller{

        private $message = '';

        function index(){
            if(!empty($type) && !empty($message)){
                $this->message = alert($type, $message);
            }
            if(!Auth::logged_in()){
                if(count($_POST) > 0 ){
                    $data = $_POST;
                    $user = $this->load_model('User');
                    $get_user = $user->login($data);
                    if(is_array($get_user)){
                        if($get_user[0]['status']  === "block"){
                            $_SESSION['message'] = "You profile has been blocked";
                            $_SESSION['message_type'] = "warning";
                        }
                        else{
                            Auth::authenticate($get_user);
                            $this->redirect('home');
                        }

                    }
                    else{
                        $this->message = alert("error","Wrong email or password!"); 
                    }
                }
            }
            else{
                Auth::logout();
                $this->redirect('login');
            }
           $this->view('login', ["alert"=>$this->message]);
        }
    } # class end
?>