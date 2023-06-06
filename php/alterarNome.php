<?php
  include("conecta.php");
  session_start();

  $id_usuario = $_SESSION['id'];
  $nome_atual = $_SESSION['user'];

  // Entradas do usuário:
  $novo_nome = $_POST['novo_nome'];

  $sql = $pdo->prepare("UPDATE usuario SET adm_nome = :nome WHERE id_adm = $id_usuario");
  $sql->bindParam(':nome', $novo_nome);

  $executar_alterar = $sql->execute();

  if($executar_alterar === TRUE)
  {
    // Update deu certo:
    $_SESSION['usuario'] = $novo_nome;

    echo("<script type = text/javascript>");
        echo ("alert('Nome alterado!');");
    echo("</script>");
    header('Location: /admin/admPerfil.php');
  }
  else
  {
    // Update deu errado:
    echo("<script type = text/javascript>");
        echo ("alert('Falha ao alterar o nome!');");
    echo("</script>");
    header('Location: /admin/admPerfil.php');   
  }
?>