<?php
namespace Models;
class Salon extends \Model{
    protected $table = "salons";
    protected $customer_table = 'customers';
    private $id;
    private $name;
    private $address;
    private $city;
    private $certificate;
    private $image;
    private $about;
    private $open_time;
    private $close_time;
    private $barber_id;
    private $errors = array();



    function __construct($data = array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->address = $data['address'];
            $this->city = $data['city'];
            $this->certificate = $data['certificate'] != '' && $data['certificate'] != null ? $data['certificate'] : '';
            $this->image = in_array('file', $keys) ? $data['file'] : null;
            $this->about = in_array('about', $keys) ? $data['about'] : null;
            $this->open_time = in_array('open_time', $keys) ? $data['open_time'] : null;
            $this->close_time = in_array('close_time', $keys) ? $data['close_time'] : null;
            $this->barber_id = $data['barber_id'];
        }

    }

    function getId(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }

    function getAddress(){
        return $this->address;
    }

    function getCity(){
        return $this->city;
    }

    function getCertificate(){
        return $this->certificate;
    }

    function getImage(){
        return $this->image;
    }

    function getAbout(){
        return $this->about;
    }

    function getOpenTime(){
        return $this->open_time;
    }

    function getCloseTime(){
        return $this->close_time;
    }

    function getBarberId(){
        return $this->barber_id;
    }


    public function sanitize_data(){
        return array("name"=>$this->getName(), "address"=>$this->getAddress(),
        "city"=>$this->getCity(), "certificate"=>$this->getCertificate(), 
        "image"=>$this->getImage(), "about"=>$this->getAbout(),
        "open_time"=>$this->getOpenTime(), "close_time"=>$this->getCloseTime(),
        "barber_id"=>$this->getBarberId());
    }

    function  validate(){
        if(!validate_string($this->getName())){
            $this->errors['name'] = "Name only contains letters and whitespaces"; 
        }
        if(!validate_string($this->getCity())){
            $this->errors['city'] = "City only contains letters "; 
        }
        if($this->getId() == 0 and is_array($this->certificate)){
            $check_upload_status = validate_image($this->certificate);
            if($check_upload_status['status'] == "Ok"){
                $this->certificate = $check_upload_status['filename'];
            }
            else{
                $this->errors['certificate'] = $check_upload_status['message'];
            }
        }
       
        return $this->errors;
    }

    // function getSalons($city, $address){
    //     $query = "SELECT * FROM $this->table WHERE verified = 1";
    //     return $this->query($query);

    // }



    

}
?>