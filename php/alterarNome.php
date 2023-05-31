<?php
  session_start();
  include ("conecta.php");

  $novoNome = $_POST["nome"];
  $nome = $_SESSION['user'];
  $id = $_SESSION['id'];

  //$query = "SELECT id_adm, adm_nome, adm_senha FROM usuarios_admin";
  //$result = mysqli_query($conn, $query);

  // Pegar a coluna ID: (seleciona as colunas)
  //while ($row = mysqli_fetch_assoc($result)) {
  //  $id = $row["id_adm"];
  //}

  $sql = "UPDATE usuarios_admin SET adm_nome = '$novoNome' WHERE id_adm = $id";
  $_SESSION['user'] = $novoNome;
  $result = mysqli_query($conn, $sql);

  if ($conn->query($sql) === TRUE)
  {
    echo("Nome alterado com sucesso!");

    //$_SESSION['senha'] = $novaSenha;

    //No sucesso, redirecionar para painel
    header("Location: admin/admPerfil.php");
  } 
  else
  {
    //Caso contrário, mostrar erro
    //Desatribuir sessão
    echo("Erro ao alterar o nome: ". $conn->error);
    session_destroy();

    //Voltar para cadastro
    header("Location: admin/admCadastro.php");
  }

  $conn->close();

?>