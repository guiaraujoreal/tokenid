<?php
function database(){
  $db = new PDO('sqlite:database.sqlite');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $db;
}

function login($user, $pwd, $att){
  $db = database();

  $query = 'SELECT id, pwd, name, atribute FROM users WHERE user = \'' . $user . '\' AND pwd = \'' . $pwd . '\'';

  // Executar a consulta
  $result = $db->query($query);

  // Obter os resultados
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);
  $rowCount = count($rows);

  if ($rowCount > 0) {
    foreach ($rows as $row) {
      // Processar cada linha do resultado
      $id = $row['id'];
      $name = $row['name'];
      $att = $row['atribute'];
      //return=1
    }
    $response = array($att, $id, $name);
    
  } else {
    //return = 0
    $response = array(0, 0, 0);
  }

  // Liberar os recursos e fechar a conexão com o banco de dados
  $db = null;

  // Retornar a resposta como JSON
  return json_encode($response);
}

function insert($user, $pwd, $name, $code, $data, $hora, $att){
  $db = new PDO('sqlite:database.sqlite');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $stmt = $db->prepare("INSERT INTO users (user, pwd, name, code, data, hora, atribute) VALUES (?, ?, ?, ?, ?, ?, ?)");

  if($stmt->execute([$user, $pwd, $name, $code, $data, $hora, $att])){
  
    echo 1;
  }
  else{
    echo 0;
  }
  $db = null;
}

?>