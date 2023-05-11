<?php
namespace Models;

class Worker extends \Model{
    
    protected $table = "salon_workers";
    private $id = 0;
    private $firstname = '';
    private $lastname  = '';
    private $phone = '';
    private $salon_id = 0;
    private $image = '';
    private $errors = array();

    function __construct($data = array()){
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->firstname = $data['firstname'];
            $this->lastname = $data['lastname'];
            $this->phone = $data['phone'];
            $this->salon_id = $data['salon_id'];
            $this->image = in_array('image', $keys) ? $data['image'] : null;
        }
    }

    function getId(){
        return $this->id;
    }

    function getFirstName(){
        return $this->firstname;
    }

    function getLastName(){
        return $this->lastname;
    }

    function getPhone(){
        return $this->phone;
    }

    function getImage(){
        return $this->image;
    }

    function getSalonId(){
        return $this->salon_id;
    }

    function sanitize_data(){
        return array("firstname"=>$this->getFirstName(), "lastname"=>$this->getLastName(),
        "image"=>$this->getImage(), "phone"=>$this->getPhone(), "salon_id"=>$this->getSalonId());
    }


    function validate(){
        $get_id = $this->where("phone",$this->getPhone());
        $get_id = is_array($get_id) ? $get_id[0]['id'] : 0;
        if(!validate_string($this->getFirstName())){
            $this->errors['firstname'] = "FirstName only contains letters and whitespaces"; 
        }
        if(!validate_string($this->getLastName())){
            $this->errors['lastname'] = "LastName only contains letters and whitespaces"; 
        }
        if(!validate_phone($this->getPhone())){
            $this->errors['phone'] = "Invalid phone number"; 
        }
        if($get_id > 0 && $get_id != $this->getId()){
            $this->errors['phone'] = "Phone number already exist"; 
        }
        return $this->errors;
    }

}

?>