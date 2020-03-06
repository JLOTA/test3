<?php
include('../../../php/conexion.php');

if(isset($_POST['id_clientes'])) {

  $id_clientes = $_POST['id_clientes'];
  $razon_social = strtoupper($_POST['razon_social']);
  $documento = $_POST['documento'];
  $correo = strtoupper($_POST['correo']);
  $telefono = $_POST['telefono'];
  $direccion = strtoupper($_POST['direccion']);
    
  $query = "UPDATE clientes SET razon_social = '$razon_social', documento = '$documento', correo = '$correo', telefono = '$telefono', direccion = '$direccion' WHERE id_clientes = '$id_clientes'";
  $result = mysqli_query($conexion, $query);
  if (!$result) {
    die('Query Error'. mysqli_error($conexion));
  } else {
    echo $result;
  }
}
?>