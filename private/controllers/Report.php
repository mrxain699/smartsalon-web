<?php

class Report extends Controller{
    private $report;

    function __construct(){
        $this->report = $this->load_model('report');
    }

    function index(){
        $salon_id = $_SESSION['SALON_ID'];
        $weekly_reviews = $this->report->getSalonReviewWeekly($salon_id);
        $monthly_reviews = $this->report->getSalonReviewMonthly($salon_id);
        $daily_income = $this->report->getDailyIncome($salon_id);
        $rating_count = $this->report->getRatingCount($salon_id);
        $appointment_trends = $this->report->getAppointmentTrends($salon_id);
        $popular_services = $this->report->getPopularServices($salon_id);

        $this->view('barber/reports', ['name'=>"zain", "weekly_reviews"=>json_encode($weekly_reviews), "monthly_reviews"=>json_encode($monthly_reviews), "daily_income"=>json_encode($daily_income), "rating_count" => json_encode($rating_count), 'appointment_trends' => json_encode($appointment_trends), 'popular_services' => json_encode($popular_services)]);
    }
    
}

?>