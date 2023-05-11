<?php
class Order extends Controller{
    private $order;
    private $customer;
    private $salon_id;

    function __construct(){
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->order = $this->load_model('Order');
        $this->customer = $this->load_model('Customer');
    }

    function index(){
        $orders = $this->order->whereAnd(['salon_id'=>$this->salon_id, "reject" => 0]); 
        $this->view('barber/order', ["orders"=>$orders]);
    }

    function getCustomer($id){
        $customer = $this->_get($this->customer, 'id', $id);
        return $customer[0];
    }

    function detail($id){
        $order = $this->order->getOrderDetail($id);
        $this->view("barber/order_detail", ["order"=>$order[0]]);
    }

    function getProductsItems($id){
        $products = $this->order->getOrderItems($id);
        return $products;
    }

    function confirm($id){
        $is_confirm = $this->order->update(['confirmed'=>1], $id);
        if($is_confirm){
            $_SESSION['message'] = "Order Confirm Successfully";
            $_SESSION['message_type'] = 'success';
            $this->redirect('/order');
        }
        else{
            echo 0;
        }
    }

    function reject($id){
        $is_reject = $this->order->update(['reject'=>1], $id);
        if($is_reject){
            $_SESSION['message'] = "Order Cancelled Successfully";
            $_SESSION['message_type'] = 'success';
            $this->redirect('/order');
        }
        else{
            echo 0;
        }
    }
}
?>