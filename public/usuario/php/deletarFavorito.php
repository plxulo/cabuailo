<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_filial = $_POST["id_filialForm"];

    $comando = $pdo->prepare("DELETE * FROM favoritos WHERE id_usuario = $id_usuario AND id_filial = $id_filial");
    $resultado = $comando->execute();

    header("Location: ../html/favoritos.html")
?>