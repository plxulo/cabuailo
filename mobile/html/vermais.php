<?php
    //inicia a seção
    session_start();
    //print_r($_SESSION);
    if((!isset($_SESSION['email']) == true ) and (!isset($_SESSION['senha']) == true))
    {
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

            include("../php/conecta.php");
            $comando = $pdo->prepare("SELECT * FROM filiais WHERE id_filial = $id_filial");
            $resultado = $comando->execute();

            while( $linhas = $comando->fetch()){
                $nome = $linhas["nome"];
                $endereco = $linhas["endereco"];
                $imagem = $linhas["imagem_filial"];
                $descricao = $linhas["descricao"];
                $imagem = $linhas["imagem_filial"];
                $i = base64_encode($imagem);

                echo("
                    <img src='data:image/jpeg;base64," . $i . "' class='imgBarbearia'>

                    <h>$nome</h>

                    <div class='boxSobreNos'>
                        <p>$descricao</p>
                    </div>

                    <a href='https://www.google.com/maps/search/?api=1&query=$endereco
                    '><p2>$endereco</p2></a>

                    <button class='btnAgendar'>    
                        <a href='escolherBarbeiro.php?id_filial=".$id_filial."''>Agendar</a>
                        <ion-icon name='calendar-outline' class='iconeAgendamento'></ion-icon>
                    </button>
                ");
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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>