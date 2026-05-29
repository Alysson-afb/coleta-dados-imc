<?php
    include("../includes/funcoes.php");
    $nome = $_GET["nome"];
    $sobrenome = $_GET["sobrenome"];
    $idade = $_GET["idade"];
    $peso = $_GET["peso"];
    $altura = $_GET["altura"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Processar Inserção</title>
</head>
<body>

    <nav>
        <a href="painel-adm.html"><img src="../assets/img/oms-ifsul.png" alt=""></a>
        <hr>
    </nav>

    <?php
        salvarDados(conectar(),$nome,$sobrenome,$idade,$peso,$altura);
    ?>

    <h2>Dados coletados com sucesso. Obrigado pela participação.</h2>

    <a href="painel-adm.html">Painel Administrativo</a>

    <footer>
        <hr>
        Crédito - Renan e Alysson - IFSul
    </footer>

</body>
</html>


