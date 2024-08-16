<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Desafio técnico - AGP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div class="d-flex align-items-center flex-column">
    <h2 class="text-center my-3">Cadastrar novo cliente</h2>
    <button class="btn btn-success mb-3"><a class="link-underline link-underline-opacity-0 link-light" href="lista-clientes.php">Ver lista de clientes</a></button>
  </div>

  <form class="form-control  form-control-sm d-flex flex-column gap-3 py-3" style="margin: 0 auto; max-width: 800px" action="lista-clientes.php" method="POST">

    <div class="form-group">
      <label class="form-label" for="nome">Nome <span class="text-danger">*</span></label>
      <input required type="text" class="form-control" name="nome" id="nome">
    </div>

    <div class="form-group">
      <label class="form-label" for="cpf">CPF</label>
      <input type="number" class="form-control" name="cpf" id="cpf">
    </div>

    <div class="form-group">
      <label class="form-label" for="telefone">Telefone <span class="text-danger">*</span></label>
      <input required type="number" class="form-control" name="telefone" id="telefone">
    </div>

    <div class="form-group">
      <label class="form-label" for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email">
    </div>

    <div class="form-group">
      <label class="form-label" for="data_de_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
      <input required type="date" class="date-input form-control" name="data_de_nascimento" id="data_de_nascimento">
    </div>

    <button class="btn btn-success" style="max-width: 100px; margin: 0 auto" type="submit" name="submit">Cadastrar</button>
  </form>
</body>

</html>