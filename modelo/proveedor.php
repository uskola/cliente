<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class Proveedor
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
            $stm = $this->pdo->prepare("SELECT id, nombre, direccion, email, telefono, provincia 
			FROM proveedor
			WHERE id =?");
            $stm->execute(array($id));
			$data =  $this->ObtenerNick($id);
				foreach ($data as $campo=>$valor):
					$$campo = $valor;
				endforeach;
			$this->RegistrarLog("JSON", "Consulta", "Consulta Proveedor " . $id . " - " . $nombre);	
            $datos =  $stm->fetch(PDO::FETCH_OBJ);
			$datos->telefono = (int)$datos->telefono;
			return $datos;
		}
        catch (exception $e) {
            die($e->getMessage());
        }
    }
	

    public function ObtenerNick($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT nombre 
			FROM proveedor
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
	
	
	
	
    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM proveedor
		WHERE id =?");
            $stm->execute(array($id));
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Eliminado", "Eliminado proveedor " . $id . " - " . $this->ObtenerNick($id) );		
		
    }
	

	
//	set($user_data=array())
	public function Actualizar($data)
	{
		
		foreach ($data as $campo=>$valor):
		$$campo = $valor;
		endforeach;
		
		try {
			$sql = "UPDATE proveedor SET 
						nombre=?,
						direccion=?,
						email=?,
						telefono=?,
 						provincia=?
					WHERE id=?";
			$this->pdo->prepare($sql)->execute(array(
				$nombre,
				$direccion,
				$email,
				$telefono,
				$provincia,
				$id
				));
		}
		catch (exception $e) {
			die($e->getMessage());
		}
		$this->RegistrarLog("JSON", "Editado", "Editado proveedor " . $id . " - " . $nombre );
		
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
            $sql = "INSERT INTO proveedor (nombre, direccion, email, telefono, provincia) 
		        VALUES (?, ?, ?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $nombre,
                $direccion,
                $email,
                $telefono,
				$provincia
				));
			return $this->pdo->lastInsertId();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		
		$this->RegistrarLog("JSON", "Insertado", "Creado proveedor " .  $nombre );
		
		
    }

	
}
?>