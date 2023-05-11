<?php
namespace Models;
class Appointment extends \Model{

    protected $table  = "appointments";
	protected $salons_table  = "salons";
	protected $service_table = "services";
	protected $booked_service_table = "booked_services";
	protected $customer_table = "customers"; 
    private $customer_id;
    private $salon_id;
    private $date;
    private $time;
    private $booked_services = array();
	private $cur_date;

    function __construct($data=array()){
    	if(count($data)>0){
    		$this->customer_id = $data['customer_id'];
	    	$this->salon_id = $data['salon_id'];
	    	$this->date = $data['date'];
	    	$this->time = $data['time'];
	    	$this->booked_services = $data['services'];
    	}
		$this->cur_date = date('Y-m-d');


    }

    function getCustomerId(){
    	return $this->customer_id;
    }

    function getSalonId(){
    	return $this->salon_id;
    }

    function getDate(){
    	return $this->date;
    }

    function getTime(){
    	return $this->time;
    }

    function getBookedServices (){
    	return $this->booked_services;
    }

    function sanitize_data(){
    	return  array("customer_id"=>$this->getCustomerId(), "salon_id"=>$this->getSalonId(),
    					"date"=>$this->getDate(), "time"=>$this->getTime());
    }

    function bookAppointment(){
    	$flag = false;
    	$con = $this->get_connection();
    	$data = $this->sanitize_data();
    	$keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "INSERT INTO ".$this->table." (".$columns.")  VALUES (:".$values.")";
        $stm = $con->prepare($query);
        if($stm){
			$check = $stm->execute($data);
			if($check){
				$appointment_id = $con->lastInsertId();
				if($appointment_id > 0){
					$service = new Service();
					foreach ($this->getBookedServices() as $key => $value) {
						$service_name = $this->booked_services[$key]['service'];
						$response = $service->whereAnd(["name"=>$service_name, "salon_id"=>$this->getSalonId()]);
						$service_id = $response[0]['id'];
						$booked_service = new BookedService();
						$insert_appointment_services = $booked_service->insert(["appointment_id"=>$appointment_id, "service_id"=>$service_id]);
						$flag = true;
					}
				}
				if($flag){
					echo 1;
				}
				else{
					echo 0;
				}
			}
			else{
				echo 0;
			}
        }
    	
    }

	

    function getAppointments($data){
        $columns = array_keys($data);
		$query = "SELECT $this->table.*, $this->salons_table.name, $this->salons_table.address, $this->salons_table.city,
		SUM($this->service_table.price) as 'total_price', COUNT($this->service_table.id) as 'total_services' FROM  $this->table
		INNER JOIN $this->salons_table ON $this->table.salon_id = $this->salons_table.id
		INNER JOIN $this->booked_service_table ON $this->booked_service_table.appointment_id = $this->table.id  
		INNER JOIN $this->service_table ON $this->booked_service_table.service_id = $this->service_table.id  
		WHERE $this->table.customer_id = :$columns[0] AND $this->table.cancelled = :$columns[1] 
		GROUP BY $this->table.id  ORDER BY $this->table.id DESC";
		return $this->query($query, $data);
    }

	function get_today_booked($salon_id){
		$query = "SELECT $this->table.*, $this->customer_table.name, $this->customer_table.phone, 
		SUM($this->service_table.price) as 'total_price', COUNT($this->service_table.id) as 'total_services' FROM  $this->table
		INNER JOIN $this->customer_table ON $this->table.customer_id =  $this->customer_table.id
		INNER JOIN $this->booked_service_table ON $this->booked_service_table.appointment_id = $this->table.id 
		INNER JOIN $this->service_table ON $this->booked_service_table.service_id = $this->service_table.id  
		WHERE  $this->table.salon_id = $salon_id AND $this->table.booked = 1 AND  $this->table.date = '$this->cur_date' 
		GROUP BY $this->table.id ORDER BY $this->table.id, $this->service_table.id DESC";
		return $this->query($query);
			
	}

	function getStatusAppointments($data){
		$keys = array_keys($data);
		$keys_0 = $keys[0];
		$keys_1 = $keys[1];
		$keys_2 = $keys[2];
		$query = "SELECT $this->table.*, $this->customer_table.name, $this->customer_table.phone, 
		SUM($this->service_table.price) as 'total_price', COUNT($this->service_table.id) as 'total_services' FROM  $this->table
		INNER JOIN $this->customer_table ON $this->table.customer_id = $this->customer_table.id
		INNER JOIN $this->booked_service_table ON $this->booked_service_table.appointment_id =  $this->table.id
		INNER JOIN $this->service_table ON $this->booked_service_table.service_id = $this->service_table.id  
		WHERE  $this->table.$keys[0] = :$keys_0 AND $this->table.$keys[1] = :$keys_1 AND  $this->table.$keys[2] = :$keys_2
		GROUP BY $this->table.id ORDER BY $this->table.id DESC";
		return $this->query($query, $data);
	}

	

}

?>