<?php
  session_start();
?>
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

  <link rel="Website Icon" type="png" href="../../public/imagens/logo.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@200;400;600;700;800;900&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../../public/css/admLogin.css"/>

  <title>Painel Principal</title>
</head>

<body>
  
  <!-- Principal com formulário de login -->
  <main>
    <section class="principal">

      <!-- Heading com título e subtítulo -->
      <img class="logo_cabuailo" src="../../public/imagens/logo.png" alt="Logo da Cabuailo">
      <header style="text-align: center;">
        <h1>Bem-vindo(a) ao Cabuailo</h1> 
        <p>Cadastre-se no sistema Cabuailo</p>
      </header>

      <!-- Formulário de autenticação com banco de dados -->
      <form aria-label="Formulário de login" class="login" action="../cadastrar_adm.php" method="post">
          <label for="usuario">Nome de usuário:</label>
          <section class="input_box">
            <input id="usuario" type="text" name="user" required="" placeholder="Nome">
          </section>

          <label for="email">Email:</label>
          <section class="input_box">
            <input id="email" type="email" name="email" required="" placeholder="Email">
          </section>

          <label for="senha">Senha:</label>
          <section class="input_box">
            <input id="senha" type="password" name="password" required="" placeholder="Senha">
          </section>
          <a href="#">Termos de uso</a>
          <button aria-label="Entrar na sua conta" name="entrar" type="submit">Criar conta</button>
          <section id="error_message"></section>
          <a href="admLogin.php">Já tenho conta</a>
      </form>

    </section>
  </main>
  
  <!-- Footer Cabuailo como navegação alternativa para login -->
  <footer aria-label="Navegação secundária footer">
    <section class="info_cabuailo">
      <img class="logo_cabuailo" src="../../public/imagens/logo.png" alt="Logo da Cabuailo">
      <header>
        <h1>Cabuailo</h1>
        <p>A Cabuailo faz uso de tecnologias avançadas para garantir a segurança e eficiência de sua barbearia!</p>
      </header>
    </section>

    <!-- Links da Cabuailo -->
    <section class="navegacao_footer">
      <ul class="links_navegacao_footer">
        <h1>Outras páginas!</h1>
        <a href="../homeScreen.html"><li>Home</li></a>
        <a href="../cadastro.html"><li>Cadastro empresa</li></a>
        <a href="#"><li>Cadastro cliente</li></a>
        <a href="#"><li>Termos de uso</li></a>
      </ul>
    </section>

    <!-- Links para contato -->
    <section class="navegacao_footer">
      <ul class="links_navegacao_footer">
        <h1>Contato</h1>
        <a href="#"><ion-icon name="location"></ion-icon><li>Av. Procópio Gomes - SENAI JLLE SUL</li></a>
        <a href="#"><ion-icon name="mail"></ion-icon><li>cabuailo_contato@gmail.com</li></a>
        <a href="#"><ion-icon name="call"></ion-icon><li>4002-8922</li></a>
        <a href="#"><ion-icon name="logo-twitter"></ion-icon><li>@cabuailo</li></a>
      </ul>
    </section>
  </footer>

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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</html>