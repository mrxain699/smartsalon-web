<?php

class Customer extends Controller
{
    protected $customer;

    function __construct()
    {
        $this->customer = $this->load_model("Customer");
    }

    function get()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            $id = $data['id'];
            $get_customer = $this->_get($this->customer,'id', $id);
            if(is_array($get_customer) && count($get_customer) > 0){
                echo json_encode($get_customer[0]);
            }
            else{
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    function getCustomer($id){
        if($id > 0){
            $get_customer = $this->_get($this->customer, "id", $id);
            if($get_customer){
                echo json_encode($get_customer[0]);
            }
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
            $id = $this->customer->login($data);
            if ($id > 0) {
                echo json_encode(array("customer_id" => $id));
            } else {
                echo 0;
            }
        }
    }




    function sendmail()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            $email = $data['email'];
            $email_exist = $this->customer->where("email", $email);
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
            } else {
                echo 0;
            }
        }
    }

    function reset_password()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            $id = $data['id'];
            $password = $data['password'];
            $response = $this->customer->update(["password" => md5($password)], $id);
            if ($response) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    function upload_image()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) && count($data) > 0) {
            $folderPath = 'uploads/customer/';
            $id = $data['id'];
            $image_base = base64_decode($data['base']);
            $image_type = $data['type'];
            $file = $folderPath . uniqid() .  ".".$image_type;
            if(file_put_contents($file, $image_base)){
                $response = $this->customer->update(["image" => $file], $id);
                if ($response) {
                    echo 1;
                } else {
                    echo 0;
                }
            } 
        } else {
            echo "Not an array";
        }
    }




    function update()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) && count($data) > 0) {
            $keys = array_keys($data);
            $id = $data['id'];
            $column = $keys[0];
            $response = $this->customer->update([$column=>$data[$column]], $id);
            if($response){
                echo 1;
            }
            else{
                echo 0;
            }

        }
        else{
            echo 0;
        }
    }

}
