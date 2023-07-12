<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/registro-resp.css">
    <title>Vincular Aluno</title>
</head>
<body>
    <div class="container-fluid div_form">
        <?php 
        $nome_aluno = $_POST['nome_aluno'];
        $id_aluno = $_POST['id_aluno'];
        $cpf_aluno = $_POST['cpf_aluno'];
        ?>
        <h1 class="title d-flex justify-content-center">Vincular <?php echo base64_decode($nome_aluno) ?> à um resposável</h1>

        <form action="../../functions/requests.php" method="post" >
            <div class="form-group">
                <label for="exampleFormControlInput1">Insira o CPF do responsável</label>
                <input name="cpf_resp" type="text" class="form-control" id="nome" placeholder="CPF do responsável legal" required>
                <input name="cpf_aluno" type="hidden" value="<?php echo $cpf_aluno?>">
                <input name="request" type="hidden" value="3">
            </div>
            
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