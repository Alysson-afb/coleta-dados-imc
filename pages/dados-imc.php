<?php
    include ("../includes/funcoes.php");
    $pessoas = buscarDados(conectar());
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dados - IMC</title>
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
            <h1>Dados de IMC</h1>
        </div>
    </nav>

    <div id="tabela">
        <table class="wrapper">
            <th>Nome Completo</th>
            <th>IMC</th>
            <th>Classificação do IMC</th>
            <th>% distante do ideal</th>
             <?php foreach ($pessoas as $pessoa):
                $imc = calcularIMC($pessoa['peso'], $pessoa['altura']);
                $classificacao = classificarIMC($imc);
                $percentual = percentualIMC($imc);
                ?>
                <tr>
                    <td> <?=$pessoa['nome']." ". $pessoa['sobrenome']?></td>
                    <td> <?= $imc ?></td>
                    <td> <?= $classificacao ?></td>
                    <td><?= $percentual?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <h2> IMC médio: <br><?php echo imcMedio($pessoas); ?></h2>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>
    
</body>
</html>

