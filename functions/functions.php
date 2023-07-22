<?php
function login($user, $pwd){
 
    $url = 'https://api.dbhub.io/v1/query';
    // Dados da solicitação
    $data = [
        'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
        'dbowner' => 'guiaraujoreal',
        'dbname' => 'tokenid.sqlite',
        'sql' => base64_encode('SELECT * FROM login WHERE (cpf = \'' . $user . '\' AND pwd = \'' . $pwd . '\') OR (email = \'' . $user . '\' AND pwd = \'' . $pwd . '\')')
    ];

    // Inicializa o cURL
    $ch = curl_init();

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a solicitação
    $resultado01 = curl_exec($ch);

    // Verifica se ocorreu algum erro
    if ($resultado01 === false) {
        $return_login = array(0,0);
    } else {
        
        // Obtém o número de linhas retornadas
        $num_rows = 0;
        if (!empty($resultado01)) {
            $resposta = json_decode($resultado01, true);
            if (!empty($resposta[0])) {
                $num_rows = count($resposta[0]);
                if($num_rows > 0){
                    
            // Decodifica o JSON para um array PHP
            $resposta = json_decode($resultado01, true);
            // Verifica se há algum resultado
            if (!empty($resposta)) {

                $att_return = $resposta[0][4]['Value'];
                $name_return = $resposta[0][5]['Value'];
                $cpf_return = $resposta[0][1]['Value'];

                $return_login = array($att_return,$name_return,$cpf_return);
            } else {
                $return_login = array(0,0,0);
            }
        
            }
        }else{
            $return_login = array(0,0,0);
        }
        echo json_encode($return_login);
    }

    // Fecha a sessão cURL
    curl_close($ch);
}
}
function insert_admin($nome, $cpf, $pwd, $endereco, $matricula, $datanasc, $email, $att) {
    // Dados do formulário
    $nome_encode = base64_encode($nome);
    $pwd_encode = base64_encode($pwd);
    $cpf_encode = base64_encode($cpf);
    $endereco_encode = base64_encode($endereco);
    $datanasc_encode = base64_encode($datanasc);
    $email_encode = base64_encode($email);
    $att_encode = base64_encode($att);
    

    if ($att == 1) {
        $tabela = 'admin';
        $matricula_encode = base64_encode($matricula);
    } else if ($att == 2) {
        $tabela = 'responsaveis';
        $matricula_encode = base64_encode(0);
    } else if ($att == 3) {
        $tabela = 'alunos';
        $matricula_encode = base64_encode($matricula);
    } else {
        $tabela = null;
        $matricula_encode = base64_encode(0);
    }

    // Endpoint da API do dbhub.io
    $url = 'https://api.dbhub.io/v1/execute';

    // Dados a serem enviados para a API
    $data01 = array(
        'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
        'dbowner' => 'guiaraujoreal',
        'dbname' => 'tokenid.sqlite',
        'sql' => base64_encode("INSERT INTO $tabela (nome, pwd, cpf, endereco, matricula, data_nasc, email, att) VALUES ('$nome_encode', '$pwd_encode', '$cpf_encode', '$endereco_encode', '$matricula_encode', '$datanasc_encode', '$email_encode', '$att_encode')")
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
        // Primeiro INSERT bem-sucedido, realizar o segundo INSERT
        $data02 = array(
            'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
            'dbowner' => 'guiaraujoreal',
            'dbname' => 'tokenid.sqlite',
            'sql' => base64_encode("INSERT INTO login (cpf, pwd, email, nome, att) VALUES ('$cpf_encode', '$pwd_encode', '$email_encode', '$nome_encode', '$att_encode')")
        );

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data02);

        $query02 = curl_exec($ch);

        if ($query02 === false) {
            echo 'Erro ao enviar os dados do segundo INSERT: ' . curl_error($ch);
        } else {
            header('location:../interface/pages/page_deucerto.php');
        }
    }
}

function vincular($cpf_aluno,$cpf_resp){

    $cpf_resp_encode = base64_encode($cpf_resp);

    $url = 'https://api.dbhub.io/v1/execute';

    // Dados a serem enviados para a API
    $data01 = array(
        'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
        'dbowner' => 'guiaraujoreal',
        'dbname' => 'tokenid.sqlite',
        'sql' => base64_encode("INSERT INTO vinculo(cpf_aluno, cpf_responsavel) VALUES ('$cpf_aluno', '$cpf_resp_encode')")
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
        echo 'ok';
}
}

