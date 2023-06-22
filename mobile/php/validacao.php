<?php
    //Inicia a seção
    session_start();
    include("conecta.php");

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $validar = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $validar->bindParam(':email', $email);
    $validar->bindParam(':senha', $senha);
    $validar->execute();

    $usuario_info = $validar->fetchAll();
    $id_usuario = $usuario_info["id"];

    if($validar->rowCount() == 0)
    {
        echo
        ("
            <script type=text/javascript>
                alert('Email ou senha incorretos')
                window.location = '../html/loginUsuario.php'     
            </script>
        ");
    }
    else
    {
        $_SESSION["usuario"] = $usuario_info["usuario"];
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id_usuario;
        header('Location: ../html/mainPage.php');
    }
?>