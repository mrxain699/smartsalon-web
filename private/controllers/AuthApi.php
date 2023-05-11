<?php

class AuthApi extends Controller
{
    protected $auth_api;
    protected $customer;
    function __construct()
    {
       
        $this->auth_api = $this->load_model("AuthApi");
        $this->customer = $this->load_model("Customer");
    }

    function get($id, $role){
        if($id > 0 && $role != ""){
            $auth_obj = new $this->auth_api($role);
            $user = $this->_get($auth_obj, 'id', $id);
            if(is_array($user) &&  count($user) > 0){
                echo json_encode($user[0]);
            }
            else{
                echo 0;
            }

        }
        else{
            echo -1;
        }
    }


    function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            $response = $this->_add($this->customer, $data);
            if (is_array($response) && count($response) > 0) {
                echo json_encode($response);
            } else {
                $get_latest_customer = $this->customer->where("email", $data['email']);
                echo $get_latest_customer[0]['id'];
            }
        } else {
            echo 0;
        }
    }



    function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            if($data['role'] != null || $data['role'] != ""){
                $login_obj = new $this->auth_api($data['role']);
                $id = $login_obj->login_user($data);
                if ($id > 0) {
                    echo json_encode(array("user_id" => $id));
                } else {
                    echo 0;
                }
            }
            else{
                echo -1;
            }
            
        }
    }


     function update(){
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) && count($data) > 0) {
            if($data['role'] != null || $data['role'] != ""){
                $id = $data['id'];
                $role = $data['role'];
                $field = $data['input'];
                $value = $data['value'];
                $auth_obj = new $this->auth_api($role);
                $response = $auth_obj->update([$field=>$value], $id);
                if($response){
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
        }
        else{
            echo -1;
        }
    }

    function sendmail()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            if($data['role'] != null || $data['role'] != ""){
                $role = $data['role'];
                $auth_obj = new $this->auth_api($role);
                $email = $data['email'];
                $email_exist =  $auth_obj->where("email", $email);
                if (is_array($email_exist) && count($email_exist) > 0) {
                    $u_id = $email_exist[0]['id'];
                    $code = random_int(1000, 9999);
                    $to = $email;
                    $subject = "Email Verification code : " . $code;
                    $message =  "Your verification code is : <b>" . $code . "</b>";
                    $header = "From:" . EMAIL . "\r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    if (send_mail($to, $subject, $message)) {
                        $response = array("u_id" => $u_id, "code" => $code, "status" => "Ok");
                        echo json_encode($response);
                    }
                    else{
                        echo -1;
                    }
                } else {
                    echo 0;
                }
            }
           
        }
    }

    function reset_password()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            if($data['role'] != null || $data['role'] != ""){
                $role = $data['role'];
                $auth_obj = new $this->auth_api($role);
                $id = $data['id'];
                $password = $data['password'];
                $response = $auth_obj->update(["password" => md5($password)], $id);
                if ($response) {
                    echo 1;
                } else {
                    echo 0;
                }
            }
           
        }
    }

    function upload_image()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) && count($data) > 0) {
            if($data['role'] != null || $data['role'] != ""){
                $role = $data['role'];
                $auth_obj = new $this->auth_api($role);
                $id = $data['id'];
                if($role == "barber"){
                    $folderPath = 'uploads/barber/profile/';
                }
                else{
                    $folderPath = 'uploads/customer/';
                }
                $image_base = base64_decode($data['base']);
                $image_type = $data['type'];
                $file = $folderPath . uniqid() .  ".".$image_type;
                if(file_put_contents($file, $image_base)){
                    $response = $auth_obj->update(["image" => $file], $id);
                    if ($response) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } 
            }
            
        } else {
            echo "Not an array";
        }
    }

    function validateField(){
        $data = json_decode(file_get_contents("php://input"), true);
        if(is_array($data) && count($data) > 0){ 
            if($data['role'] != null || $data['role'] != ""){
                $role = $data['role'];
                $field = $data['field'];
                $input = $data['input'];
                $id = $data['id'];
                $auth_obj = new $this->auth_api($role);
                $user = $auth_obj->checkField([$field=>$input, 'id'=>$id]);
                if(is_array($user) && count($user) > 0){
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
        }
    }



  









  

   




   

}
