<?php
  // Inicia a sessão, talvez não seja necessário porém antes
  // Estava bugando com o código das outras páginas que preveniam
  // Usuários de entrarem sem estarem logados.
  session_start();
  include("conecta.php");

  // Verifica se o ID foi fornecido
  if (isset($_GET['id_prod'])) 
  {
    // O ID foi fornecido pelos parâmetros da URL
    $id_prod = $_GET['id_prod'];

    // Excluir o funcionário do banco de dados com o ID fornecido e bindParam:
    $excluir_func = $pdo->prepare("DELETE FROM produtos WHERE id_produto = :id_prod");
    $excluir_func->bindParam(':id_prod', $id_prod);
    $executar = $excluir_func->execute();

    // Verifica se o funcionário foi excluído
    if ($executar === TRUE) 
    {
      header("Location: admin/admProdutos.php");
      // Excluído com sucesso
      echo ("<script type = text/javascript>");
        echo ("alert('Produto excluído com sucesso!')");
        echo ("window.location = 'admin/admProdutos.php'");
      echo ("</script>");
    } 
    else 
    {
      header("Location: admin/admProdutos.php");
      // Não foi possível excluir
      echo ("<script type = text/javascript>");
        echo ("alert('Erro ao excluir o produto, tente novamente.')");
        echo ("window.location = 'admin/admProdutos.php'");
      echo ("</script>");
    }
  } 
  else 
  {
    // Não foi fornecido o ID:
    echo "ID do produto não foi fornecido.";
  }
?>