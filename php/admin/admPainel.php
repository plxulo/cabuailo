<?php
  /* 
  esse bloco de código em php verifica se existe a sessão, pois o usuário pode
  simplesmente não fazer o login e digitar na barra de endereço do seu navegador
  o caminho para a página principal do site (sistema), burlando assim a obrigação de
  fazer um login, com isso se ele não estiver feito o login não será criado a session,
  então ao verificar que a session não existe a página redireciona o mesmo
  para a index.php.
  */
  include("../conecta.php");
  include("../painel_info.php");

  session_start();

  if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['senha']) == true))
  {
    header('location: admLogin.php');
  }

  $id = $_SESSION['id'];
  
  // As linhas abaixo você usará sempre que quiser mostrar a imagem
  $comando = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = $id");
  $resultado = $comando->execute();

  // Operador de coalescência nula (?? 'default.png') para evitar o erro de null no PHP:
  $logado = $_SESSION['user'];
  $foto_perfil = $_SESSION['foto_perfil'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<!-- 
  Painel geral do administrador exibindo informações relevantes sobre o negócio
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
  <link rel="stylesheet" href="../../public/css/stylePainel.css"/>
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />

  <!-- Tabelas com: https://developers.google.com/chart/interactive/docs?hl=pt-br -->
  <!-- Carregar scripts AJAX para Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    /*
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', 'Expenses'],
        ['2004',  1000,      400],
        ['2005',  1170,      460],
        ['2006',  660,       1120],
        ['2007',  1030,      540]
      ]);

      var options = {
        title: 'Número de Clientes',
        curveType: 'function',
        width: 380,
        height: 215,
        legend: { position: 'bottom' }
      };

      // Iniciar e exibir o gráfico com opções: (Exibir a tabela com base no id)
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    */
  </script>

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
            echo("<h1>" . $logado . "</h1>");
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
            <?php
              // Dar boas vindas ao usuário logado
              echo (
                "<h1> Bem vindo(a), "
                  .
                  $logado
                  .
                "</h1>"
              )
            ?>
            <p>Aqui você encontra a visão geral do seu empreendimento:</p>
          </header>
        </section>

        <!-- Estatísticas e gráficos ( 1 container row geral com dois elementos e elemento column + 2 elementos em column)-->
        <section aria-label="Estatísticas e gráficos" class="container_row">
          <section class="clientes_rendimentos">
            <!-- Este ID faz com que o gráfico de pizza criado com JavaScript seja exibido: -->
            <!-- Ele está em cima do h1 / h2 e ocupa o espaço do gráfico, mudar altura e largura no JavaScript -->
            <div class="grafico" id="chart_div">
              <div class="grafico_texto">
                <h1>Clientes</h1>
                <h2>5,241</h2>
              </div>
            </div>
            <div class="grafico">
              <div class="grafico_texto">
                <h1>Rendimentos</h1>
                <h2>R$ 35,231</h2>
              </div>
            </div>
          </section>

          <section  aria-label="Gráfico entradas e saídas" class="fluxo_caixa">
            <div class="grafico_grande">
                <div class="grafico_texto">
                  <h1>Fluxo de Caixa</h1>
                  <div class="valor_entrada">
                    <h2>R$ 35,231</h2>
                    <h4>Entradas</h4>
                  </div>

                  <div class="valor_saida">
                    <h2>R$ 24,832</h2>
                    <h4>Saídas</h4>
                  </div>
                </div>
            </div>
          </section>
        </section>
        
        <!-- Tabela com estatísticas de vendas de produtos -->
        <section class="tabela_vendas" aria-labelledby="titulo_vendas">
          <!-- Título vendas -->
          <header>
            <h1 id="titulo_vendas">Serviços e produtos mais vendidos:</h1>
          </header>

          <table class="tabela_redonda">
            <!-- Dados da tabela -->
            <thead>
              <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Valor</th>
                <th>Quantidade</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Dia de noivo</td>
                <td>450</td>
                <td>1</td>
                <td>450</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Barba e corte</td>
                <td>25</td>
                <td>353</td>
                <td>8,825</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Barba e corte</td>
                <td>25</td>
                <td>353</td>
                <td>8,825</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Barba e corte</td>
                <td>25</td>
                <td>353</td>
                <td>8,825</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Barba e corte</td>
                <td>25</td>
                <td>353</td>
                <td>8,825</td>
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
            <p>A Cabuailo faz uso de tecnologias avançadas para garantir a segurança e eficiência de sua barbearia!</p>
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
<script type="text/javascript">
  // Carregue a biblioteca do Google Charts
  google.charts.load('current', {'packages':['corechart']});

  // Defina a função de callback para o carregamento da biblioteca
  google.charts.setOnLoadCallback(drawChart);

  // Função para desenhar o gráfico
  function drawChart() {
    // Crie uma tabela de dados
    var data = new google.visualization.DataTable();

    // Defina as colunas da tabela
    data.addColumn('string', 'Ano');
    data.addColumn('number', 'Total de Clientes');

    // Adicione os dados à tabela
    data.addRows(<?php echo $json; ?>);

    // Configurar as opções do gráfico
    var options = {
      title: 'Número de Clientes por Ano',
      hAxis: {title: 'Ano'},
      vAxis: {title: 'Total de Clientes'}
    };

    // Crie o gráfico de colunas
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
</html>