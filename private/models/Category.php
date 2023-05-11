<?php
namespace Models;
class Category extends \Model{

    protected $table = "service_categories";
    private $id = 0;
    private $category = '';
    private $salon_id = 0;
    private $errors = array();

    function __construct($data = array()){
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->category = $data['category'];
            $this->salon_id = $data['salon_id'];
        }
    }

    
    public function getId(){
        return $this->id;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getSalonId(){
        return $this->salon_id;
    }


    public function sanitize_data(){
        return array("category"=>$this->getCategory(), "salon_id"=>$this->getSalonId());
    }

    public function validate(){
        if(!validate_string($this->getCategory())){
            $this->errors['category'] = "Category only contains letters and whitespaces."; 
        }
        return $this->errors;
    }




}
?>