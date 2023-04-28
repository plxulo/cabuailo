<?php
  include ("conecta.php");

  $query = "SELECT * FROM usuarios;";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Erro ao executar a consulta: " . mysqli_error($conn));
  }
?>
