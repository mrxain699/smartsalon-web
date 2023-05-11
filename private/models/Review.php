<?php
namespace Models;
class Review extends \Model{

	protected $table  = "salon_ratings";
    protected $customer_table = "customers";
	private $rating;
	private $review;
	private $salon_id;
	private $customer_id;

	function __construct($data=array()){
    	if(count($data)>0){
    		$this->rating = $data['rating'];
    		$this->review = $data['review'];
    		$this->salon_id = $data['salon_id'];
    		$this->customer_id = $data['customer_id'];
    	}
    }

    function getRating(){
    	return $this->rating;
    }

    function getReview(){
    	return $this->review;
    }

    function getSalonid(){
    	return $this->salon_id;
    }

    function getCustomerId(){
    	return $this->customer_id;
    }

    function sanitize_data(){
    	return  array("rating"=>$this->getRating(), "review"=>$this->getReview(),
    				 "customer_id"=>$this->getCustomerId(), "salon_id"=>$this->getSalonId());
    }

    function countReviews($column, $value){
        $column = addslashes($column);
        $query = "SELECT COUNT(*) as total_reviews FROM  $this->table WHERE $column = :value";
        return $this->query($query, ["value"=>$value]);
    }

    function getAverageRating($column, $value){
	  	$column = addslashes($column);
        $query = "SELECT AVG(rating) as average_rating FROM  $this->table WHERE $column = :value";
        return $this->query($query, ["value"=>$value]);
    }

    function getReviews($salon_id){
        $query  = "SELECT $this->customer_table.*, $this->table.* FROM $this->table INNER JOIN $this->customer_table 
        ON $this->table.customer_id = $this->customer_table.id WHERE $this->table.salon_id = $salon_id ORDER BY $this->table.id DESC";
        return $this->query($query);
    }
}
?>