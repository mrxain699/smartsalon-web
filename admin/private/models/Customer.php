<?php
namespace Models;
class Customer extends \Model{
    protected $table = "customers";
    private $id = 0;
    private $name = '';
    private $email = '';
    private $phone = '';
    private $address = '';
    private $password = '';
    private $image = array();
    private $errors = array();

    function __construct($data=array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->address = $data['address']; 
            $this->password = in_array('password', $keys) ? $data['password'] : '';
            $this->image = in_array('image', $keys) ? $data['image'] : array();
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

    public function getAddress(){
        return $this->address;
    }


    public function getPassword(){
        return $this->password;
    }

    public function getImage(){
        if(count($this->image) > 0){
            return $this->image[0];
        }
        else{
            return null;
        }
    }


    public function sanitize_data(){
        if($this->getId() > 0){
            return array("id"=>$this->getId(), "name"=>$this->getName(), "email"=>$this->getEmail(),
            "phone"=>$this->getPhone(), "address"=>$this->getAddress(), "image"=>$this->getImage());
        }
        else{
            return array("name"=>$this->getName(), "email"=>$this->getEmail(), "phone"=>$this->getPhone(),
            "address"=>$this->getAddress(), "password"=>$this->getPassword(), "image"=>$this->getImage());
        }
        
    }


    public function validate(){
        $email = $this->where("email",$this->getEmail());
        $phone = $this->where("phone",$this->getPhone());
        $email = is_array($email) ? $email[0]['id'] : 0;
        $phone = is_array($phone)? $phone[0]['id'] : 0;
        if(validate_string($this->getName())){
            $this->errors['name'] = "Name only contain letters and white-space"; 
        }
        if(validate_email($this->getEmail())){
            $this->errors['email'] = "Email is invalid"; 
        }
        if(validate_phone($this->getPhone())){
            $this->errors['phone'] = "Invalid phone number"; 
        }
        if(validate_password($this->getPassword())){
            $this->errors['password'] = "Password should be min 8 characters"; 
        }
        if($email > 0 && $email != $this->getId()){
            $this->errors['email'] = "Email already exist"; 
        }
        else if($phone > 0 && $phone != $this->getId()){
            $this->errors['phone'] = "Phone number already exist"; 
        }
        if(count($this->image) > 0){
            $file = upload_file($this->image);
            if(is_array($file)){
                if(empty($file['message'])){
                    $this->image[0] = $file['filename'];
                }
                else{
                    $this->errors['image'] = $file['message'];
                }
            }
            
        } 
        
        return $this->errors;
    }


   

}
?>