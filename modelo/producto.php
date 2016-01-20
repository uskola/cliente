<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class Producto
{
    private $pdo;
    public $id;
    public $nombre;
	public $nick;
	
	public $clientes;
	public $proveedores;
	public $productos;
	public $usuarios;	
	public $pedidos;
	public $ventas;
	public $logs ;	

		
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::Conectar();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

			
   public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT id, nombre, precio, stock, imagen, stockminimo, caracteristicas 
			FROM producto
			WHERE id =?");
            $stm->execute(array($id));
			$data =  $this->ObtenerNick($id);
				foreach ($data as $campo=>$valor):
					$$campo = $valor;
				endforeach;
			$this->RegistrarLog("JSON", "Consulta", "Consulta Producto " . $id . " - " . $nombre);	
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

    public function ObtenerNick($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT nombre 
			FROM producto
			WHERE id =?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }
		
		//getuserlist() 
    public function Listar()
    {
        try {
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, nombre
			FROM producto order by nombre asc
		");
            $stm->execute();
			$this->RegistrarLog("JSON", "Consulta", "Consulta lista productos ");	
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }

    }
	
	
	
	
    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM producto
		WHERE id =?");
            $stm->execute(array($id));
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Eliminado", "Eliminado producto " . $id . " - " . $this->ObtenerNick($id) );		
		
    }
	

	
//	set($user_data=array())
	public function Actualizar($data)
	{
		
		foreach ($data as $campo=>$valor):
		$$campo = $valor;
		endforeach;
		
		try {
			$sql = "UPDATE producto SET 
						nombre=?,
						precio=?,
						stock=?,
						imagen=?,
 						stockminimo=?,
						caracteristicas=?
					WHERE id=?";
			$this->pdo->prepare($sql)->execute(array(
				$nombre,
				$precio,
				$stock,
				$imagen,
				$stockminimo,
				$caracteristicas,
				$id
				));
		}
		catch (exception $e) {
			die($e->getMessage());
		}
		$this->RegistrarLog("JSON", "Editado", "Editado producto " . $id . " - " . $nombre );
		
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
	
	
	
	
	
    public function Registrar($data)
    {
		
		foreach ($data as $campo=>$valor):
		$$campo = $valor;
		endforeach;

		
        try {
            $sql = "INSERT INTO producto (nombre, precio, stock) 
		        VALUES (?, ?, ? )";
            $this->pdo->prepare($sql)->execute(array(
                $nombre,
                $precio,
                $stock
				));
			return $this->pdo->lastInsertId();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Insertado", "Creado producto " .  $nombre );
		
		
    }

	
}
?>