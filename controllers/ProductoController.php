<?php

require_once 'models/producto.php';

class productoController
{
    public function index()
    {
        
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        //Rendirizar vista
        require_once 'views/producto/destacados.php';

    }

    public function gestion()
    {
        Utils::isAdmin();

        $producto = new Producto();

        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        //Rendirizar vista
        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();

        $save = false;
        $dirImgs = 'uploads/images';
        //Guardar el producto en la base de datos
        if (isset($_POST)) {

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;


            if ($nombre && $descripcion && $categoria && $precio && $stock) { //&& $imagen

                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setCategoria_id($categoria);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                //Guardar la imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    //Solo se guarda si es una imagen
                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg"  || $mimetype == "image/png " || $mimetype == "image/gif") {
                        //Directorio donde voy a guardar las imagenes
                        if (!is_dir($dirImgs)) {
                            mkdir($dirImgs, 0777, true);
                        }
                        $producto->setImg($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }
                if(isset($_GET['id'])){
                    $producto->setId($_GET['id']);
                    $save = $producto->edit();
                }else{
                    $save = $producto->save();
                }
            }
        }
        if ($save) {
            $_SESSION['producto'] = 'complete';
        } else {
            $_SESSION['producto'] = 'failed';
        }
        header("Location:" . base_url . "producto/gestion");
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $edit = true;
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);

            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        }else{
            header('Location:'.base_url.'producto/gestion');
        }
    }


    public function eliminar()
    {
        Utils::isAdmin();
        $delete = false;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
        }
        if ($delete) {
            $_SESSION['delete'] = 'complete';
        } else {
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url."producto/gestion");
    }

    public function ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);

            $product = $producto->getOne();

        }require_once 'views/producto/ver.php';
    }
}
