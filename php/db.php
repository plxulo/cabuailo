<?php

    namespace Cabuailo;

    class gerenciamentoSenha
    {
        public $user;
        private $password;

        public function __construct()
        {
            $this-> user = $_POST['usuario'];
            $this-> password = $_POST['senha'];
        }

        public function getPassword()
        {
            return $this-> password; //retornar senha
        }
    }

    $user = new gerenciamentoSenha();

    echo("<br>");
    echo("Sua senha é: " . $user->getPassword()); //exibir senha

?>