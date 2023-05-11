<?php

class Customer extends Controller {


    function __construct(){
        $this->customer = $this->load_model("Customer");
    }

    function index(){
        $customers = $this->_all($this->customer);
        $this->view("customers",
        [
            "customers"=>$customers,
        ]);
    }

    

    function delete($id = null){
        if($id != null){
            $res = $this->customer->delete($id);
            if($res){
                $_SESSION['message'] = "Customer deleted successfully";
                $_SESSION['message_type'] = "success";
                $this->redirect('customer'); 
            }
            else{
                $_SESSION['message'] = "Sorry, something went wrong!";
                $_SESSION['message_type'] = "error";
                $this->redirect('customer'); 
            }
        }

    }



    function filter(){
        if(is_array($_POST) && count($_POST) > 0){
            $data = $this->_filter($this->customer, $_POST);
            if(is_array($data) && count($data) > 0){
                echo json_encode($data);
            }
            else{
                echo 0;
            }
        }
           
    }

    function search(){
        if(is_array($_POST) && count($_POST) > 0){
            $data = $this->_search($this->customer, "name", $_POST);
            if(is_array($data) && count($data) > 0){
                echo json_encode($data);
            }
            else{
                echo 0;
            } 
        } 
    }


    
}

?>