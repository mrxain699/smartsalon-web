<?php
class Register extends Controller {

    private $message = '';
    private $errors = array();
    private $data = array();
    protected $register = null;
    function __construct(){
        
        $this->register = $this->load_model('Register');
    }

    function index($type = null, $message = null){
        if(!empty($type) && !empty($message)){
            $this->message = alert($type, $message);
        }
        if(is_array($_POST) && COUNT($_POST) > 0){
            $this->data = $_POST;
            $response = $this->_add($this->register, $this->data);
            if(is_array($response) && count($response) > 0){
                $this->errors = $response;
            } 
            else{
                $get_barber_id = $this->register->where('email', $this->data['email']);
                $_SESSION["BARBER_ID"] = $get_barber_id[0]['id'];
                $_SESSION["HAS_SALON"] = $get_barber_id[0]['has_salon'];
                $this->data = array();
                $this->redirect("/salon");
            }
        }
        $this->view('register',
        [   
            "alert"=>$this->message,
            "errors"=>$this->errors,
            "data"=>$this->data,

        ]);
    }

}
?>