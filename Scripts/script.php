<?php
// Conecte-se ao servidor MongoDB
$cliente = new MongoDB\Client("mongodb://localhost:27017");

// Selecione o banco de dados e a coleção
$bancoDeDados = $cliente->selectDatabase('nome_do_seu_banco_de_dados');
$colecao = $bancoDeDados->selectCollection('usuarios');

// Obtenha os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cpf = $_POST['cpf'];
$dataNascimento = new DateTime($_POST['data_nascimento']);
$celular = $_POST['celular'];

// Crie um documento para inserção
$documento = [
    'nome' => $nome,
    'sobrenome' => $sobrenome,
    'cpf' => $cpf,
    'data_nascimento' => $dataNascimento,
    'celular' => $celular,
];

// Insira o documento na coleção
$colecao->insertOne($documento);

// Redirecione de volta para o formulário
header('Location: script.php');
?>
