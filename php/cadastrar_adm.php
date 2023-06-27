<?php
  session_start();
  include ("conecta.php");

  class cadastroAdm {

    public $user;
    public $email;
    private $password;

    public function __construct() {
      $this -> user = $_POST["user"];
      $this -> email = $_POST["email"];
      $this -> password = $_POST["password"];
    }

    public function getUser()
    {
      return $this-> user;
    }

    public function getEmail()
    {
      return $this-> email;
    }

    public function getPassword()
    {
      return $this-> password;
    }

  }

  $retorno = new cadastroAdm();

  $nome = $retorno->getUser();
  $senha = $retorno->getPassword();
  $email = $retorno->getEmail();

  // Verificar se o usuário já existe:
  $verificar = $pdo->prepare("SELECT * FROM usuarios_admin WHERE adm_nome = :adm_nome");
  $verificar->bindParam(':adm_nome', $nome);
  $verificar->execute();

  if($verificar->rowCount() > 0)
  {
    echo ("<script type = text/javascript>");
      echo ("alert('Usuário já existe.');");
      echo ("window.location = 'admin/admCadastro.php'");
    echo ("</script>");   
  }
  else
  {
    // Variável $sql prepara uma inserção dentro do banco de dados:
    $sql = $pdo->prepare("INSERT INTO usuarios_admin (adm_nome, adm_email, adm_senha) VALUES (?,?,?)");

    // bindParam(ordem na consulta, variável) para proteger o banco de dados de SQL injection:
    $sql->bindParam(1, $nome);
    $sql->bindParam(2, $email);
    $sql->bindParam(3, $senha);

    // Selecionar o id_usuario da última inserção:
    $query = $pdo->prepare("SELECT id_adm FROM usuarios_admin ORDER BY id_adm DESC LIMIT 1");
    $executar_insert = $sql->execute();
    $executar_query = $query->execute();

    // Após a consulta, armazenar o valor do id_adm na sessão:
    $query_id = $query->fetch(PDO::FETCH_ASSOC);
    $id_usuario = $query_id['id_adm'];

    if($executar_insert === TRUE)
    {
      // Inserção bem sucedida:
      $_SESSION['id'] = $id_usuario;
      $_SESSION['user'] = $nome;
      $_SESSION['senha'] = $senha;
      $_SESSION['foto_perfil'] = 'default.png';
      header('Location: admin/admPainel.php');
    }
    else
    {
      // Inserção falhou:
      unset($_SESSION['user']);
      unset($_SESSION['id']);

      echo ("<script type = text/javascript>");
        echo ("alert('Erro ao cadastrar o usuário, por favor, tente novamente.');");
        echo ("window.location = 'admin/admCadastro.php'");
      echo ("</script>");    
    }
  }
?>