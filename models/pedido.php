<?php


class Pedido{
    private $id;
	private $usuario_id;
	private $provincia;
	private $localidad;
	private $direccion;
	private $coste;
	private $estado;
	private $fecha;
	private $hora;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
    public function save(){
        $sql = "INSERT INTO pedidos VALUES 
        (null,{$this->getUsuario_id()},'{$this->getProvincia()}','{$this->getLocalidad()}','{$this->getDireccion()}',{$this->getCoste()},'confirm',CURDATE(),CURTIME())";


        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function saveLinea(){

        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $indice => $elemento){

            $insert = "INSERT INTO lineas_pedidos VALUES (null,{$pedido_id},{$elemento['id_producto']},{$elemento['unidades']});";


            $save = $this->db->query($insert);
        }

        $result = false;
        if($save){

            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }


    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC;";
        $productos = $this->db->query($sql);
        
        return $productos;
    }

    public function getOne(){
        $sql = "SELECT * FROM pedidos WHERE id = {$this->id};";
        $pedido = $this->db->query($sql);
        
        return $pedido->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id,p.coste FROM pedidos p 
            WHERE p.usuario_id = {$this->usuario_id} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);

        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p 
            WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC;";
        $pedido = $this->db->query($sql);


        return $pedido;
    }

    public function getProductByPedi($id){

        $sql = "SELECT p.*,lp.unidades FROM lineas_pedidos lp
        INNER JOIN productos p ON p.id = lp.producto_id
        WHERE lp.pedido_id = {$id}";

        $productos = $this->db->query($sql);

        return $productos;

    }

	public function edit(){
		$sql = "UPDATE pedidos SET
		estado = '{$this->getEstado()}' WHERE id = {$this->id}";

	   $edit = $this->db->query($sql);



	   $result = false;
	   if($edit){
		   $result = true;
	   }
	   return $result;
	}

	function getId() {
		return $this->id;
	}

	function getUsuario_id() {
		return $this->usuario_id;
	}

	function getProvincia() {
		return $this->provincia;
	}

	function getLocalidad() {
		return $this->localidad;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getCoste() {
		return $this->coste;
	}

	function getEstado() {
		return $this->estado;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getHora() {
		return $this->hora;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}

	function setProvincia($provincia) {
		$this->provincia = $this->db->real_escape_string($provincia);
	}

	function setLocalidad($localidad) {
		$this->localidad = $this->db->real_escape_string($localidad);
	}

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $estado;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setHora($hora) {
		$this->hora = $hora;
	}
}
