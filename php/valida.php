<?php
  // Inicia sessão
  session_start();
  include ("conecta.php");

  $user = $_POST['user'];
  $password = $_POST['password'];

  // Realizar a consulta SQL para verificar se usuário e senha existem
  $sql =  "SELECT id_adm, adm_nome, adm_senha FROM usuarios_admin WHERE adm_nome = '$user' AND adm_senha = '$password'";
  $result = mysqli_query($conn, $sql);

  // Pegar a coluna ID: (seleciona as colunas)
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_adm"];
  }

  // Se existir, inicia sessão e redireciona para página de painel
  if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $user;
    $_SESSION['senha'] = $password;
    $_SESSION['id'] = $id;
    header("Location: admin/admPainel.php");
  } else {
    unset ($_SESSION['user']);
    unset ($_SESSION['senha']);
    unset ($_SESSION['id']);

    // Mensagem de erro, retorna usuário para tela de login
    echo ("<script type = text/javascript>");
      echo ("alert('Usuário ou senha incorretos');");
      echo ("window.location = 'admin/admlogin.php'");
    echo ("</script>");  

  };

?>