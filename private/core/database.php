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

    public function query($query, $data = array(), $response = "array"){
        $con = $this->connect();
        $stm = $con->prepare($query);
        if($stm){
            $check = $stm->execute($data);
            if($check){
                if($response == "array"){
                    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                }
                else{
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                }
                if(count($data) > 0){
                    return $data;
                }
                else{
                    return true;
                }
            }
        }
        
        return false;
    }

    public function get_connection(){
        return $this->connect();
    }

}

?>