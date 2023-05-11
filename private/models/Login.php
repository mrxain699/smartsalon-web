<?php
namespace Models;
class Login extends \Model{
    
    protected $table = "barbers";
    
    public function login($data){
        $email = $data['email'];
        $password = md5($data['password']);
        $query = "SELECT * FROM  $this->table WHERE email = :email AND password = :password";
        $user = $this->query($query, ["email"=>$email, "password"=>$password]);
        return $user;
    }

}

?>