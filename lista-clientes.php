<?php

require('db/queries.php');
require('db/connection.php');
require('utils/validation.php');

// Variável para armazenar as possíveis mensagens de erro
$error = "";

// Se houve uma requisição $_POST para lista-clientes-php ele cria o novo cliente no banco
if (isset($_POST['submit'])) {
  try {
    validateInputs($conn, $_POST['nome'], $_POST['data_de_nascimento'], $_POST['telefone'], $_POST['cpf']);
    if (empty($_POST['cpf'])) {
      $_POST['cpf'] = null;
    }
    create($conn, $_POST['nome'], $_POST['telefone'], $_POST['data_de_nascimento'], $_POST['email'], $_POST['cpf']);
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

// Quando uma requisição GET para lista-clientes.php é feita através do botão deletar faz a query no banco 
if(isset($_GET['telefone'])) {
  try {
    deleteByNumber($conn, $_GET['telefone']);
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

// Formata o cpf 
function formatCpf($cpf)
{
  if (strlen($cpf) == 11) {
    $cpf = chunk_split($cpf, 3, '.');
    $cpf[11] = '-';
    $cpf = chop($cpf, '.');
  }
  return $cpf;
}

// Calcula a idade com base na data de nascimento
function calculateAge($date)
{
  $current = new DateTime("now");
  $parsedDate = DateTimeImmutable::createFromFormat('Y-m-d', $date);
  $result = date_diff($current, $parsedDate);
  return $result->y;
}

// Busca todos os clientes no banco de dados
$clientes = getAll($conn);

// Função que cria a tabela  com os clientes
function showClientes($clientes)
{

  echo "<tr>
          <th>Nome</th>  
          <th>Telefone</th>  
          <th>Idade</th>  
          <th>Email</th>  
          <th>CPF</th>
          <th></th>  
        </tr>";
  foreach ($clientes as $cliente) {
    $cpf = $cliente->cpf ? formatCpf($cliente->cpf) : '-';
    $email = $cliente->email ? "<a href=''>$cliente->email</a>" : '-';
    $idade = calculateAge($cliente->data_de_nascimento);
    echo "<tr>
            <td>$cliente->nome</td>  
            <td>$cliente->telefone</td>  
            <td>$idade anos</td>  
            <td>$email</td>  
            <td>$cpf</td>
            <td class='text-center'><a class='btn btn-danger' href='lista-clientes.php?telefone=$cliente->telefone' name='delete'>Deletar</a></button</td>  
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
  <script>
    // Envia um alerta caso tenha acontecido algum erro no cadastro    
    if (<?php echo (empty($error) ? 'false' : 'true') ?>) {
      window.alert("Aconteceu um erro no cadastro\n" + "<?php echo "$error" ?>");
    }
  </script>
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