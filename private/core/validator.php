<?php

    function validate_string($name){
        if(!preg_match('/^[a-zA-Z\s]+$/', $name) && !empty($name)){
           return false; 
        }
        return true;
    }

    function validate_email($email){
        if(!filter_var(trim($email), FILTER_VALIDATE_EMAIL) || !check_domain($email)){
            return false;
        }
        return true;
        
    }

    function check_domain($email){
        $domains = array("com", "outlook", "yahoo");
        $email_domain = explode(".", $email);
        if(!in_array($email_domain[1], $domains)){
            return false;
        }
        return true;
    }

    function validate_phone($phone){
        if((strlen($phone) < 11 or strlen($phone) > 11 or !is_numeric($phone) or !check_phone_code($phone)) && !empty($phone)){
            return false;
        }
        return true;
    }

    function check_phone_code($phone){
        $phone_codes = array("030", "031", "032", "033", "034");
        if(!in_array(substr($phone, 0, 3), $phone_codes)){
            return false;
        }
        return true;

    }

    function validate_cnic($cnic){
        if(strlen($cnic) < 13 || strlen($cnic) > 13 || !validate_cnic_code($cnic) || substr($cnic, strlen($cnic) - 1) == "0"){
            return false;
        }
        return true;

    }

    function validate_cnic_code($cnic){
        $cnic_code = ["1", "2", "3", "4", "5", "6", "7"];
        if(!in_array(substr($cnic, 0, 1), $cnic_code)){
            return false;
        }
        return true;
    }

    function validate_password($password){
        if(!empty($password) && strlen($password) < 8){
            return false; 
        }
        return true;
    }

    function validate_image($file){
        $newFile = "";
        $message = "";
        $status = "";
        if(trim($file['name'])){
            $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
            if(!checkExtension($ext)){
                $message = "Invalid Extension. Extension should be .jpg, .png, .jpeg";
            }
            else if(!checkFileSize($file['size'])){
                $message = "Size of file must not exceed 10MB";
            }
            else{
                if(!file_exists("uploads/".$file['name'])){
                    $newFile = rand(111111111,999999999).".$ext";
                    $upload_directory = "uploads/".$newFile;
                    if(move_uploaded_file($file['tmp_name'], $upload_directory)){
                        $status  = "Ok";
                    }
                    else{
                        $message =  "Something went wrong";
                    }
    
                }
               
            }
        }

        return array("status"=>$status, "message"=>$message, "filename"=>$newFile);
    }

    function checkFileSize($size){
        return ($size<=(1024*1024*10));
    }

    function checkExtension($ext){
        $ext=strtolower($ext);
        $extensions = ["jpg", "png", "jpeg", "pdf"];
        if(!in_array($ext, $extensions))
            return false;
        return true;
    }

  

    

?>