<?php
  //Arquivo para fazer logout do usuário

  session_start();

  //Destruir sessão
  session_destroy();
  
  //Voltar para o login
  header("Location: admin/admLogin.php");
?>