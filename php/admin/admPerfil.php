<?php

  session_start();

  if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['senha']) == true))
  {
    header('location: admLogin.php');
  }

  $logado = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<!-- 
  Painel administrador para inserir alterar e remover dados do usuário no banco de dados
  Seguimos padrão ARIA (Accessible Rich Internet Applications) para dividir os elementos em seções
  Isso se deve ao fator de acessibilidade para pessoas com dificuldades
  https://www.w3.org/WAI/ARIA/apg/patterns/landmarks/examples/HTML5.html 
-->

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../public/css/admPerfil.css" />
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />

  <script defer src="../../js/private/sAdmCadastro.js"></script>

  <title>Painel Admin</title>
</head>

<body>

  <main>
    <!-- Barra de navegação na esquerda -->
    <aside class="navbar_esquerda" title="Barra de navegação" aria-label="Navegação esquerda">
      <navbar>
        <!-- Nome do sistema e logo -->
        <header class="titulo_navbar">
          <img class="logo_cabuailo" aria-label="Logo da Cabuailo" src="../../public/imagens/logo.png" />
          <h1>Cabuailo</h1>
        </header>

        <!-- Navegação principal -->
        <nav>
          <ul aria-label="Anchor da barra de navegação esquerda" class="navlinks">
            <input type="text" placeholder="Pesquisar...">
            <a href="admPainel.php">Painel principal</a>
            <a href="admCrud.php">Cadastros</a>
            <a href="#">Funcionários</a>
            <a href="admFiliais.php">Empreendimentos cadastrados</a>
            <a href="admSeguranca.php">Segurança</a>
            <hr width="100%">
            <a href="#">Ajuda</a>
            <a href="admPerfil.php">Perfil</a>
            <a href="admConfig.php">Configurações</a>
            <a href="../admLogout.php">Sair</a>
          </ul>
        </nav>
      </navbar>
    </aside>

    <!-- Seção do conteúdo principal da página escolhida -->
    <section class="principal">

      <!-- Barra de navegação topo com input para pesquisa de outras configurações -->
      <navbar class="navbar_topo" aria-label="Navegação topo">
        <section class="usuario_logado">
          <header>
            <?php
              echo ("<h1>" . $logado . "</h1>");
            ?>
          </header>
          <div class="foto_perfil"></div>
        </section>
      </navbar>

      <section class="container_column">
        <!-- Título e descrição -->
        <header class="descricao_geral">
          <h1 id="titulo_cadastros">Configurações do perfil</h1>
          <p>
            Cadastre sua filial diretamente no aplicativo para que seja visível para todos.
            Você pode insirir imagens, textos e produtos para cadastro e venda no aplicativo.
            Primeiro insira o nome e a descrição:
          </p>
        </header>

        <!--
          Seção das entradas para exibir no aplicativo 
          Registrar com banco de dados depois
        -->
        <section aria-label="Adicionar nome e descrição" class="inputs">
          <h1>Nome de usuário:</h1>
          <!-- Alter table -->
          <form action="../alterarNome.php" method="POST">
            <p>Esté é seu nome atual: <?php echo $logado ?></p>
            <input id="nome" type="text" placeholder="Novo nome" name="nome">
            <label for="nome">Este será o nome da sua conta de administrador</label>
            <button type="submit">Alterar Nome</button>
          </form>

        </section>

        <h1>Foto de perfil:</h1>
        <p>Insira sua foto de perfil</p>
        <section aria-label="Adicionar imagens do empreendimento" class="inputs">
        
          <form action="../salvar_imagem.php" method="POST" enctype="multipart/form-data">
            Selecione uma imagem:
            <input type="file" id="imagem" name="imagem">
            <input type="submit" value="Enviar">
          </form>

          <section aria-label="Botões inserir/remover imagens" class="container_botoes">
            <button>Inserir</button>
            <button>Remover</button>
          </section>

        <!-- Seção de inputs imagem -->
        </section>
      <!-- Seção column -->
      </section>
    <!-- Seção do conteúdo principal -->
    </section>

  </main>
</body>

</html>