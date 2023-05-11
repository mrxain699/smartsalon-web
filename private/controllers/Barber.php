<?php

class Barber extends Controller
{
    protected $barber;

    function __construct()
    {
        
        $this->barber = $this->load_model("Barber");
    }

    function get()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (is_array($data) and count($data) > 0) {
            $id = $data['id'];
            $get_barber = $this->_get($this->barber,'id', $id);
            if(is_array($get_barber) && count($get_barber) > 0){
                echo json_encode($get_barber[0]);
            }
            else{
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    // function getCustomer($id){
    //     if($id > 0){
    //         $get_customer = $this->_get($this->customer, "id", $id);
    //         if($get_customer){
    //             echo json_encode($get_customer[0]);
    //         }
    //     }

    // }

    // function register()
    // {
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     if (is_array($data) and count($data) > 0) {
    //         $response = $this->_add($this->customer, $data);
    //         if (is_array($response) && count($response) > 0) {
    //             echo json_encode($response);
    //         } else {
    //             $get_latest_customer = $this->customer->where("email", $data['email']);
    //             echo $get_latest_customer[0]['id'];
    //         }
    //     } else {
    //         echo 0;
    //     }
    // }

    // function login()
    // {
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     if (is_array($data) and count($data) > 0) {
    //         $id = $this->customer->login($data);
    //         if ($id > 0) {
    //             echo json_encode(array("customer_id" => $id));
    //         } else {
    //             echo 0;
    //         }
    //     }
    // }



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
                $response = $this->barber->update(["image" => $file], $id);
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




    // function update()
    // {
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     if (is_array($data) && count($data) > 0) {
    //         $keys = array_keys($data);
    //         $id = $data['id'];
    //         $column = $keys[0];
    //         $response = $this->customer->update([$column=>$data[$column]], $id);
    //         if($response){
    //             echo 1;
    //         }
    //         else{
    //             echo 0;
    //         }

    //     }
    //     else{
    //         echo 0;
    //     }
    // }

}
