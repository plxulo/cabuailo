<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];

    $comando = $pdo->prepare("INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES('$id_usuario', '$id_produto', '$quantidade')");
    $resultado = $comando->execute();

    header("Location: ../html/carrinho.php")
?>