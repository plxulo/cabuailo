<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_produto = $_POST["id_produtoForm"];
    $quantidade = $_POST["numero"];
    $preco_produto = $_POST["preco_produtoForm"];

    if($quantidade < 1) {
        $quantidade = 1;
    }

    $comando = $pdo->prepare("INSERT INTO carrinho (id_usuario, id_produto, quantidade, preco) VALUES('$id_usuario', '$id_produto', '$quantidade', $preco_produto)");
    $resultado = $comando->execute();

    header("Location: ../html/carrinho.php")
?>