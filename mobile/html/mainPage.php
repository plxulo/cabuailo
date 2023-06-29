<?php
  //inicia a seção
  session_start();
  //print_r($_SESSION);
  if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: loginUsuario.php');
  }
  $logado = $_SESSION['usuario'];
  $id_usuario = $_SESSION['id'];
  unset($_SESSION['id_filial']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mainPage.css">
    <title>Cabuailo</title>
</head>

<style>
  .collapsed-text {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 90%; /* Ajuste o valor conforme necessário */
    cursor: pointer;
  }
</style>

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
        <a href="../html/perfil.php">Meus Dados</a>
        <a href="../php/sair.php">Sair</a>
    </div>    
</header>
<main>
    <section1>
        <p>Oferta especial para você</p>
        <h>Descontos de 25%</h>
        <button class="desconto">Resgatar cupom</button>
    </section1>
       
    <section3>
        <h>Serviços</h>
        <div class="botoes3">
            <button class="meuBotao" onclick="mostrarDiv(1)">
                <ion-icon name="storefront-outline" class="icones_servicos"></ion-icon>
                <p>Barbearias</p>
            </button>
            <button class="meuBotao" onclick="mostrarDiv(2)">
                <ion-icon name="bag-outline" class="icones_servicos"></ion-icon>
                <p>Comprar</p>
            </button>
            <button class="meuBotao" onclick="mostrarDiv(3)">
                <ion-icon name="home-outline" class="icones_servicos"></ion-icon>
                <p>Delivery</p>
            </button>
        </div>

        <div id="div1" class="minhaDiv">
            <div class="divBarbearias">
                <h1>Barbearias</h1>
                <section>
                    <?php
                        include("../php/conecta.php");
                        $comando = $pdo->prepare("SELECT * FROM filiais");
                        $resultado = $comando->execute();

                        while ($linhas = $comando->fetch()) 
                        {
                            $nome = $linhas["nome"];
                            $endereco = $linhas["endereco"];
                            $imagem = $linhas["imagem"];
                            $i = base64_encode($imagem);
                            $id = $linhas["id_filial"];

                            echo
                            ("
                            <a href='vermais.php?id_filial=".$id."' class='cardBarbearia'>
                                <div class='imgCard'>
                                    <img src='data:image/jpeg;base64," . $i . "' class='imgBarbearia'>
                                </div>
                                <article>
                                    <h3>
                                        $nome                                                                
                                    </h3>
                                            
                                    <p>
                                        $endereco
                                    </p>
                                    <div class='stars'>    
                                        <img src='../image/estrela.svg' width='15px'>
                                        <img src='../image/estrela.svg' width='15px'>
                                        <img src='../image/estrela.svg' width='15px'>
                                        <img src='../image/estrela.svg' width='15px'>
                                        <img src='../image/estrela.svg' width='15px'>        
                                    </div>
                                    
                                </article>
                            </a>
                            ");
                        }
                    ?>
                </section>

            </div>
        </div>
        <div id="div2" class="minhaDiv">
            <div class="divBarbearias">
                <h1>Compras</h1>
                    <div class='conteinerCompras'>
                        <?php
                            include("../php/conecta.php");
                            $comando = $pdo->prepare("SELECT * FROM produtos");
                            $resultado = $comando->execute();

                            while( $linhas = $comando->fetch())
                            {
                                $id_produto = $linhas["id_produto"];
                                $nome_produto = $linhas["nome_produto"];
                                $preco_produto = $linhas["preco_produto"];
                                $preco_promocao = $linhas["preco_promocao"];
                                $imagem = $linhas["imagem_produto"];
                                $i = base64_encode($imagem);
                                    
                                if($preco_promocao == null) {
                                    echo("
                                    <a href='produto.php?id_produto=$id_produto' class='conteinerCardCompras'>
                                        <div class='cardCompras'>
                                            <div class='imgCard'>
                                                <img src='data:image/jpeg;base64," . $i . "' class='imgBarbearia'>
                                            </div>
                                            <h4> $nome_produto </h4>
                                            <p2>R$ $preco_produto</p2>     
                                        </div>
                                    </a>
                                    ");
                                    }
                                else {
                                    echo("
                                    <a href='produto.php?id_produto=$id_produto' class='conteinerCardCompras'>
                                        <div class='cardCompras'>
                                            <div class='imgCard'>
                                                <img src='data:image/jpeg;base64," . $i . "' class='imgBarbearia'>
                                            </div>
                                            <h4> $nome_produto </h4>
                                            <p>R$ $preco_produto</p>
                                            <p2>R$ $preco_promocao</p2>      
                                        </div>
                                    </a>
                                    ");
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        <div id="div3" class="minhaDiv">
            <div class="divBarbearias">
                <h1>Barbearias</h1>
                <?php
                    $comando = $pdo->prepare("SELECT * FROM filiais WHERE delivery = 'S'");
                    $resultado = $comando->execute();

                    while ($linhas = $comando->fetch()) 
                    {
                        $nome = $linhas["nome"];
                        $endereco = $linhas["endereco"];
                        $imagem = $linhas["imagem"];
                        $i = base64_encode($imagem);
                        $id = $linhas["id_filial"];

                        echo
                        ("
                        <a href='vermais.php?id_filial=".$id."' class='cardBarbearia'>
                            <img src='data:image/jpeg;base64," . $i . "' class='imgCard'>
                            <article>
                                <h3>
                                    $nome                                                                
                                </h3>
                                        
                                <p>
                                    $endereco
                                </p>
                                <div class='stars'>    
                                    <img src='../image/estrela.svg' width='15px'>
                                    <img src='../image/estrela.svg' width='15px'>
                                    <img src='../image/estrela.svg' width='15px'>
                                    <img src='../image/estrela.svg' width='15px'>
                                    <img src='../image/estrela.svg' width='15px'>        
                                </div>
                                
                            </article>
                        </a>
                        ");
                    }
                ?>
            </div>
        </div>

    </section3>
    <section4>
        <img src="">
    </section4>
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
mostrarDiv(1);
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