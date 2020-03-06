<?php 
include('../../../php/conexion.php');

$query = "SELECT * FROM articulos a INNER JOIN categoria c on a.id_categoria=c.id_categoria ORDER BY a.id_articulo";

$result = mysqli_query($conexion, $query);
if(!$result) {
die('Query Failed'. mysqli_error($conexion));
}
$json = array();
while($row = mysqli_fetch_array($result)) {
$json[] = array(
	'id_articulo' => $row['id_articulo'],
  	'articulo' => $row['articulo'],
  	'descripcion' => $row['detalle_articulo'],
  	'categoria' => $row['categoria'],
  	'stock' => $row['stock'],
  	'foto' => $row['foto'],
  	'precio' => $row['precio']
);
}
$jsonstring = json_encode($json);
echo $jsonstring;
?>