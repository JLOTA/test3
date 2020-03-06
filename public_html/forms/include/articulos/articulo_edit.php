<?php
  include('../../../php/conexion.php');
if(isset($_POST['id_articulo'])) {
  $articulo = strtoupper($_POST['articulo']);
  $descripcion = strtoupper($_POST['descripcion']);
  $categoria = $_POST['categoria'];
  $stock = $_POST['stock'];
  $precio = $_POST['precio'];
  $id = $_POST['id_articulo']; 

  $nombreImg=$_FILES['imagen']['name'];
  $ruta=$_FILES['imagen']['tmp_name'];
  $destino="../../../img/articulos/".$nombreImg;
  if (copy($ruta,$destino)) {
    if(empty($_POST['categoria'])) {
      $query = "UPDATE articulos SET articulo = '$articulo', detalle_articulo = '$descripcion', stock = '$stock', precio = '$precio', foto = '$nombreImg' WHERE id_articulo = '$id'";
      $result = mysqli_query($conexion, $query);
    } else{
      $query = "UPDATE articulos SET articulo = '$articulo', detalle_articulo = '$descripcion', id_categoria = '$categoria', stock = '$stock', precio = '$precio', foto = '$nombreImg' WHERE id_articulo = '$id'";
      $result = mysqli_query($conexion, $query);
      }
  } else {
    if(empty($_POST['categoria'])) {
      $query = "UPDATE articulos SET articulo = '$articulo', detalle_articulo = '$descripcion', stock = '$stock', precio = '$precio' WHERE id_articulo = '$id'";
      $result = mysqli_query($conexion, $query);
    } else{
      $query = "UPDATE articulos SET articulo = '$articulo', detalle_articulo = '$descripcion', id_categoria = '$categoria', stock = '$stock', precio = '$precio' WHERE id_articulo = '$id'";
      $result = mysqli_query($conexion, $query);
      }
  }
}
?>