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
          VALUES ('{$retorno->getUser()}', '{$retorno->getEmail()}', '{$retorno->getPassword()}');";

  $query = "SELECT id_adm, adm_nome, adm_senha FROM usuarios_admin";
  $result = mysqli_query($conn, $query);

  // Pegar a coluna ID: (seleciona as colunas)
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_adm"];
  }

  //Verificar se o usuário foi inserido com sucesso
  //Atribuir usuário e senha para superglobal sessão
  if ($conn->query($sql) === TRUE)
  {
    echo("Usuário cadastrado com sucesso!");

    $_SESSION['user'] = $retorno->getUser();
    $_SESSION['senha'] = $retorno->getPassword();
    $_SESSION['id'] = $id;
    //No sucesso, redirecionar para painel
    header("Location: admin/admPainel.php");
  } 
  else
  {
    //Caso contrário, mostrar erro
    //Desatribuir sessão
    echo("Erro ao cadastrar usuário: ". $conn->error);

    unset ($_SESSION['user']);
    unset ($_SESSION['senha']);

    //Voltar para cadastro
    header("Location: admin/admCadastro.php");
  }

  $conn->close();
?>