<?php
  include('../conecta.php');
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
  Painel administrador para inserir alterar e remover filiais no banco de dados, para depois serem exibidas no app
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
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../public/css/admPerfil.css" />
  <link rel="stylesheet" type="text/css" href="../../public/css/admProdutos.css" />
  <link rel="stylesheet" type="text/css" href="../../public/global/admCSS.css" />
  <link rel="stylesheet" type="text/css" href="../../public/css/styleAdmin.css" />

  <script defer src="../../js/private/sAdmCadastro.js"></script>

  <title>Painel Admin</title>
  <style>
    input::placeholder {
      color: var(--cor-escura);
    }
  </style>
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
              if ($comando->rowCount() > 0) 
              {
                // Recuperar os dados da imagem
                $dados_imagem = $comando->fetch(PDO::FETCH_ASSOC);
                // Exibir a imagem no elemento <img> no HTML
                echo '<img src="data:image/jpeg;base64,' . $foto_perfil . '" alt="Foto de Perfil" width="85px" height="85px" style="border-radius: 50px">';
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
        <!-- Título e descrição -->
        <header class="descricao_geral">
          <h1 id="titulo_cadastros">Adicionar Produtos</h1>
          <p>
            Adicione produtos para serem vendidos no aplicativo, como por exemplo, kits, shampoos, espumas, tesoura e relacionados ao seu negócio.
          </p>
        </header>

        <!-- Entradas do usuário para o banco de dados: -->
        <section aria-label="Adicionar as informações do produto">
          <form aria-label="Cadastrar uma filial" action="../inserir_produto.php" method="POST" enctype="multipart/form-data">
            <section class="inputs">
              <div class="input_box">
                <!-- Nome do produto que será exibido -->
                <label for="nome">Este será o nome em exibição no aplicativo</label>
                <input id="nome" type="text" placeholder="Nome do produto." name="nome">
              </div>
              <div class="input_box">
                <!-- Preço do produto -->
                <label for="preco">Este será o preço em exibição no aplicativo</label>
                <input id="preco" type="number" placeholder="Preço do produto." name="preco">
              </div>
              <div class="input_box">
                <!-- Quantidade do produto -->
                <label for="quantidade">Esta é a quantidade disponível do produto</label>
                <input id="quantidade" type="number" placeholder="Quantidade do produto." name="quantidade">
              </div>
            </section>
            <!-- Descrição do produto -->
            <label for="descricao">Esta é a descrição do produto vendido</label>
            <textarea name="descricao" id="descricao" cols="30" rows="10"></textarea>

            <!-- Formulário para enviar imagens do produto: -->
            <section aria-labelledby="nova_foto" class="inputs nova_foto" title="Adicionar foto do produto">
              <div class="inserir_imagem">
                <header>
                  <h1 id="nova_foto">Insira uma imagem do produto:</h1>
                  <p>Selecione uma imagem:</p>
                </header>
                <input type="file" id="imagem" name="imagem">
                <input type="submit" value="Enviar">
              </div>
            </section>
          </form>
        </section>

        <header aria-label="Prévia do produto" class="previa_produto">
          <h1>Aqui é exibida a prévia do produto que vocë deseja adicionar:</h1>
        </header>

        <section aria-label="Lista de produtos cadastrados">
          <h1>Lista de produtos cadastrados</h1>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Quantidade</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php

                // Consultar os produtos cadastrados:
                $selecionar_produto = $pdo->prepare("SELECT * FROM produtos WHERE id_adm = :id");
                $selecionar_produto->bindParam(':id', $id);
                $selecionar_produto->execute();

                // Exibir os produtos cadastrados.
                // Se existir algum produto (rowCount() > 0 ), mostrar os dados (fetch).
                // Se não existir nenhum produto, mostrar uma mensagem.
                if($selecionar_produto->rowCount() > 0)
                {
                  // Funcionários existem (rowCount() > 0)

                  // While percorre os produtos existentes na consulta SQL com o fetch:
                  while( $linhas = $selecionar_produto->fetch() ) 
                  {
                    // Após percorrer atribuir respectivas colunas com seus respectivos valores à variáveis:
                    $id = $linhas["id_produto"];
                    $nome = $linhas["nome_produto"];
                    $descricao = $linhas["descricao_produto"];
                    $preco = $linhas["preco_produto"];
                    $imagem = $linhas["imagem_produto"];
                    $quantidade = $linhas["quantidade_produto"];

                    // Codificar imagem:
                    $i = base64_encode($imagem);
                    
                    // Exibir os dados na tabela:
                    echo "<tr>";
                      echo "<td>" . $id . "</td>" ;
                      echo "<td>" . $nome . "</td>" ;
                      echo "<td>" . $descricao . "</td>" ;
                      echo "<td>" . $preco . "</td>" ;
                      echo "<td><img src='data:image/jpeg;base64,$i' width='100' height='100'></td>";
                      echo "<td>" . $quantidade . "</td>";
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
                  // Nenhum produto existe:
                  echo("<tr>");
                  echo("<td>");
                  echo("Nenhum produto cadastrado");
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
<script src="../../public/js/perfil.js"></script>

</html>