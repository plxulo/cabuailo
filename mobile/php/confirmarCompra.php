<?php

    include("conecta.php");
    session_start();

    $filial = $_GET['id_filial'];
    $id = $_SESSION['id'];
    $valor = $_GET['valor'];

    if(!isset($filial) && !isset($valor))
    {
        echo ("<script type = text/javascript>");
            echo ("alert('Nenhum produto no carrinho');");
            echo ("window.location = '../html/mainPage.php'");
        echo ("</script>"); 
    }

    $inserir_pedido = $pdo->prepare("INSERT INTO pedidos(filial, id_cliente, valor) VALUES (?, ?, ?)");
    $inserir_pedido->bindValue(1, $filial);
    $inserir_pedido->bindValue(2, $id);
    $inserir_pedido->bindValue(3, $valor);
    $inserir_pedido->execute();

    if($inserir_pedido == TRUE)
    {
        $deletar = $pdo->prepare("DELETE FROM carrinho WHERE id_usuario = ?");
        $deletar->bindValue(1, $id);
        $deletar->execute();
        echo ("<script type = text/javascript>");
            echo ("alert('Pedido realizado com sucesso!');");
            echo ("window.location = '../html/mainPage.php'");
        echo ("</script>"); 
    }
?>