<?php
    include("conecta.php");

    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $comando = $pdo->prepare("INSERT INTO usuarios (usuario, email, senha) VALUES(?, ?, ?)");
    $comando->bindParam(1, $nome);
    $comando->bindParam(2, $email);
    $comando->bindParam(3, $senha);
    $resultado = $comando->execute();
    header("Location: ../html/loginUsuario.php");

?>