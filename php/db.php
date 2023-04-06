<?php

    namespace Cabuailo;

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
            return $this->user;
        }
    }

    $user = new gerenciamentoSenha();

    echo("<br>");
    echo("Sua senha é: " . $user->getPassword()); //exibir senha

    echo("<br>");
    echo("Seu email é: " . $user->getMail()); //exibir email

?>