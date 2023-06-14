<?php
  // Inicia a sessão, talvez não seja necessário porém antes
  // Estava bugando com o código das outras páginas que preveniam
  // Usuários de entrarem sem estarem logados.
  session_start();
  include("conecta.php");

  // Verifica se o ID foi fornecido
  if (isset($_GET['id_func'])) 
  {
    // O ID foi fornecido pelos parâmetros da URL
    $id_func = $_GET['id_func'];

    // Excluir o funcionário do banco de dados com o ID fornecido e bindParam:
    $excluir_func = $pdo->prepare("DELETE FROM funcionarios WHERE id_func = :id_func");
    $excluir_func->bindParam(':id_func', $id_func);
    $executar = $excluir_func->execute();

    // Verifica se o funcionário foi excluído
    if ($executar === TRUE) 
    {
      header("Location: admin/admCrud.php");
      // Excluído com sucesso
      echo ("<script type = text/javascript>");
      echo ("alert('Funcionário excluído com sucesso!')");
      echo ("window.location = 'admin/admCrud.php'");
      echo ("</script>");
    } 
    else 
    {
      header("Location: admin/admCrud.php");
      // Não foi possível excluir
      echo ("<script type = text/javascript>");
      echo ("alert('Erro ao excluir o funcionário, tente novamente.')");
      echo ("window.location = 'admin/admCrud.php'");
      echo ("</script>");
    }
  } 
  else 
  {
    // Não foi fornecido o ID:
    echo "ID do funcionário não foi fornecido.";
  }
?>