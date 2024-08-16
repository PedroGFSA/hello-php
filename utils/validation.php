<?php
function validateInputs($conn, $nome, $data_de_nascimento, $telefone, $cpf){
    if (strlen($nome) < 3) {
        throw new Exception("O nome deve conter ao menos 3 caracteres.");
    }
    $today = new DateTime('now');
    $data_de_nascimento = DateTime::createFromFormat('Y-m-d', $data_de_nascimento);
    if ($data_de_nascimento > $today) {
        throw new Exception("Data de nascimento inválida.");
    }
    if(strlen($cpf) != 11) {
        throw new Exception("CPF inválido.");
    }

    $result = mysqli_query($conn, "SELECT id FROM clientes WHERE telefone = $telefone");
    $value = $result->fetch_assoc();
    if ($value) {
        throw new Exception("Esse número já foi registrado.");
    }
}