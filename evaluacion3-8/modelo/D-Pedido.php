<?php
class Detalle_Pedido{
    public $id;
    public $id_pedido;
    public $producto;
    public $cantidad;
    public $precio_unitario;

    public function __construct(){
        $this->id;
        $this->id_pedido;
        $this->producto;
        $this->cantidad;
        $this->precio_unitario;
    }

    public function get_subTotal($cantidad,$precio_unitario){
        $this->cantidad=$cantidad;
        $this->precio_unitario=$precio_unitario;
        return $cantidad * $precio_unitario;
    }

    public function insertarDetallesPedido($id,$producto,$cantidad,$precio_unitario){
        $this->id_pedido=$id;
        $this->producto=$producto;
        $this->cantidad=$cantidad;
        $this->precio_unitario=$precio_unitario;
        $cn=new Conexion();
        $cn->getConexion();
        $insertarPedido='INSERT INTO detalle_pedido(id_pedido,producto,cantidad,precio_unitario) VALUES (?,?,?,?)';
        $query=$cn->prepare($insertarPedido);
        $query->execute([
            $this->id_pedido, $this->producto, $this->cantidad, $this->precio_unitario
        ]);
    }

    public function verDetallePedido($id){
        $this->id_pedido=$id;
        $cn=new Conexion();
        $cn->getConexion();
        $verDetallePedido="SELECT producto,cantidad,precio_unitario FROM detalle_pedido WHERE id_pedido='$id'";
        foreach ($cn->query($verDetallePedido) as $row) {
            $producto           = $row['producto'];
            $cantidad           = $row['cantidad'];
            $precio_unitario    = $row['precio_unitario'];
        }
        $datos=array($producto,$cantidad,$precio_unitario);
        return $datos;
    }
    
}