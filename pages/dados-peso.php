<?php
    include ("../includes/funcoes.php");
    $conexao = conectar();
    $pessoas = buscarDados($conexao);
    $pessoasFora = pessoasForaPesoNormal($pessoas);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dados - Peso</title>
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
            <h1>Dados de Peso</h1>
        </div>
    </nav>

    <div id="infos">
        <h3>Qual o maior peso:</h3>
        <p><?php echo maiorPeso($pessoas); ?> kg</p>

        <h3>Qual o menor peso:</h3>
        <p><?php echo menorPeso($pessoas); ?> kg</p>

        <h3>Qual o peso médio:</h3>
        <p><?php echo number_format(pesoMedio($pessoas), 2); ?> kg</p>

    </div>

    <h2>Pessoas fora da classificação de peso normal:</h2>

    <div id="tabela">

        <table class="wrapper">
            <tr>
                <th>Nome</th>
                <th>IMC</th>
                <th>Classificação</th>
                <th>Peso Atual</th>
                <th>Ajuste necessário</th>
            </tr>

            <?php foreach ($pessoasFora as $pessoa): ?>
                <tr>
                    <td><?= $pessoa['nome'] . " " . $pessoa['sobrenome'] ?></td>
                    <td><?= number_format($pessoa['imc'], 2) ?></td>
                    <td><?= $pessoa['classificacao'] ?></td>
                    <td><?= $pessoa['peso'] ?> kg</td>
                    <td>
                        <?php if ($pessoa['ajuste'] > 0): ?>
                            <?= "+" . $pessoa['ajuste'] ?> kg (ganhar)
                        <?php else: ?>
                            <?= $pessoa['ajuste'] ?> kg (perder)
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>
    
</body>
</html>

