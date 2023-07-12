<?php
include_once 'functions.php';

if (isset($_GET['request'])){
    $request = $_GET['request'];
}else{
    $request = $_POST['request'];
}


switch ($request) {

    case '1':
        $user = $_GET['user'];
        $pwd = $_GET['pwd'];
        login($user, $pwd);
        break;

    case '2':
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $pwd = $_POST['pwd'];
        $endereco = $_POST['endereco'];
        $matricula = 'u21o1029';
        $datanasc = $_POST['data'];
        $email = $_POST['email'];
        $att = $_POST['att'];
        insert_admin($nome, $cpf, $pwd, $endereco, $matricula, $datanasc, $email, $att);
        break;
    
    case '3':
        $cpf_aluno = $_POST['cpf_aluno'];
        $cpf_resp = $_POST['cpf_resp'];
        vincular($cpf_aluno, $cpf_resp);
        break;
    
    case '4':
        $cpf_resp = $_GET['cpf_resp'];
        return_vinculo($cpf_resp);
        break;
}
?>