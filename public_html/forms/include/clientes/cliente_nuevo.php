<?php
include('../../../php/conexion.php');
$id_clientes = $_POST['id_clientes'];
$razon_social = strtoupper($_POST['razon_social']);
$documento = $_POST['documento'];
$correo = strtoupper($_POST['correo']);
$telefono = $_POST['telefono'];
$direccion = strtoupper($_POST['direccion']);
$hoy = date('Y-m-d');

$query = mysqli_query($conexion,"SELECT * FROM clientes where id_clientes='$id_clientes'");
$result = mysqli_fetch_array($query);
$msj = '';
if(!empty($_POST)) {
    if(empty($_POST['razon_social']) || empty($_POST['documento']) || empty($_POST['correo'])|| empty($_POST['telefono'])|| empty($_POST['direccion'])) {
        $msj= "<script>
        alert('Todos los campos son obligatorios.');
        </script>";
    } else {
        if($result > 0) {
            $msj =  "<script>
            alert('$razon_social ya existe.');
            </script>";
        } else {
                $consulta = mysqli_query ($conexion, "INSERT INTO `clientes` VALUES ('', '$razon_social', '$documento', '$telefono', '$correo', '$direccion', '$hoy')"); 
                $msj = "<script>
                alert('Se registro a $razon_social correctamente.');
                </script>";
        }
    }
}
echo $msj;
?>