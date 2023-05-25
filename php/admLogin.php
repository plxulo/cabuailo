<?php include ("valida.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<!-- 
  Tela de login para acesso ao painel administrador
  Seguimos padrão ARIA (Accessible Rich Internet Applications) para dividir os elementos em seções
  Isso se deve ao fator de acessibilidade para pessoas com dificuldades
  https://www.w3.org/WAI/ARIA/apg/patterns/landmarks/examples/HTML5.html 
-->

<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../public/css/admLogin.css"/>

  <title>Painel Principal</title>
</head>

<body>
  
  <main>
    <section class="principal">

      <!-- Heading com título e subtítulo -->
      <img src="../public/imagens/logo.png">
      <header style="text-align: center;">
        <h1>Bem-vindo(a) ao Cabuailo</h1> 
        <p>Faça Login para acessar o sistema</p>
      </header>

      <!-- Formulário de autenticação com banco de dados -->
      <form aria-label="Formulário de login" class="login" action="../public/valida.php" method="post">
          <label for="usuario">Nome de usuário:</label>
          <input type="text" name="user">
          <label for="senha">Senha:</label>
          <input type="password" name="password">
          <a href="#">Esqueci minha senha</a>
          <button aria-label="Entrar na sua conta" name="entrar" type="submit">Entrar na sua Conta</button>
          <section id="error_message"></section>
      </form>

    </section>

    <footer>
      <section class="nome_empresa">

      </section>
      <section class="navegacao_footer">
        <ul class="links_navegacao_footer">
          <a><li>Sobre</li></a>
        </ul>
      </section>
    </footer>
  </main>

</body>

<script>
  const form = document.querySelector("form");

  // Adiciona um ouvinte de eventos para o envio do formulário
  form.addEventListener("submit", function(event) {
    // Impede o envio do formulário por padrão
    event.preventDefault();

    function validateForm() {
      // Verifica se o campo de usuário está vazio
      if (form.user.value === "") {
        // Exibe a mensagem de erro
        const errorMessage = document.getElementById("error-message");
        errorMessage.innerHTML = "Por favor, preencha o campo de usuário.";
      }
    }

    // Verifica se a validação falhou
    if (!form.checkValidity()) {
      // Exibe a mensagem de erro
      const errorMessage = document.getElementById("error_message");
      errorMessage.innerHTML = "Por favor, preencha todos os campos corretamente.";
    } else {
      // Envia o formulário se a validação foi bem sucedida
      form.submit();
    }
  });
</script>

</html>