<?php


if (isset($_GET['accion']))
{
	
	require_once('../../../modelo/usuario.php');	
	
	switch ($_GET['accion']) 
	{

    case "Listar":
        $usuario1 = new Usuario();
		$lista = $usuario1->Listar();
		echo json_encode($lista);
        break;
    case "Obtener":
		$usuario1 = new Usuario();
		$lista = $usuario1->Obtener($_GET['id']);
		echo json_encode($lista);
        break;
    case "Eliminar":
		$usuario1 = new Usuario();
		$lista = $usuario1->Eliminar($_GET['id']);
		$usuario1->delete($_GET['id']);
		echo $_GET['id'];
		echo json_encode($usuario1) ; 
        break;
    case "Crear":
		$data = json_decode(file_get_contents('php://input'), true);
		$usuario1 = new Usuario();
		$nuevoid = $usuario1->Registrar($data);
		echo $nuevoid;
        break;		
    case "Actualizar":
		$data = json_decode(file_get_contents('php://input'), true);
		$usuario1 = new Usuario();
		$usuario1->Actualizar($data); 
        break;				
	}
	
}

?>
	



