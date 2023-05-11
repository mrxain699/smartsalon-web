<?php
class Product extends Controller{
    private $product;
    private $salon_id;

    function __construct(){
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->product  = $this->load_model("Product");
    }

    function index(){
        $products = $this->_get($this->product, 'salon_id', $this->salon_id);
        $this->view('barber/products', ["products"=>$products]);
    }

    function get($s_id = null){
        if($s_id == null){
            $products = $this->_get($this->product, 'salon_id', $this->salon_id);
            echo json_encode($products);
        }
        else{
            $products = $this->_get($this->product, 'salon_id', $s_id);
            echo json_encode($products);
        }
        
    }

    

    function getById($product_id){
        $products = $this->_get($this->product, 'id', $product_id);
        echo json_encode($products);
    }

    function add(){
        if(is_array($_POST) and count($_POST) > 0){
            $file = $_POST['image'];
            $temp = base64_decode($_POST['temp']);
            if(file_put_contents($file, $temp)){
                $response = $this->_add($this->product, $_POST);
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
                    $response = $this->_update($this->product, $_POST, $id);
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
                $response = $this->_update($this->product, $_POST, $id);
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
                $response = $this->_delete($this->product, $id);
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
            $response = $this->product->searchAnd($_POST);
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