<?php
$servername = "localhost";
$username = "root";  // Seu usuário do banco de dados
$password = "";      // Sua senha do banco de dados
$dbname = "iteflix";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}
?>

