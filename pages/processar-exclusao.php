<?php
    include("../includes/funcoes.php");
    $id = $_GET["id"];

    $retorno = excluirRegistro(conectar(),$id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Processar Exclusão</title>
</head>
<body>

    <nav>
        <a href="painel-adm.html"><img src="../assets/img/oms-ifsul.png" alt=""></a>
        <div id="menu-painel">
            <hr>
            <menu>
                <a href="visualizar-registros.php">Visualizar registros</a>
                <br>
                <a href="dados-imc.php">Dados - IMC</a>
                <br>
                <a href="dados-idade.php">Dados - Idade</a>
                <br>
                <a href="dados-peso.php">Dados - Peso</a>
            </menu>
            <h1>Painel Administrativo</h1>
        </div>
    </nav>

    <?php
    echo $retorno;
        if($retorno){
            echo "<h2>Registro excluído com sucesso.</h2>";
        }
        else{
            echo "<h2>Houve um erro inesperado. Tente novamente.</h2>";
        }
    ?>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>

</body>
</html>


