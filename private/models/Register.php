<?php
namespace Models;
class Register extends \Model{

    protected $table = "barbers";
    private $id = 0;
    private $name = '';
    private $email = '';
    private $phone = '';
    private $cnic = '';
    private $password = '';
    private $errors = array();
    



    function __construct($data=array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->cnic = $data['cnic'];
            $this->password = in_array('password', $keys) ? $data['password'] : '';
        }

    }


    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getCnic(){
        return $this->cnic;
    }

    public function getPassword(){
        return $this->password;
    }

 
 

    public function sanitize_data(){
        if($this->getId()>0){
            return array("name"=>$this->getName(), "email"=>$this->getEmail(),
            "phone"=>$this->getPhone(), "cnic"=>$this->getCnic());
        }
        return array("name"=>$this->getName(), "email"=>$this->getEmail(),
        "phone"=>$this->getPhone(), "cnic"=>$this->getCnic(), "password"=>md5($this->getPassword()));

        
    }

    public function validate(){
        $email = $this->where("email",$this->getEmail());
        $phone = $this->where("phone",$this->getPhone());
        $cnic = $this->where("cnic",$this->getCnic());
        $email = is_array($email) ? $email[0]['id'] : 0;
        $phone = is_array($phone)? $phone[0]['id'] : 0;
        $cnic = is_array($cnic)? $cnic[0]['cnic'] : 0;
        if(!validate_string($this->getName())){
            $this->errors['name'] = "Name only contains letters and whitespaces"; 
        }
        if(!validate_email($this->getEmail())){
            $this->errors['email'] = "Email is invalid"; 
        }
        if(!validate_phone($this->getPhone())){
            $this->errors['phone'] = "Invalid phone number"; 
        }
        if(!validate_cnic($this->getCnic())){
            $this->errors['cnic'] = "Invalid CNIC number"; 
        }
        if(!validate_password($this->getPassword())){
            $this->errors['password'] = "Password should be min 8 characters"; 
        }
        if($email > 0 && $email != $this->getId()){
            $this->errors['email'] = "Email already exist"; 
        }
        else if($phone > 0 && $phone != $this->getId()){
            $this->errors['phone'] = "Phone number already exist"; 
        }
        else if($cnic > 0 && $cnic != $this->getId()){
            $this->errors['cnic'] = "Cnic already exist"; 
        }
        return $this->errors;
    }

    

}

?>