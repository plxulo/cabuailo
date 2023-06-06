<?php
  include ("conecta.php");

  $query = $pdo->prepare("SELECT * FROM funcionarios");
  $query->execute();

  $result = $query->fetchAll(PDO::FETCH_ASSOC);
?>