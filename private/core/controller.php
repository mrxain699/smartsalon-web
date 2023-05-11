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
        header("location:".URL.$link);
    }

    public function _all($object){
        return $object->all();
    }

    public function _get($object, $column, $value){
        return $object->where($column, $value);
    }

    public function _add($object, $data){
        $obj = new $object($data);
        if(method_exists($obj, 'validate')){
            $this->errors = $obj->validate();
        } 
        if(count($this->errors) > 0){
            return $this->errors;
        }
        else{
            return $obj->insert($obj->sanitize_data());
        } 
    }

    public function _update($object, $data, $id = null){
        $obj = new $object($data); 
        if(method_exists($obj, 'validate')){
            $this->errors = $obj->validate();
        } 
        if(count($this->errors) > 0){
            return $this->errors;
        }
        else{
            return $obj->update($obj->sanitize_data(), $id);
        } 
            
    }

    public function _delete($object, $id){
        if($id != null && $object != null){
            return $object->delete($id);
        }
    }

    public function _block($object, $id = null){
        if($id != null){
            return $object->update(["status"=>"block"], $id);
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

 

    

    
}
    

?>