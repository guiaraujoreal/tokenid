<?php
function login($user, $pwd){
    $user_encode = base64_encode($user);
    $pwd_encode = base64_encode($pwd);

    $url = 'https://api.dbhub.io/v1/query';
    // Dados da solicitação
    $data = array(
        'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
        'dbowner' => 'guiaraujoreal',
        'dbname' => 'tokenid.sqlite',
        'sql' => base64_encode('SELECT * FROM login WHERE user = \'' . $user_encode . '\' AND pwd = \'' . $pwd_encode . '\'')
    );

    // Inicializa o cURL
    $ch = curl_init();

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a solicitação
    $resultado = curl_exec($ch);

    // Verifica se ocorreu algum erro
    if ($resultado === false) {
        echo "Erro ao enviar a solicitação cURL: " . curl_error($ch);
    } else {
        
        // Obtém o número de linhas retornadas
        $num_rows = 0;
        if (!empty($resultado)) {
            $resposta = json_decode($resultado, true);
            if (!empty($resposta[0])) {
                $num_rows = count($resposta[0]);
                if($num_rows > 0){
                    echo $resultado;
                }else{
                    echo "Tente novamente.";
                }
            }
        }

    // Fecha a sessão cURL
    curl_close($ch);
}
}

// Exemplo de uso
login("Ricardo", "1234");
?>