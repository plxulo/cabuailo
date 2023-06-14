<?php
  session_start();
  include("conecta.php");

  class cadastroFunc {
    public $nome;
    public $senha;
    public $nivel_acesso;

    function __construct()
    {
      $this -> nome = $_POST["nome"];
      $this -> senha = $_POST["senha"];
      $this -> nivel_acesso = $_POST["nivel_acesso"];
    }

    public function getNome() {
      return $this -> nome;
    }

    public function getSenha() {
      return $this -> senha;
    }

    public function getAcesso() {
      return $this -> nivel_acesso;
    }

  }

  $retorno = new cadastroFunc();

  $nome = $retorno->getNome();
  $senha = $retorno->getSenha();
  $acesso = $retorno->getAcesso();
  $filial_funcionario = $_POST["filial_funcionario"];
  $id_adm = $_SESSION['id'];

  // $acesso = $retorno->getAcesso();

  $sql = $pdo->prepare("INSERT INTO funcionarios (nome_func, senha_func, filial, nivel_acesso, adm_superior)
                        VALUES (?, ?, ?, ?, ?)");

  $sql->bindParam(1, $nome);
  $sql->bindParam(2, $senha);
  $sql->bindParam(3, $filial_funcionario);
  $sql->bindParam(4, $acesso);
  $sql->bindParam(5, $id_adm);

  $executar_insert = $sql->execute();

  if($executar_insert === TRUE)
  {
    // Inserção bem sucedida:
    echo ("<script type = text/javascript>");
      echo ("alert('Funcionário cadastrado com sucesso!');");
      echo ("window.location = 'admin/admCrud.php'");
    echo ("</script>");    
  }
  else
  {
    // Inserção falhou:
    echo ("<script type = text/javascript>");
      echo ("alert('Erro ao cadastrar o funcionário, por favor, tente novamente.');");
      echo ("window.location = 'admin/admCrud.php'");
    echo ("</script>");    
  }
  // Se o nível de acesso for admin, inserir o usuário no banco de dados:
  if($executar_insert === TRUE AND $acesso == 'admin')
  {
    $inserir_admin = $pdo->prepare("INSERT INTO usuarios_admin (adm_nome, adm_senha) VALUES (?, ?)");
    $inserir_admin->bindParam(1, $nome);
    $inserir_admin->bindParam(2, $senha);
    $inserir_admin->execute();

    // Inserção bem sucedida:
    echo ("<script type = text/javascript>");
      echo ("alert('Admin cadastrado com sucesso!');");
      echo ("window.location = 'admin/admCrud.php'");
    echo ("</script>");    
  }

?>