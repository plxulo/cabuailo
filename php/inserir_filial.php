<?php
  
  include("conecta.php");
  session_start();

  // Armazena o ID do usuário atual para atribuí-lo à filial
  $id_adm = $_SESSION['id'];

  // Variáveis com dados enviados pelo usuário:
  $nome_filial = $_POST["nome"];
  $endereco_filial = $_POST["endereco"];
  $cep_filial = $_POST["cep"];
  $descricao_filial = $_POST["descricao"];
  $foto_filial = file_get_contents($_FILES["imagem"]["tmp_name"]);
  $servicos_filial = $_POST["servicos_disponiveis"];

  // Inserir valorzinho mistério no banco de dados, junto com o ID referente ao usuário atual:
  $inserir_filial = $pdo->prepare("INSERT INTO filiais (nome, endereco, cep, filial_adm, imagem, descricao, servicos) VALUES (?, ?, ?, ?, ?, ?, ?)");

  // bindParams para segurança:
  $inserir_filial->bindParam(1, $nome_filial);
  $inserir_filial->bindParam(2, $endereco_filial);
  $inserir_filial->bindParam(3, $cep_filial);
  $inserir_filial->bindParam(4, $id_adm);
  $inserir_filial->bindParam(5, $foto_filial, PDO::PARAM_LOB);
  $inserir_filial->bindParam(6, $descricao_filial);
  $inserir_filial->bindParam(7, $servicos_filial);

  $executar_insert = $inserir_filial->execute();

  if($executar_insert === TRUE)
  {
    // Execução deu certo:
    header("Location: admin/admFiliais.php");
  }
  else
  {
    // Execução deu errado:
    header("Location: admin/admFiliais.php");
  }

?>