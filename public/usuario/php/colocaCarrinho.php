<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_produto = $_POST["id_produtoForm"];
    $quantidade = $_POST["quantidade"];

    $comando = $pdo->prepare("INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES('$id_usuario', '$id_produto', '$quantidade')");
    $resultado = $comando->execute();

    header("Location: ../html/carrinho.php")
?>