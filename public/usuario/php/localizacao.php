<?php
    $id_filial = $_GET["codigo"];

    include("../php/conecta.php");
    $comando = $pdo->prepare("SELECT * FROM filiais WHERE id_filial = $id_filial" );
    $resultado = $comando->execute();

    while( $linhas = $comando->fetch()){
        $endereco = $linhas["endereco"];
    }
   

?>
<srcipt>
    
</script>