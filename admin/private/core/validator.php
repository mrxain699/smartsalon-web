<?php

    function validate_string($name){
        if(!preg_match('/^[a-zA-Z]+$/', $name) && !empty($name)){
           return true; 
        }
        return false;
    }

    function validate_email($email){
        if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
        
    }

    function validate_phone($phone){
        if((strlen($phone) < 11 or strlen($phone) > 11 or !is_numeric($phone)) && !empty($phone)){
            return true;
        }
        return false;
    }


    function validate_password($password){
        if(!empty($password) && strlen($password) < 8){
            return true; 
        }
        return false;
    }

  

    

?>