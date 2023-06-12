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

    // Excluir o funcionário do banco de dados com o ID fornecido e bindParam:
    $excluir_func = $pdo->prepare("DELETE FROM filiais WHERE id_filial = :id_filial");
    $excluir_func->bindParam(':id_filial', $id_filial);
    $executar = $excluir_func->execute();

    // Verifica se o funcionário foi excluído
    if ($executar) 
    {
      // Excluído com sucesso
      echo ("<script type = text/javascript>");
      echo ("alert('Filial excluída com sucesso!')");
      echo ("window.location = 'admin/empCadastrados.php'");
      echo ("</script>");
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