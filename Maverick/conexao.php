<?php
$host = 'localhost';
$dbname = 'aeroclub';
$username = 'root';
$password = '';

try{
    $conexao = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Erro na conexao: ". $e->getMessage());
}

?>