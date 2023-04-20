<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'cabuailo';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM usuarios;";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Erro ao executar a consulta: " . mysqli_error($conn));
    }
?>
