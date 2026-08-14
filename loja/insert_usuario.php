<?php
function getConnection() {
$host = "localhost";
$dbname = "lojinha";
$user = "root";
$pass = "";
try {
$conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass);
$conn->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
return $conn;
} catch (PDOException $e) {
die("Erro de conexão: " . $e->getMessage());
}
}
try{
$pdo = getConnection();

$sql = "INSERT INTO usuario (nome, email, cpf) VALUES (:n, :p, :d)";
$stmt = $pdo->prepare($sql);
extract ($_POST);
$stmt->execute([
":n" => $nome,
":p" => $email,
":d" => $cpf
]);
echo "usuario inserido com ID" . $pdo->lastInsertId();
}
catch (\PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>