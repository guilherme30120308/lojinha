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
?>