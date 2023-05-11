<?php
namespace Models;
class Service extends \Model{
    protected $table = "services";
    private $id = 0;
    private $name = '';
    private $price = 0.0;
    private $duration = '';
    private $category = '';
    private $salon_id = 0;
    private $errors = array();

    function __construct($data = array()){
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->price = abs($data['price']);
            $this->duration = $data['duration'];
            $this->category = $data['category'];
            $this->salon_id = $data['salon_id'];
        }
    }

    
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getSalonId(){
        return $this->salon_id;
    }


    public function sanitize_data(){
        return array("name"=>$this->getName(), "price"=>$this->getPrice(),
        "duration"=>$this->getDuration(), "category"=>$this->getCategory(), 
        "salon_id"=>$this->getSalonId());
    }

    public function validate(){
        if(!validate_string($this->getName())){
            $this->errors['name'] = "Service Name only contains letters and whitespaces."; 
        }
        if($this->getPrice() < 50){
            $this->errors['price'] = "Price must be equal to or greater then 50."; 
        }
        if($this->getCategory() == "Select Category"){
            $this->errors['category'] = "Service category is required."; 
        }
        if($this->getDuration() == "Select Service Duration"){
            $this->errors['duration'] = "Service Duration is required."; 
        }
        return $this->errors;
    }




}
?>