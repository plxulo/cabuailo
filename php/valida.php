<?php
  session_start();
  include ("conecta.php");

  $user = $_POST['user'];
  $password = $_POST['password'];
  $output;

  // Realizar a consulta SQL para verificar se usuário e senha existem
  $sql =  "SELECT adm_nome, adm_senha FROM usuarios_admin WHERE adm_nome = '$user' AND adm_senha = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['user'] = $user;
    $_SESSION['senha'] = $password;
    header("Location: admin/admPainel.php");
  } else {
    $output = "Usuário ou senha incorretos";
    unset ($_SESSION['user']);
    unset ($_SESSION['senha']);
    header("Location: admin/admLogin.php");
  };

?>