<?php
  include("conecta.php");
  session_start();

  if(isset($_GET['id_adm']))
  {
    $id_adm = $_GET['id_adm'];

    // Excluir conta em todas as tabelas:
    $excluir = $pdo->prepare("DELETE FROM funcionarios WHERE adm_superior = '$id_adm'");
    $excluir->execute();

    $excluir = $pdo->prepare("DELETE FROM filiais WHERE filial_adm = '$id_adm'");
    $excluir->execute();

    $excluir = $pdo->prepare("DELETE FROM imagem_pfp_adm WHERE pfp_adm = '$id_adm'");
    $excluir->execute();

    $excluir = $pdo->prepare("DELETE FROM produtos WHERE id_adm = '$id_adm'");
    $excluir->execute();

    $excluir = $pdo->prepare("DELETE FROM usuarios_admin WHERE id_adm = '$id_adm'");
    $excluir->execute();
    header("Location: admin/admLogin.php");
    session_destroy();
  }
  else
  {
    echo("<script type = text/javascript>");
      echo ("alert('ID não fornecido')");
      echo ("window.location = 'admin/admPerfil.php'");
    echo("</script>");
  }
?>