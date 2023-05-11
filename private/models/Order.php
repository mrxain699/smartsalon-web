<?php
namespace Models;
class Order extends \Model{
    protected $table = "orders";
    protected $customer_table = "customers";
    protected $product_table = "products";
    protected $od_table = "order_items";


    function getOrderDetail($id){
        $query = "SELECT $this->table.*, $this->customer_table.name as 'customer_name', $this->customer_table.city   FROM $this->table
        JOIN $this->customer_table ON $this->customer_table.id = $this->table.customer_id 
        WHERE $this->table.id  = $id";
        return $this->query($query);
    }

    function getOrderItems($id){
        $query = "SELECT $this->od_table.quantity, $this->product_table.name, $this->product_table.price   FROM $this->od_table
        JOIN $this->product_table ON $this->product_table.id = $this->od_table.product_id 
        WHERE $this->od_table.order_id  = $id ";
        return $this->query($query);
    }
}
?>