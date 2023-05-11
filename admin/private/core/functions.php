<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    function send_mail($to, $subject, $message){

        $mail = new PHPMailer(true);
        $address = EMAIL;
        try {
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $address;                    
            $mail->Password   = 'ehpferzihnrriusx';                             
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                   
            $mail->setFrom($address, 'SmartSalon');
            $mail->addAddress($to);    
            $mail->isHTML(false);                                  
            $mail->Subject = $subject;
            $mail->Body    = $message;;
            $mail->AltBody = $message;
            if($mail->send()){
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    function debug($data){
        if(is_array($data)){
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
        else{
            echo $data;
        }
    }

    function current_date(){
        return date("Y:m:d");
    }

    function cuerrent_time(){
        return date("h:i:s");
    }

    function alert($type, $message){
        if(!empty($type) && !empty($message)){
            if($type == "error"){
                $type = "danger";
            }
            return '
            <div class="alert alert-'.$type.' alert-dismissible fade show " role="alert">
            '.$message.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="text-dark">&times;</span>
            </button>
            </div>';
        }
        return '';
    }

    function upload_file($file){
        $newFile = "";
        $message = "";
        $status = "";
        if(trim($file['name'])){
            $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
            if(!checkExtension($ext)){
                $message = "Invalid Extension. Extension must be .jpg, .png, jpeg";
            }
            else if(!checkFileSize($file['size'])){
                $message = "Size of file must not exceed 5MB";
            }
            else{
                if(!file_exists("uploads/".$file['name'])){
                    $status  = "Ok";
                    $newFile = rand(111111111,999999999).".$ext";
                    $upload_directory = "uploads/".$newFile;
                    if(!move_uploaded_file($file['tmp_name'], $upload_directory))
                        $message =  "Something went wrong";
                }
                else{
                    $newFile = $file['name'];
                }
               
            }
        }

        return array("status"=>$status, "message"=>$message, "filename"=>$newFile);
        
    }

    function checkFileSize($size){
        return ($size<=(1024*1024*5));
    }

    function checkExtension($ext){
        $ext=strtolower($ext);
        if(!($ext == "jpg" || $ext == "png" || $ext == "jpeg" ))
            return false;
        return true;
    }



?>

