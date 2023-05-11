<?php
class Model extends Database{
    function __construct() {
        if(!property_exists($this, 'table')){
            $this->classname = get_class($this);
            $this->table = strtolower($this->classname).'s';
        }
    }

    function insert($data){
        $keys = array_keys($data);
        $columns = implode(",", $keys);
        $values = implode(",:", $keys);
        $query = "INSERT INTO ".$this->table." (".$columns.")  VALUES (:".$values.")";
        return $this->query($query, $data);
    }

    function update($data, $id){
        $string = '';
        foreach($data as $key => $value){
            $string .= $key."=:".$key.",";
        }
        $string = str_replace("id=:id,", "", $string);
        $string = trim($string, ",");
        $data['id'] = $id; 
        $query = "UPDATE $this->table SET $string WHERE id = :id";
        return $this->query($query, $data);
        
    }   

    function delete($id){
        $query = "DELETE FROM $this->table WHERE id = :id";
        return $this->query($query, ["id"=>$id]);
    }

    function findAll(){
        $query = "SELECT * FROM ".$this->table;
        $data = $this->query($query);
        return $data;
    }

    function where($column, $value){
        $column = addslashes($column);
        $query = "SELECT * FROM  $this->table WHERE $column = :value";
        $data =  $this->query($query, ["value"=>$value]);
        return $data;
    }

    function search($column, $value){
        $query = "SELECT * FROM  $this->table WHERE $column LIKE :value";
        return $this->query($query, ["value"=>$value,]);
    }

    function count($column = null, $value = null){
        if(empty($column) && empty($value)){
            $query = "SELECT count(*) as 'count' FROM  $this->table";
            $data =  $this->query($query);
            return $data[0]['count'];
        }
        else{
            $column = addslashes($column);
            $query = "SELECT count(*) as :value FROM  $this->table WHERE $column = :value";
            $data =  $this->query($query, ["value"=>$value]);
            $data = $data[0][$value];
            return $data;
        }
    }

    
}
?>