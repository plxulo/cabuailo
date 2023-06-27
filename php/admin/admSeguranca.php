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
  Painel para gerenciar as opções de segurança, como dispositovs conectados e senhas utilizadas.
  Seguimos padrão ARIA (Accessible Rich Internet Applications) para dividir os elementos em seções
  Isso se deve ao fator de acessibilidade para pessoas com dificuldades
  https://www.w3.org/WAI/ARIA/apg/patterns/landmarks/examples/HTML5.html 
-->

<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="Website Icon" type="png" href="../../public/imagens/logo.png" />
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
            <a href="empCadastrados.php">Empreendimentos cadastrados</a>
            <a href="admFiliais.php">Adicionar Filiais</a>
            <a href="admProdutos.php">Adicionar Produtos</a>
            <a href="admAgendamentos.php">Agendamentos</a>
            <a href="admSeguranca.php">Segurança</a>
            <hr width="100%"/>
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
                echo '<img onclick="voltarPerfil();" src="../default.png" alt="Foto de Perfil" width="80" height="80">';
              }            
            ?>
          </div>
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
          <input type="text" class="senha" placeholder="Senha anterior" onkeyup="validar_senha()">
          <input type="text" class="senha" placeholder="Nova senha" onkeyup="validar_senha()">
          <input type="text" class="senha" placeholder="Confirmar nova senha" onkeyup="validar_senha()">
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
                  <p class="sub_table">Está é sua sessão atual</p>
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
<script src="../../public/js/perfil.js"></script>
<script>
  function validar_senha()
  {
    var senhas = document.getElementsByClassName("senha");
    for(var iteracao = 0; iteracao < senhas.length; iteracao++)
    {
      var senha = senhas[iteracao];
      expressao = /[A-z]{8}|[1-9]{8}/g;
      texto = senha.value;
      resposta = expressao.test(texto); // Retorna valor true / false

      // Verificar se texto está de acordo com a expressão
      if (resposta === true) {
        senha.classList.remove("--errado");
        senha.classList.add("--certo");
      }
      if (resposta == false) {
        senha.classList.remove("--certo")
        senha.classList.add("--errado")
      }
    }
  }
</script>
</html>