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
  Painel para gerenciar as opções de segurança, como dispositovs conectados e senhas utilizadas.
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
  <link rel="stylesheet" href="../../public/css/admSeguranca.css"/>
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />

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
            <a href="#">Perfil</a>
            <a href="admConfig.php">Configurações</a>
            <a href="../admLogout.php">Sair</a>
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

      <section aria-label="Painel principal" class="container_column">

        <!-- Texto principal -->
        <section aria-labelledby="titulo_painel" class="secao_container">
          <!-- Título e descrição -->
          <header class="descricao_geral">
            <h1 id="titulo_painel">Segurança</h1>
            <p>Aqui você encontra a visão geral do seu empreendimento:</p>
          </header>
        </section>

        <!-- Senha principal admin -->
        <section class="configs">
          <section class="titulo_configs">
            <h2>Senha Principal</h2>
            <button>Nova Senha</button>
          </section>
          <hr width="100%">
          <p>Esta é a sua senha de administrador. Você não tem nenhuma senha gerada ainda.</p>
          <input type="text" placeholder="Senha anterior">
          <input type="text" placeholder="Nova senha">
          <input type="text" placeholder="Confirmar nova senha">
          <p>A senha deve ter no mínimo 8 caracteres, incluindo letras e números. <a><b>Saiba mais.</b></a></p>
          <button>Alterar senha</button>
        </section>

        <!-- Verificar senhas de outras filiais -->
        <section class="configs">
          <section class="titulo_configs">
            <h2>Gerenciar senhas</h2>
          </section>
          <hr width="100%">
          <p>Esta é a sua senha de administrador. Você não tem nenhuma senha gerada ainda.</p>
          <input type="text" placeholder="Código da filial">
          <input type="text" placeholder="Código de usuário">
          <p>A senha deve ter no mínimo 8 caracteres, incluindo letras e números. <a><b>Saiba mais.</b></a></p>
          <button>Verificar Senha</button>
        </section>

        <!-- Dispositivos Conectados -->
        <section class="configs">
          <section class="titulo_configs">
            <h2>Acessos e sessões</h2>
          </section>
          <hr width="100%">
          <p>Esta é uma lista de dispositivos conectados à sua conta. Revogue acesso aos que você não reconhece.</p>
          
          <table>
            <tbody>
              <tr>
                <th>Endereço e IP</th>
                <th>Quando conectou</th>
                <th>Opções</th>
              </tr>
              <tr>
                <td>
                  <p>Joinville 177.221.52.92</p>
                  <p class="sub_table">Está é sua sessão atual</p>
                </td>
                <td></td>
                <td>
                  <button>
                    Saiba Mais
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Joinville 177.221.52.92</p>
                </td>
                <td></td>
                <td>
                  <button>
                    Saiba Mais
                  </button>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Joinville 177.221.52.92</p>
                </td>
                <td></td>
                <td>
                  <button>
                    Saiba Mais
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          
        </section>

      </section>

      <!-- Footer Cabuailo como navegação alternativa para login -->
      <footer aria-label="Navegação secundária footer">
        <section class="info_cabuailo">
          <img class="logo_cabuailo" src="../../public/imagens/logo.png" alt="Logo da Cabuailo">
          <header>
            <h1>Cabuailo</h1>
            <p>Gerencie suas senhas, crie novas, política de privacidade, encerramento remoto, para ter todo o controle em suas mãos.</p>
          </header>
        </section>

        <!-- Links da Cabuailo -->
        <section class="navegacao_footer">
          <ul class="links_navegacao_footer">
            <h1>Outras páginas!</h1>
            <a href="../homeScreen.html"><li>Home</li></a>
            <a href="../cadastro.html"><li>Cadastro empresa</li></a>
            <a href="#"><li>Cadastro cliente</li></a>
            <a href="#"><li>Termos de uso</li></a>
          </ul>
        </section>

        <!-- Links para contato -->
        <section class="navegacao_footer">
          <ul class="links_navegacao_footer">
            <h1>Contato</h1>
            <a href="#"><ion-icon name="location"></ion-icon><li>Av. Procópio Gomes - SENAI JLLE SUL</li></a>
            <a href="#"><ion-icon name="mail"></ion-icon><li>cabuailo_contato@gmail.com</li></a>
            <a href="#"><ion-icon name="call"></ion-icon><li>4002-8922</li></a>
            <a href="#"><ion-icon name="logo-twitter"></ion-icon><li>@cabuailo</li></a>
          </ul>
        </section>
      </footer>

    </section>
  </main>
  
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>