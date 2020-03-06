<?php
include('../../../php/conexion.php');
if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($conexion, $_POST['id']);
  $query = "SELECT * from articulos WHERE id_articulo = {$id}";
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
    'stock' => $row['stock'],
    'precio' => $row['precio']
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
?>