<?php
  session_start();

  include ("conecta.php");

  use mysqli;

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

  $sql = "INSERT INTO usuarios_admin (adm_nome, adm_email, adm_senha)
          VALUES ('{$retorno->getUser()}', '{$retorno->getEmail()}', '{$retorno->getPassword()}')";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['user'] = $user;
    $_SESSION['senha'] = $password;
    echo("Usuário cadastrado com sucesso!");
  }
  else
  {
    echo("Erro ao cadastrar usuário: ". $conn->error);
    unset ($_SESSION['user']);
    unset ($_SESSION['senha']);
  }

  header("Location: admin/admPainel.php");

  $conn->close();
?>