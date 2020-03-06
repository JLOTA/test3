<?php
include('../../../php/conexion.php');
$articulo = strtoupper($_POST['articulo']);
$descripcion = strtoupper($_POST['descripcion']);
$categoria = $_POST['categoria'];
$stock = $_POST['stock'];
$precio = $_POST['precio'];

$query = mysqli_query($conexion,"SELECT * FROM articulos WHERE articulo = '$articulo' AND id_categoria = '$categoria'");
$result = mysqli_fetch_array($query);

if(!empty($_POST)) {
  if(empty($_POST['articulo']) || empty($_POST['descripcion']) || empty($_POST['categoria']) || empty($_POST['stock']) || empty($_POST['precio'])) {
    echo "<script>
    alert('Todos los campos son obligatorios.');
    </script>";
  } else {
    if($result > 0) {
      echo "<script>
      alert('El articulo $articulo ya existe.');
      </script>";
    } else {
      $nombreImg=$_FILES['imagen']['name'];
      $ruta=$_FILES['imagen']['tmp_name'];
      $destino="../../../img/articulos/".$nombreImg;
      if (copy($ruta,$destino)) {
        $sql = "INSERT INTO articulos VALUES ('', '$articulo','$descripcion','$categoria','$stock','$nombreImg','$precio')";
        $exe = mysqli_query($conexion, $sql);
        if (!$exe) {
          //die(mysqli_error($conexion));
        }
        echo "<script>
              alert('Se registro el articulo $articulo correctamente.');
              </script>";
      }

    }
  }
}
?>