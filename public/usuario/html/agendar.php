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
    <link rel="stylesheet" href="../css/agendar.css">
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
   <a href="../html/mainPage.php"	 class="novoAgendamento">	
		<ion-icon name="add-outline"></ion-icon>
		<p>Fazer novo agendamento</p>
	</a>
	<div class="agendamentos">
		<h>Seus agendamentos</h>
		<div class="lineAgendamentos">
			<div class="textBarb"><p>Barbearia</p></div>
			<div class="textData"><p>Data</p></div>
		</div>
        <?php
            include("../php/conecta.php");
            $comando = $pdo->prepare("SELECT * FROM app_agendamentos");
            $resultado = $comando->execute();

            while( $linhas = $comando->fetch()){
                $nome = $linhas["nome"];
               
                echo("
                    <div class='cardAgendamento'>
                        <div class='imgCard'>
                            <img src='../image/barbearia1.jpeg'>
                        </div>
                        <div class='infoBarbearia'>
                            <p>Osmar's barber Shop Club</p>
                        </div>
                        <div class='dataAgendamento'>
                            20/06 20:30
                        </div>
                    </div>
                ")
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
</script>
</html>