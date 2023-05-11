<?php

class Profile extends Controller{

    private $errors = array();
    private $data = array();
    private $id = null;
    protected $barber = null;
    

    function __construct() {
       
        $this->barber = $this->load_model("Register");
        if(isset($_SESSION['BARBER_ID'])){
            $this->id =$_SESSION['BARBER_ID'];
        }
    }

    function index(){
        $barber = $this->barber->where("id", $this->id);
        $this->data = $barber[0];
        $this->view("barber/profile",
        [
            "data"=>$this->data,
        ]);
    }

    function update_image(){
        $folderPath = 'uploads/';
        $image = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image[1]);
        $file = $folderPath . uniqid() .  ".".$image_type;
        if(file_put_contents($file, $image_base64)){
            $response = $this->barber->update(["image"=>$file], $this->id);
            if($response){
                $get_updated_barber = $this->barber->where("id", $this->id);
                $_SESSION['IMAGE'] = ucfirst($get_updated_barber[0]['image']);
                echo 1;
            }
            else{
                echo 0;
            }
        }
    }

    function update(){
        if(is_array($_POST) && count($_POST) > 0){
            $this->data = $_POST;
            $response = $this->_update($this->barber, $this->data, $this->id);
            if(is_array($response) && count($response) > 0){
                $this->errors = $response;
            }
            else if($response){
                $get_updated_barber = $this->barber->where("id", $this->id);
                $_SESSION['USER'] = ucfirst($get_updated_barber[0]['name']);
                $_SESSION['message'] = "Profile update successfully!";
                $_SESSION['message_type'] = "success";
                $this->redirect("/profile");
            } 
            else{
                $_SESSION['message'] = "Sorry, Something went wrong!";
                $_SESSION['message_type'] = "warning";
                $this->redirect("/profile");
            }
        }
        if(!empty($this->errors)){
            $_SESSION['errors'] = $this->errors;
            $this->redirect("/profile");
        }
    }

    function change_password(){
        if(is_array($_POST) && count($_POST) > 0){
            $this->data = $_POST;
            $password = $this->data['password'];
            $confirm_password = $this->data['cpass'];
            if($password != $confirm_password){
                $this->errors["cpass"] = "Confirm password didn't match"; 
            }
            else{
                if(validate_password($password)){
                    $res = $this->barber->update(["password"=>md5($password)], $this->id);
                    if($res){
                        $_SESSION['message'] = "Password changed successfully!";
                        $_SESSION['message_type'] = "success";
                        $this->redirect("/profile");
                    }
                    else{
                        $_SESSION['message'] = "Sorry, Something went wrong!";
                        $_SESSION['message_type'] = "warning";
                        $this->redirect("/profile");
                    }
                }
                else{
                    $this->errors["password"] = "Password shoud be minimum 8 characters";  
                }
            }
            
        }
        if(!empty($this->errors)){
            $_SESSION['errors'] = $this->errors;
            $this->redirect("/profile");
        }
    }
}

?>