<?php
    namespace Cabuailo;

    use mysqli;

    class gerenciamentoSenha
    {
        public $user;
        private $password;

        public function __construct()
        {
            $this-> user = $_POST['email'];
            $this-> password = $_POST['senha'];
        }

        public function getPassword()
        {
            return $this-> password; //retornar senha
        }

        public function getMail()
        {
            return $this-> user;
        }
    }

    $user = new gerenciamentoSenha();

    echo("<br>");
    echo("Sua senha é: " . $user->getPassword()); //exibir senha

    echo("<br>");
    echo("Seu email é: " . $user->getMail()); //exibir email
    echo("<br>");

    //acima apenas checagens de funcionamento / recebimento de entradas
    //abaixo inserção no banco de dados:

    //realizar conexão com o banco de dados, segue comandos admin

    $servername = 'localhost';
    $username = 'cabuailo';
    $password = '9o5oYO3WJrASZin-';
    $dbname = 'cabuailo';

    //criar a conexão:
    $conn = new mysqli($servername, $username, $password, $dbname);

    //verificar possiveis erros na conexao:

    if ($conn->connect_error)
    {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $sql = "INSERT INTO usuarios (email, senha)
            VALUES ('{$user->getMail()}', '{$user->getPassword()}')";

    if ($conn->query($sql) === TRUE)
    {
        echo("Usuário cadastrado com sucesso!");
    }
    else
    {
        echo("Erro ao cadastrar usuário: ". $conn->error);
    }

    $conn->close();
?>