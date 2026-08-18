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

     if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("E-mail invalido.");
}
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    if (strlen($cnpj) != 14) {
    die("O CNPJ deve ter 14 numeros.");
}
    $telefone = preg_replace('/[^0-9]/', '', $telefone);
    if (strlen($telefone) != 10 && strlen($telefone) != 11) {
    die("O telefone deve ter 10 ou 11 numeros.");
}
    $sql = "INSERT INTO fornecedor (nome, email, cnpj, telefone) VALUES (:n, :e, :c, :t)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
    ":n" => $nome,
    ":e" => $email,
    ":c" => $cnpj,
    ":t" => $telefone,
]);
    echo "Fornecedor inserido com ID " . $pdo->lastInsertId();
}
    catch (PDOException $e){
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>