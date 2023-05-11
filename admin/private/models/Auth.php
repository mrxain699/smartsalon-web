<?php

class Auth{
     
    public static function authenticate($user){
        $_SESSION['ID'] = $user[0]['id'];
        $_SESSION['USER'] = ucfirst($user[0]['firstname'])." ".ucfirst($user[0]['lastname']);
        $_SESSION['ROLE'] = $user[0]['rank'];
        $_SESSION['IMAGE'] = $user[0]['image'];
        
    
    }

    public static function logout(){
        if(isset($_SESSION['ID'])){
            unset($_SESSION['ID']);
            unset($_SESSION['USER']);
            unset($_SESSION['ROLE']);
            unset($_SESSION['IMAGE']); 
        }
    }

    public static function logged_in(){
        if(isset($_SESSION['ID'])){
            return true;
        }
        return false;
    }


}

?>