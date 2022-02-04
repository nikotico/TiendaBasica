<?php

class ErrorController{
    public function index(){
        echo "<h1>La pagina que buscas no existe</h1>";
    }
    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){
        if(isset($_POST)){
            echo "done";
        }
    }

}