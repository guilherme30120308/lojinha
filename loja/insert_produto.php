<?php
function getConnection() {
    $host = "localhost";
    $dbname = "loja";
    $user = "root";
    $pass = "";
try{
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } 
    catch (PDOException $e){
        die("Erro de conexao: " . $e->getMessage());
    }
}
try{
    $pdo = getConnection();
    extract($_POST);

    if (!is_numeric($quantidade) || $quantidade < 0 || $quantidade != (int)$quantidade){
        die("A quantidade deve ser um numero inteiro maior ou igual a zero.");
    }
    $preco = str_replace(',', '.', $preco);
    if (!is_numeric($preco) || $preco <= 0){
        die("O preco deve ser maior que zero.");
    }
    if (!filter_var($id_fornecedor, FILTER_VALIDATE_INT)) {
     die("O ID do fornecedor deve ser um numero inteiro.");
}
    $sql = "INSERT INTO produto (nome, quantidade, preco, categoria, id_fornecedor) VALUES (:n, :q, :p, :c, :i)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":n" => $nome,
        ":q" => $quantidade,
        ":p" => $preco,
        ":c" => $categoria,
        ":i" => $id_fornecedor
    ]);
    echo "Produto inserido com ID " . $pdo->lastInsertId();
}   
    catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}
?>
