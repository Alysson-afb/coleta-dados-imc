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
    <title>Visualizar Registros</title>
</head>
<body>

    <nav>
        <a href="painel-adm.html"><img src="../assets/img/oms-ifsul.png" alt=""></a>

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
        <h1>Visualizar Registros</h1>
        <div></div>
    </nav>

    <div id="tabela">
        <table class="wrapper">
            <th>Nome Completo</th>
            <th>Idade (Anos)</th>
            <th>Peso (Kg)</th>
            <th>Altura (m)</th>
            <th colspan="2">Ações</th>
           
            <?php foreach ($pessoas as $registro): ?>
                <tr>
                    <td> <?=$registro['nome']." ". $registro['sobrenome']?></td>
                    <td> <?=$registro['idade'] ?></td>
                    <td> <?=$registro['peso'] ?></td>
                    <td> <?=$registro['altura'] ?></td>
                    <td class="acoes"><a href="processar-exclusao.php?id=<?=$registro['idpessoa'] ?>">Excluir</a></td>
                    <td class="acoes"><a href="formulario-alteracao.php?id=<?=$registro['idpessoa'] ?>">Alterar</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>

</body>
</html>


