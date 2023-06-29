<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];

    $comando = $pdo->prepare("DELETE FROM carrinho WHERE id_usuario = $id_usuario;");
    $resultado = $comando->execute();

    header("Location: ../html/carrinho.php")
?>