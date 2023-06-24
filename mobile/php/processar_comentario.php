<?php
    /*
        Este bloco de código insere comentários na tabela comentários
        Para selecioná-los depois no arquivo index.php e exibi-los
        Na página. A tabela tem chave estrangeira id_usuario, pois desejo
        Separar no banco de dados para não poluir a tabela usuários.
    */

    include("conecta.php");
    session_start();

    $comentario = $_POST['frm_comentario'];
    $id_usuario = $_SESSION['id'];
    $id_filial = $_SESSION['id_filial'];

    $selecionar_filial = $pdo->prepare
    ("SELECT * FROM filiais WHERE id_filial = $id_filial");
    $selecionar_filial->execute();
    $filial = $selecionar_filial->fetch();
    
    $id_filial = $filial['id_filial'];

    $inserir_comentario = $pdo->prepare("INSERT INTO app_comentarios (comentario, id_usuario, id_filial)
                                        VALUES (?, ?, ?)");
    $inserir_comentario->bindParam(1, $comentario);
    $inserir_comentario->bindParam(2, $id_usuario);
    $inserir_comentario->bindParam(3, $id_filial);
    $inserir_comentario->execute();

    // Atualizar a página mantendo o ID post para que o post seja exibido corretamente.
    if($inserir_comentario)
    {
        header("Location: ../html/vermais.php?id_filial=$id_filial");
    }
?>