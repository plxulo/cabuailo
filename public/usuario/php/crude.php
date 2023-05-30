<?php
    include("conecta.php");

    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if(isset($_POST["inserir"])) {
        $comando = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES('$nome', '$email', '$senha')");
        $resultado = $comando->execute();
        header("Location: cadastrofoda.html");
    }


?>