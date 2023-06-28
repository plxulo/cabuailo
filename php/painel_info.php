<?php
  include("conecta.php");

  $sql = $pdo->prepare("SELECT FLOOR(YEAR(data_agendamento) / 5) * 5 AS ano_raio, COUNT(DISTINCT id_usuario) AS total_clientes 
  FROM app_agendamentos 
  GROUP BY FLOOR(YEAR(data_agendamento) / 5) * 5");
  $sql->execute();

  $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  $total_clientes = 0;
  $dados = array();

  foreach($result as $resultado)
  {
    $ano = $resultado['ano_raio'];
    //$clientes = $resultado['total_clientes'];
    //echo "Mês: $mes, Total de Clientes: $clientes <br>";
    $clientes = intval($resultado['total_clientes']);
    $total_clientes += $clientes;
    $dados[] = array(strval($ano), $total_clientes);
  }
  //echo $total_clientes;

  $json = json_encode($dados);

  /*
  $sql = $pdo->prepare("SELECT FLOOR(MONTH(data_agendamento) / 2) * 2 AS ano_raio, COUNT(DISTINCT id_usuario) AS total_clientes
                        FROM app_agendamentos 
                        GROUP BY FLOOR(MONTH(data_agendamento) / 2) * 2");

  $sql->execute();
  $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  $dados = array();
  $total_clientes = 0;

  foreach ($result as $row) {
    $ano_raio = $row['ano_raio'];
    $clientes = intval($row['total_clientes']);

    $total_clientes += $clientes;
    echo "Ano Raio: $ano_raio, Total de Clientes: $total_clientes<br>";
    $dados[] = array(strval($ano_raio), $total_clientes);
  }
  */

?>