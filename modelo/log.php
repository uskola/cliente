<?php
require_once 'Database.php';

//INSERT INTO `ciudad`(`id`, `nombre`) VALUES ([value-1],[value-2])


class Log
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
            $result = array();
			
            $stm = $this->pdo->prepare("
			SELECT id, usuario, fecha, operacion, consulta
			FROM logs
			WHERE " . $parametros . " order by fecha desc
		");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
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


