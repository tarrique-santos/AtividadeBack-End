<?php

// Cria uma conexão com o MongoDB
$mongo = new MongoClient("mongodb://localhost:27017");

// Seleciona o banco de dados
$db = $mongo->selectDB("funcionarios");

// Cria uma coleção para armazenar os dados dos funcionários
$collection = $db->createCollection("funcionarios");

// Cria um formulário para coletar os dados do funcionário
echo <<<HTML
<form action="index.php" method="post">

  <label for="nome">Nome:</label>
  <input type="text" id="nome" name="nome" required>

  <label for="sobrenome">Sobrenome:</label>
  <input type="text" id="sobrenome" name="sobrenome" required>

  <label for="cpf">CPF:</label>
  <input type="text" id="cpf" name="cpf" required>

  <label for="data_nasc">Data de nascimento:</label>
  <input type="date" id="data_nasc" name="data_nasc" required>

  <label for="celular">Celular:</label>
  <input type="text" id="celular" name="celular" required>

  <input type="submit" value="Salvar">

</form>
HTML;

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Obtém os dados do formulário
  $nome = $_POST["nome"];
  $sobrenome = $_POST["sobrenome"];
  $cpf = $_POST["cpf"];
  $data_nasc = $_POST["data_nasc"];
  $celular = $_POST["celular"];

  // Cria um documento para armazenar os dados do funcionário
  $documento = [
    "nome" => $nome,
    "sobrenome" => $sobrenome,
    "cpf" => $cpf,
    "data_nasc" => $data_nasc,
    "celular" => $celular,
  ];

  // Salva o documento no MongoDB
  $collection->insertOne($documento);

  // Exibe uma mensagem de confirmação
  echo "Funcionário cadastrado com sucesso!";
}

?>
