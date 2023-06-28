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
    <link rel="stylesheet" href="../css/produto.css">
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
            $id_produto = $_GET['id_produto'];

            include("../php/conecta.php");
            $comando = $pdo->prepare("SELECT * FROM produtos where id_produto = $id_produto");
            $resultado = $comando->execute();

            while( $linhas = $comando->fetch()){
                $nome_produto = $linhas["nome_produto"];
                $preco_produto = $linhas["preco_produto"];
                $descricao = $linhas["descricao"];
                $imagem = $linhas["img_produto"];
                $i = base64_encode($imagem);

                echo ("
                    <div class='titulo'>
                        <h>$nome_produto</h>
                    </div>
                    <div class='box-imagem-produto'>
                        <img src='data:image/jpeg;base64," . $i . "'  class='imagem-produto'>
                    </div>
                    <div class='preco'>
                        <p>R$ $preco_produto </p>
                    </div>
                    <div class='descricao'>
                        <div class='entrega'>
                            <div class='envio'>  
                                <img src='../image/image 1.svg' class='envioSVG'>
                                <p2>Enviamos para todo o pais</p2>
                            </div>
                            <p>Calcular prazo de entrega<ion-icon name='location-outline'></ion-icon></p>
                        </div>
                        <h>Descricao do produto</h>
                        <p>$descricao</p>
                        <hr style='border-color: black; border-width: 1px; margin-top: 15px;'>
                    </div>      
                    <div class='quantidade'>
                        <p>Disponível no estoque:</p>
                        <form action='../php/colocaCarrinho.php' method='POST'>
                            <input type='hidden' name='id_produtoForm' value=' $id_produto '>
                            <label for='quantidade'>Quantidade:</label>
                            <input type='number' class='inputQuantidade' name='quantidade'>
                            <button type='submit' class='adicionarCarrinho'>Adicionar ao carrinho</button>
                        </form>
                    </div>
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
                <a href="../html/agendar.php">
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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>