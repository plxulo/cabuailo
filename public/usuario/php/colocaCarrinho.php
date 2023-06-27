<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_produto = $_POST["id_produto"];

    echo $id_usuario;
    echo $id_produto;
    //$comando = $pdo->prepare("INSERT INTO carrinho (id_usuario, id_filial) VALUES('$id_usuario', '$id_filial')");
    //$resultado = $comando->execute();

    //header("Location: ../html/produto.php?id_produto=$id_produto")
?>