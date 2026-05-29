<?php

    function conectar(): PDO {
        include("dados-do-banco.php");
        $dsn = "mysql:host=$localServidor;dbname=$nomeBaseDados;charset=utf8";
        return new PDO($dsn, $usuario, $senha);
    }

    //Basear nessa método para utilizar PDO nas funções
    function buscarDados(PDO $conexao): array {
        //Comando SQL
        $sql = "SELECT * FROM pessoas";
        //Prepara a query
        $stmt = $conexao->prepare($sql);
        //Executa a query
        $stmt->execute();
        //Retorna os resultados como um array, neste caso associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarDadosPorId(PDO $conexao, $id): array {
        $sql = "SELECT * FROM pessoas WHERE idpessoa = $id";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    function excluirRegistro(PDO $conexao, $id): bool {
        $sql = "DELETE FROM pessoas WHERE idpessoa = $id";

        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        return $stmt->rowCount() > 0;

        registrarLog($conexao, "EXCLUIR", "Pessoa ID $id foi excluída");
    }

    function salvarDados(PDO $conexao, $nome, $sobrenome, $idade, $peso, $altura): void {
        $sql = "INSERT INTO pessoas (nome, sobrenome, idade, peso, altura)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $idade, $peso, $altura]);

        $id = $conexao->lastInsertId();

        registrarLog($conexao, "INSERIR", "Pessoa ID $id foi criada");
    }

    function alterarDados(PDO $conexao, $id, $nome, $sobrenome, $idade, $peso, $altura): string {
        $sql = "UPDATE pessoas
                SET nome=?, sobrenome=?, idade=?, peso=?, altura=?
                WHERE idpessoa=?";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $idade, $peso, $altura, $id]);

        if ($stmt->rowCount() > 0) {
            registrarLog($conexao, "ALTERAR", "Pessoa ID $id foi alterada");
            return "Dados alterados com sucesso!";
            }
            else{
                return "Nenhuma linha foi alterada";
            }
        return "Erro: " . $conexao->errorInfo()[2];
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

    function tresMaisVelhosIMC(PDO $conexao): array {
        $sql = "SELECT nome, sobrenome, peso, altura FROM pessoas ORDER BY idade DESC LIMIT 3";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $pessoas = [];

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $imc = calcularIMC($linha['peso'], $linha['altura']);

            $pessoas[] = [
                'nome' => $linha['nome'],
                'sobrenome' => $linha['sobrenome'],
                'imc' => $imc
            ];
        }
        return $pessoas;
    }

    function cincoMaisNovosIMC(PDO $conexao): array {
        $sql = "SELECT nome, sobrenome, peso, altura FROM pessoas ORDER BY idade ASC LIMIT 5";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        $pessoas = [];

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

    function registrarLog(PDO $conexao, string $acao, string $descricao):void{
        $sql = "INSERT INTO log_alteracoes (acao, descricao) VALUES (?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([$acao, $descricao]);
    }
?>