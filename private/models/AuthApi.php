<?php
namespace Models;
class AuthApi extends \Model{
    protected $table = "";
   

    function __construct($table_name = "") {
       if($table_name != ""){
        $this->table = $table_name."s";
       }
    }

    function login_user($data){
        $email = $data['email'];
        $password = md5($data['password']);
        $query = "SELECT * FROM  $this->table WHERE email = :email AND password = :password";
        $user = $this->query($query, ["email"=>$email, "password"=>$password]);
        if(is_array($user) && count($user) > 0){
            return $user[0]['id'];
        }
    }

    function checkField($data){
        $keys = array_keys($data);
        $query = "SELECT * FROM  $this->table WHERE $keys[0] = :$keys[0] AND $keys[1] != :$keys[1]";
        return $this->query($query, ["$keys[0]"=>$data[$keys[0]], "$keys[1]"=>$data[$keys[1]]]);
    }

   



   

}
?>