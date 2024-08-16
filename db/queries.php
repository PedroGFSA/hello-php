<?php

require('models/Cliente.php');

// Cadastrar novo cliente no banco de dados
function create($conn, $nome, $telefone, $data_de_nascimento, $email, $cpf)
{
    $query = mysqli_prepare($conn, "INSERT INTO clientes (nome, telefone, data_de_nascimento, email, cpf) VALUES (?, ?, ?, ?, ?)");
    $query->bind_param('sssss', $nome, $telefone, $data_de_nascimento, $email, $cpf);
    return $query->execute();
}

// Busca todos os clientes no banco
function getAll($conn)
{
    $array_clientes = [];
    $result = mysqli_query($conn, "SELECT * FROM clientes");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $cliente = new Cliente($row['nome'], $row['telefone'], $row['data_de_nascimento'], $row['email'], $row['cpf']);
            $array_clientes[] = $cliente;
        }
    }
    return $array_clientes;
}
