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
  Painel geral de configurações do administrador exibindo configurações como tema escuro, etc.
  Seguimos padrão ARIA (Accessible Rich Internet Applications) para dividir os elementos em seções
  Isso se deve ao fator de acessibilidade para pessoas com dificuldades
  https://www.w3.org/WAI/ARIA/apg/patterns/landmarks/examples/HTML5.html 
-->

<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />
  <link rel="stylesheet" href="../../public/css/admConfig.css">

  <title>Painel Principal</title>
</head>

<body>

  <main>
    <aside class="navbar_esquerda" title="Barra de navegação" aria-label="Navegação esquerda">
        <navbar>
          <!-- Nome do sistema e logo -->
          <header class="titulo_navbar">
            <img class="logo_cabuailo" aria-label="Logo da Cabuailo" src="../../public/imagens/logo.png"/>
            <h1>Cabuailo</h1>
          </header>

          <!-- Navegação principal -->
          <nav>
            <ul aria-label="Anchor da barra de navegação esquerda" class="navlinks">
              <input type="text" placeholder="Pesquisar..."/>
              <a href="admPainel.php">Painel principal</a>
              <a href="admCrud.php">Cadastros</a>
              <a href="#">Funcionários</a>
              <a href="admFiliais.php">Empreendimentos cadastrados</a>
              <a href="admSeguranca.php">Segurança</a>
              <hr width="100%"/>
              <a href="#">Ajuda</a>
              <a href="admPerfil.php">Perfil</a>
              <a href="admConfig.php">Configurações</a>
              <a href="../adm_logout.php">Sair</a>
            </ul>
          </nav>
        </navbar>
    </aside>

    <section class="principal">
      <!-- Barra de navegação topo com input para pesquisa de outras configurações -->
      <navbar aria-label="Navegação topo" class="navbar_topo">
        <section class="usuario_logado">
          <header>
            <?php
              echo ("<h1>" . $logado . "</h1>");
            ?>
          </header>
          <div class="foto_perfil"></div>
        </section>
      </navbar>
      <!-- Só deve ter a opção de alterar tema escuro / claro -->
      <section aria-labelledby="titulo" class="container_column">
        <header id="titulo" class="titulo">
          <h1>Configurações</h1>
        </header>

        <!-- Switch redondinho -->
        <hr width="100%">
        <section class="container_switch">
          <p>Tema escuro</p>
          <input type="checkbox" id="switch" /><label for="switch"></label>
        </section>
        <hr width="100%">
      </section>
    </section>

  </main>

</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>

<!-- Feito por SENAS TECH em 2023 -->