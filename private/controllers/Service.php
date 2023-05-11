<?php

class Service extends Controller{

    protected $service = null;
    protected $category = null;
    private $salon_id;
    function __construct(){
        
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->service = $this->load_model("Service");
        $this->category = $this->load_model("Category");
    }

    function index(){
        $services = array();
        $categories = array();
        $services = $this->_get($this->service, 'salon_id', $this->salon_id);
        $categories = $this->_get($this->category, 'salon_id', $this->salon_id);
        $this->view("barber/services",
        [
            "services"=>$services,
            "categories"=>$categories
        ]);
    }

    function all(){
        echo json_encode($this->_get($this->service, 'salon_id', $this->salon_id));
    }

    function get(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            if($id != null){
                $response = $this->_get($this->service, "id", $id);
                if(is_array($response) && count($response) > 0){
                    echo json_encode($response);
                }
                else{
                    echo 0;
                }
            }
           
        }
      
    }

    function getServicesType($category){
        
        if($category != null){
            $response = $this->_get($this->service, "category", $category);
            if(is_array($response) && count($response) > 0){

                echo count($response);
            }
            else{
                echo 0;
            }
        }
    }

    function getSalonServices($category, $salon_id){
        if($category != null && $salon_id !=null){
            $response = $this->service->whereAnd(["category"=>$category, "salon_id"=>$salon_id]);
            if(is_array($response) && count($response) > 0){

                echo json_encode($response);
            }
            else{
                echo 0;
            }
        }
    }

    function add(){
        if(is_array($_POST) and count($_POST) > 0){
            $data = $_POST;
            $response = $this->_add($this->service, $data);
            if(is_array($response) && count($response) > 0){
                echo json_encode($response);
            }
            else{
                echo 1;
            }
        }
        
    }

    function update(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            $response = $this->_update($this->service, $_POST, $id);
            if(is_array($response) && count($response) > 0){
                echo json_encode($response);
            }
            else if($response){
                echo 1;
            }
            else{
                echo 0;
            }
        }

    }

    function delete(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            if($id != null){
                $response = $this->_delete($this->service, $id);
                if($response){
                    echo 1;
                }
                else{
                    echo 0;
                }
            }
           
        } 
    }

    function search(){
        if(is_array($_POST) and count($_POST) > 0){
            $response = $this->service->searchAnd($_POST);
            if(is_array($response) && count($response) > 0){
                echo json_encode($response);
            }
            else{
                echo 0;
            }
        }
    }


}


?>