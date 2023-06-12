<?php
  include ("conecta.php");
  session_start();
  $id_adm = $_SESSION['id'];

  $query = $pdo->prepare("SELECT * FROM filiais WHERE filial_adm = :id_adm");
  $query->bindParam(':id_adm', $id_adm);
  $query->execute();

?>