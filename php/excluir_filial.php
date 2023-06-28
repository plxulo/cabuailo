<?php
  // Inicia a sessão, talvez não seja necessário porém antes
  // Estava bugando com o código das outras páginas que preveniam
  // Usuários de entrarem sem estarem logados.
  session_start();
  include("conecta.php");

  // Verifica se o ID foi fornecido
  if (isset($_GET['id_filial'])) 
  {
    // O ID foi fornecido pelos parâmetros da URL
    $id_filial = $_GET['id_filial'];

    $excluir_funcionario = $pdo->prepare("DELETE FROM funcionarios WHERE filial = :id_filial");
    $excluir_funcionario->bindParam(':id_filial', $id_filial);
    $executar = $excluir_funcionario->execute();

    // Excluir o funcionário do banco de dados com o ID fornecido e bindParam:
    $excluir_filial = $pdo->prepare("DELETE FROM filiais WHERE id_filial = :id_filial");
    $excluir_filial->bindParam(':id_filial', $id_filial);
    $executar = $excluir_filial->execute();

    // Verifica se o funcionário foi excluído
    if ($executar == TRUE) 
    {
      // Excluído com sucesso
      header("Location: admin/empCadastrados.php");
    } 
    else 
    {
      // Não foi possível excluir
      echo ("<script type = text/javascript>");
        echo ("alert('Erro ao excluir a filial, tente novamente.')");
        echo ("window.location = 'admin/empCadastrados.php'");
      echo ("</script>");
    }
  } 
  else 
  {
    // Não foi fornecido o ID:
    echo "ID da filial não foi fornecido.";
  }
?>