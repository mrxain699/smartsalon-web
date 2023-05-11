<?php
namespace Models;
class Chat extends \Model{
	protected $table = "chat";
	protected $salon_table = "salons";
	protected $customer_table = "customers";
	protected $chat_heads = "chat_heads";
	private $sender;
	private $receiver;
	private $message;
	private $image;


	function __construct($data= array()){
		if(count($data) > 0){
			$this->sender = $data['sender'];
			$this->receiver = $data['receiver'];
			$this->message = $data['message'];
			$this->image = $data['image'];
		}
	}

	function getSender(){
		return $this->sender;
	}

	function getReceiver(){
		return $this->receiver;
	}

	function getMessage(){
		return $this->message;
	}

	function getImage(){
		return $this->image;
	}

	function sanitize_data(){
    	return  array("sender"=>$this->getSender(), "receiver"=>$this->getReceiver(),
    					"message"=>$this->getMessage(), "image"=>$this->getImage());
    }

    function getMessages($sender, $receiver){
    	$query = "SELECT * FROM $this->table WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) ORDER BY id DESC";
    	return $this->query($query, ["sender"=>$sender, "receiver"=>$receiver]);
    }

	function getChats($user_id){
		$query="SELECT $this->salon_table.id, $this->salon_table.name as 'salon_name', $this->salon_table.image as 'salon_image', $this->customer_table.name as 'customer_name', $this->customer_table.image as 'customer_image', $this->chat_heads.last_msg FROM $this->chat_heads 
		INNER JOIN $this->salon_table  ON $this->salon_table.id = $this->chat_heads.salon 
		INNER JOIN $this->customer_table  ON $this->customer_table.id = $this->chat_heads.customer 
		WHERE $this->chat_heads.customer = $user_id ";
		return $this->query($query);
	}

	function getBrberChats($user_id){
		$query="SELECT  $this->salon_table.name as 'salon_name', $this->salon_table.image as 'salon_image', $this->customer_table.id, $this->customer_table.name as 'customer_name', $this->customer_table.image as 'customer_image', $this->chat_heads.last_msg FROM $this->chat_heads 
		INNER JOIN $this->salon_table  ON $this->salon_table.id = $this->chat_heads.salon 
		INNER JOIN $this->customer_table  ON $this->customer_table.id = $this->chat_heads.customer 
		WHERE $this->chat_heads.salon = $user_id ";
		return $this->query($query);
	}
	
}
?>