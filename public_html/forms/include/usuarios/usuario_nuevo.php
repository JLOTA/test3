<?php
include('../../../php/conexion.php');
$id_usuarios = $_POST['id_usuarios'];
$dni = $_POST['dni'];
$password = $_POST['password'];
$nombres = strtoupper($_POST['nombres']);
$apellidos = strtoupper($_POST['apellidos']);
$correo = strtoupper($_POST['correo']);
$telefono = $_POST['telefono'];
$direccion = strtoupper($_POST['direccion']);
$hoy = date('Y-m-d');
$id_tipo_usuario = $_POST['id_tipo_usuario'];

$query = mysqli_query($conexion,"SELECT * FROM usuarios where dni='$dni'");
$result = mysqli_fetch_array($query);
$msj = '';
if(!empty($_POST)) {
    if(empty($_POST['dni']) || empty($_POST['password']) || empty($_POST['id_tipo_usuario']) || empty($_POST['nombres']) || empty($_POST['apellidos'])|| empty($_POST['correo'])|| empty($_POST['telefono'])|| empty($_POST['direccion'])) {
        $msj= "<script>
        alert('Todos los campos son obligatorios.');
        </script>";
    } else {
        if($result > 0) {
            $msj =  "<script>
            alert('El usuario $dni ya existe.');
            </script>";
        } else {
                $consulta = mysqli_query ($conexion, "INSERT INTO `usuarios` VALUES ('', '$dni', '$password', '$nombres', '$apellidos', '$correo', '$telefono', '$direccion', '$hoy', '$id_tipo_usuario')"); 
                $msj = "<script>
                alert('Se registro a $nombres $apellidos correctamente.');
                </script>";
        }
    }
}
echo $msj;
?>