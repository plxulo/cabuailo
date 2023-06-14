<?php

include("conecta.php");
session_start();

// Armazenar entradas:
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$quantidade = $_POST["quantidade"];
$descricao = $_POST["descricao"];
$imagem = $_POST["imagem"];
$id = $_SESSION['id'];

// Cadastrar:
$inserir_produto = $pdo->prepare("INSERT INTO produtos (nome_produto, preco_produto, descricao_produto, quantidade_produto, id_adm) VALUES (?, ?, ?, ?, ?)");

// Bind param:
$inserir_produto->bindParam(1, $nome);
$inserir_produto->bindParam(2, $preco);
$inserir_produto->bindParam(3, $descricao);
$inserir_produto->bindParam(4, $quantidade);
$inserir_produto->bindParam(5, $id);

$inserir_produto->execute();

// Selecionar para exibir na tabela:
if($inserir_produto === TRUE)
{
  // Inserção bem sucedida:
  echo ("<script type = text/javascript>");
    echo ("alert('Produto cadastrado com sucesso!');");
    echo ("window.location = 'admin/admProdutos.php'");
  echo ("</script>");

  $selecionar_produto = $pdo->prepare("SELECT * FROM produtos WHERE id_adm = :id");
  $selecionar_produto->bindParam(':id', $id);
  $selecionar_produto->execute();
}
else
{
  echo ("<script type = text/javascript>");
    echo ("alert('Erro ao cadastrar o produto');");
    echo ("window.location = 'admin/admProdutos.php'");
  echo ("</script>");
}
?>