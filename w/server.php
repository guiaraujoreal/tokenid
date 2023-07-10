<?php
// Dados do formulário
$nome = 'Ricardo';
$pwd = '1234';
$nome_encode = base64_encode($nome);
$pwd_encode = base64_encode($pwd);

// Endpoint da API do dbhub.io
$url = 'https://api.dbhub.io/v1/execute';

// Dados a serem enviados para a API
$data = array(
    'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
    'dbowner' => 'guiaraujoreal',
    'dbname' => 'tokenid.sqlite',
    'sql' => base64_encode("INSERT INTO login (user, pwd) VALUES ('$nome_encode', '$pwd_encode')")
);

// Inicializa o cURL
$ch = curl_init();

// Configura as opções do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Executa a solicitação
$resultado = curl_exec($ch);

// Verifica se ocorreu algum erro
if ($resultado === false) {
    echo 'Erro ao enviar os dados: ' . curl_error($ch);
} else {
    echo 'Dados enviados com sucesso.';
}

// Fecha a sessão cURL
curl_close($ch);
?>
