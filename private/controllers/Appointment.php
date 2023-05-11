<?php

class Appointment extends Controller{
    
    protected $appointment;
    protected $customer;
    protected $booked_service;
    protected $service;
    private $salon_id;

    function __construct(){
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->appointment = $this->load_model('Appointment');
        $this->booked_service = $this->load_model('BookedService');
        $this->service = $this->load_model('Service');
        $this->customer = $this->load_model('Customer');
    }

    function index(){
        
    }

    function booked_appointment(){
        $booked_appointments = $this->appointment->getStatusAppointments(["salon_id"=>$this->salon_id, "booked"=>1, "cancelled"=>0]);
        $this->view("barber/booked_appointment",
        [
            
            "booked_appointments"=>$booked_appointments,
            
        ]);
    }

    function cancelled_appointment(){
        $cancelled_appointments = $this->appointment->getStatusAppointments(["salon_id"=>$this->salon_id, "booked"=>0, "cancelled"=>1]);
        $this->view("barber/cancelled_appointment",
        [
            
            "cancelled_appointments"=>$cancelled_appointments,
            
        ]);
    }


    function get_customer($id){
        return $this->_get($this->customer, 'id', $id);
    }

    function get_services($id){
        $booked_services = array();
        $booked_services_id =  $this->_get($this->booked_service, 'appointment_id', $id);
        foreach($booked_services_id as $booked_service){
            $service = $this->_get($this->service, 'id', $booked_service['service_id']);
            array_push($booked_services, $service[0]);
        }
        return $booked_services;
    }

    function add(){
        $data = json_decode(file_get_contents("php://input"), true);
        if(is_array($data) && count($data)>0){
            $new_appointment = new $this->appointment($data);
            $response = $new_appointment->bookAppointment();
            if($response > 0){
                echo 1;
            }
            else{
                echo $response;
            }
        }
    }

    function get($customer_id){
        if($customer_id > 0){
            $appointments = $this->appointment->getAppointments(["customer_id"=>$customer_id, "cancelled"=>0]);
            if(is_array($appointments) && count($appointments) > 0){
                echo json_encode($appointments);
            }
            else{
                echo 0;
            }   
        }
    }

    function getAllAppointments($salon_id){
        if($salon_id > 0){
            $appointments = $this->appointment->whereAnd(["salon_id"=>$salon_id, "booked"=>1]);
            if(is_array($appointments) && count($appointments) > 0){
                echo json_encode($appointments);
            }
            else{
                echo 0;
            }   
        }
    }

    function getTodayBooked($salon_id){
        if($salon_id > 0){
            $appointments = $this->appointment->get_today_booked($salon_id);
            if(is_array($appointments) && count($appointments) > 0){
                echo json_encode($appointments);
            }
            else{
                echo 0;
            } 
            
        }
    }

    function booked($id){
        if($id > 0){
            $response = $this->appointment->update(["booked"=>1, "cancelled"=>0], $id);
            if($response){
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            echo -1;
        }
    }

    function cancelled($id){
        if($id > 0){
            $response = $this->appointment->update(["cancelled"=>1, "booked"=>0], $id);
            if($response){
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else{
            echo -1;
        }
    }

    function getByStatus($salon_id, $status){
        $appointments = array();
        if($salon_id > 0 && $status != null){
            if($status == "Pending"){
                $appointments = $this->appointment->getStatusAppointments(["salon_id"=>$salon_id, "booked"=>0, "cancelled"=>0]);
            }
            else if($status == "Booked"){
                $appointments = $this->appointment->getStatusAppointments(["salon_id"=>$salon_id, "booked"=>1, "cancelled"=>0]);
            }
            else if($status == "Cancelled"){
                $appointments = $this->appointment->getStatusAppointments(["salon_id"=>$salon_id, "booked"=>0, "cancelled"=>1]);
            }
        }
        if(is_array($appointments) && count($appointments) > 0){
            echo json_encode($appointments);
        }
        else{
            echo 0;
        }
    }

    function booked_by_salon($id){
        if($id > 0){
            $response = $this->appointment->update(["booked"=>1, "cancelled"=>0], $id);
            if($response){
                $_SESSION['message'] = "Appointment Booked Successfully";
                $_SESSION['message_type'] = 'success';
                $this->redirect('/dashboard');
            }
            else{
                $_SESSION['message'] = "Sorry, something went wrong";
                $_SESSION['message_type'] = 'error';
                $this->redirect('/dashboard');
            }
        }
        else{
            $_SESSION['message'] = "Sorry, something went wrong.";
            $_SESSION['message_type'] = 'error';
            $this->redirect('/dashboard');
        }
    }

    function cancel_by_salon($id){
        if($id > 0){
            $response = $this->appointment->update(["cancelled"=>1, "booked"=>0], $id);
            if($response){
                $_SESSION['message'] = "Appointment Cancelled Successfully";
                $_SESSION['message_type'] = 'success';
                $this->redirect('/dashboard');
            }
            else{
                $_SESSION['message'] = "Sorry, something went wrong";
                $_SESSION['message_type'] = 'error';
                $this->redirect('/dashboard');
            }
        }
        else{
            $_SESSION['message'] = "Sorry, something went wrong.";
            $_SESSION['message_type'] = 'error';
            $this->redirect('/dashboard');
        }
    }

    
}
?>