<?php 
include('../../../php/conexion.php');

$search = $_POST['search'];

if(!empty($search)) {
	$query = "SELECT * FROM usuarios a INNER JOIN tipo_usuario c on a.id_tipo_usuario=c.id_tipo_usuario where dni like '$search%' ORDER BY a.id_usuarios";
	$result = mysqli_query($conexion, $query);
	if(!$result) {
		die('Query Error'. mysqli_error($conexion));
	}
	$json = array();
	while ($row = mysqli_fetch_array($result)) {
		$json[] = array(
			'id_usuarios' => $row['id_usuarios'],
			'dni' => $row['dni'],
			'password' => $row['password'],
			'nombres' => $row['nombres'],
			'apellidos' => $row['apellidos'],
			'correo' => $row['correo'],
			'telefono' => $row['telefono'],
			'direccion' => $row['direccion'],
			'fecha_creacion' => $row['fecha_creacion'],
			'cargo' => $row['cargo']
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
 ?>