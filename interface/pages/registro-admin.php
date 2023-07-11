<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/registro-resp.css">
    <title>Registrar Responsável</title>
</head>
<body>
    <div class="container-fluid div_form">
        <h1 class="title d-flex justify-content-center">Adicionar Administrador</h1>

        <form action="../../functions/requests.php" method="post" >
            <div class="form-group">
                <label for="exampleFormControlInput1">Nome Completo:</label>
                <input name="nome" type="text" class="form-control" id="nome" placeholder="Ex: Elder">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">CPF:</label>
                <input name="cpf" type="text" class="form-control" id="cpf" placeholder="00000000000">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Data de nascimento:</label>
                <input name="data" type="text" class="form-control" id="data" placeholder="Formato: dia-mes-ano">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email:</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Endereço:</label>
                <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Endereco">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Crie uma senha:</label>
                <input name="pwd" type="text" class="form-control" id="pwd" placeholder="Senha forte">
            </div>
            <input name="request" type="hidden" class="form-control" id="request" value="2">
            <input name="att" type="hidden" class="form-control" id="att" value="1">
            <div class="botao d-flex justify-content-center">
            <button class="btn btn-success">Enviar</button>
            </div>
            </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>