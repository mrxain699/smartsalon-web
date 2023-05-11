<?php
namespace Models;
class Product extends \Model{
    protected $table = "products";
    private $id = 0;
    private $name = '';
    private $p_desc = '';
    private $price = '';
    private $quantity = '';
    private $image = '';
    private $salon_id = '';


    function __construct($data=array()) {
        $keys = array_keys($data);
        if(count($data) > 0){
            $this->id = in_array('id', $keys) ? $data['id'] : 0;
            $this->name = $data['name'];
            $this->p_desc = $data['p_desc'];
            $this->price = $data['price'];
            $this->quantity = $data['quantity'];
            $this->image = in_array('image', $keys) ? $data['image'] : null;
            $this->salon_id = $data['salon_id'];
        }

    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }

    public function getP_Desc(){
        return $this->p_desc;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getImage(){
        return $this->image;
    }


    public function getSalonId(){
        return $this->salon_id;
    }




    public function sanitize_data(){
        return array("name"=>$this->getName(), "p_desc"=>$this->getP_desc(), "price"=>$this->getPrice(),
        "quantity"=>$this->getQuantity(), "image"=>$this->getImage(),  "salon_id"=>$this->getSalonId());
        
    }



   



   

}
?>