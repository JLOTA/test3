<?php
include('../../../php/conexion.php');
if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($conexion, $_POST['id']);
  $query = "SELECT * from usuarios WHERE id_usuarios = {$id}";
  $result = mysqli_query($conexion, $query);
  if(!$result) {
    die(mysqli_error($conexion));
  }
  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
    'id_usuarios' => $row['id_usuarios'],
    'dni' => $row['dni'],
    'password' => $row['password'],
    'nombres' => $row['nombres'],
    'apellidos' => $row['apellidos'],
    'correo' => $row['correo'],
    'telefono' => $row['telefono'],
    'direccion' => $row['direccion']
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}
?>