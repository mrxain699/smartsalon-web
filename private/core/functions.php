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
            $mail->Body    = $message;
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




?>

