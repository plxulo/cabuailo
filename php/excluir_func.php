<?php
  session_start();
  include("admin/admCrud.php");

  if(isset($_GET['id_func']))
  {
    $id_func = $_GET['id_func'];

    $excluir_func = $pdo->prepare("DELETE FROM funcionarios WHERE id_func = $id_func");
    $executar = $excluir_func->execute();
    header("Location: admin/admCrud.php");

    if ($executar) {
      echo "Funcionário excluído com sucesso!";
    } else {
      echo "Erro ao excluir o funcionário.";
    }
  }
?>