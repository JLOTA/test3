<?php 
include('../../../php/conexion.php');
if(isset($_POST['id'])) {
  $id = $_POST['id'];
  $query = "DELETE FROM clientes WHERE id_clientes = $id"; 
  $result = mysqli_query($conexion, $query);
  if (!$result) {
    die('Query Failed.');
  }
  echo "Task Deleted Successfully";  
}
 ?>