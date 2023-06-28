<?php
  include ("conecta.php");
  session_start();
  $id_adm = $_SESSION['id'];

  //$query = $pdo->prepare("SELECT * FROM funcionarios WHERE adm_superior = :id_adm");
  //$query->bindParam(':id_adm', $id_adm);
  //$query->execute();

  // Este bloco é para consultar a tabela funcionarios selecionando o nome do funcionário cadastrado
  // E a filial com base na chave estrangeira 'funcionarios.filial' utilizando INNER JOIN que busca dados em comum:
  $query = $pdo->prepare("SELECT funcionarios.*, filiais.nome FROM funcionarios INNER JOIN filiais ON funcionarios.filial = filiais.id_filial WHERE adm_superior = :id_adm");
  $query->bindParam(':id_adm', $id_adm);
  $query->execute();

  // Este bloco é para consultar a tabela filiais selecionando o nome da filial cadastrada
  // Onde o ID da filial for igual ao ID da sessão:
  $selecionar_filiais = $pdo->prepare("SELECT id_filial, nome FROM filiais WHERE filial_adm = :id_adm");
  $selecionar_filiais->bindParam(':id_adm', $id_adm);
  $executar_consulta = $selecionar_filiais->execute();

?>