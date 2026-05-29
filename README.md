# Coleta de Dados de IMC

> **Projeto Prático: Desenvolvimento para a Disciplina de Linguagem de Programação Web 2 (LPW2)** 
> **Curso: Análise e Desenvolvimento de Sistemas (ADS) — IFSul Campus Venâncio Aires**

---

## Sobre o Projeto

Este sistema foi desenvolvido a partir de um cenário de pesquisa em parceria com a Organização Mundial da Saúde (OMS). O grupo de pesquisa do IFSul ficou responsável por mapear, coletar e avaliar o Índice de Massa Corporal (IMC) da população adulta do município de Venâncio Aires/RS.

O software consiste em uma plataforma web dividida em duas frentes principais:
1. Formulário On-line: Destinado à coleta de dados da população (Nome, Sobrenome, Idade, Peso e Altura).
2. Painel Administrativo: Área restrita aos pesquisadores para gerenciamento dos dados (CRUD completo) e visualização de análises estatísticas sobre a saúde pública local.

---

## Tecnologias e Recursos Utilizados

O foco principal do projeto foi o processamento e a lógica do lado do servidor (backend), garantindo a persistência correta e a segurança das informações.

- Linguagem Backend: PHP (com funções fortemente tipadas)
- Banco de Dados: MySQL / MariaDB (Script incluso)
- Frontend: HTML5, CSS3 (Design responsivo para coleta e painel)
- Persistência de Logs: Manipulação de arquivos no servidor (operacoes_bd.txt)

---

## Funcionalidades Implementadas

### 1. Sistema de Coleta (Formulário Público)
- Cadastro de participantes contendo: Nome, Sobrenome, Idade, Peso e Altura.
- Armazenamento imediato na base de dados.

### 2. Painel Administrativo (Gerenciamento)
- Visualizar Registros: Listagem dinâmica de todas as pessoas cadastradas.
- CRUD Completo: Opções diretas na tabela para Alterar (carrega os dados atuais em um formulário de ajuste) e Excluir registros.

### 3. Módulo Estatístico (Análise de Dados)
O painel processa e exibe indicadores cruciais divididos em três categorias:

* Dados - Índice de Massa Corporal (IMC):
  * Qual o IMC de cada participante?
  * Qual a classificação no grau de Obesidade e seus respectivos percentuais?
  * Qual o IMC médio do grupo?
* Dados - Idade:
  * Maior e menor idade cadastrada (com exibição dos respectivos nomes e alturas).
  * Idade média do grupo.
  * Listagem quantitativa e nominal das pessoas acima e abaixo da idade média.
  * Ranking: Nomes e IMC das 3 maiores e das 5 menores idades.
* Dados - Peso:
  * Identificação do maior, menor e peso médio do grupo.
  * Relatório de Ajuste de Peso: Lista as pessoas fora da classificação "Normal", exibindo o peso atual e o cálculo de quantos quilos a pessoa deve ganhar ou perder para atingir a faixa ideal.

### 4. Auditoria e Logs do Servidor
- Todas as operações de criação, edição ou exclusão disparam um registro automático em um arquivo local chamado `operacoes_bd.txt`. O log armazena a ação executada juntamente com a data e hora exata do evento.

---

## Estrutura de Arquivos Obrigatórios

Conforme os requisitos da entrega, o repositório contém:
- Scripts dos códigos fontes (Páginas, lógicas de processamento e arquivos de funções tipadas).
- Script do banco de dados (Arquivo .sql para criação das tabelas estruturadas).
- Arquivo operacoes_bd.txt (Gerado no servidor contendo o histórico do CRUD).

---

## Como Executar o Projeto Localmente - Pré-requisitos

Você precisará de um ambiente de servidor local que suporte PHP e MySQL, como o XAMPP.

---

### Clonar o Repositório:

```bash
   git clone [https://github.com/Alysson-afb/coleta-dados-imc.git](https://github.com/Alysson-afb/coleta-dados-imc.git)