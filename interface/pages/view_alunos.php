<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/view_alunos.css">
    <title>Usuários</title>
</head>
<body>
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th class="escopo" scope="col">Nome</th>
      <th class="escopo" scope="col">CPF</th>
      <th class="escopo" scope="col">Email</th>
      <th class="escopo" scope="col">Atribuição</th>
      <th class="escopo" scope="col">Matricula</th>
      <th class="escopo" scope="col">Senha</th>
      <th class="escopo" scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  <?php

$url = 'https://api.dbhub.io/v1/query';

// Dados a serem enviados para a API
$data01 = array(
    'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
    'dbowner' => 'guiaraujoreal',
    'dbname' => 'tokenid.sqlite',
    'sql' => base64_encode('SELECT * FROM alunos')
);

// Inicializa o cURL
$ch = curl_init();

// Configura as opções do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data01);

// Executa a solicitação
$query01 = curl_exec($ch);

// Verifica se ocorreu algum erro
if ($query01 === false) {
    echo 'Erro ao enviar os dados: ' . curl_error($ch);
} else {
    // Decodifica a resposta JSON
    $resultados = json_decode($query01, true);
    //print_r($resultados);
    
    foreach ($resultados as $element) {
       
        echo "<tr>";

            echo "<td>" . base64_decode($element[1]["Value"]) . "</td>";
            if(base64_decode($element[6]["Value"]) == 3){
                $att_name = 'Aluno';
            }else{
                $att_name = 'Sem atribuição';
            }
            echo "<td class='escopo'>" . base64_decode($element[4]["Value"]) . "</td>";
            echo "<td class='escopo'>" . base64_decode($element[5]["Value"]) . "</td>";
            echo "<td class='escopo'>" .$att_name . "</td>";
            echo "<td class='escopo'>" . base64_decode($element[8]["Value"]) . "</td>";
            echo "<td class='escopo'>" . base64_decode($element[3]["Value"]) . "</td>";

            echo "<td  class='escopo'>
            <form action='vincular.php' method='post'>
            <input type='hidden' value='" . $element[0]["Value"] . "' name='id_aluno'>
            <input type='hidden' value='" . $element[1]["Value"] . "' name='nome_aluno'>
            <input type='hidden' value='" . $element[4]["Value"] . "' name='cpf_aluno'>
            <button type='submit' class='btn btn-primary'>Vincular responsavel</button>
            </form>
            </td>";
        
        echo "</tr>";
        
    }
    
    echo "</table>";
    
}

// Fecha a conexão cURL
curl_close($ch);

?>

</table>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>