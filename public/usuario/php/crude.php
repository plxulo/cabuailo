<?php
    include("conecta.php");

    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $comando = $pdo->prepare("INSERT INTO usuario (usuario, email, senha) VALUES('$nome', '$email', '$senha')");
    $resultado = $comando->execute();
    header("Location: ../html/mainPage.html");


?>