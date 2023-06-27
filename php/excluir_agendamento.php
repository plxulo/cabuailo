<?php
  include("conecta.php");
  if(isset($_GET['id']))
  {
    $id_agendamento = $_GET['id'];

    // Excluir o agendamento:
    $excluir_agendamento = $pdo->prepare("DELETE FROM app_agendamentos WHERE id = :id_agendamento");
    $excluir_agendamento->bindValue(":id_agendamento", $id_agendamento);
    $excluir_agendamento->execute();

    if($excluir_agendamento)
    {
      header("Location: admin/admAgendamentos.php");
    }
  }
?>