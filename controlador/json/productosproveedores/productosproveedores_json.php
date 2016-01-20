<?php


if (isset($_GET['accion']))
{
	
	require_once('../../../modelo/productoproveedor.php');	
	
	switch ($_GET['accion']) 
	{

    case "Listar":
        $proveedor1 = new ProductosProveedores();
		$lista = $proveedor1->ListarProveedores();
		echo json_encode($lista);
        break;
    case "Obtener":
		$proveedor1 = new ProductosProveedores();
		$lista = $proveedor1->ListarDisponibles($_GET['id']);
		echo json_encode($lista);
        break;
		
    case "ObtenerNo":
		$proveedor1 = new ProductosProveedores();
		$lista = $proveedor1->ListarNoDisponibles($_GET['id']);
		echo json_encode($lista);
        break;		
    case "Eliminar":
		$proveedor1 = new ProductosProveedores();
		$proveedor1->Eliminar($_GET['id_producto'],$_GET['id_proveedor'] );
		echo $_GET['id_proveedor'];
        break;
    case "Crear":
		$proveedor1 = new ProductosProveedores();
		$nuevoid = $proveedor1->Registrar($_GET['id_producto'],$_GET['id_proveedor'] );
		echo $_GET['id_proveedor'];
        break;		
    case "Actualizar":
		$data = json_decode(file_get_contents('php://input'), true);
		$proveedor1 = new ProductosProveedores();
		$proveedor1->Actualizar($data); 
        break;				
	}
	
}

?>
	



