<?php

class Gallery extends Controller{
    protected $gallery;
    private $salon_id;

    function __construct(){
        
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->gallery = $this->load_model("Gallery");
    }

    function index(){
        $images = $this->_get($this->gallery, 'salon_id', $this->salon_id);
        $this->view("barber/gallery",
        [
            "images"=>$images,
        ]);
    }


    function all(){
        echo json_encode($this->_get($this->gallery, 'salon_id', $this->salon_id));
    }

    function getImages($salon_id){
         if($salon_id != null){
            $response = $this->_get($this->gallery, "salon_id", $salon_id);
            if(is_array($response) && count($response) > 0){
                echo json_encode($response);
            }
            else{
                echo 0;
            }
        }
    }

    function upload(){
        $folderPath = 'uploads/barber/gallery/';
        $image = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image[1]);
        $file = $folderPath . uniqid() .  ".".$image_type;
        $_POST['image'] = $file;
        if(file_put_contents($file, $image_base64)){
            $response = $this->gallery->insert($_POST);
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

    function delete(){
        if(is_array($_POST) and count($_POST) > 0){
            if($_POST['id'] != null){
                $image = $this->_get($this->gallery, 'id', $_POST['id']);
                $response = $this->_delete($this->gallery, $_POST['id']);
                if($response){
                    unlink($image[0]['image']);
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
           
        }  
    }
}
?>