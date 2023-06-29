<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_filial = $_GET['id_filial'];

    $comando = $pdo->prepare("DELETE FROM favoritos WHERE id_usuario = $id_usuario AND id_filial = $id_filial");
    $resultado = $comando->execute();

    header("Location: ../html/favoritos.php");
?>