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
    <link rel="stylesheet" href="../css/escolherBarbeiro.css">
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
        <p>Fale conosco:</p>
        <a href="#">cabuailo_enterprise@gmail.com</a>        
        <a href="#">Meus Dados</a>
        <a href="../php/sair.php">Sair</a>
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
                $descricao = $linhas["descricao"];
                $imagem = $linhas["imagem"];
                $i = base64_encode($imagem);
                echo("
                    <h>$nome</h>
                ");
            }
        ?>
        <div class='cardEscolhaProficional'>  
        <h2>Escolha Um Profissional: </h2>
        <?php
             $id_filial = $_GET['id_filial'];

             include("../php/conecta.php");
             $comando = $pdo->prepare("SELECT * FROM funcionarios WHERE filial = $id_filial");
             $resultado = $comando->execute();

             while( $linhas = $comando->fetch()){
                $nome_barbeiro = $linhas["nome_func"];
                $id_barbeiro = $linhas["id_func"];
                $imagem = $linhas["foto_funcionario"];
                $i = base64_encode($imagem);
                
                echo("
                    <a href='agendar.php?id_filial=$id_filial&id_func=$id_barbeiro' class='cardProficional'>
                        <div class='box-imgBarbeiro'>
                            <img src='data:image/jpeg;base64," . $i . "' class='imgFuncionario'>
                        </div>
                        <h5>$nome_barbeiro</h5> 
                    </a>
                    <br>
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
                    <span class="text">Carrinho</span>
                </a>
            </li>
            <li class="list active">
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