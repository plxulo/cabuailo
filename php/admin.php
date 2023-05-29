<?php
  include ("conecta.php");

  $query = "SELECT * FROM funcionarios;";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Erro ao executar a consulta: " . mysqli_error($conn));
  }
?>
