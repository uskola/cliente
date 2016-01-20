<?php


if (isset($_GET['accion']))
{
	
	require_once('../../../modelo/proveedor.php');	
	
	switch ($_GET['accion']) 
	{

    case "Listar":
        $proveedor1 = new Proveedor();
		$lista = $proveedor1->Listar();
		echo json_encode($lista);
        break;
    case "Obtener":
		$proveedor1 = new Proveedor();
		$lista = $proveedor1->Obtener($_GET['id']);
		echo json_encode($lista);
        break;
    case "Eliminar":
		$proveedor1 = new Proveedor();
		$lista = $proveedor1->Eliminar($_GET['id']);
		$proveedor1->delete($_GET['id']);
		echo $_GET['id'];
		echo json_encode($proveedor1) ; 
        break;
    case "Crear":
		$data = json_decode(file_get_contents('php://input'), true);
		$proveedor1 = new Proveedor();
		$nuevoid = $proveedor1->Registrar($data);
		echo $nuevoid;
        break;		
    case "Actualizar":
		$data = json_decode(file_get_contents('php://input'), true);
		$proveedor1 = new Proveedor();
		$proveedor1->Actualizar($data); 
        break;				
	}
	
}

?>
	



