<?php
    class Login extends Controller{

        private $message = '';

        function index(){
            if(!Auth::logged_in()){
                if(is_array($_POST) && count($_POST) > 0 ){
                    $data = $_POST;
                    $auth = $this->load_model('Login');
                    $barber = $auth->login($data);
                    if(is_array($barber)){
                        Auth::authenticate($barber[0]);
                        $barber_id = $barber[0]["id"];
                        $salon = $this->load_model('Salon');
                        $get_salon = $salon->where("barber_id", $barber_id);
                        if($barber[0]["has_salon"] == 0){
                            $this->redirect('/salon');
                        }
                        else if($get_salon[0]["verified"] == 0){
                            $_SESSION['message'] = "Your Registration request has not approved yet!";
                            $_SESSION['message_type'] = "warning";
                        }
                        else{
                            $_SESSION['SALON_ID'] = $get_salon[0]['id'];
                            $this->redirect('/dashboard');
                        }
                    }
                    else{
                        $this->message = alert("error","Wrong email or password!"); 
                    }
                }
            }
            else if(Auth::logged_in()){
                Auth::logout();
                $this->redirect('/login');
            }
           $this->view('login', ["alert"=>$this->message]);
        }
    } # class end
?>