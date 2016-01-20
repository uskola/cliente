<?php
require_once 'modelo/Database.php';

class Sesiones
{
    private $pdo;

	public $sesion;
	public $tiempo = 3600;
	public $nick;

	public $usuario_sesion;
	public $usuario_nick;
		
    public $usuario;
	public $id;
	public $nombre;

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
			
   public function Desconectar($id)
    {
		unset($_COOKIE["usuario"]);
		unset($_COOKIE["sesion"]);
		session_start(); 
		$_SESSION = array();
		session_destroy();
		header('Location: index.php'); 
    }
	
    public function CambiarSesion($usuario)
    {
		$int = 3600;
		unset($_COOKIE["usuario"]);
		unset($_COOKIE["sesion"]);
		if(session_id() == ""){ 
			session_start(); 
		} else 	{ 
			session_regenerate_id();         
		} 
		$sesion = session_id(); 
		setcookie("usuario",$usuario,time()+$int);
		setcookie("sesion",$sesion ,time()+$int);
		$_SESSION["usuario"] = $usuario; 
		$this->usuario = $usuario;
		$this->sesion = $sesion;
	}
		

    public function ComprobarSesionActiva($usuario, $sesion)
    {

		$correcto = true;
		if ($correcto){
			return true;
		}else{
			unset($_COOKIE["usuario"]);
			unset($_COOKIE["sesion"]);
			header('Location: index.php'); 
		}
    }
	
	
    public function ComprobarSesion()
    {
		if(session_id() == ""){
			if(!isset($_COOKIE["usuario"])) {
				header('Location: index.php'); 
			} else 	{ 
				$usuario = $_COOKIE["usuario"];
				$sesion = $_COOKIE["sesion"];
				if ($this->ComprobarSesionActiva($usuario, $sesion)){
					$this->CambiarSesion($usuario);
				}
			}
		}else{
			$usuario = $_SESSION["usuario"];
			$this->CheckSesion();
		} 
    }
	

		public function CheckSesion()
		{
			session_start(); 
			$sesion = session_id(); 
			if (isset($_SESSION["usuario"])){
				$usuario = $_SESSION["usuario"];
				$this->GetLoginSesion($usuario, $sesion);
				$isUser = true;
				$isAdmin = true;
			}
		}


		public function SetSession($sesion, $nick) {
			try {
				$stm = $this->pdo->prepare("
					UPDATE usuarios
					SET sesion=?
					WHERE nick =?
				");
					
				$stm->execute(array($sesion, $nick));
				
			}
				catch (exception $e) {
				die($e->getMessage());
			}
		
		}
	

		public function GetLoginSesion($nick, $sesion) 
		{
			try {
				$stm = $this->pdo->prepare("SELECT id, nombre, nick, clientes , proveedores, productos, usuarios, pedidos, ventas, logs
					FROM usuarios WHERE nick =? and sesion = ?");
				$stm->execute(array($nick, $sesion));
				$parametros =  $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($parametros as $parametro)
				{
					$this->nombre = $parametro->nombre;
					$this->nick = $parametro->nick;	
					$this->id = $parametro->id;	
					$this->clientes = $parametro->clientes;	
					$this->proveedores = $parametro->proveedores;	
					$this->productos = $parametro->productos;	
					$this->usuarios = $parametro->usuarios;	
					$this->pedidos = $parametro->pedidos;						
					$this->ventas = $parametro->ventas;	
					$this->logs = $parametro->logs;	
				}
			}
			catch (exception $e) {
				die($e->getMessage());
			}
		}

		
		public function GetLogin($nick, $pass) {
	
			$stm = $this->pdo->prepare("SELECT nick, pass 
				FROM usuarios WHERE nick = ? and pass = ?");
			$stm->execute(array($nick, $pass));
			return $stm->fetch(PDO::FETCH_OBJ);
		}
}
?>