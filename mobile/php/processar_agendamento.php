<?php
    include("../php/conecta.php");
    session_start();
    $agendar = $pdo->prepare("INSERT INTO app_agendamentos (id_usuario, id_funcionario, id_filial, servico_escolhido, data_agendamento)
                              VALUES (:id_suario, :idfuncionario, :idfilial, :servico, :data_agendamento)");

    $id_cliente = $_SESSION['id'];
    $funcionario = $_SESSION['id_funcionario'];
    $id_filial = $_SESSION['id_filial'];
    $data_agendamento = $_POST['data_agendamento'];
    $forma_pagamento = $_POST['forma_pagamento'];
    $servicos = $_POST['servico'];

    $agendar->bindValue(":id_suario", $id_cliente);
    $agendar->bindValue(":idfuncionario", $funcionario);
    $agendar->bindValue(":idfilial", $id_filial);
    $agendar->bindValue(":data_agendamento", $data_agendamento);

    // Percorrer os valores da checkbox e executar insert:
    foreach($servicos as $servico)
    {
        $agendar->bindValue(":servico", $servico);
        $agendar->execute();
    }

    if($agendar) 
    {
        header("Location: ../html/mainPage.php");
    }

?>