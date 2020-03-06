<?php
$conexion = mysqli_connect("localhost", "root", "", "test");
$conexion->set_charset("utf8");
if(!$conexion){
	echo 'Error al conectar a la bd';
}
else{
	
}