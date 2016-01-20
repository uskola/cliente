<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class Pedidos
{
    private $pdo;
    public $id;
    public $nombre;
	public $nick;
	public $id_producto;
	public $id_pedido;


		
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::Conectar();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

	

	
	
	
	
			
   public function ObtenerPrecio($id_producto, $id_pedido)
    {
        try {
            $stm = $this->pdo->prepare("SELECT cantidad 
			FROM pedido_linea
			WHERE id_producto =? and id_pedido=?");
            $stm->execute(array($id_producto, $id_pedido ));
			$this->RegistrarLog("JSON", "Consulta", "Consulta Pedido Linea Prod." . $id_producto . " Ped. " . $id_pedido);	
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

		
		//getuserlist() 
    public function ListarPedidos($mio, $abiertos, $cerrados, $usuario )
    {
		
		$cadena1 = " 1 ";
		$cadena2=" where  ";
		if ($mio){
			$cadena1 ="  (usuario_abre = '$usuario' or usuario_cierra = '$usuario')";
		}
		if ($abiertos){
			$cadena2 = " where proveedor = 0  and ";
		}
		if ($cerrados){
			$cadena2 = " where proveedor > 0 and ";
		}
		if ($cerrados && $abiertos){
			$cadena2=" where  ";
		}
	
		
		
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, referencia as nombre, proveedor, usuario_abre, usuario_cierra
			FROM pedido " . $cadena2 . $cadena1 . " order by nombre asc
		");
            $stm->execute();
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista pedidos");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }
	
	
		//getuserlist() 
    public function ListarPedidosCerrados()
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, referencia as nombre
			FROM pedido where proveedor > 0 order by nombre asc
		");
            $stm->execute();
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista pedidos Cerrados");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	
	
   public function ListarProveedoresPosibles($productos, $proveedoresposibles)
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			select proveedor.nombre as provider, producto.id as id, producto.nombre as nombre, 
producto_proveedor.precio as precio from producto_proveedor, proveedor, producto 
where producto_proveedor.id_proveedor = proveedor.id and producto_proveedor.id_producto= producto.id  
and producto.id = ? and proveedor.id = ? group by producto_proveedor.id_producto
			");
            $stm->execute(array($productos, $proveedoresposibles));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista pedidos Abiertos ");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	
    public function ListarPedidosAbiertos()
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, referencia as nombre, proveedor 
			FROM pedido where proveedor = 0 order by referencia asc
		");
            $stm->execute();
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista pedidos Abiertos ");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }
	
		
	
	
	
    public function ListarDisponibles($id_pedido)
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT pp.idproducto as pid, p.nombre, pp.idpedido, pp.idproducto, pp.precio, pp.cantidad
			FROM pedido_linea as pp, producto as p where pp.idproducto=p.id and idpedido= ?
		");
            $stm->execute(array($id_pedido));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos en pedido " . $id_pedido);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	

	public function ListarProveedores($id_producto)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("
			select * from producto_proveedor where producto_proveedor.id_producto = " . $id_producto . "
		");
            $stm->execute(array($id_producto));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos no disponibles en producto " . $id_producto);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	
	public function ListaMagica($parametros, $id_pedido)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("
			select producto.id as id, producto.nombre as nombre from producto_proveedor, proveedor, producto where producto_proveedor.id_proveedor = proveedor.id and producto_proveedor.id_producto= producto.id  " . $parametros . " group by producto_proveedor.id_producto
		");
            $stm->execute(array($id_pedido));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos magica en en pedido " . $id_pedido);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	
	
	
    public function ListarNoDisponibles($id_pedido)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("
			SELECT  t1.id as idproducto, t1.nombre as nombre, " . $id_pedido . " as idpedido FROM producto T1
			WHERE NOT EXISTS (SELECT * from pedido_linea T2 where T2.idpedido = ?  and T1.id = T2.idproducto)
		");
            $stm->execute(array($id_pedido));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos no disponibles en pedido " . $id_pedido);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	

    public function ListarComplejo($consulta)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("
			SELECT  t1.id as idproducto, t1.nombre as nombre, " . $id_pedido . " as idpedido FROM producto T1
			WHERE NOT EXISTS (SELECT * from pedido_linea T2 where T2.idpedido = ?  and T1.id = T2.idproducto)
		");
            $stm->execute(array($id_pedido));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos no disponibles en pedido " . $id_pedido);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	


	
    public function Eliminar($idproducto, $idpedido)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM pedido_linea
		WHERE idproducto =? and idpedido=?");
            $stm->execute(array($idproducto, $idpedido));
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Eliminado", "Eliminado Pedido Linea Prod." . $idproducto . " Ped. " . $idpedido);		
		
    }


    public function EliminarPedido($idpedido)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM pedido_linea
		WHERE idpedido=?");
            $stm->execute(array($idpedido));
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
        try {
            $stm = $this->pdo->prepare("DELETE FROM pedido
		WHERE id=?");
            $stm->execute(array($idpedido));
        }
        catch (exception $e) {
            die($e->getMessage());
        }

		$this->RegistrarLog("JSON", "Eliminado", "Eliminado Pedido Ped. " . $idpedido);		
		
    }
	
	

	
//	set($user_data=array())
	public function Actualizar($data)
	{
		
		foreach ($data as $campo=>$valor):
		$$campo = $valor;
		endforeach;
	
		try {
			$sql = "UPDATE pedido_linea SET 
						cantidad=?
					WHERE idproducto =? and idpedido=?";
			$this->pdo->prepare($sql)->execute(array(
				$precio,
				$idproducto,
				$idpedido
				));
		}
		catch (exception $e) {
			die($e->getMessage());
		}
		$this->RegistrarLog("JSON", "Editado", "Editado Pedido Linea Prod." . $idproducto . " Ped. " . $idpedido);	
		
	}
	

	public function FinalizarPedido($idpedido, $idproveedor, $precio, $usuario)
	{
		
		try {
			$sql = "UPDATE pedido SET 
						proveedor=?, fecha_recepcion =?, totalpedido=?, usuario_cierra=? 
					WHERE id =? ";
			$this->pdo->prepare($sql)->execute(array(
				$idproveedor,
				date("Y-m-d H:i:s"),
				$precio,
				$usuario,
				$idpedido
				));
		}
		catch (exception $e) {
			die($e->getMessage());
		}
		
		$disponibles = $this->ListarDisponibles($idpedido);
		
		foreach ($disponibles as $lineaproducto)
		{
			$elproducto =  $lineaproducto->idproducto;
			$elprecio = $this->ObtenerElPrecio($elproducto, $idpedido);
					try {		
						$sql = "UPDATE pedido_linea SET 
									precio=? , fecha = ?
								WHERE idpedido =? and idproducto = ? ";
						$this->pdo->prepare($sql)->execute(array(
							$elprecio->precio,
							date("Y-m-d H:i:s"),
							 $idpedido,
							 $lineaproducto->idproducto
							));
					}
					catch (exception $e) {
						die($e->getMessage());
					}
			
		}
		
		

			
		$this->RegistrarLog("JSON", "Editado", "Finalizado Pedido ."  . $idpedido);	
		
	}

	   public function ObtenerElPrecio($id_producto, $idproveedor)
		{
			try {
				$stm = $this->pdo->prepare("SELECT precio 
				FROM producto_proveedor
				WHERE id_producto =? and id_proveedor=?");
				$stm->execute(array($id_producto, $idproveedor ));
				$this->RegistrarLog("JSON", "Consulta", "Consulta Pedido Linea Prod." . $id_producto . " Ped. " . $id_pedido);	
				return $stm->fetch(PDO::FETCH_OBJ);
			}
			catch (exception $e) {
				die($e->getMessage());
			}
		}

		
	   public function RegistrarLog($usuario, $tipo, $detalle)
    {
        try {
            $sql = "INSERT INTO logs (usuario, fecha, operacion, consulta) 
		        VALUES (?, ?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $usuario,
                date("Y-m-d H:i:s"),
                $tipo,
                $detalle			
				));
			return $this->pdo->lastInsertId();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	
	
    public function Registrar($idproducto, $idpedido)
    {
		

        try {
            $sql = "INSERT INTO pedido_linea (idproducto, idpedido, fecha, cantidad) 
		        VALUES (?, ?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $idproducto,
                $idpedido,
				date("Y-m-d H:i:s"),
                1
    			));
			return $this->pdo->lastInsertId();
			
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Insertado", "Creado Pedido Linea Prod." . $idproducto . " Ped. " . $idpedido);	
		
		
    }

	
	   public function RegistrarNuevoPedido($nombre, $usuario)
    {
		
        try {
            $sql = "INSERT INTO pedido (referencia, fecha, usuario_abre) 
		        VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $nombre,
                date("Y-m-d H:i:s"),
                $usuario
    			));
			return $this->pdo->lastInsertId();
			
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Insertado", "Creado Pedido Linea Prod." . $idproducto . " Ped. " . $idpedido);	
		
		
    }

	
	
	
	
	

}
?>