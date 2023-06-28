<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_produto = $_POST['id_produto'];

    $comando = $pdo->prepare("DELETE FROM carrinho WHERE id_usuario = $id_usuario and id_produto = $id_produto;");
    $resultado = $comando->execute();

    header("Location: ../html/carrinho.php")
?>