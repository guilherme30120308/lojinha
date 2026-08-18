<?php
    function getConnection() {
     $host = "localhost";
     $dbname = "loja";
     $user = "root";
     $pass = "";
try{
     $conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
     $conn->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
     return $conn;
    } 
     catch (PDOException $e){
     die("Erro de conexao: " . $e->getMessage());
    }
}
try{
    $pdo = getConnection();
    extract ($_POST);

    if (!filter_var($numero, FILTER_VALIDATE_INT) || $numero <= 0){
    die("O numero deve ser um inteiro maior que zero.");
    }

     if (!filter_var($id_usuario, FILTER_VALIDATE_INT)) {
     die("O ID do usuario deve ser um numero inteiro.");
}

    $sql = "INSERT INTO endereco (rua, numero, bairro, cidade, estado, pais, id_usuario) VALUES (:r, :n, :b, :c, :e, :p, :i)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
    ":r" => $rua,
    ":n" => $numero,
    ":b" => $bairro,
    ":c" => $cidade, 
    ":e" => $estado,
    ":p" => $pais,
    ":i" => $id_usuario
]);
    echo "Endereco inserido com ID " . $pdo->lastInsertId();
}
    catch (PDOException $e){
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>