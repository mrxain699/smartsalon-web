<?php

class Worker extends Controller{

    protected $worker = null;
    private $salon_id;

    function __construct(){
        
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->worker = $this->load_model('Worker'); 
    }

    function index(){
        $workers = array();
        $workers = $this->_get($this->worker, 'salon_id', $this->salon_id);

        $this->view("barber/workers",
        [
            "workers"=>$workers
        ]);
    }

    
    function all(){
        echo json_encode($this->_get($this->worker, 'salon_id', $this->salon_id));
    }

    function getWorker(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            if($id != null){
                $response = $this->_get($this->worker, "id", $id);
                if(is_array($response) && count($response) > 0){
                    echo json_encode($response);
                }
                else{
                    echo 0;
                }
            }
           
        }
      
    }

     function get($salon_id){

        if($salon_id != null){
            $response = $this->_get($this->worker, "salon_id", $salon_id);
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
            $file = $_POST['image'];
            $temp = base64_decode($_POST['temp']);
            if(file_put_contents($file, $temp)){
                $response = $this->_add($this->worker, $_POST);
                if(is_array($response) && count($response) > 0){
                    echo json_encode($response);
                }
                else{
                    echo 1;
                }  
            }
           
        }
        
    }

    function update(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            $file = $_POST['image'];
            $temp = base64_decode($_POST['temp']);
            if(!empty($temp)){
                if(file_put_contents($file, $temp)){
                    $response = $this->_update($this->worker, $_POST, $id);
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
            else{
                $response = $this->_update($this->worker, $_POST, $id);
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

    }

    function delete(){
        if(is_array($_POST) and count($_POST) > 0){
            $id = $_POST['id'];
            if($id != null){
                $response = $this->_delete($this->worker, $id);
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
            $response = $this->worker->searchAnd($_POST);
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