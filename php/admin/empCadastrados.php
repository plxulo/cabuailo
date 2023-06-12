<?php
  include ("../emp_cadastrados.php");
  include("../conecta.php");
  if((!isset ($_SESSION['user']) == true) and (!isset ($_SESSION['senha']) == true))
  {
    header('location: admLogin.php');
  }

  $id = $_SESSION['id'];
  
  // As linhas abaixo você usará sempre que quiser mostrar a imagem
  $comando = $pdo->prepare("SELECT * FROM imagem_pfp_adm WHERE pfp_adm = $id");
  //$comando->bindParam(':id', $id);
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
                echo '<img src="data:image/jpeg;base64,' . $foto_perfil . '" alt="Foto de Perfil" width="100px" height="100px">';
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
          </header>
        </section>

        <!-- Tabela com usuários -->
        <section aria-label="Tabela de usuários cadastrados" class="tabela_usuarios">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>Administrador da Filial</th>
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
                    $id = $linhas["id_filial"];           // Nome da coluna XAMPP
                    $nome = $linhas["nome"];              // Nome da coluna XAMPP
                    $endereco = $linhas["endereco"];      // Nome da coluna XAMPP
                    $filial_adm = $linhas["filial_adm"];  // Nome da coluna XAMPP"
                    
                    // Exibir os dados na tabela:
                    echo "<tr>";
                      echo "<td>" . $linhas["id_filial"] . "</td>" ;
                      echo "<td>" . $linhas["nome"] . "</td>" ;
                      echo "<td>" . $linhas["endereco"] . "</td>" ;
                      echo "<td>" . $linhas["cep"] . "</td>" ;
                      echo "<td>" . $linhas["filial_adm"] . "</td>" ;
                      echo 
                      // Editar / excluir do banco de dados:
                      "<td> 
                        <a href=''>Editar</a>
                        <a href='' onclick='enviar_id($id);'> Excluir </a>
                      </td>";
                    echo "<tr>";
                  }
                }
                else
                {
                  // Nenhum funcionário existe:
                  echo("<tr>");
                  echo("<td>");
                  echo("NÃO HÁ EMPREENDIMENTOS CADASTRADOS");
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
    window.open("../excluir_filial.php?id_filial=" + x,"_self");
  }
</script>
<script src="../../public/js/perfil.js"></script>

</html>

<!-- Feito por SENAS TECH em 2023 -->