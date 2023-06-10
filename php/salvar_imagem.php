<?php
  /* 
    Este trecho em PHP salva a imagem enviada pelo usuário dentro do banco de dados
    Após salvar, podemos exibir a imagem no website
  */
  include("conecta.php");
  session_start();

  // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB

  // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
  $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
	
  // Insere a imagem no banco de dados junto com o ID do usuário:
  $comando = $pdo->prepare("INSERT INTO imagem_pfp_adm(imagem, pfp_adm) VALUES(:imagem, $_SESSION[id])");
  $comando->bindParam(":imagem", $imagem, PDO::PARAM_LOB);
  $resultado = $comando->execute();
        
  $id = $_SESSION['id'];
  
  // As linhas abaixo você usará sempre que quiser mostrar a imagem
  $comando = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = $id");
  //$comando->bindParam(':id', $id);
  $resultado = $comando->execute();
  
  if($resultado === TRUE) 
  {
    $consulta_imagem = $comando->fetch(PDO::FETCH_ASSOC);
    $imagem = $consulta_imagem["imagem"];

    // Converter a imagem para base64 e armazená-la em uma sessão:
    $i = base64_encode($imagem);
    $_SESSION['foto_perfil'] = $i;
    header("Location: admin/admPerfil.php");
  }
  else
  {
    $imagem = "default.png";
    $i = base64_encode($imagem);
    $_SESSION['foto_perfil'] = $i;
    header("Location: admin/admPerfil.php");
  }

  /*
  while( $linhas = $comando->fetch() )
  {
    $dados_imagem = $linhas["imagem"];
    $i = base64_encode($dados_imagem);

    echo(" <img src='data:image/jpeg;base64,$i' width='100px'> <br> ");
  }
  */
?>