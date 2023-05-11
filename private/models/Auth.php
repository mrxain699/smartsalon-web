<?php
class Auth{
     
    public static function authenticate($barber){
        $_SESSION['BARBER_ID'] = $barber['id'];
        $_SESSION['USER'] = ucfirst($barber['name']);
        $_SESSION['HAS_SALON'] = ucfirst($barber['has_salon']);
        $_SESSION['IMAGE'] = ucfirst($barber['image']);
    
    }

    public static function logout(){
        if(isset($_SESSION['BARBER_ID'])){
            unset($_SESSION['BARBER_ID']);
            unset($_SESSION['USER']);
            unset($_SESSION['IMAGE']);
            unset($_SESSION['SALON_ID']);

        }
    }

    public static function logged_in(){
        if(isset($_SESSION['BARBER_ID'])){
            return true;
        }
        return false;
    }

  


}

?>