<?php
class App {
    
    protected $controller = "Home";
    protected $method = "index";
    protected $params = array();
    
    function __construct() {

        $URL = $this->getUrl();

        if(file_exists("../private/controllers/".$URL[0].".php")){
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        }

        require "../private/controllers/".$this->controller.".php";
        $this->controller = new $this->controller();
        

        if(isset($URL[1])){
            if(method_exists($this->controller, $URL[1])){
                $this->method = ucfirst($URL[1]);
                unset($URL[1]);
            }
        }

        $URL= array_values($URL);
        $this->params = $URL;
        call_user_func_array([$this->controller, $this->method], $this->params);
        
    
    }

    private function getUrl(){
        $url = isset($_GET['url']) ? $_GET['url'] : "Home";
        return explode("/", filter_var(trim($url, "/")), FILTER_SANITIZE_URL);
    }
}

?>