<?php
  include("../conecta.php");
  session_start();
  if ((!isset($_SESSION['user']) == true) and (!isset($_SESSION['senha']) == true)) {
    header('location: admLogin.php');
  }

  $id = $_SESSION['id'];

  // As linhas abaixo você usará sempre que quiser mostrar a imagem
  $comando = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = $id");
  $resultado = $comando->execute();

  // Operador de coalescência nula para evitar o erro de null no PHP:
  $logado = $_SESSION['user'];
  $foto_perfil = $_SESSION['foto_perfil'] ?? 'default.png';
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

  <link rel="Website Icon" type="png" href="../../public/imagens/logo.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../public/css/styleAdmin.css" />
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />

  <script defer src="../../public/js/private/sAdmCadastro.js"></script>

  <title>Agendamentos</title>
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
            <a href="admAgendamentos.php">Agendamentos</a>
            <a href="admSeguranca.php">Segurança</a>
            <hr width="100%">
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
            if ($comando->rowCount() > 0) {
              // Recuperar os dados da imagem
              $dados_imagem = $comando->fetch(PDO::FETCH_ASSOC);
              // Exibir a imagem no elemento <img> no HTML
              echo '<img src="data:image/jpeg;base64,' . $foto_perfil . '" alt="Foto de Perfil" width="85px" height="85px" style="border-radius: 50px;">';
            } else {
              // Caso não haja imagem associada ao usuário, exibir uma imagem padrão
              echo '<img onclick="voltarPerfil();" src="../default.png" alt="Foto de Perfil" width="80" height="80">';
            }
            ?>
          </div>
        </section>
      </navbar>

      <section class="container_column">
        <!-- Seção com as funcionalidades (botões) e formulário submit para cada uma das func. -->
        <section aria-labelledby="titulo_cadastros" class="secao_container">
          <!-- Título e descrição -->
          <header class="descricao_geral">
            <h1 id="titulo_cadastros">Agendamentos</h1>
            <p>Gerenciamento dos agendamentos cadastrados no sistema.</p>
            <p>Selecione abaixo o que gostaria de realizar no banco de dados.</p>
            <a href="empCadastrados.php">Clique aqui para visualizar empreendimentos</a>
          </header>
        </section>

        <!-- Tabela com usuários -->
        <section aria-label="Tabela de usuários cadastrados" class="tabela_usuarios">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Funcionário</th>
                <th>Filial selecionada</th>
                <th>Serviço</th>
                <th>Data</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Selecionar os agendamentos e os nomes dos envolvidos com base na filial ser do adm:
              $query = $pdo->prepare("SELECT app_agendamentos.*, usuarios.usuario, funcionarios.nome_func, filiais.nome FROM app_agendamentos
                                      INNER JOIN filiais ON app_agendamentos.id_filial = filiais.id_filial
                                      INNER JOIN usuarios ON app_agendamentos.id_usuario = usuarios.id
                                      INNER JOIN funcionarios ON app_agendamentos.id_funcionario = funcionarios.id_func
                                      WHERE filiais.filial_adm = $id");
              $query->execute();

              // Exibir os funcionários cadastrados.
              // Se existir algum funcionário (rowCount() > 0 ), mostrar os dados (fetch).
              // Se não existir nenhum funcionário, mostrar uma mensagem.
              if ($query->rowCount() > 0) {
                // Funcionários existem (rowCount() > 0)

                // While percorre os funcionários existentes na consulta SQL com o fetch:
                while ($linhas = $query->fetch()) {
                  // Após percorrer atribuir respectivas colunas com seus respectivos valores à variáveis:
                  $id = $linhas["id"];                              // Nome da coluna XAMPP
                  $cliente = $linhas["usuario"];                    // Nome da coluna XAMPP
                  $nome_funcionario = $linhas["nome_func"];         // Nome da coluna XAMPP
                  $filial_selecionada = $linhas["nome"];            // Nome da coluna XAMPP
                  $servico = $linhas["servico_escolhido"];          // Nome da coluna XAMPP
                  $data_agendamento = $linhas["data_agendamento"];  // Nome da coluna XAMPP

                  // Exibir os dados na tabela:
                  echo "<tr>";
                    echo "<td>" . $id . "</td>";
                    echo "<td>" . $cliente . "</td>";
                    echo "<td>" . $nome_funcionario . "</td>";
                    echo "<td>" . $filial_selecionada . "</td>";
                    echo "<td>" . $servico . "</td>";
                    echo "<td>" . $data_agendamento . "</td>";
                    echo
                    // Editar / excluir do banco de dados:
                    "<td> 
                          <a href=''>Editar</a>
                          <a href='#' onclick='enviar_id($id);'> Excluir </a>
                    </td>";
                  echo "<tr>";
                }
              } else {
                // Nenhum funcionário existe:
                echo ("<tr>");
                echo ("<td>");
                echo ("NÃO HÁ FUNCIONÁRIOS CADASTRADOS");
                echo ("</td>");
                echo ("</tr>");
              }
              ?>
            </tbody>
          </table>
        </section>
      </section>

    </section>
  </main>

</body>
<script>
  // Função para abrir o arquivo PHP referente à exclusão de funcionários com base no ID:
  function enviar_id(x) {
    if(confirm("Excluir agendamento?"))
    {
      window.open("../excluir_agendamento.php?id=" + x, "_self");
    }
    else
    {
      return false;
    }
  }
</script>
<script src="../../public/js/perfil.js"></script>

</html>

<!-- Feito por SENAS TECH em 2023 -->