<?php 
include('../../../php/conexion.php');

$search = $_POST['search'];

if(!empty($search)) {
	$query = "SELECT * FROM clientes where documento like '$search%'";
	$result = mysqli_query($conexion, $query);
	if(!$result) {
		die('Query Error'. mysqli_error($conexion));
	}
	$json = array();
	while ($row = mysqli_fetch_array($result)) {
		$json[] = array(
			'id_clientes' => $row['id_clientes'],
			'razon_social' => $row['razon_social'],
			'documento' => $row['documento'],
			'correo' => $row['correo'],
			'telefono' => $row['telefono'],
			'direccion' => $row['direccion'],
			'fecha_creacion' => $row['fecha_creacion']
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
 ?>