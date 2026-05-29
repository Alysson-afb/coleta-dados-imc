<?php

    function conectar(): mysqli {
        include("dados-do-banco.php");
        return mysqli_connect($localServidor, $usuario, $senha, $nomeBaseDados);
    }

    function buscarDados(mysqli $conexao): array {
        $sql = "SELECT * FROM pessoas";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $dados = [];

        while ($registro = mysqli_fetch_assoc($resultado)) {
            $dados[] = $registro;
        }
        return $dados;
    }

    function buscarDadosPorId(mysqli $conexao, $id): array {
        $sql = "SELECT * FROM pessoas WHERE idpessoa = $id";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        return mysqli_fetch_assoc($resultado) ?? [];
    }

    function excluirRegistro(mysqli $conexao, $id): bool {
        $sql = "DELETE FROM pessoas WHERE idpessoa = $id";
        registrarLog($conexao, "EXCLUIR", "Pessoa ID $id foi excluída");
        return mysqli_query($conexao, $sql);
    }

    function salvarDados(mysqli $conexao, $nome, $sobrenome, $idade, $peso, $altura): void {
        $sql = "INSERT INTO pessoas (nome, sobrenome, idade, peso, altura)
                VALUES ('$nome', '$sobrenome', $idade, $peso, $altura)";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $id = mysqli_insert_id($conexao);
        registrarLog($conexao, "INSERIR", "Pessoa ID $id foi criada");
    }

    function alterarDados(mysqli $conexao, $id, $nome, $sobrenome, $idade, $peso, $altura): string {
        $sql = "UPDATE pessoas
                SET nome='$nome', sobrenome='$sobrenome', idade=$idade, peso=$peso, altura=$altura
                WHERE idpessoa=$id";

        $resultado = mysqli_query($conexao, $sql);

        if ($resultado) {
            registrarLog($conexao, "ALTERAR", "Pessoa ID $id foi alterada");
            if(mysqli_affected_rows($conexao) > 0){
                return "Dados alterados com sucesso!";
            }
            else{
                return "Nenhuma linha foi alterada";
            }
        }
        return "Erro: " . mysqli_error($conexao);
    }

    function calcularIMC($peso, $altura) {
        if ($altura == 0) return 0;
        return round($peso / ($altura * $altura), 2);
    }

    function classificarIMC($imc): string {
        if ($imc <= 18.5) return "Peso abaixo do normal";
        if ($imc <= 24.9) return "Peso normal";
        if ($imc <= 29.9) return "Sobrepeso";
        if ($imc <= 34.9) return "Obesidade grau I";
        if ($imc < 39.9) return "Obesidade grau II";
        return "Obesidade grau III";
    }

    function percentualIMC($imc, $imcIdeal = 22) {
        return round((($imc - $imcIdeal) / $imcIdeal) * 100, 2);
    }

    function imcMedio($pessoas) {
        if (empty($pessoas)) return 0;
        $soma = 0;

        foreach ($pessoas as $pessoa) {
            $soma += calcularIMC($pessoa['peso'], $pessoa['altura']);
        }
        return $soma / count($pessoas);
    }

    function maiorIdade($pessoas): int {
        if (empty($pessoas)) return 0;
        $maior = $pessoas[0]['idade'];

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] > $maior) $maior = $pessoa['idade'];
        }
        return $maior;
    }

    function menorIdade($pessoas): int {
        if (empty($pessoas)) return 0;
        $menor = $pessoas[0]['idade'];

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] < $menor) $menor = $pessoa['idade'];
        }
        return $menor;
    }

    function nomeMaisVelho($pessoas): string {
        if (empty($pessoas)) return "";
        $maisVelho = $pessoas[0];

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] > $maisVelho['idade']) {
                $maisVelho = $pessoa;
            }
        }
        return $maisVelho['nome'] . " " . $maisVelho['sobrenome'];
    }

    function nomeAlturaMaisNovo($pessoas): array {
        if (empty($pessoas)) return [];
        $maisNovo = $pessoas[0];

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] < $maisNovo['idade']) {
                $maisNovo = $pessoa;
            }
        }
        return [
            'nome' => $maisNovo['nome'],
            'sobrenome' => $maisNovo['sobrenome'],
            'altura' => $maisNovo['altura']
        ];
    }

    function idadeMedia($pessoas): float {
        if (empty($pessoas)) return 0;
        $soma = 0;

        foreach ($pessoas as $pessoa) {
            $soma += $pessoa['idade'];
        }
        return $soma / count($pessoas);
    }

    function qntNomesAcimaDaMedia($pessoas): array {
        if (empty($pessoas)) return ['pessoas' => [], 'total_acima_media' => 0];
        $media = idadeMedia($pessoas);
        $nomes = [];

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] > $media) {
                $nomes[] = [
                    'nome' => $pessoa['nome'],
                    'sobrenome' => $pessoa['sobrenome']
                ];
            }
        }
        return [
            'pessoas' => $nomes,
            'total_acima_media' => count($nomes)
        ];
    }

    function qntAbaixoMedia($pessoas): int {
        if (empty($pessoas)) return 0;
        $media = idadeMedia($pessoas);
        $total = 0;

        foreach ($pessoas as $pessoa) {
            if ($pessoa['idade'] < $media) {
                $total++;
            }
        }
        return $total;
    }

    function tresMaisVelhosIMC(mysqli $conexao): array {
        $sql = "SELECT nome, sobrenome, peso, altura FROM pessoas ORDER BY idade DESC LIMIT 3";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
        $pessoas = [];

        while ($linha = mysqli_fetch_assoc($resultado)) {
            $imc = calcularIMC($linha['peso'], $linha['altura']);


            $pessoas[] = [
                'nome' => $linha['nome'],
                'sobrenome' => $linha['sobrenome'],
                'imc' => $imc
            ];
        }
        return $pessoas;
    }


    function cincoMaisNovosIMC(mysqli $conexao): array {
        $sql = "SELECT nome, sobrenome, peso, altura FROM pessoas ORDER BY idade ASC LIMIT 5";
        $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

        $pessoas = [];

        while ($linha = mysqli_fetch_assoc($resultado)) {
            $imc = calcularIMC($linha['peso'], $linha['altura']);
            $pessoas[] = [
                'nome' => $linha['nome'],
                'sobrenome' => $linha['sobrenome'],
                'imc' => $imc
            ];
        }
        return $pessoas;
    }


    function maiorPeso($pessoas): float {
        if (empty($pessoas)) return 0;

        $maior = $pessoas[0]['peso'];

        foreach ($pessoas as $pessoa){
            if ($pessoa['peso'] > $maior){
                $maior = $pessoa['peso'];
            }
        }
        return $maior;
    }


    function menorPeso($pessoas): float {
        if (empty($pessoas)) return 0;

        $menor = $pessoas[0]['peso'];

        foreach ($pessoas as $pessoa){
            if ($pessoa['peso'] < $menor){
                $menor = $pessoa['peso'];
            }
        }
        return $menor;
    }


    function pesoMedio($pessoas): float {
        if (empty($pessoas)) return 0;

        $soma = 0;

        foreach ($pessoas as $pessoa){
            $soma += $pessoa['peso'];
        }
        return $soma / count($pessoas);
    }


    function pessoasForaPesoNormal($pessoas): array {
        $resultado = [];

        foreach ($pessoas as $pessoa) {
            $imc = calcularIMC($pessoa['peso'], $pessoa['altura']);
            $classificacao = classificarIMC($imc);

            if ($classificacao != "Peso normal") {


                $pesoIdeal = 22 * ($pessoa['altura'] * $pessoa['altura']);
                $diferenca = round($pesoIdeal - $pessoa['peso'], 2);


                $resultado[] = [
                    'nome' => $pessoa['nome'],
                    'sobrenome' => $pessoa['sobrenome'],
                    'imc' => $imc,
                    'classificacao' => $classificacao,
                    'peso' => $pessoa['peso'],
                    'ajuste' => $diferenca
                ];
            }
        }
        return $resultado;
    }

    function registrarLog(mysqli $conexao, string $acao, string $descricao):void{
        $sql = "INSERT INTO log_alteracoes (acao, descricao) VALUES ('$acao', '$descricao')";
        mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    }
?>

