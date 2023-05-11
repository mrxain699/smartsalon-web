<?php

class Chat extends Controller{
	protected $chat;
	protected $chat_heads;
	function __construct(){

		$this->chat =  $this->load_model('Chat');
		$this->chat_heads = $this->load_model('ChatHeads');
	}

	function messages($sender, $receiver){
		if($sender > 0 && $receiver > 0){
			$messages = $this->chat->getMessages($sender, $receiver);
			if(count($messages) > 0){
				echo json_encode($messages);	
			}

		}
		
	}

	function chats($user_id){
		if($user_id > 0){
			$all_chats = $this->chat->getChats($user_id);
			if(is_array($all_chats) and count($all_chats) > 0){
				echo json_encode($all_chats);
			}
			else{
				echo -1;
			}
		}
		else{
			echo 0;
		}
		
	}

	function barber_chats($user_id){
		if($user_id > 0){
			$all_chats = $this->chat->getBrberChats($user_id);
			if(is_array($all_chats) and count($all_chats) > 0){
				echo json_encode($all_chats);
			}
			else{
				echo -1;
			}
		}
		else{
			echo 0;
		}
		
	}

	function send_message(){
		$data = json_decode(file_get_contents("php://input"), true);
		if(is_array($data) && count($data)>0){

			if(is_array($data['image'])){
		 		$folderPath = 'uploads/chat/';
		        $image_base = base64_decode($data['image']['base']);
            	$image_type = $data['image']['type'];
		        $file = $folderPath . uniqid() .  ".".$image_type;
		        if(file_put_contents($file, $image_base)){
		        	$data['image'] = $file;
		        	$new_chat = new $this->chat($data);
					$response = $this->chat->insert($new_chat->sanitize_data());
					if($response){
						echo 1;
					}
					else{
						echo -1;
					}
		        }
		        else{
		        	echo 0;
		        }
			}
			else{
				$new_chat = new $this->chat($data);
				$response = $this->chat->insert($new_chat->sanitize_data());
				if($response){
					$check_heads = $this->chat_heads->whereAnd(["salon"=>$data['receiver'], "customer"=>$data['sender']]);
					if(is_array($check_heads) && count($check_heads) > 0){
						$update_check_heads =  $this->chat_heads->update_chat($data['message'], $data['receiver'], $data['sender']);
						if($update_check_heads){
							echo 1;
						}
						else{
							echo 0;
						}
					}
					else{
						$insert_check_heads =  $this->chat_heads->insert_chat($data['message'], $data['receiver'], $data['sender']);
						if($insert_check_heads){
							echo 1;
						}
						else{
							echo 0;
						}
					}
					
				}
				else{
					echo -1;
				}
			}
			
		}
		else
			echo 0;
	}

	function send_barber_message(){
		$data = json_decode(file_get_contents("php://input"), true);
		if(is_array($data) && count($data)>0){

			if(is_array($data['image'])){
		 		$folderPath = 'uploads/chat/';
		        $image_base = base64_decode($data['image']['base']);
            	$image_type = $data['image']['type'];
		        $file = $folderPath . uniqid() .  ".".$image_type;
		        if(file_put_contents($file, $image_base)){
		        	$data['image'] = $file;
		        	$new_chat = new $this->chat($data);
					$response = $this->chat->insert($new_chat->sanitize_data());
					if($response){
						echo 1;
					}
					else{
						echo -1;
					}
		        }
		        else{
		        	echo 0;
		        }
			}
			else{
				$new_chat = new $this->chat($data);
				$response = $this->chat->insert($new_chat->sanitize_data());
				if($response){
					$check_heads = $this->chat_heads->whereAnd(["salon"=>$data['sender'], "customer"=>$data['receiver']]);
					if(is_array($check_heads) && count($check_heads) > 0){
						$update_check_heads =  $this->chat_heads->update_chat($data['message'], $data['sender'], $data['receiver']);
						if($update_check_heads){
							echo 1;
						}
						else{
							echo 0;
						}
					}
					else{
						$insert_check_heads =  $this->chat_heads->insert_chat($data['message'], $data['sender'], $data['receiver']);
						if($insert_check_heads){
							echo 1;
						}
						else{
							echo 0;
						}
					}
					
				}
				else{
					echo -1;
				}
			}
			
		}
		else
			echo 0;
	}


}
?>