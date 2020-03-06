<?php
session_start();
$dni = $_POST['usuario'];
$password = $_POST['clave'];
require_once 'conexion.php';
$consulta = mysqli_query ($conexion, "SELECT * FROM usuarios WHERE dni = '$dni' AND password = '$password'"); 

if(!$consulta){ 
    echo "<script>
    alert('Por favor ingrese usuario y contraseña correctas');
   	history.go(-1);
   	</script>";
} 

if($user = mysqli_fetch_assoc($consulta)){ 
		header('location:../forms/listar_productos.php');
	} 
	else{ 
		echo "<script>
    	alert('Por favor ingrese usuario y contraseña correctas');
    	history.go(-1);
    	</script>";
}	 