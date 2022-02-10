<?php


require_once 'models/pedido.php';

class pedidoController{
    public function hacer(){
        require_once 'views/pedidos/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $save = false;
            //Guardar datos en la base de datos
            $userId = $_SESSION['identity']->id;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            if($provincia && $localidad && $direccion){
                $pedido = new Pedido;

                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);

                $pedido->setUsuario_id($userId);
                $pedido->setCoste($coste);
 
                //Guardar
                $save = $pedido->save();
                //Guardar linea
                $saveLinea = $pedido->saveLinea();
            }

            if($save && $saveLinea){
                $_SESSION['pedido'] = 'complete';
            }else{
                $_SESSION['pedido'] = 'failed';
            }
        }
        header("Location:".base_url."pedido/confirm");
    }

    public function confirm(){
        if(isset($_SESSION['identity'])){
            $userId = $_SESSION['identity']->id;

            $pedido = new Pedido;
            $pedido->setUsuario_id($userId);
            $pedido = $pedido->getOneByUser();

            $pedido_producto = new Pedido;
            $productos = $pedido_producto->getProductByPedi($pedido->id);

            require_once 'views/pedidos/confirm.php';
        }
    }

    public function misPedidos(){
        Utils::isIdentity();

        $userId = $_SESSION['identity']->id;
        $pedido = new Pedido;

        //Sacar los pedidos del usuario
        $pedido->setUsuario_id($userId);

        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedidos/misPedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();
        if(isset($_GET['id'])){

            $id = $_GET['id'];

            //Sacar el pedido
            $pedido = new Pedido;
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar los productos
            $pedido_producto = new Pedido;
            $productos = $pedido_producto->getProductByPedi($id);

            require_once 'views/pedidos/detalle.php';
        }else{
        header("Location:".base_url."pedido/misPedidos");
        }
    }
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;
        $pedido = new Pedido;
        $pedidos = $pedido->getAll();
        require_once 'views/pedidos/misPedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            //Update del pedido en concreto
            $pedido = new Pedido();
            $pedido->setId($_POST['pedido_id']);
            $pedido->setEstado($_POST['estado']);
            $pedido->edit();

            header("Location:".base_url."pedido/detalle&id=".$_POST['pedido_id']);

        }else{
            header("Location:".base_url);
        }
    }
}