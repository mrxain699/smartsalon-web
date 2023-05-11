<?php
class Database{

    private function connect(){
        $string  = DBDRIVER.":host=".DBHOST.";dbname=".DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);
        if(!$con){
            die("couldn't connect to database!");
        }
        return $con;
    }

    public function query($query, $data=array()){
        $con = $this->connect();
        $stm = $con->prepare($query);
        if($stm){
            $check = $stm->execute($data);
            if($check){
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                if(is_array($data) && count($data) > 0){
                    return $data;
                }
                else{
                    return true;
                }
            }
        }
        
        return false;
    }

}

?>