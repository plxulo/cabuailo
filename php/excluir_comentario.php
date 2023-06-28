<?php

    include("conecta.php");
    session_start();

    if(isset($_SESSION['user']))
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $deletar_comentario = $pdo->prepare("DELETE FROM app_comentarios WHERE id = '$id'");
            $deletar_comentario->execute();

            header("Location: admin/empCadastrados.php");
        }
        else
        {
            echo("ID não fornecido");
            header("Location: admin/empCadastrados.php");
        }
    }
    else
    {
        header("Location: admin/admLogin.php");
    }
?>