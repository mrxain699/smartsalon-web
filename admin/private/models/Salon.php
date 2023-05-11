<?php

namespace Models;

class Salon extends \Model
{

    protected $table = "salons";
    protected $barber_table = "barbers";

    public function getSalons()
    {
        $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
        FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id";
        return $this->query($query);
    }

    public function filterSalon($data)
    {
        $rows = array();
        if ($data['value'] == "all") {
            $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
            FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id";
            $rows = $this->query($query);

        } else if ($data['value'] == "verified") {
            $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
            FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id WHERE $this->table.verified = 1";
            $rows =  $this->query($query);

        } else if ($data['value'] == "rejected") {
            $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
            FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id WHERE $this->table.cancelled = 1";
            $rows =  $this->query($query);
        }
        else{
            $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
            FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id WHERE $this->table.cancelled = 0 AND $this->table.verified = 0";
            $rows =  $this->query($query);
        }

        return $rows;
    }

    public function requests(){
        $query = "SELECT $this->table.*, $this->barber_table.name as 'barber_name', $this->barber_table.email, $this->barber_table.phone , $this->barber_table.image as 'barber_image'  
            FROM $this->table JOIN $this->barber_table ON $this->table.barber_id = $this->barber_table.id WHERE $this->table.cancelled = 0 AND $this->table.verified = 0";
            return  $this->query($query);
    }

   

   
}
