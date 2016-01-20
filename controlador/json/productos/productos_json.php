<?php


if (isset($_GET['accion']))
{
	
	require_once('../../../modelo/producto.php');	
	
	switch ($_GET['accion']) 
	{

    case "Listar":
        $producto1 = new Producto();
		$lista = $producto1->Listar();
		echo json_encode($lista);
        break;
    case "Obtener":
		$producto1 = new Producto();
		$lista = $producto1->Obtener($_GET['id']);
		echo json_encode($lista);
        break;
    case "Eliminar":
		$producto1 = new Producto();
		$lista = $producto1->Eliminar($_GET['id']);
		$producto1->delete($_GET['id']);
		echo $_GET['id'];
		echo json_encode($producto1) ; 
        break;
    case "Crear":
		$data = json_decode(file_get_contents('php://input'), true);
		$producto1 = new Producto();
		$nuevoid = $producto1->Registrar($data);
		echo $nuevoid;
        break;		
    case "Actualizar":
		$data = json_decode(file_get_contents('php://input'), true);
		$producto1 = new Producto();
		$producto1->Actualizar($data); 
        break;				
	}
	
}

?>
	



