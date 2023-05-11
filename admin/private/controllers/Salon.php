<?php

class Salon extends Controller
{

    private $salon;
    private $barber;

    function __construct()
    {
        $this->salon = $this->load_model("Salon");
        $this->barber = $this->load_model("Barber");
    }

    function index()
    {
        $salons = $this->salon->getSalons();
        $this->view(
            "salons",
            [
                "salons" => $salons,
            ]
        );
    }

    function view_certificate($image)
    {
        if ($image != "") {
            $this->view('view_certificate', ["image" => $image]);
        }
    }

    function filter()
    {
        if (is_array($_POST) && count($_POST) > 0) {
            $data = $this->salon->filterSalon($_POST);
            if (is_array($data) && count($data) > 0) {
                echo json_encode($data);
            } else {
                echo 0;
            }
        }
    }

    function verify_request($salon_id, $barber_id)
    {
        if ($salon_id > 0 && $barber_id > 0) {
            $get_barber_email = $this->barber->getBarberEmail($barber_id);
            if ($get_barber_email) {
                $verify_salon = $this->salon->update(["verified" => 1], $salon_id);
                if ($verify_salon) {
                    $to = $get_barber_email;
                    $subject = "Salon Verification Request";
                    $message =  "Your salon verification request has been verified";
                    $header = "From:" . EMAIL . "\r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    if (send_mail($to, $subject, $message)) {
                        $_SESSION['message'] = "Salon Verified Successfully";
                        $_SESSION['message_type'] = "success";
                        $this->redirect('home');
                    }
                } else {
                    $_SESSION['message'] = "Sorry, something went wrong";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('home');
                }
            } else {
                $_SESSION['message'] = "Sorry, something went wrong";
                $_SESSION['message_type'] = "error";
                $this->redirect('home');
            }
        }
    }

    function cancel_request($salon_id, $barber_id)
    {
        if ($salon_id > 0 && $barber_id > 0) {
            $get_barber_email = $this->barber->getBarberEmail($barber_id);
            if ($get_barber_email) {
                $verify_salon = $this->salon->update(["cancelled" => 1], $salon_id);
                if ($verify_salon) {
                    $to = $get_barber_email;
                    $subject = "Salon Verification Request";
                    $message =  "Your salon verification request has been cancelled";
                    $header = "From:" . EMAIL . "\r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    if (send_mail($to, $subject, $message)) {
                        $_SESSION['message'] = "Salon Rejected Successfully";
                        $_SESSION['message_type'] = "success";
                        $this->redirect('home');
                    }
                } else {
                    $_SESSION['message'] = "Sorry, something went wrong";
                    $_SESSION['message_type'] = "error";
                    $this->redirect('home');
                }
            } else {
                $_SESSION['message'] = "Sorry, something went wrong";
                $_SESSION['message_type'] = "error";
                $this->redirect('home');
            }
        }
    }
    
}