function return_vinculo($cpf_resp){
    $url = 'https://api.dbhub.io/v1/query';
    // Dados da solicitação
    $data = [
        'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
        'dbowner' => 'guiaraujoreal',
        'dbname' => 'tokenid.sqlite',
        'sql' => base64_encode('SELECT cpf_aluno FROM vinculo WHERE cpf_responsavel = \'' . $cpf_resp . '\'')
    ];

    // Inicializa o cURL
    $ch = curl_init();

    // Configura as opções do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a solicitação
    $resultado01 = curl_exec($ch);

    // Verifica se ocorreu algum erro
    if ($resultado01 === false) {
        $return_vinculo["return"]["Value"] = 0;
        $return_vinculo["dados"][] = 0;
        echo json_encode($return_vinculo);
    } else {
        
        // Obtém o número de linhas retornadas
        $num_rows = 0;
        if (!empty($resultado01)) {
            $resposta = json_decode($resultado01, true);
            //print_r($resposta);
            
            
            if (!empty($resposta)) {
                $num_rows = count($resposta);
                if($num_rows > 0){
                    
                    // Verifica se há algum resultado
                    if (!empty($resposta)) {
                        
                        foreach($resposta as $element){
                            $cpf_aluno[] = $element[0]["Value"];
                        }
                        $cpf_query = '"' . implode('", "',$cpf_aluno) . '"';
                        
                        
                        
                        $url = 'https://api.dbhub.io/v1/query';
                        // Dados da solicitação
                        $query = [
                            'apikey' => '2SO1wiXchRm2wZSeCz6D0HKIk4d',
                            'dbowner' => 'guiaraujoreal',
                            'dbname' => 'tokenid.sqlite',
                            'sql' => base64_encode('SELECT cpf,nome FROM alunos WHERE cpf IN (' . $cpf_query . ')')
                        ];
                        // Configura as opções do cURL
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        // Executa a solicitação
                        $nomes = curl_exec($ch);

                        if ($nomes === false) {
                            echo 'vazio';
                        } else {
                            $num_rows = 0;
                            if (!empty($nomes)) {
                                $info_als = json_decode($nomes, true);
                                
                                if (!empty($info_als)) {

                                    $num_rows = count($info_als);

                                    if($num_rows > 0){
                                        
                                        
                                        if (!empty($info_als)) {
                                            $cpf = null;
                                            $nome = null;
                                            //print_r($info_als);
                                            
                                            foreach($info_als as $element2){
                                                foreach($element2 as $dados){
                                                    if($dados["Name"] === 'cpf'){
                                                        $cpf = $dados["Value"];
                                                    }
                                                    elseif($dados["Name"] === 'nome'){
                                                        $nome = $dados["Value"];
                                                    }
                                    
                                                }
                                                if($cpf !== null && $nome !== null) {
                                                    $dados_alunos[] = array(
                                                        "cpf" => base64_decode($cpf),
                                                        "nome" => base64_decode($nome)
                                                    );
                                                }
                                                else{
                                                    $dados_alunos[] = array(
                                                        "cpf" => base64_encode(0),
                                                        "nome" => base64_encode(0)
                                                    );
                                                }
                                                
                                                
                                                //echo json_encode($return_vinculo);
                                            }
                                            $return_vinculo["return"]["Value"] = 1;
                                            $return_vinculo["dados"][] = $dados_alunos;
                                            //print_r($return_vinculo["dados"][0][0]["nome"]);
                                            echo json_encode($return_vinculo);
                                            
                                        }
                                        else{
                                            $return_vinculo["return"]["Value"] = 0;
                                            $return_vinculo["dados"][] = 0;
                                            echo json_encode($return_vinculo);
                                            
                                        }
                                    }
                                    else{
                                        $return_vinculo["return"]["Value"] = 0;
                                        $return_vinculo["dados"][] = 0;
                                        echo json_encode($return_vinculo);
                                            
                                    }
                                }
                                else{
                                    $return_vinculo["return"]["Value"] = 0;
                                    $return_vinculo["dados"][] = 0;
                                    echo json_encode($return_vinculo);

                                }
                            }
                            else{
                                $return_vinculo["return"]["Value"] = 0;
                                $return_vinculo["dados"][] = 0;
                                echo json_encode($return_vinculo);
                                
                            }

                        }

                    } else {
                        $return_vinculo["return"]["Value"] = 0;
                        $return_vinculo["dados"][] = 0;
                        echo json_encode($return_vinculo);
                        
                    }
                
            }
        }else{
            $return_vinculo["return"]["Value"] = 0;
            $return_vinculo["dados"][] = 0;
            echo json_encode($return_vinculo);
           
            
        }
        
    }else{
        $return_vinculo["return"]["Value"] = 0;
        $return_vinculo["dados"][] = 0;
        echo json_encode($return_vinculo);
    }

    // Fecha a sessão cURL
    curl_close($ch);
}
}

//function confere_vinculo()


?>