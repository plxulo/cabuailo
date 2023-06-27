<?php
  include("conecta.php");

  $sql = $pdo->prepare("SELECT DATE_FORMAT(data_agendamento, '%d/%m/%Y') AS mes, COUNT(DISTINCT id_usuario) AS total_clientes FROM app_agendamentos GROUP BY mes");
  $sql->execute();

  $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  $total_clientes = 0;
  $dados = array();

  foreach($result as $resultado)
  {
    $mes = $resultado['mes'];
    //$clientes = $resultado['total_clientes'];
    //echo "Mês: $mes, Total de Clientes: $clientes <br>";
    $clientes = intval($resultado['total_clientes']);
    $total_clientes += $clientes;
    $dados[] = array($mes, $clientes);
  }
  //echo $total_clientes;

  $json = json_encode($dados);
?>