<?php
  include ("conecta.php");
  // Inicia sessão
  session_start();

  $user = $_POST['user'];
  $password = $_POST['password'];

  // Validar se as entradas do usuário retornam algo do banco de dados:
  $sql = $pdo->prepare("SELECT id_adm, adm_nome, adm_senha FROM usuarios_admin WHERE adm_nome = :nome AND adm_senha = :senha");
  $sql->bindParam(':nome', $user); 
  $sql->bindParam(':senha', $password); 

  $executar_validacao = $sql->execute();

  // Após a consulta, armazenar o valor do id_adm na sessão:
  $sql_id = $sql->fetch(PDO::FETCH_ASSOC);
  $id_usuario = $sql_id['id_adm'];

  // Verficiar se a validação deu certo ou não:
  if($executar_validacao === TRUE)
  {
    // Validação deu certo:
    if ($sql->rowCount() > 0) 
    {
      // Houve um retorno similar à entrada do usuário:
      $_SESSION['id'] = $id_usuario;
      $_SESSION['user'] = $user;
      $_SESSION['senha'] = $password;

      $pegar_imagem = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = :id");
      $pegar_imagem->bindParam(':id', $id_usuario);
      $pegar_imagem->execute();

      // Pegar os dados da foto para atribuir a sessão:
      $dados = $pegar_imagem->fetch(PDO::FETCH_ASSOC);
      $imagem = $dados['imagem'];
      $img_encode = base64_encode($imagem);

      if($dados)
      {
        $_SESSION['foto_perfil'] = $img_encode;
      }
      else
      {
        echo "<script type = text/javascript>";
        echo "window.alert('Erro ao consultar!')";
        echo "</script>";
      }

      header("Location: admin/admPainel.php");
    }
    else
    {
      // Não houve retorno no rowCount:
      unset($_SESSION['user']);
      unset($_SESSION['id']);

      // Por algum motivo, se eu utilizar o header("Location: x.php") o alerta não é exibido?
      echo ("<script type = text/javascript>");
        echo ("alert('Nome de usuário ou senha incorretos, tente novamente.');");
        echo ("window.location = 'admin/admLogin.php'");
      echo ("</script>"); 
    }
  }
  // Validação deu errado:
  else
  {
    unset($_SESSION['user']);
    unset($_SESSION['id']);

    echo ("<script type = text/javascript>");
    echo ("alert('A validação falhou, tente novamente.');");
    echo ("</script>");    
    header("Location: admin/admLogin.php");
  }
?>