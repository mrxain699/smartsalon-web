<?php

class Home extends Controller
{

    private $salon;
    private $customer;
    private $user;

    function __construct()
    {
        $this->salon = $this->load_model("Salon");
        $this->customer = $this->load_model("Customer");
        $this->user = $this->load_model("User");
    }

    function index()
    {
        $total_users = $this->_count($this->user);
        $total_customers = $this->_count($this->customer);
        $total_salons = $this->_count($this->salon);
        $salons = $this->salon->requests();
        $total_requests = is_array($salons) && count($salons) > 0 ? count($salons) : 0;
        $this->view('dashboard', [
            "total_users"=>$total_users,
            "total_customers"=>$total_customers,
            "total_salons"=>$total_salons,
            "total_requests"=>$total_requests,
            "salons"=>$salons,
        ]);
    }
}
