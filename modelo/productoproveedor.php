<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class ProductosProveedores
{
    private $pdo;
    public $id;
    public $nombre;
	public $nick;
	public $id_producto;
	public $id_proveedor;


		
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::Conectar();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

			
   public function ObtenerPrecio($id_producto, $id_proveedor)
    {
        try {
            $stm = $this->pdo->prepare("SELECT precio 
			FROM producto_proveedor
			WHERE id_producto =? and id_proveedor=?");
            $stm->execute(array($id_producto, $id_proveedor ));
			$this->RegistrarLog("JSON", "Consulta", "Consulta Producto-Proveedor Prod." . $id_producto . " Prov " . $id_proveedor);	
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

		
		//getuserlist() 
    public function ListarProveedores()
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, nombre
			FROM proveedor order by nombre asc
		");
            $stm->execute();
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista proveedores ");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }
	
    public function ListarDisponibles($id_proveedor)
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT pp.id_producto, p.nombre, pp.id_proveedor, pp.precio 
			FROM producto_proveedor as pp, producto as p where pp.id_producto=p.id and id_proveedor= ?
		");
            $stm->execute(array($id_proveedor));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos disponibles para proveedor " . $id_proveedor);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	
	


    public function ListarNoDisponibles($id_proveedor)
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT  t1.id as id_producto, t1.nombre as nombre, " . $id_proveedor . " as id_proveedor FROM producto T1
			WHERE NOT EXISTS (SELECT * from producto_proveedor T2 where T2.id_proveedor = ?  and T1.id = T2.id_producto)
		");
            $stm->execute(array($id_proveedor));
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos no disponibles para proveedor " . $id_proveedor);	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }	


	
    public function Eliminar($id_producto, $id_proveedor)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM producto_proveedor
		WHERE id_producto =? and id_proveedor=?");
            $stm->execute(array($id_producto, $id_proveedor));
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Eliminado", "Eliminado Producto-Proveedor Prod." . $id_producto . " Prov " . $id_proveedor);		
		
    }
	

	
//	set($user_data=array())
	public function Actualizar($data)
	{
		
		foreach ($data as $campo=>$valor):
		$$campo = $valor;
		endforeach;
	
		try {
			$sql = "UPDATE producto_proveedor SET 
						precio=?
					WHERE id_producto =? and id_proveedor=?";
			$this->pdo->prepare($sql)->execute(array(
				$precio,
				$id_producto,
				$id_proveedor
				));
		}
		catch (exception $e) {
			die($e->getMessage());
		}
		$this->RegistrarLog("JSON", "Editado", "Editado Producto-Proveedor Prod." . $id_producto . " Prov " . $id_proveedor);	
		
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
	
	
    public function Registrar($id_producto, $id_proveedor)
    {
		

        try {
            $sql = "INSERT INTO producto_proveedor (id_producto, id_proveedor, fecha, precio) 
		        VALUES (?, ?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $id_producto,
                $id_proveedor,
				date("Y-m-d H:i:s"),
                0
    			));
			return $this->pdo->lastInsertId();
			
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Insertado", "Creado Producto-Proveedor Prod." . $id_producto . " Prov " . $id_proveedor);	
		
		
    }

	
	
	
	
	
	
	

}
?>