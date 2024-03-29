<?php
        // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB
        include("conecta.php");

        // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
		$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
		
		$comando = $pdo->prepare("INSERT INTO imagem_tabela(imagem) VALUES(:imagem)");
        $comando->bindParam(":imagem", $imagem, PDO::PARAM_LOB);
		$resultado = $comando->execute();



        
        // As linhas abaixo você usará sempre que quiser mostrar a imagem

        $comando = $pdo->prepare("SELECT imagem FROM imagem_tabela");
		$resultado = $comando->execute();
        while( $linhas = $comando->fetch() )
        {
            $dados_imagem = $linhas["imagem"];
            $i = base64_encode($dados_imagem);

            echo(" <img src='data:image/jpeg;base64,$i' width='100px'> <br> ");
        }
		
?>
