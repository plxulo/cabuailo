<?php
include ("conecta.php");
session_start();

// ID da sessão, quando o usuário é logado seu ID é atribuído à essa sessão:
$id = $_SESSION['id'];
$senha = $_POST['senha_anterior'];
$nova_senha = $_POST['nova_senha'];

$senha_antiga = $pdo->prepare("SELECT adm_senha FROM usuarios_admin WHERE id_adm = :id AND adm_senha = :senha");
$senha_antiga->bindParam(":id", $id, PDO::PARAM_INT);
$senha_antiga->bindParam(":senha", $senha, PDO::PARAM_STR);
$senha_antiga->execute();

if ($senha_antiga->rowCount() > 0) {
  $nova_senha_query = $pdo->prepare("UPDATE usuarios_admin SET adm_senha = :nova_senha WHERE id_adm = :id");
  $nova_senha_query->bindParam(':nova_senha', $nova_senha, PDO::PARAM_STR);
  $nova_senha_query->bindParam(':id', $id, PDO::PARAM_INT);
  $nova_senha_query->execute();
  echo ("<script type='text/javascript'>");
  echo ("alert('Senha atualizada com sucesso');");
  echo ("window.location = 'admin/admSeguranca.php'");
  echo ("</script>");
  exit;
} else {
  echo ("<script type='text/javascript'>");
  echo ("alert('Senha antiga incorreta');");
  echo ("window.location = 'admin/admSeguranca.php'");
  echo ("</script>");
  exit;
}
?>