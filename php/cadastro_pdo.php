<?php
  session_start();
  include("conecta_pdo.php");

  // Armazenar as entradas do usuário:
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // Variável $sql prepara uma inserção dentro do banco de dados:
  $sql = $pdo->prepare("INSERT INTO usuarios_admin (adm_nome, adm_email, adm_senha) VALUES (?,?,?)");

  // bindParam(ordem na consulta, variável) para proteger o banco de dados de SQL injection:
  $sql->bindParam(1, $nome);
  $sql->bindParam(2, $email);
  $sql->bindParam(3, $senha);

  $executar_insert = $sql->execute();

  // Selecionar o id_adm da última inserção:
  $query = $pdo->prepare("SELECT id_adm FROM usuarios_admin ORDER BY id_adm DESC LIMIT 1");
  $executar_query = $query->execute();

  // Após a consulta, armazenar o valor do id_adm na sessão:
  $query_id = $query->fetch(PDO::FETCH_ASSOC);
  $id_adm = $query_id['id_adm'];

  if($executar_insert === TRUE)
  {
    // Inserção bem sucedida:
    $_SESSION['usuario'] = $nome;
    $_SESSION['id_adm'] = $id_adm;
    header('Location: pagina.php');
  }
  else
  {
    // Inserção falhou:
    unset($_SESSION['usuario']);
    unset($_SESSION['id_adm']);

    echo ("<script type = text/javascript>");
      echo ("alert('Erro ao cadastrar o usuário, por favor, tente novamente.');");
      echo ("window.location = 'admin/admCadastro.php'");
    echo ("</script>");    
  }

?>