<?php
function validateInputs($conn, $nome, $data_de_nascimento, $telefone, $cpf){
    // Se o nome tiver menos de 3 caracteres não passa
    if (strlen($nome) < 3) {
        throw new Exception("O nome deve conter ao menos 3 caracteres.");
    }
    // Checa se a data de nascimento escolhida é maior que a data atual
    $today = new DateTime('now');
    $data_de_nascimento = DateTime::createFromFormat('Y-m-d', $data_de_nascimento);
    if ($data_de_nascimento > $today) {
        throw new Exception("Data de nascimento inválida.");
    }
    // Checa se cpf possui 11 dígitos, caso contrário não passa
    if($cpf && strlen($cpf) != 11) {
        throw new Exception("CPF inválido.");
    }
    // Busca se já existe algum cliente com o número 
    $result = mysqli_query($conn, "SELECT id FROM clientes WHERE telefone = $telefone");
    $value = $result->fetch_assoc();
    if ($value) {
        throw new Exception("Esse número já foi registrado.");
    }
}