<?php

require_once 'models/categoria.php';

require_once 'models/producto.php';

class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();

        $categoria = new Categoria();
        //Guardar la categoria en la base de datos
        if(isset($_POST)){
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        header("Location:".base_url."categoria/index");
    }


    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Get categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            //Get productos de esa categoria;
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllByCategory();
            
        }
        require_once 'views/categoria/ver.php';
    }
}