<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">]
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Usuários</title>
</head>
<body>
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Email</th>
      <th scope="col">Atribuição</th>
      <th scope="col">Matricula</th>
      <th scope="col">Senha</th>
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
         'sql' =>base64_encode('SELECT * FROM responsaveis')
     );
 
     // Inicializa o cURL
     $ch = curl_init();
 
     // Configura as opções do cURL
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data01);
 
     // Executa a solicitação
 
     // Verifica se ocorreu algum erro
     $query01 = curl_exec($ch);

     // Verifica se ocorreu algum erro
     if ($query01 === false) {
         echo 'Erro ao enviar os dados: ' . curl_error($ch);
     } else {
         // Decodifica a resposta JSON
         $resultados = json_decode($query01, true);
         $array = array(
            array(
                array(
                    'Name' => 'id',
                    'Type' => 4,
                    'Value' => 1
                ),
                array(
                    'Name' => 'nome',
                    'Type' => 3,
                    'Value' => 'UmVzcG9uc8OhdmVsMDE='
                ),
                // Outros elementos...
            )
        );
        
        $values = array();
        foreach ($array[0] as $element) {
            $values[] = $element['Value'];
        }
        
        print_r($values);
        
        }

         /*
         // Verifica se há resultados
         if (isset($resultados['result']['rows'])) {
             $rows = $resultados['result']['rows'];

             foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '</tr>';
            }
    
            echo '</table>';
            
         }
         
        }
        */
    ?>
</table>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>