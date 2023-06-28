<?php
    include("../php/conecta.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/global.css">
    <link rel="stylesheet" type="text/css" href="../css/calendario.css">
    <link rel="stylesheet" type="text/css" href="../css/appAgendar.css">
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
        <section1>
            <h1>Falta pouco para terminar seu agendamento!</h1>
        </section1>
        <section>
            <p>Funcionário escolhido:</p>
            <?php
                $id_filial = $_GET['id_filial'];
                $id_func = $_GET['id_func'];

                $_SESSION['id_funcionario'] = $id_func;
                $_SESSION['id_filial'] = $id_filial;

                $comando = $pdo->prepare("SELECT * FROM funcionarios WHERE filial = $id_filial AND id_func = $id_func");
                $resultado = $comando->execute();

                while( $linhas = $comando->fetch()) {
                    $nome_barbeiro = $linhas["nome_func"];
                    $id_barbeiro = $linhas["id_func"];
                    $imagem = $linhas["foto_funcionario"];
                    $i = base64_encode($imagem);
                    
                    echo("
                        <div class='box-imgBarbeiro'>
                            <img src='data:image/jpeg;base64," . $i . "' class='imgFuncionario' width='200px' height='200px'>
                        </div>
                        <h5>$nome_barbeiro</h5> 
                        <br>
                    "); 
                }
            ?>
        </section>
        <form action="../php/processar_agendamento.php" method="POST" style="display:flex; flex-direction:column">
            <label for="data_agendamento">Data do agendamento:</label>
            <input type="datetime-local" id="data_agendamento" name="data_agendamento">
            <label for="forma_pagamento">Forma de pagamento:</label>
            <select name="forma_pagamento" id="forma_pagamento">
                <option value="Dinheiro">Dinheiro</option>
                <option value="PIX">PIX</option>
                <option value="Cartão">Cartão</option>
            </select>
            <label>Serviços desejados</label>
            <div style="display:flex; justify-content:space-between">
                <input type="checkbox" name="servico[]" value="Corte e barba"><p>Corte e barba</p>
                <input type="checkbox" name="servico[]" value="Manicure"><p>Manicure ou pedicure</p>
                <input type="checkbox" name="servico[]" value="Piercing"><p>Piercing</p>
            </div>
            <button type="submit">Agendar</button>
        </form>
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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</script>
</html>