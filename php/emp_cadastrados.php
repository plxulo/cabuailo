<?php
  include ("conecta.php");
  session_start();
  $id_adm = $_SESSION['id'];

  $query = $pdo->prepare("SELECT filiais.*, usuarios_admin.adm_nome FROM filiais INNER JOIN usuarios_admin ON filiais.filial_adm = usuarios_admin.id_adm  WHERE filial_adm = :id_adm");
  $query->bindParam(':id_adm', $id_adm);
  $query->execute();

?>