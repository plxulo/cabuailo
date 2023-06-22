<?php
  include("conecta.php");
  session_start();

  // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
  $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);

  $inserir_imagem = $pdo->prepare("INSERT INTO filiais (imagem) VALUES (:imagem");
?>