<?php
    //inicia a seção
    session_start();
    //print_r($_SESSION);
    if((!isset($_SESSION['email']) == true ) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        header('Location: loginUsuario.php');
    }
    $logado = $_SESSION['email'];
    $id_usuario = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css">
    <title>Cabuailo</title>
</head>
<body>
<header>
        <button class="mapa"><ion-icon name="settings"></ion-icon></button>
        <section class="textoLocal">
            <h1>Localização atual</h1>
            <p><ion-icon name="location-sharp" class="iconeLocal"></ion-icon>Joinville</p>
        </section>
        
        <ion-icon name="person-circle-sharp" class="fotoPerfil" onclick="mostrarCampo()"></ion-icon>

        <div class="campoEscondido" id="campoLinks">
            <p>Seu email</p>
            <a href="#">Meus Dados</a>
            <a href="../php/sair.php">Sair</a>
        </div>     
</header>
<main>
    <div class="boxUsuario">
        <?php
            $id_usuario = $_SESSION['id'];
            include("../php/conecta.php");
            $comando = $pdo->prepare("SELECT * FROM usuarios where id = $id_usuario");
            $resultado = $comando->execute();

            while( $linhas = $comando->fetch()){
                $nome = $linhas["usuario"];
                $email = $linhas["email"];
                $imagem = $linhas["imagem"];
                $i = base64_encode($imagem);

                if($imagem == null) {
                echo("
                <div class='box_img_usuario'>
                    <ion-icon name='person-circle' class='imgUsuario'></ion-icon>
                </div>
                <div class='box_info_usuario'>
                    <p>$nome</p>
                    <p2>$email</p2>
                </div>
                ");}
                else {
                    echo("
                    <div class='box_img_usuario'>
                        <img src='data:image/jpeg;base64," . $i . "'  class='imgUsuario'>
                    </div>
                    <div class='box_info_usuario'>
                        <p>$nome</p>
                        <p2>$email</p2>
                    </div>
                ");
                }

            }
        ?>
    </div>
    <div class="boxOpcoes">
        <div class="opcao"><a href="#">Adicionar endereço <ion-icon class="setinha" name="chevron-forward-outline"></ion-icon></a></div>
        <div class="opcao">
            <a href="#">Foto de perfil <ion-icon class="setinha" name="chevron-forward-outline"></ion-icon></a>
        </div>
        <br>
        <form action="../php/salvar_imagem.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="imagem" id="foto">
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <div class="opcao"><a href="#">Alterar Senha <ion-icon class="setinha" name="chevron-forward-outline"></ion-icon></a></div>
        <div class="opcao"><a href="../php/sair.php" class="sairConta">Sair da conta <ion-icon class="setinha" name="chevron-forward-outline"></ion-icon></a></div>
    </div>
</main>
<nav>
    <ul>
        <li class="list">
            <a href="../html/mainPage.php">
                <span class="icon"><ion-icon name="home"></ion-icon></span>
                <span class="text">Home</span>
            </a>
        </li>
        <li class="list">
            <a href="../html/carrinho.php">
                <span class="icon"><ion-icon name="notifications"></ion-icon></span>
                <span class="text">Notificações</span>
            </a>
        </li>
        <li class="list">
            <a href="../html/agendamentos.php">
                <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                <span class="text">Agenda</span>
            </a>
        </li>
        <li class="list">
            <a href="../html/favoritos.php">
                <span class="icon"><ion-icon name="bookmarks"></ion-icon></span>
                <span class="text">Favoritos</span>
            </a>
        </li>
        <li class="list active">
            <a href="../html/perfil.php">
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
    function activeLink(){
     list.forEach((item) =>
     item.classList.remove('active'));
     this.classList.add('active');
    }
    list.forEach((item) => item.addEventListener('click', activeLink));
 </script>
<script>
    function mostrarDiv(divIndex) {
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
<script>
    var campoVisivel = false;

    function mostrarCampo() {
    var campoLinks = document.getElementById('campoLinks');
  
    if (campoVisivel) {
    campoLinks.style.display = 'none';
    campoVisivel = false;
  } else {
    campoLinks.style.display = 'flex';
    campoVisivel = true;
  }
}
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>