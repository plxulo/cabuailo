<?php
    session_start();

    include("conecta.php");

    $id
    $id_produto = $_POST['id_produto'];
    $quantidade = $_POST['quantidade'];
    
    $comando = $pdo->prepare("INSERT INTO carrinho (id_usuario, id_produto, quantidade) VALUES('$id', '$id_produto', '$quantidade')");
    $resultado = $comando->execute();
?>
