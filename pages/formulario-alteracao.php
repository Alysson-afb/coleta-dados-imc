<?php
    include("../includes/funcoes.php");
    $id = $_GET["id"];
    $dados = [];

    if ($id) {
        $dados = buscarDadosPorId(conectar(), $id);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Formulario Alterações</title>
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
            <h1>Editar registros</h1>
        </div>
    </nav>
    
    <div id="formulario">
        <form action="processar-alteracao.php" method="get">
                <label for="nome">Nome</label>
                <br>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="text" name="nome" value="<?php echo $dados['nome'] ?? ''; ?>">
                <br>
                <label for="sobrenome">Sobrenome</label>
                <br>
                <input type="text" name="sobrenome" value="<?php echo $dados['sobrenome'] ?? ''; ?>">
                <br>
                <label for="peso">Peso</label>
                <br>
                <input type="float" name="peso" value="<?php echo $dados['peso'] ?? ''; ?>">
                <br>
                <label for="idade">Idade</label>
                <br>
                <input type="int" name="idade" value="<?php echo $dados['idade'] ?? ''; ?>">
                <br>
                <label for="altura">Altura</label>
                <br>
                <input type="float" name="altura" value="<?php echo $dados['altura'] ?? ''; ?>">
                <br>
                <input type="submit" value="Enviar" >
        </form>
    </div>

    <footer>
        Crédito - Renan e Alysson - Grupo de pesquisa
    </footer>

</body>
</html>

