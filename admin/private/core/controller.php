<?php

class Controller{

    private $errors = array();

    public function view($view, $data = array()){
        extract($data);
        if(file_exists("../private/views/".$view.".view.php")){
            require "../private/views/".$view.".view.php";
        }
        else{
            require "../private/views/404.view.php";
        }
    }
    
    public function load_model($model){
        $model = ucfirst($model);
        if(file_exists("../private/models/".$model.".php")){
            require "../private/models/".$model.".php";
            $model = "\models\\".$model;
            return $model =  new $model();
        }
    }

   
    public function redirect($link){
        header("location:http://localhost/smartsalon/admin/public/".$link);
    }

    public function _add($object, $data){
        $obj = new $object($data); 
        $this->errors = $obj->validate();
        if(count($this->errors) > 0){
            return $this->errors;
        }
        else{
            return $obj->insert($obj->sanitize_data());
        } 
    }

    public function _update($object, $data){
        $obj = new $object($data); 
        $id = $obj->getId();
        $this->errors = $obj->validate();
        if(count($this->errors) > 0){
            return $this->errors;
        }
        else{
            return $obj->update($obj->sanitize_data(), $id);
        } 
            
    }

    public function _block($object, $id = null){
        if($id != null){
            return $object->update(["status"=>"block"], $id);
        }
        return null;
    }

    public function _unblock($object, $id = null){
        if($id != null){
            return $object->update(["status"=>"active"], $id);
        }
        return null;
    }

    public function _filter($object, $data){
        $rows = array();   
        if($data['value'] == "all"){
            $rows = $this->_all($object);
        }
        else if($data['value'] == "block"){
            $rows = $object->where('status', $data['value']);
        }
        else{
            $rows = $object->where('rank', $data['value']);   
        }
        
        return $rows;
               
    }

    public function _search($object, $column, $data){
        return $object->search($column, $data['value']."%");
    }

    public function _all($object){
        return $object->findAll();
    }

    public function  _count($object, $column = null, $value = null){
        return $object->count($column, $value);
    }


    
}
    

?>