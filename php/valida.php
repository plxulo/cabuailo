<?php
  include ("conecta.php");

  $user = $_POST['user'];
  $password = $_POST['password'];
  $output;

  // Realizar a consulta SQL para verificar se usuário e senha existem
  $sql =  "SELECT usuario, senha FROM usuarios WHERE usuario = '$user' AND senha = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    session_start();
    $_SESSION['user'] = $user;
    header("Location: ../php/adminScreen.php");
  } else {
    $output = "Usuário ou senha incorretos";
    header("Location: html/admin/admLogin.html");
  };

?>