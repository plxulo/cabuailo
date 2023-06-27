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

    $pegar_id = $validar->fetch(PDO::FETCH_ASSOC);
    $id = $pegar_id['id'];

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
        $_SESSION["id"] = $id;
        header('Location: ../html/mainPage.php');
    }
?>