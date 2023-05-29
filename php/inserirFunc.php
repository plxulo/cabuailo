<?php

include("conecta.php");

class cadastroFunc {
  public $nome;
  public $senha;
  public $nivelAcesso;
  public $filial;

  function __construct()
  {
    $this -> nome = $_POST["nome"];
    $this -> endereco = $_POST["endereco"];
    $this -> cep = $_POST["cep"];
  }

  public function getNome() {
    return $this -> nome;
  }

  public function getEndereco() {
    return $this -> endereco;
  }

  public function getCep() {
    return $this -> cep;
  }

}

$retorno = new cadastroFunc();

$sql = "INSERT INTO filiais (nome, endereco, cep)
        VALUES ('{$retorno->getNome()}', '{$retorno->getEndereco()}', '{$retorno->getCep()}')";

if ($conn->query($sql) === TRUE)
{
    echo("Usuário cadastrado com sucesso!");
}
else
{
    echo("Erro ao cadastrar usuário: ". $conn->error);
}

header("Location: ../public/html/admin/admFiliais.html");
$conn->close();

?>