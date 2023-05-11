<?php

class Recommendation extends Controller
{
    private $salon;
    private $salon_rating;
    private $service;
    private $service_category;
    private $appointment;
    private $booked_service;


    function __construct(){
        $this->salon = $this->load_model('Salon');
        $this->salon_rating = $this->load_model('Review');
        $this->service = $this->load_model('Service');
        $this->service_category = $this->load_model('Category');
        $this->appointment = $this->load_model('Appointment');
        $this->booked_service = $this->load_model('BookedService');
    }

    function salons(){

        echo json_encode($this->_all($this->salon));
    }

    function salon_ratings(){
        echo json_encode($this->_all($this->salon_rating));
    }

    function services(){
        echo json_encode($this->_all($this->service));
    }

    function service_categories(){
        echo json_encode($this->_all($this->service_category));
    }

    function appointments(){
        echo json_encode($this->_all($this->appointment));
    }

    function booked_services(){
        echo json_encode($this->_all($this->booked_service));
    }

}

?>