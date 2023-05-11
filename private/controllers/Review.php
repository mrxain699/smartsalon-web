<?php

class Review extends Controller{
	protected $review;

  	function __construct(){
		
    	$this->review = $this->load_model('Review');   
	}


	function add(){
		$data = json_decode(file_get_contents("php://input"), true);
		if(is_array($data) && count($data) > 0){
			$new_review = new $this->review($data);
			$response = $new_review->insert($data);
			if($response){
				echo 1;
			}
			else{
				echo 0;
			}
		}
	}

	function get($salon_id){
		if($salon_id > 0){
			$reviews = $this->review->getReviews($salon_id);
			if(is_array($reviews) && count($reviews) > 0){
				echo json_encode($reviews);	
			}
			else{
				echo -1;
			}
			
		}
		else{
			echo 0;
		}
	}

	function totalReviews($salon_id){
		if($salon_id > 0){
			$total_reviews = $this->review->countReviews("salon_id", $salon_id);
			if($total_reviews){
				echo $total_reviews[0]['total_reviews'];	
			}
			else{
				echo -1;
			}
			
		}
		else{
			echo 0;
		}
	}

	function averageRating($salon_id){
		if($salon_id > 0){
			$ratings = $this->review->getAverageRating("salon_id", $salon_id);
			if($ratings){
				echo $ratings[0]['average_rating'];	
			}
			else{
				echo -1;
			}
			
		}
		else{
			echo 0;
		}
	}
}

?>