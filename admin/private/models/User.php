<?php
namespace Models;
class User extends \Model{

    protected $table = "users";
    private $id = 0;
    private $firstname = '';
    private $lastname = '';
    private $email = '';
    private $phone = '';
    private $password = '';
    private $rank = '';
    private $status = '';
    private $errors = array();



    function __construct($data=array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->firstname = $data['firstname'];
            $this->lastname = $data['lastname'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->password = in_array('password', $keys) ? $data['password'] : '';
            $this->rank = in_array('rank', $keys) ? $data['rank'] : "active";
            $this->status = in_array('status', $keys) ? $data['status'] : "active";
        }

    }



    public function getId(){
        return $this->id;
    }
    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }


    public function getPassword(){
        return $this->password;
    }

   

    public function getRank(){
        return $this->rank;
    }

    public function getStatus(){
        return $this->status;
    }

 

    public function sanitize_data(){
        if($this->getId()>0){
            return array("id"=>$this->getId(), "firstname"=>$this->getFirstname(), "lastname"=>$this->getLastname(), 
                "email"=>$this->getEmail(), "phone"=>$this->getPhone(), "rank"=>$this->getRank(),
               "status"=>$this->getStatus());
        }
        else{
            return array("id"=>$this->getId(), "firstname"=>$this->getFirstname(), "lastname"=>$this->getLastname(), 
                "email"=>$this->getEmail(), "phone"=>$this->getPhone(), "password"=>md5($this->getPassword()),
                "rank"=>$this->getRank(),  "status"=>$this->getStatus());
        }
        
    }

    public function validate(){
        $email = $this->where("email",$this->getEmail());
        $phone = $this->where("phone",$this->getPhone());
        $email = is_array($email) ? $email[0]['id'] : 0;
        $phone = is_array($phone)? $phone[0]['id'] : 0;
        if(validate_string($this->getFirstName())){
            $this->errors['firstname'] = "Firstname only contain letters"; 
        }
        if(validate_string($this->getLastName())){
            $this->errors['lastname'] = "Lastname only contains letters"; 
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
        
        return $this->errors;
    }

    function validate_image($image){
        if(is_array($image) && count($image) > 0){
            $file = upload_file($image);
            if(is_array($file)){
                if(empty($file['message'])){
                    return $image[0] = $file['filename'];
                }
                else{
                    return $this->errors['image'] = $file['message'];
                }
            }
            
        } 
    }

    

    public function login($data){
        $keys = array_keys($data);
        $email = $data['email'];
        $password = md5($data['password']);
        $query = "SELECT * FROM  $this->table WHERE $keys[0] = :email AND $keys[1] = :password";
        $user = $this->query($query, ["email"=>$email, "password"=>$password]);
        return $user;
    }

    public function reset_password($id, $password){
        $password = md5($password);
        $query = "UPDATE $this->table SET password = :password WHERE id = :id";
        return  $this->query($query, ["password"=>$password, "id"=>$id]);
    }


}

?>