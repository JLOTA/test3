<?php
include('../../../php/conexion.php');
if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($conexion, $_POST['id']);
  $query = "SELECT * from clientes WHERE id_clientes = {$id}";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die(mysqli_error($conexion));
  }
  $json = array();
  while($row = mysqli_fetch_array($result)) {
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
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
?>