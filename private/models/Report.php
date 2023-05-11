<?php
namespace Models;
class Report extends \Model{
    protected $table = "salon_ratings";

    function getSalonReviewWeekly($salon_id){
        $query = "SELECT AVG(rating) as average_rating, DATE(datetime) as date, DAYOFWEEK(datetime) as day_of_week FROM $this->table WHERE salon_id = ? AND datetime >= DATE(NOW() - INTERVAL 7 DAY) GROUP BY date ORDER BY date ASC";
        return $this->query($query, [$salon_id]);
    }
    
    function getSalonReviewMonthly($salon_id){
        $query = "SELECT AVG(rating) as average_rating, MONTH(datetime) as month, YEAR(datetime) as year FROM $this->table WHERE salon_id = ? AND datetime >= DATE(NOW() - INTERVAL 12 MONTH) GROUP BY year, month ORDER BY year ASC, month ASC";
        return $this->query($query, [$salon_id]);
    }
    
    function getDailyIncome($salon_id){
        $query = "SELECT SUM(s.price) as total_income, DATE(a.date) as date FROM booked_services bs INNER JOIN services s ON bs.service_id = s.id INNER JOIN appointments a ON bs.appointment_id = a.id WHERE a.salon_id = ? AND a.date >= DATE(NOW() - INTERVAL 7 DAY) GROUP BY date ORDER BY date ASC";
        return $this->query($query, [$salon_id]);
    }    
    
    function getRatingCount($salon_id) {
        $query = "SELECT rating, COUNT(*) as count FROM $this->table WHERE salon_id = ? GROUP BY rating ORDER BY rating ASC";
        return $this->query($query, [$salon_id]);
    }

    function getAppointmentTrends($salon_id) {
        $query = "SELECT COUNT(id) as total_appointments, DATE(date) as date FROM appointments WHERE salon_id = ? AND date >= DATE(NOW() - INTERVAL 60 DAY) GROUP BY date ORDER BY date ASC";
        return $this->query($query, [$salon_id]);
    }

    function getPopularServices($salon_id){
        $query = "SELECT s.name, COUNT(bs.service_id) as count FROM booked_services bs INNER JOIN services s ON bs.service_id = s.id INNER JOIN appointments a ON bs.appointment_id = a.id WHERE a.salon_id = ? GROUP BY bs.service_id ORDER BY count DESC LIMIT 5";
        return $this->query($query, [$salon_id]);
    }
}
?>