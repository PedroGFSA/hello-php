<?php

require('db/queries.php');
require('db/connection.php');
require('utils/validation.php');

if (isset($_POST['submit'])) {
  try {
    validateInputs($conn, $_POST['nome'], $_POST['telefone'], $_POST['cpf']);
    create($conn, $_POST['nome'], $_POST['telefone'], $_POST['data_de_nascimento'], $_POST['email'], $_POST['cpf']);
  } catch (Exception $e) {
    echo $e;
  }
}

function formatCpf($cpf)
{
  if (strlen($cpf) == 11) {
    $cpf = chunk_split($cpf, 3, '.');
    $cpf[11] = '-';
    $cpf = chop($cpf, '.');
  }
  return $cpf;
}

function formatDate($date)
{
  $date = implode('/', array_reverse(explode('-', $date)));
  return $date;
}

$clientes = getAll($conn);

function showClientes($clientes)
{

  echo "<tr>
          <th>Nome</th>  
          <th>Telefone</th>  
          <th>Data de nascimento</th>  
          <th>Email</th>  
          <th>CPF</th>  
        </tr>";
  foreach ($clientes as $cliente) {
    $cliente->cpf = $cliente->cpf ? formatCpf($cliente->cpf) : '-';
    $cliente->email = $cliente->email ? "<a href=''>$cliente->email</a>" : '-';
    $cliente->data_de_nascimento = formatDate($cliente->data_de_nascimento);
    echo "<tr>
            <th>$cliente->nome</th>  
            <th>$cliente->telefone</th>  
            <th>$cliente->data_de_nascimento</th>  
            <th>$cliente->email</th>  
            <th>$cliente->cpf</th>  
          </tr>";
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Desafio técnico - AGP</title>
</head>

<body class="pb-5">
  <h2 class="text-center mt-3 mb-3">Lista de Clientes</h2>
  <form class="mb-4 text-center" action="index.php">
    <input class="btn btn-success" type="submit" value="Cadastrar novo cliente">
  </form>
  <table class="table table-bordered table-striped" style="max-width: 90vw; margin: 0 auto">
    <?php
    showClientes($clientes);
    ?>
  </table>

</body>

</html>