<?php

    //realizar conexão com o banco de dados, segue comandos admin

    $servername = 'localhost';
    $username = 'paulo';
    $password = 'paulo123';
    $dbname = 'cabuailo_db';

    //criar a conexão:
    $conn = new mysqli($servername, $username, $password, $dbname);

    //verificar possiveis erros na conexao:

    if ($conn->connect_error)
    {
        die("Erro na conexão: " . $conn->connect_error);
    }

?>