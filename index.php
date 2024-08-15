<?php

require('models/Cliente.php');

$host = 'localhost:3306';
$dbuser = 'root';
$dbpassword = 'root';
$dbname = 'visu_clientes';

$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
if ($conn) {
    echo "Connection - successful </br>";
    migrate($conn);
} else {
    echo "Connection - failed </br>" . mysqli_connect_error();
}

// Executa as migrations
function migrate($conn)
{
    try {
        // Salvando a query na variável
        $create_clientes_table = file_get_contents("./migrations/001__create_clientes_table.sql");
        mysqli_query($conn, "$create_clientes_table");
    } catch (Exception $e) {
        echo $e;
    }
}

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>

<body>
    <h1>Desafio técnico - AGP</h1>
    <h2>Cadastrar novo cliente</h2>
    <form action="" method="POST">
        Nome
        <input required type="text"><br>
        Telefone
        <input required type="text"><br>
        Data de nascimento
        <input required type="date"><br>
        Email
        <input type="email"><br>
        CPF
        <input type="text"><br>
        <button>Criar</button>
    </form>
</body>

</html>