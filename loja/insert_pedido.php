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

    if ($data_pedido < date('Y-m-d')){
    die("A data do pedido nao pode ser uma data passada.");
}
    if (!is_numeric($quant) || $quant <= 0 || $quant != (int)$quant) {
    die("A quantidade deve ser um numero inteiro maior que zero.");
}
    if (!filter_var($id_endereco, FILTER_VALIDATE_INT) ||
        !filter_var($id_usuario, FILTER_VALIDATE_INT) ||
        !filter_var($id_transportadora, FILTER_VALIDATE_INT)) {
    die("Os IDs devem ser numeros inteiros.");
}
    $sql = "INSERT INTO pedido (data_pedido, quant, id_endereco, id_usuario, id_transportadora) VALUES (:d, :q, :e, :u, :t)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
    ":d" => $data_pedido,
    ":q" => $quant,
    ":e" => $id_endereco,
    ":u" => $id_usuario,
    ":t" => $id_transportadora
    ]);
    echo "Pedido inserido com ID " . $pdo->lastInsertId();
}
    catch (PDOException $e){
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>
