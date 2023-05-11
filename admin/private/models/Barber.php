<?php

namespace Models;
class Barber extends \Model{
    protected $table = 'barbers';

    public function getBarberEmail($barber_id){
        if($barber_id > 0){
            $barber = $this->where('id', $barber_id);
            if(is_array($barber) && count($barber) > 0){
                return $barber[0]['email'];
            }
            else{
                return 0;
            }
        }
    }
}


?>

