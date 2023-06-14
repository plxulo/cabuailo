<?php
  include("../conecta.php");
  session_start();

  if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['senha']) == true))
  {
    header('location: admLogin.php');
  }

  $id = $_SESSION['id'];
  
  // As linhas abaixo você usará sempre que quiser mostrar a imagem
  $comando = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = $id");
  //$comando->bindParam(':id', $id);
  $resultado = $comando->execute();

  // Operador de coalescência nula (?? 'default.png') para evitar o erro de null no PHP:
  $logado = $_SESSION['user'];
  $foto_perfil = $_SESSION['foto_perfil'];
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
            <a href="empCadastrados.php">Empreendimentos cadastrados</a>
            <a href="admFiliais.php">Adicionar Filiais</a>
            <a href="admProdutos.php">Adicionar Produtos</a>
            <a href="admSeguranca.php">Segurança</a>
            <hr width="100%">
            <a href="#">Ajuda</a>
            <a href="admPerfil.php">Perfil</a>
            <a href="admConfig.php">Configurações</a>
            <a href="../adm_logout.php">Sair</a>
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
          <div class="foto_perfil">
            <?php
              // Exibir a imagem do usuário logado:
              // Verificar se a consulta retornou resultados
              if ($comando->rowCount() > 0) 
              {
                // Recuperar os dados da imagem
                $dados_imagem = $comando->fetch(PDO::FETCH_ASSOC);
                // Exibir a imagem no elemento <img> no HTML
                echo '<img src="data:image/jpeg;base64,' . $foto_perfil . '" alt="Foto de Perfil" width="85px" height="85px" style="border-radius: 50px;">';
              } 
              else 
              {
                // Caso não haja imagem associada ao usuário, exibir uma imagem padrão
                echo '<img src="../default.png" alt="Foto de Perfil" width="80" height="80">';
              }
            ?>
          </div>
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
        <h1>Nome de usuário:</h1>
        <section aria-label="Adicionar nome e descrição" class="inputs">
          <!-- Alter table -->
          <form action="../alterar_nome.php" method="POST">
            <p>Esté é seu nome atual: <?php echo $logado ?></p>
            <input id="nome" type="text" placeholder="Novo nome" name="novo_nome">
            <label for="nome">Este será o nome da sua conta de administrador</label>
            <button type="submit">Alterar Nome</button>
          </form>
        </section>
        
        <section aria-labelledby="nova_foto" class="inputs nova_foto" title="Nova foto de perfil">
          <header aria-labelledby="foto_atual" title="Foto de perfil atual">
            <h1>Foto de perfil:</h1>
            <p id="foto_atual">Esta é a sua foto atual:</p>
            <?php
              echo '<img src="data:image/jpeg;base64,' . $foto_perfil . '" alt="Foto de Perfil" width="200px" height="200px">';
            ?>
          </header>
          <form action="../salvar_imagem.php" method="POST" enctype="multipart/form-data">
            <h1 id="nova_foto">Nova foto de perfil:</h1>
            <p>Selecione uma imagem:</p>
              <input type="file" id="imagem" name="imagem">
              <input type="submit" value="Enviar">
          </form>

        <!-- Seção de inputs imagem -->
        </section>
      <!-- Seção column -->
      </section>
    <!-- Seção do conteúdo principal -->
    </section>

  </main>
</body>

</html>