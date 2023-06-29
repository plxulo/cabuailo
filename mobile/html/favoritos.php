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
    <link rel="stylesheet" href="../css/favoritos.css">
    <title>Cabuailo</title>
</head>
<body>
    <header>
    <button class="mapa"><ion-icon name="settings"></ion-icon></button>
    <section class="logoCabuailo">
        <img src="../image/imgLogo (3).png" class="imgLogo" width="70%"> 
    </section>
        
    <!-- <ion-icon name="person-circle-sharp" class="fotoPerfil" onclick="mostrarCampo()"></ion-icon> -->
    <?php
        $id_usuario = $_SESSION['id'];
        include("../php/conecta.php");
        $comando = $pdo->prepare("SELECT imagem FROM usuarios where id = $id_usuario");
        $resultado = $comando->execute();
        
        while ($linhas = $comando->fetch()) {
            $imagem = $linhas["imagem"];
            $i = base64_encode($imagem);
            
            if($imagem == null) {
            echo("
                <ion-icon name='person-circle-sharp' class='fotoPerfil' onclick='mostrarCampo()'></ion-icon>
            ");
            }
            else {
            echo("
                <img src='data:image/jpeg;base64," . $i . "' class='fotoPerfil' onclick='mostrarCampo()'>
            ");
            }
        }

    ?>
    <div class="campoEscondido" id="campoLinks">
        <p>Seu email</p>
        <a href="#">Meus Dados</a>
        <a href="../php/sair.php">Sair</a>
    </div>    
    </header>
    <main>
        <h>Suas barbearias favoritas:</h>
        <div class="divFavoritos">
            <?php 
                include("../php/conecta.php");
                $comando = $pdo->prepare("SELECT  filiais.id_filial, filiais.nome, filiais.endereco, filiais.imagem FROM usuarios JOIN favoritos ON usuarios.id = favoritos.id_usuario 
                JOIN filiais ON favoritos.id_filial = filiais.id_filial WHERE usuarios.id = $id_usuario;");
                $resultado = $comando->execute();
                
                if($comando->rowCount() == 0)
                {
                    echo("
                    <div class='cardFavoritos'>
                        <article>   
                            <div class='subDivFavoritos'>
                                <h3>Nenhum favorito no momento...</h3>                             
                        </article>                
                    </div>
                    ");
                }

                while( $linhas = $comando->fetch()){
                    $id_filial = $linhas["id_filial"];
                    $nome = $linhas["nome"];
                    $endereco = $linhas["endereco"];
                    $imagem = $linhas["imagem"];
                    $i = base64_encode($imagem);

                    echo("
                    <div class='cardFavoritos'>
                        <img src='data:image/jpeg;base64," . $i . "' class='imgCard'>
                        <article>   
                            <div class='subDivFavoritos'>
                                <h3>$nome</h3> 
                                <a class='desfavoritar' href='../php/deletarFavorito.php?id_usuario=$id_usuario&id_filial=$id_filial'><ion-icon name='close-circle'></ion-icon></ion-icon></a>
                            </div>
                            <p>$endereco</p>
                            <div class='stars'>    
                                <img src='../image/estrela.svg' width='15px'>
                                <img src='../image/estrela.svg' width='15px'>
                                <img src='../image/estrela.svg' width='15px'>
                                <img src='../image/estrela.svg' width='15px'>
                                <img src='../image/estrela.svg' width='15px'>
                            </div>
                            
                        </article>                
                    </div>
                    ");
                }
            ?>
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
                    <span class="icon"><ion-icon name="cart"></ion-icon></ion-icon></span>
                    <span class="text">carrinho</span>
                </a>
            </li>
            <li class="list">
                <a href="../html/agendamentos.php">
                    <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    <span class="text">Agendar</span>
                </a>
            </li>
            <li class="list active">
                <a href="../html/favoritos.php">
                    <span class="icon"><ion-icon name="bookmarks"></ion-icon></span>
                    <span class="text">Favoritos</span>
                </a>
            </li>
            <li class="list">
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
    function removerCard(icon) {
        var card = icon.closest('.cardFavoritos');
        card.parentNode.removeChild(card);
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