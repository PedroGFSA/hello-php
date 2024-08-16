<?php
function validateInputs($conn, $nome, $telefone, $cpf){
    if (strlen($nome) < 3) {
        throw new Exception("O nome deve conter ao menos 3 caracteres.");
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