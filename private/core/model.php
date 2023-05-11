<?php
class Model extends Database{
    protected $classname;
    protected $table;
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
        $string = trim($string, ",");
        $data['id'] = $id; 
        $query = "UPDATE $this->table SET $string WHERE id = :id";
        return $this->query($query, $data);
        
    }   

    function delete($id){
        $query = "DELETE FROM $this->table WHERE id = :id";
        return $this->query($query, ["id"=>$id]);
    }

    function all(){
        $query = "SELECT * FROM ".$this->table;
        return $this->query($query);
    }

    function where($column, $value){
        $column = addslashes($column);
        $query = "SELECT * FROM  $this->table WHERE $column = :value";
        return $this->query($query, ["value"=>$value]);
        
    }

    function whereAnd($data){
        $keys = array_keys($data);
        $query = "SELECT * FROM  $this->table WHERE $keys[0] = :$keys[0] AND $keys[1] = :$keys[1]";
        return $this->query($query, ["$keys[0]"=>$data[$keys[0]], "$keys[1]"=>$data[$keys[1]]]);
    }

    function search($column, $value){
        $query = "SELECT * FROM  $this->table WHERE $column LIKE :value";
        return $this->query($query, ["value"=>$value,]);
    }

    function searchAnd($data){
        $keys = array_keys($data);
        $query = "SELECT * FROM  $this->table WHERE $keys[0] = :$keys[0] AND $keys[1] LIKE :$keys[1]";
        return $this->query($query, ["$keys[0]"=>$data[$keys[0]], "$keys[1]"=>$data[$keys[1]]."%"]);
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

    function get_last_id(){
        $con = $this->get_connection();
        $id = $con->lastInsertId();
        return $id;
    }

    function whereOrderBy($column, $value, $order = "ASC"){
        $column = addslashes($column);
        $query = "SELECT * FROM  $this->table WHERE $column = :value ORDER BY id ". $order;
        return $this->query($query, ["value"=>$value]);
    }

    





    
}
?>