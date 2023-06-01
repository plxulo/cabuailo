<?php
        session_start();

        // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB
        include("conecta_pdo.php");

        // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
		$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
		
		$comando = $pdo->prepare("INSERT INTO imagem_pfp_adm(imagem, pfp_adm) VALUES(:imagem, $_SESSION[id])");
        $comando->bindParam(":imagem", $imagem, PDO::PARAM_LOB);
		$resultado = $comando->execute();
        
        // As linhas abaixo você usará sempre que quiser mostrar a imagem

        $comando = $pdo->prepare("SELECT imagem FROM imagem_pfp_adm");
		$resultado = $comando->execute();
        while( $linhas = $comando->fetch() )
        {
            $dados_imagem = $linhas["imagem"];
            $i = base64_encode($dados_imagem);

            echo(" <img src='data:image/jpeg;base64,$i' width='100px'> <br> ");
        }
		
?>
