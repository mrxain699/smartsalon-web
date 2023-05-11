<?php
namespace Models;
class ChatHeads extends \Model{
	protected $table = "chat_heads";


    function update_chat($message, $salon, $customer){
        $query = "UPDATE $this->table SET last_msg = '$message' WHERE salon = '$salon' AND customer = '$customer'";
        return $this->query($query);
    }

    function insert_chat($message, $salon, $customer){
        $query = "INSERT INTO $this->table (salon, customer, last_msg) VALUES ('$salon', '$customer', '$message')"; 
        return $this->query($query);
    }




}
?>