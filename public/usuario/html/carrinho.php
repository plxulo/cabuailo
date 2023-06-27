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
    <link rel="stylesheet" href="../css/carrinho.css">
    <title>Notificações</title>
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
    <h>Seu carrinho</h>

</main>
        <nav>
            <ul>
                <li class="list">
                    <a href="../html/mainPage.php">
                        <span class="icon"><ion-icon name="home"></ion-icon></span>
                        <span class="text">Home</span>
                    </a>
                </li>
                <li class="list active">
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
                    <a href="../html/favoritos.php">
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
       function activeLink(){
        list.forEach((item) =>
        item.classList.remove('active'));
        this.classList.add('active');
       }
       list.forEach((item) => item.addEventListener('click', activeLink));
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