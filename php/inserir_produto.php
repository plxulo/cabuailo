<?php

include("conecta.php");
session_start();

// Armazenar entradas:
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$quantidade = $_POST["quantidade"];
$descricao = $_POST["descricao"];
$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
$id = $_SESSION['id'];

// Cadastrar:
$inserir_produto = $pdo->prepare("INSERT INTO produtos 
(nome_produto, preco_produto, descricao_produto, quantidade_produto, imagem_produto, id_adm) 
VALUES (:nome, :preco, :descricao, :quantidade, :imagem, :id)");

// Bind param:
$inserir_produto->bindParam(':nome', $nome);
$inserir_produto->bindParam(':preco', $preco);
$inserir_produto->bindParam(':descricao', $descricao);
$inserir_produto->bindParam(':quantidade', $quantidade);
$inserir_produto->bindParam(":imagem", $imagem, PDO::PARAM_LOB);
$inserir_produto->bindParam(':id', $id);

$inserir_produto->execute();

// Selecionar para exibir na tabela:
if($inserir_produto === TRUE)
{
  // Inserção bem sucedida:
  echo ("<script type = text/javascript>");
    echo ("alert('Produto cadastrado com sucesso!');");
    echo ("window.location = 'admin/admProdutos.php'");
  echo ("</script>");
}
else
{
  echo ("<script type = text/javascript>");
    echo ("alert('Erro ao selecionar o produto');");
    echo ("window.location = 'admin/admProdutos.php'");
  echo ("</script>");
}

// Consultar os produtos cadastrados:
$selecionar_produto = $pdo->prepare("SELECT * FROM produtos WHERE id_adm = :id");
$selecionar_produto->bindParam(':id', $id);
$selecionar_produto->execute();
?>