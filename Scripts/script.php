<?php

require 'vendor/autoload.php'; // Certifique-se de que o autoload do Composer esteja incluído

$client = new MongoDB\Client("mongodb://localhost:27017"); // Substitua pela URL do seu servidor MongoDB

$db = $client->selectDatabase("AplicacaoPHP");
$colecao = $db->selectCollection("Funcionarios");



$i = 1;
$cadastrar = true;

do {
    echo "[ C ] ~ Cadastrar Funcionário. \n[ L ] ~ Listar Funcionário. \n[ E ] ~ Editar Funcionário. \n[ D ] ~ Deletar Funcionário. \n[ S ] ~ Sair do programa. \nOpção: ";
    $opc = readline();

    $opc = filter_var($opc, FILTER_SANITIZE_STRING);
    $opc = ucwords($opc);

    switch ($opc) {
        case 'C':
            $nome = readline("Digite o nome do $i ª Funcionário: ");
            $sobrenome = readline("Digite o sobrenome do $i ª Funcionário: "); 
            $cpf = readline("Digite o CPF do $i ª Funcionário: ");
            $nasc = readline("Digite a data de nascimento do $i ª Funcionário: ");
            $celular = readline("Digite o celular do $i ª Funcionário: ");
            $colecao = $db->selectCollection("Funcionarios");

            $documento = [
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'cpf' => $cpf,
                'nascimento' => $nasc,
                'celular' => $celular
            ];

            try {
                $colecao->insertOne($documento);
                echo "Funcionário cadastrado.";
            } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
                echo "Erro ao cadastrar funcionário: " . $e->getMessage() . "\n";
            }

            $i += 1;
            break;

        case 'L':
            $funcionarios = $collection->find();

            foreach ($funcionarios as $funcionario) {
                echo "Nome: " . $funcionario['nome'] . "\n";
                echo "Sobrenome: " . $funcionario['sobrenome'] . "\n";
                echo "CPF: " . $funcionario['cpf'] . "\n";
                echo "Data de Nascimento: " . $funcionario['nascimento'] . "\n";
                echo "Celular: " . $funcionario['celular'] . "\n\n";
            }

            break;

        case 'E':
            // Implemente a edição aqui

            break;

        case 'D':
            // Implemente a exclusão aqui

            break;

        case 'S':
            echo "Saindo do programa [ ... ]\n";
            $cadastrar = false;
            break;

        default: echo "Opção digitada não condiz com as opções acima! \nDigite uma opção válida.\n";
    }
} while ($cadastrar);
?>
