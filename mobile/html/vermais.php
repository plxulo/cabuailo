<?php
//inicia a seção
session_start();
//print_r($_SESSION);
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('Location: loginUsuario.php');
}
$logado = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/verMais.css">
  <title>Cabuailo</title>
</head>

<body>
  <header>
    <button class="mapa"><ion-icon name="settings"></ion-icon></button>
    <section class="textoLocal">
      <h1>Localização atual</h1>
      <p><ion-icon name="location-sharp" class="iconeLocal"></ion-icon>Joinville</p>
    </section>

    <div class="fotoPerfil">
      <a href="sair.php"></a>
      <ion-icon name="person-circle-sharp" class="fotoPerfil"></ion-icon>
    </div>
  </header>
  <main>
    <?php
      $id_filial = $_GET['id_filial'];
      $_SESSION['id_filial'] = $id_filial;

      include("../php/conecta.php");
      $comando = $pdo->prepare("SELECT * FROM filiais WHERE id_filial = $id_filial");
      $resultado = $comando->execute();

      while ($linhas = $comando->fetch()) 
      {
        $nome = $linhas["nome"];
        $endereco = $linhas["endereco"];
        $imagem = $linhas["imagem"];
        $descricao = $linhas["descricao"];
        $i = base64_encode($imagem);

        echo 
        ("
          <img src='data:image/jpeg;base64," . $i . "' class='imgBarbearia' width='100%' height='100%'/>

          <h><b>$nome</b></h>

          <div class='boxSobreNos'>
              <p>$descricao</p>
          </div>

          <a href='https://www.google.com/maps/search/?api=1&query=$endereco
          '><p2><ion-icon name='location-sharp' class='iconeLocal'></ion-icon>&nbsp;$endereco</p2></a>

          <a href='escolherBarbeiro.php?id_filial=" . $id_filial . "'' style='width: 100%; text-decoration: none'>
              <button class='btnAgendar'>    
                  <p>Agendar</p>
                  <ion-icon name='calendar-outline' class='iconeAgendamento'></ion-icon>
              </button>
          </a>
        ");
      }
    ?>
    <form action="../php/processar_comentario.php" method="POST" class="frm_comentario" style="text-align: center;">
      <label class="texto_formulario" for="comentario">Comente sobre esta barbearia:</label><br>
      <input type="text" class="frm_comentario" name="frm_comentario" id="comentario">
      <br>
      <input type="submit" name="frm_submit" id="frm_submit" class="btnComentar" value="Comentar">
    </form>
    <h2>Comentários e avaliações:</h2>
    <hr width="100%"/>
    <?php
      // Selecionar o nome do usuário que enviou comentário por chave estrangeira:
      $selecionar_comentario = $pdo->prepare
      ("SELECT app_comentarios.*, usuarios.usuario
      FROM app_comentarios INNER JOIN usuarios 
      ON app_comentarios.id_usuario = usuarios.id 
      WHERE app_comentarios.id_filial = :id_filial
      ");
      $selecionar_comentario->bindValue(":id_filial", $id_filial);
      $selecionar_comentario->execute();

      if($selecionar_comentario->rowCount() == 0)
      {
          echo("<p style='margin-bottom: 50px'>Nenhum comentário no momento.</p>");
      }
      else
      {
          while($row_comentario = $selecionar_comentario->fetch())
          {
              // Caso deseje exibir o nome do usuário na sessão sem definir
              // Uma entrada de input "nome" para o mesmo, utilize a tabela e sessão.
              $nome = $row_comentario["usuario"];

              // Nesse caso, como eu possuo uma entrada para o nome e desejo exibir
              // O nome de cada entrada, eu utilizarei o seguinte código
              // Para atribuir o valor da entrada nome para a variável e exibi-lá:
              $comentario = $row_comentario["comentario"];
              echo("<div class='boxComentario'>");
                echo("<h2 style='margin-bottom:0'>" . $nome . "</h2>");
                echo("<p>" . $comentario . "</p>");
              echo("</div>");
          }
      }
    ?>
  </main>
  <nav>
    <ul>
      <li class="list active">
        <a href="../html/mainPage.php">
          <span class="icon"><ion-icon name="home"></ion-icon></span>
          <span class="text">Home</span>
        </a>
      </li>
      <li class="list">
        <a href="../html/carrinho.php">
          <span class="icon"><ion-icon name="cart"></ion-icon></ion-icon></span>
          <span class="text">Carrinho</span>
        </a>
      </li>
      <li class="list">
        <a href="../html/agendar.html">
          <span class="icon"><ion-icon name="calendar"></ion-icon></span>
          <span class="text">Agenda</span>
        </a>
      </li>
      <li class="list">
        <a href="../html/favoritos.html">
          <span class="icon"><ion-icon name="bookmarks"></ion-icon></span>
          <span class="text">Favoritos</span>
        </a>
      </li>
      <li class="list">
        <a href="../html/perfil.html">
          <span class="icon"><ion-icon name="person"></ion-icon></span>
          <span class="text">Perfil</span>
        </a>
      </li>
      <div class="indicador"></div>
    </ul>
  </nav>
</body>
<script>
  const list = document.querySelectorAll('.list');

  function activeLink() 
  {
    list.forEach((item) =>
      item.classList.remove('active'));
    this.classList.add('active');
  }
  list.forEach((item) => item.addEventListener('click', activeLink));
</script>
<script>
  function mostrarDiv(divIndex) 
  {
    var divs = document.querySelectorAll(".minhaDiv");
    var botoes = document.querySelectorAll(".meuBotao");

    // Oculta todas as divs e restaura a cor dos botões
    for (var i = 0; i < divs.length; i++) {
      divs[i].style.display = "none";
      botoes[i].style.backgroundColor = "#FFFAFF";
    }

    // Exibe a div selecionada e altera a cor do botão correspondente
    var divSelecionada = document.getElementById("div" + divIndex);
    var botaoSelecionado = document.querySelector(".meuBotao:nth-child(" + divIndex + ")");
    divSelecionada.style.display = "block";
    botaoSelecionado.style.backgroundColor = "#D8315B";
  }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>