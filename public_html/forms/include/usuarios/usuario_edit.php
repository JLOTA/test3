<?php
include('../../../php/conexion.php');

if(isset($_POST['id_usuarios'])) {

  $dni = $_POST['dni'];
  $password = $_POST['password'];
  $tipo_user = $_POST['id_tipo_usuario'];
  $nombres = strtoupper($_POST['nombres']);
  $apellidos = strtoupper($_POST['apellidos']);
  $email = strtoupper($_POST['correo']);
  $telefono = $_POST['telefono'];
  $direccion = strtoupper($_POST['direccion']);
  $id = $_POST['id_usuarios'];

  if(!empty($_POST)) {
    if(empty($_POST['id_tipo_usuario'])) {
      $query = "UPDATE usuarios SET dni = '$dni', password = '$password', nombres = '$nombres', apellidos = '$apellidos', correo = '$email', telefono = '$telefono', direccion = '$direccion' WHERE id_usuarios = '$id'";
    } else {
      $query = "UPDATE usuarios SET dni = '$dni', password = '$password', nombres = '$nombres', apellidos = '$apellidos', correo = '$email', telefono = '$telefono', id_tipo_usuario = '$tipo_user', direccion = '$direccion' WHERE id_usuarios = '$id'";
    }
    $result = mysqli_query($conexion, $query);
    if (!$result) {
      die('Query Error'. mysqli_error($conexion));
    } else {
      echo $result;
    }
}}
?>