<?php

class Category extends Controller{
    protected $category = null;
    private $salon_id;
    function __construct(){
      
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->category = $this->load_model("Category");
    }

    function index(){
        $categories = array();
        $categories = $this->_get($this->category, 'salon_id', $this->salon_id);
        $this->view("barber/categories",
        [
            "categories"=>$categories,
        ]);
    }


    function all(){
        echo json_encode($this->_get($this->category, 'salon_id', $this->salon_id));
    }

    function get(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            if($id != null){
                $response = $this->_get($this->category, "id", $id);
                if(is_array($response) && count($response) > 0){
                    echo json_encode($response);
                }
                else{
                    echo 0;
                }
            }
           
        }
      
    }

    function getCategories($salon_id){

        if($salon_id != null){
            $response = $this->_get($this->category, "salon_id", $salon_id);
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
            $response = $this->_add($this->category, $_POST);
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

    function update(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            $response = $this->_update($this->category, $_POST, $id);
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
                $response = $this->_delete($this->category, $id);
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
            $response = $this->category->searchAnd($_POST);
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