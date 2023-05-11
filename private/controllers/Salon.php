<?php
class Salon extends Controller {

    private $message = "";
    private $errors = array();
    private $data = array();
    private $salon_id = 0;
    private $barber_id = 0;
    protected $salon = null;
    protected $customer;
    
    function __construct() {
        
        $this->salon = $this->load_model("Salon");
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        if(isset($_SESSION["BARBER_ID"])){
            $this->barber_id = $_SESSION["BARBER_ID"];
        }

        $this->customer = $this->load_model("Customer");
    
    }

    function get($id){
        if($id > 0){
            $salon = $this->_get($this->salon, 'barber_id', $id);
            if(is_array($salon) && count($salon) > 0){
                echo json_encode($salon);
            }
            else{
                echo -1;
            }
        }
    }

    function get_all($customer_id){
        // $customer = $this->customer->where('id', $customer_id);
        // $city = $customer[0]['city'];
        // $address = $customer[0]['address'];
        $salons = $this->salon->where("verified", 1);
        if(is_array($salons) && count($salons) > 0){
            echo json_encode($salons);
        }
        else{
            echo 0;
        }
        
    }

    function index() {
        if(is_array($_POST) && COUNT($_POST) > 0){
            $this->data = $_POST;
            $this->data["certificate"] = $_FILES['img'];
            $this->data["barber_id"] = $this->barber_id;
            $response = $this->_add($this->salon, $this->data);
            if(is_array($response) && count($response) > 0){
                $this->errors = $response;
            } 
            else{
                $barber = $this->load_model("Register");
                if($barber->update(["has_salon"=>1], $this->barber_id)){
                    $this->data = array();
                    $_SESSION['message'] = "Your registration request has been submitted. You will be notified by an email within 24-hours when your registration request will verified.";
                    $_SESSION['message_type'] = 'success';  
                }
            }
        }
        $this->view("register_salon",
        [   
            "alert"=>$this->message,
            "errors"=>$this->errors,
            "data"=>$this->data,
        ]);
    }

    function profile(){
        if(is_array($_POST) && count($_POST) > 0){
            $data = $_POST;
            $id = $data['id'];
            $data['barber_id'] = $this->barber_id;
            if(!file_exists($data['file']) && $data['temp'] != ""){
                if(file_put_contents($data['file'], base64_decode($data['temp']))){
                    $response = $this->_update($this->salon, $data, $id);
                    if(is_array($response) && count($response) > 0){
                        $this->errors = $response;
                        
                    }
                    else{
                        $_SESSION['message'] = "Salon Profile updated successfully!";
                        $_SESSION['message_type'] = 'success'; 
                    } 
                }
            }
            else{
                $response = $this->_update($this->salon, $data, $id);
                if(is_array($response) && count($response) > 0){
                    $this->errors = $response;
                }
                else{
                    $_SESSION['message'] = "Salon Profile updated successfully!";
                    $_SESSION['message_type'] = 'success'; 
                } 
            }

        } 

        $salon_profile = $this->salon->where("id", $this->salon_id);
        $this->view('barber/salon_profile',
        [
            "salon_profile"=>$salon_profile[0],
        ]);
    }

}
?>