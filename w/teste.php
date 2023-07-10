
    <?php

        $url = 'https://api.dbhub.io/v1/query';
        // Dados da solicitação
        $data = array(
            'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
            'dbowner' => 'guiaraujoreal',
            'dbname' => 'tokenid.sqlite',
            'sql' => base64_encode("SELECT * FROM login WHERE id = 2")
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
            // Decodifica o JSON para um array PHP
            $resposta = json_decode($resultado, true);
        
            // Verifica se há algum resultado
            if (!empty($resposta)) {
                // Variável contador
                $contador = 0;
        
                // Acessa apenas o segundo valor do JSON
                foreach ($resposta[0] as $elemento) {
                    // Incrementa o contador
                    $contador++;
        
                    // Verifica se é o segundo elemento
                    if ($contador === 2) {
                        $valor = base64_decode($elemento['Value']);
                        echo $valor . "<br>";
                        break; // Sai do loop após o segundo elemento
                    }
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        }
        
        // Fecha a sessão cURL
        curl_close($ch);
        ?>