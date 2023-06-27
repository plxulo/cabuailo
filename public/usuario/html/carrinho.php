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
    <div class="boxCarrinho">
        <div class="lineCarrinho">
            <p>Produtos</p>
        </div>
        <div class="containerProdutos">
            <?php
                include("../php/conecta.php");
                $id_usuario = $_SESSION['id'];
                $comando = $pdo->prepare("SELECT * FROM produtos INNER JOIN carrinho 
                ON produtos.id_produto = carrinho.id_produto WHERE carrinho.id_usuario = $id_usuario;");
                $resultado = $comando->execute();

                while( $linhas = $comando->fetch()){
                    $nome_produto = $linhas["nome_produto"];
                    $preco_produto = $linhas["preco_produto"];
                    $preco_promocao = $linhas["preco_promocao"];
                    $imagem = $linhas["img_produto"];
                    $i = base64_encode($imagem);
                    
                    if($preco_promocao == null)
                    echo("
                        <div class='boxCardProduto'>
                            <div class='boxImgProduto'>
                                <img src='data:image/jpeg;base64," . $i . "' class='imgProduto'>
                            </div>
                            <p>$nome_produto</p>
                            <div class='preco'>
                                <p>Preço R$ $preco_produto</p>
                            </div>
                            <a href='tirarCarrinho'> 
                                <ion-icon class='tirarCarrinho' name='close-circle-sharp'></ion-icon>
                            </a>
                        </div>
                    ");
                    else {
                        echo("
                        <div class='boxCardProduto'>
                            <div class='boxImgProduto'>
                                <img src='data:image/jpeg;base64," . $i . "' class='imgProduto'>
                            </div>
                            <p>$nome_produto</p>
                            <div class='preco'>
                                <p>Preço R$ $preco_produto</p>
                            </div>
                            <a href='tirarCarrinho'> 
                                <ion-icon class='tirarCarrinho' name='close-circle-sharp'></ion-icon>
                            </a>
                        </div>
                        ");
                    }
                }
            ?>
        </div>
        <div class="bottomCarrinho"></div>
    </div>
    <div class="pagamento">
        <p>Escolher Modo de pagamento: </p>
        <select id="quantidade" name="quantidade">
            <option value="1">Pix</option>
            <option value="2">Boleto</option>
            <option value="3">Cartão</option>
        </select>
    </div>
    <div class="entrega">
        <p>Local de entrega: </p>
        <input class="inputCep" type="number" placeholder="CEP">
    </div>
    <div class="total">

    </div>
    <div class="botoes">
        <button class="confirmarCompra">Confirmar compra</button>
        <button class="limparCarrinho"><a href="../php/limparCarrinho.php"></a>Limpar Carrinho</button>   
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