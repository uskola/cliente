<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class Informe
{
    private $pdo;
    public $id;
    public $nombre;
	public $nick;
	
	
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::Conectar();
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
    public function Listar($parametros='')
    {
		
        try {
            $sql = "INSERT INTO proveedor (id, nombre) 
		        VALUES (0, ' ')";
            $this->pdo->prepare($sql)->execute();
			
        }
        catch (exception $e) {
            die($e->getMessage());
        }
		$numero_registro = $this->pdo->lastInsertId();
		
        try {
            $result = array();
            $stm = $this->pdo->prepare("
			SELECT p.id as id, p.referencia as referencia, p.fecha as fecha, pro.nombre as nombre, p.totalpedido as totalpedido, CONCAT(p.usuario_abre  , ' - ' , p.usuario_cierra) as usuario
			FROM pedido p, proveedor pro 
			WHERE p.proveedor = pro.id and " . $parametros . " order by id desc
		");
            $stm->execute();
			$valor =  $stm->fetchAll(PDO::FETCH_OBJ);

		try {
			$stm = $this->pdo->prepare("DELETE FROM proveedor WHERE id=" . $numero_registro. "");
			$stm->execute();
		}
		catch (exception $e) {
			die($e->getMessage());
		}		
		return $valor;
	}
        catch (exception $e) {
            die($e->getMessage());
        }
			
		
    }


    public function Obtener($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM ciudad WHERE id=?");
            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        }
        catch (exception $e) {
            die($e->getMessage());
        }
    }
    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo->prepare("DELETE FROM ciudad WHERE id=?");
            $stm->execute(array($id));
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
}
?>


