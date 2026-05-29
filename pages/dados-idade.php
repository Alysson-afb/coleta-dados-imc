<?php
    include ("../includes/funcoes.php");
    $conexao = conectar();
    $pessoas = buscarDados($conexao);

    $nomeAltura = nomeAlturaMaisNovo($pessoas);
    $NomesAcimaDaMedia = qntNomesAcimaDaMedia($pessoas);
    $tresMaisVelhos = tresMaisVelhosIMC($conexao);
    $cincoMaisNovos = cincoMaisNovosIMC($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dados - Idade</title>
</head>
<body>
    <nav>
        <a href="painel-adm.html"><img src="../assets/img/oms-ifsul.png" alt=""></a>
        <div id="menu-painel">
            <menu>
                <a href="visualizar-registros.php">Visualizar registros</a>
                <br>
                <a href="dados-imc.php">Dados - IMC</a>
                <br>
                <a href="dados-idade.php">Dados - Idade</a>
                <br>
                <a href="dados-peso.php">Dados - Peso</a>
            </menu>
            <hr>
            <h1>Dados de Idade</h1>
        </div>
    </nav>

    <div id="infos">
        <h3>Idade máxima encontrada:</h3>
        <p><?php echo maiorIdade($pessoas); ?> anos</p>

        <h3>Nome da pessoa mais velha::</h3>
        <p><?php echo nomeMaisVelho($pessoas); ?></p>

        <h3>Idade mínima encontrada:</h3>
        <p><?php echo menorIdade($pessoas); ?> anos</p>

        <h3>Nome e altura da pessoa mais nova:</h3>
        <p>Nome: <?php echo $nomeAltura['nome']. " " .$nomeAltura['sobrenome'] ?> <br> Altura:<?php echo $nomeAltura['altura'] ?>m</p>

        <h3>Idade média:</h3>
        <p><?php echo idadeMedia($pessoas) ?></p>

        <h3>Quantidade e nomes de quem está acima da média:</h3>
        <p>Quantidade: <?php echo $NomesAcimaDaMedia['total_acima_media'] ?></p>

        <p>Nomes: <?php
                    foreach ($NomesAcimaDaMedia['pessoas'] as $pessoa){
                        echo $pessoa['nome'] . " " . $pessoa['sobrenome'] . "<br>";
                    }
                  ?>
        </p>

        <h3>Quantos estão abaixo da média:</h3>
        <p><?php echo qntAbaixoMedia($pessoas) ?></p>

        <h2>Nome e IMC das 3 pessoas mais velhas:</h2>
        <p>
            <?php
                foreach ($tresMaisVelhos as $pessoa){
                    echo $pessoa['nome'] . " " . $pessoa['sobrenome'] . " - IMC: " . number_format($pessoa['imc'], 2) . "<br>";
                }
            ?>
        </p>

        <h2>Nome e IMC das 5 pessoas mais novas:</h2>
        <p>
            <?php
            foreach ($cincoMaisNovos as $pessoa){
                echo $pessoa['nome'] . " " . $pessoa['sobrenome'] . " - IMC: " . number_format($pessoa['imc'], 2) . "<br>";
            }
            ?>
        </p>
    </div>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>
</body>
</html>