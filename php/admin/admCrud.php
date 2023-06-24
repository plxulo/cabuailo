<?php
  include ("../admin.php");
  if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['senha']) == true))
  {
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

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../public/css/styleAdmin.css" />
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />

  <script defer src="../../public/js/private/sAdmCadastro.js"></script>

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
            <h1 id="titulo_cadastros">Gerenciar cadastros</h1>
            <p>Gerenciamento de usuários cadastrados no sistema.</p>
            <p>Selecione abaixo o que gostaria de realizar no banco de dados.</p>
            <a href="empCadastrados.php">Clique aqui para visualizar empreendimentos</a>
          </header>

          <!-- Botões com funcionalidades do sistema -->
          <section aria-label="Botões funcionalidades" class="container_botoes">
            
            <button id="btn_formulario_inserir" class="alterar_form">Inserir</button>
            <!-- Botões comentados pois desejo deixar tudo embutido na própria tabela
              (exceto inserção e pesquisa)
              ** USAR PDO -> PREPARE
            <button id="btn_formulario_alterar" class="alterar_form">Alterar</button>
            <button id="btn_formulario_deletar" class="alterar_form">Deletar</button>
            -->
            <!--
            <button id="btn_formulario_pesquisa" class="alterar_form pesquisar">Pesquisar</button>
            -->
            <input type="text" placeholder="Pesquisar">
          </section>

          <!-- Formulário para inserção de usuários no sistema -->
          <form id="formulario_inserir" class="formulario" style="display:none;" aria-label="Formulário de inserção de usuários" action="../inserir_func.php" method="POST">
            <section class="input">
              <input type="text" placeholder="Nome do funcionário" name="nome">
              <input type="text" placeholder="Senha" name="senha">
            </section>
            <!-- Nível de acesso do usuário -->
            <div class="select_container">
              <div>
                <label for="user_access_level">Nível de acesso do usuário à ser inserido:</label>
                <select id="user_access_level" name="nivel_acesso" required>
                    <option value="admin">1 - Administrador</option>
                    <option value="operator">2 - Operador</option>
                    <option value="funcionario">3 - Funcionário</option>
                </select>
              </div>
              <div>
                <label for="filial_funcionario">Filial aonde o funcionário trabalha:</label>
                <select id="filial_funcionario" name="filial_funcionario" required>
                    <?php
                    // Caso não haja nenhuma filial cadastrada, exibir uma mensagem.
                    if($selecionar_filiais->rowCount() == 0) 
                    {
                      echo ("<option>Nenhuma filial cadastrada</option>");
                    }

                    // Exibir dentro de um select as filiais disponíveis para designar cada funcionário.
                    // Estas filiais são exibidas de acordo com o ID de cada sessão de cada usuário adm.
                      while($linhas_filial = $selecionar_filiais->fetch())
                      {
                        $nome_filial = $linhas_filial["nome"]; // Nome da coluna XAMPP
                        $id_filial = $linhas_filial["id_filial"]; // ID da coluna XAMPP
                        // Dentro de um select, while é usado para percorrer e projectar o máximo possível de filiais.
                        echo ("<option>" . $id_filial . " - " . $nome_filial . "</option>");
                      }
                    ?>
                </select>
              </div>
            </div>
            <button type="submit" class="botao_acao">Inserir Funcionário</button>
          </form>

          <!-- Formulário para inserção de usuários no sistema -->
          <form id="formulario_alterar" class="formulario" style="display:none;" aria-label="Formulário de alteração de usuários" action="" method="">
            <input type="text" placeholder="Email, código ou nome de usuário">
            <input type="text" placeholder="Senha">
            <button class="botao_acao">Salvar Alterações</button>
          </form>

          <!-- Formulário para inserção de usuários no sistema -->
          <form id="formulario_deletar" class="formulario" style="display:none;" aria-label="Formulário de remoção de usuários" action="" method="">
            <input type="text" placeholder="Email, código ou nome de usuário">
            <input type="text" placeholder="Senha">
            <input type="text" placeholder="Nível de acesso">
            <button class="botao_acao">Deletar o usuário</button>
          </form>
        </section>

        <!-- Tabela com usuários -->
        <section aria-label="Tabela de usuários cadastrados" class="tabela_usuarios">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Filial</th>
                <th>Nível Acesso</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Exibir os funcionários cadastrados.
                // Se existir algum funcionário (rowCount() > 0 ), mostrar os dados (fetch).
                // Se não existir nenhum funcionário, mostrar uma mensagem.
                if($query->rowCount() > 0)
                {
                  // Funcionários existem (rowCount() > 0)

                  // While percorre os funcionários existentes na consulta SQL com o fetch:
                  while( $linhas = $query->fetch() ) 
                  {
                    // Após percorrer atribuir respectivas colunas com seus respectivos valores à variáveis:
                    $id = $linhas["id_func"];     // Nome da coluna XAMPP
                    $nome = $linhas["nome_func"]; // Nome da coluna XAMPP
                    $filial = $linhas["nome"];    // Nome da coluna XAMPP
                    $acesso = $linhas["nivel_acesso"];  // Nome da coluna XAMPP
                    
                    // Exibir os dados na tabela:
                    echo "<tr>";
                      echo "<td>" . $linhas["id_func"] . "</td>" ;
                      echo "<td>" . $linhas["nome_func"] . "</td>" ;
                      echo "<td>" . $linhas["nome"] . "</td>" ;
                      echo "<td>" . $linhas["nivel_acesso"] . "</td>" ;
                      echo 
                      // Editar / excluir do banco de dados:
                      "<td> 
                        <a href=''>Editar</a>
                        <a href='#' onclick='enviar_id($id);'> Excluir </a>
                      </td>";
                    echo "<tr>";
                  }
                }
                else
                {
                  // Nenhum funcionário existe:
                  echo("<tr>");
                  echo("<td>");
                  echo("NÃO HÁ FUNCIONÁRIOS CADASTRADOS");
                  echo("</td>");
                  echo("</tr>");
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
  function enviar_id(x)
  {
    window.open("../excluir_func.php?id_func=" + x,"_self");
  }
</script>
<script src="../../public/js/perfil.js"></script>

</html>

<!-- Feito por SENAS TECH em 2023 -->