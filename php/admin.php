<?php
  include ("conecta.php");
  session_start();
  $id_adm = $_SESSION['id'];

  $query = $pdo->prepare("SELECT * FROM funcionarios");
  $query->execute();

  // Este bloco é para consultar a tabela filiais selecionando o nome da filial cadastrada
  // Onde o ID da filial for igual ao ID da sessão:
  $selecionar_filiais = $pdo->prepare("SELECT nome FROM filiais WHERE filial_adm = :id_adm");
  $selecionar_filiais->bindParam(':id_adm', $id_adm);
  $executar_consulta = $selecionar_filiais->execute();

?>