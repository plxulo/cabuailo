<?php
    namespace Cabuailo;

    use mysqli;

    class gerenciamentoSenha
    {
        public $user;
        public $mail;
        private $password;

        public function __construct()
        {
            $this-> user = $_POST['user'];
            $this-> mail = $_POST['email'];
            $this-> password = $_POST['senha'];
        }

        public function getUser()
        {
            return $this-> user; //retornar usuário
        }

        public function getPassword()
        {
            return $this-> password; //retornar senha
        }

        public function getMail()
        {
            return $this-> mail; //retornar email
        }
    }

    $mail = new gerenciamentoSenha();

    echo("<br>");
    echo("Seu usuário é: " . $mail->getUser()); //exibir usuário
    echo("<br>");

    echo("<br>");
    echo("Sua senha é: " . $mail->getPassword()); //exibir senha
    echo("<br>");

    echo("<br>");
    echo("Seu email é: " . $mail->getMail()); //exibir email
    echo("<br>");

    //acima apenas checagens de funcionamento / recebimento de entradas
    //abaixo inserção no banco de dados:

    //realizar conexão com o banco de dados, segue comandos admin

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cabuailo';

    //criar a conexão:
    $conn = new mysqli($servername, $username, $password, $dbname);

    //verificar possiveis erros na conexao:

    if ($conn->connect_error)
    {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $sql = "INSERT INTO usuarios (usuario, email, senha)
            VALUES ('{$mail->getUser()}', '{$mail->getMail()}', '{$mail->getPassword()}')";

    if ($conn->query($sql) === TRUE)
    {
        echo("Usuário cadastrado com sucesso!");
    }
    else
    {
        echo("Erro ao cadastrar usuário: ". $conn->error);
    }

    $conn->close();

    //validate
    if ($mail->getUser() == "")
?>