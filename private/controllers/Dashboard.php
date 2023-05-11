<?php 

class Dashboard extends Controller{
    protected $appointment;
    protected $service;
    protected $workers;
    private $salon_id;
    private $booked_service;

    function __construct(){
        if(isset($_SESSION['SALON_ID'])){
            $this->salon_id = $_SESSION['SALON_ID'];
        }
        $this->appointment = $this->load_model('Appointment');
        $this->service = $this->load_model('Service');
        $this->workers = $this->load_model('Worker');
        $this->booked_service = $this->load_model('BookedService');

    }

    function index(){
        $pending_appointments = $this->appointment->getStatusAppointments(['salon_id'=>$this->salon_id, "booked"=>0, "cancelled"=>0]);
        $today_booked = $this->appointment->get_today_booked($this->salon_id);
        $total_services = $this->service->count('salon_id', $this->salon_id);
        $total_workers = $this->workers->count('salon_id', $this->salon_id);
        $total_appointments = is_array($pending_appointments) && count($pending_appointments) > 0 ? count($pending_appointments) : 0;
        $total_today_booked = is_array($today_booked) && count($today_booked) > 0 ? count($today_booked) : 0;
        $this->view("barber/dashboard", [
            "total_appointments"=>$total_appointments,
            "total_services"=>$total_services,
            "total_workers"=>$total_workers,
            "total_today_booked"=>$total_today_booked,
            "pending_appointments"=>$pending_appointments,
            "today_booked"=>$today_booked,
        ]);
    
    }

    function get_services($id){
        $booked_services = array();
        $booked_services_id =  $this->_get($this->booked_service, 'appointment_id', $id);
        foreach($booked_services_id as $booked_service){
            $service = $this->_get($this->service, 'id', $booked_service['service_id']);
            array_push($booked_services, $service[0]);
        }
        return $booked_services;
    }

   
}

?>