<?php

// Define a URL da API
$apiUrl = 'https://a.free.micuim.ravendb.cloud'; // Substitua pela URL da sua API .NET

// Inicializa variáveis
$i = 1;
$cadastrar = true;

do {
    // Exibe as opções para o usuário
    echo "[ C ] ~ Cadastrar Funcionário. \n[ S ] ~ Sair do programa. \nOpção: ";
    $opc = readline();

    // Filtra e converte a opção do usuário para maiúsculas
    $opc = filter_var($opc, FILTER_SANITIZE_STRING);
    $opc = strtoupper($opc);

    // Realiza a ação com base na opção escolhida
    switch ($opc) {
        case 'C':
            // Solicita informações do funcionário
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

            // Verifica se o cadastro foi bem-sucedido
            if ($response === false) echo "Erro ao cadastrar funcionário.\n";
            else  echo "Funcionário cadastrado com sucesso!\n";
            
            $i += 1;
            break;

        case 'S':
            echo "Saindo do programa [ ... ]\n";
            $cadastrar = false;
            break;

        default:
            echo "Opção digitada não condiz com as opções acima! \nDigite uma opção válida.\n";
    }
} while ($cadastrar);