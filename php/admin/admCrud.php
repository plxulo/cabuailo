<?php
  include ("../admin.php");
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
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/styleAdmin.css">
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
        <!-- Seção com as funcionalidades (botões) e formulário submit para cada uma das func. -->
        <section aria-labelledby="titulo_cadastros" class="secao_container">
          <!-- Título e descrição -->
          <header class="descricao_geral">
            <h1 id="titulo_cadastros">Gerenciar cadastros</h1>
            <p>Gerenciamento de usuários cadastrados no sistema.</p>
            <p>Selecione abaixo o que gostaria de realizar no banco de dados.</p>
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
          <form id="formulario_inserir" class="formulario" style="display:none;" aria-label="Formulário de inserção de usuários" action="" method="">
            <input type="text" placeholder="Email, código ou nome do usuário">
            <input type="text" placeholder="Senha">
            <!-- Nível de acesso do usuário -->
            <label for="user_access_level">Nível de acesso do usuário à ser inserido:</label>
            <div class="select_container">
              <select id="user_access_level" name="user_access_level" required>
                  <option value="admin">Administrador</option>
                  <option value="operator">Operador</option>
                  <option value="funcionario">Funcionário</option>
              </select>
            </div>
            <button class="botao_acao">Inserir Usuário</button>
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
                <th>Email</th>
                <th>Nível Acesso</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>João</td>
                <td>joao@example.com</td>
                <td></td>
                <td>
                  <a href="#">Editar</a>
                  <a href="#">Excluir</a>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Maria</td>
                <td>maria@example.com</td>
                <td></td>
                <td>
                  <a href="#">Editar</a>
                  <a href="#">Excluir</a>
                </td>
              </tr>
              <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nome_func"] . "</td>";
                    echo "<td>" . $row["filial"] . "</td>";
                    echo "<td>" . $row["senha_func"] . "</td>";
                    echo 
                    "<td> 
                      <a href=''>Editar</a>
                      <a href=''>Excluir</a>
                    </td>";
                    echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </section>
      </section>

    </section>
  </main>

</body>

</html>

<!-- Feito por SENAS TECH em 2023 -->