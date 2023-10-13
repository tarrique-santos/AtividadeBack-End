<?php

$apiUrl = 'https://a.free.micuim.ravendb.cloud'; // Substitua pela URL da sua API .NET

$i = 1;
$cadastrar = true;

do {
    echo "[ C ] ~ Cadastrar Funcionário. \n[ L ] ~ Listar Funcionário. \n[ E ] ~ Editar Funcionário. \n[ D ] ~ Deletar Funcionário. \n[ S ] ~ Sair do programa. \nOpção: ";
    $opc = readline();

    $opc = filter_var($opc, FILTER_SANITIZE_STRING);
    $opc = strtoupper($opc);

    switch ($opc) {
        case 'C':
            echo "Digite o nome completo do funcionário: ";
            $nomeCompleto = readline();
            echo "Digite o CPF do funcionário: ";
            $cpf = readline();
            echo "Digite a data de nascimento do funcionário: ";
            $dataNascimento = readline();
            echo "Digite o celular do funcionário: ";
            $celular = readline();

            // Dados a serem enviados como JSON no corpo da solicitação
            $dadosFuncionario = [
                'nome' => $nomeCompleto,
                'cpf' => $cpf,
                'dataNascimento' => $dataNascimento,
                'celular' => $celular,
            ];

            // Realize uma solicitação HTTP POST para cadastrar o funcionário
            $ch = curl_init($apiUrl . '/funcionarios');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dadosFuncionario));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                echo "Erro ao cadastrar funcionário.\n";
            } else {
                echo "Funcionário cadastrado com sucesso!\n";
            }

            $i += 1;
            break;

        case 'L':
            // Realize uma solicitação HTTP GET para listar funcionários
            $ch = curl_init($apiUrl . '/funcionarios');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            // Decodifique o JSON retornado
            $funcionarios = json_decode($response, true);

            if ($funcionarios === null) {
                echo "Erro ao obter a lista de funcionários.\n";
            } else {
                foreach ($funcionarios as $funcionario) {
                    echo "Nome: " . $funcionario['nome'] . "\n";
                    echo "CPF: " . $funcionario['cpf'] . "\n";
                    echo "Data de Nascimento: " . $funcionario['dataNascimento'] . "\n";
                    echo "Celular: " . $funcionario['celular'] . "\n\n";
                }
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

        default:
            echo "Opção digitada não condiz com as opções acima! \nDigite uma opção válida.\n";
    }
} while ($cadastrar);
?>
