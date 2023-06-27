<?php
    include("conecta.php");
    session_start();

    $id_usuario = $_SESSION['id'];
    $id_filial = $_POST["id_filialForm"];

    $comando = $pdo->prepare("INSERT INTO favoritos (id_usuario, id_filial) VALUES('$id_usuario', '$id_filial')");
    $resultado = $comando->execute();

    header("Location: ../html/vermais.php?id_filial=$id_filial")
?>