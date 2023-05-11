<?php
namespace Models;

class Gallery extends \Model{

    protected $table  = "gallery";
    private $image;
    private $salon_id;

    function __construct($data = array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->image = $data['image'];
            $this->salon_id = $data['salon_id'];
        }
    }

    function getImage(){
        return $this->image;
    }

    function getSalonId(){
        return $this->salon_id;
    }

    function sanitize_data(){
        return array("image"=>$this->getImage(), "salon_id"=>$this->getSalonId());
    }
}
?>