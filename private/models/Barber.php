<?php
namespace Models;
class Barber extends \Model{
    protected $table = "barbers";
    private $id = 0;
    private $name = '';
    private $email = '';
    private $phone = '';
    private $address = '';
    private $city = '';
    private $password = '';
    private $errors = array();

    function __construct($data=array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->address = $data['address']; 
            $this->city = $data['city']; 
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

    public function getAddress(){
        return $this->address;
    }

    public function getCity(){
        return $this->city;
    }


    public function getPassword(){
        return $this->password;
    }




    public function sanitize_data(){
        return array("name"=>$this->getName(), "email"=>$this->getEmail(), "phone"=>$this->getPhone(),
        "address"=>$this->getAddress(), "city"=>$this->getCity(),  "password"=>md5($this->getPassword()));
        
    }


    public function validate(){
        $email = $this->where("email",$this->getEmail());
        $phone = $this->where("phone",$this->getPhone());
        $email_id = is_array($email) ? $email[0]['id'] : 0;
        $phone_id = is_array($phone)? $phone[0]['id'] : 0;
        if(!validate_string($this->getName())){
            $this->errors['name'] = "Name only contain letters and white-space"; 
        }
        if(!validate_email($this->getEmail())){
            $this->errors['email'] = "Email is invalid"; 
        }
        if(!validate_phone($this->getPhone())){
            $this->errors['phone'] = "Invalid phone number"; 
        }
        if(!validate_string($this->getCity())){
            $this->errors['city'] = "City only contain letters"; 
        }
        if(!validate_password($this->getPassword())){
            $this->errors['password'] = "Password should be min 8 characters"; 
        }
        if($email_id > 0 && $email_id != $this->getId()){
            $this->errors['email'] = "Email already exist"; 
        }
        if($phone_id > 0 && $phone_id != $this->getId()){
            $this->errors['phone'] = "Phone number already exist"; 
        }

        return $this->errors;
    }

    function login($data){
        $email = $data['email'];
        $password = md5($data['password']);
        $query = "SELECT * FROM  $this->table WHERE email = :email AND password = :password";
        $customer = $this->query($query, ["email"=>$email, "password"=>$password]);
        if(is_array($customer)){
            return $customer[0]['id'];
        }
    }

   



   

}
?>