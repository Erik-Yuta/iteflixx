<?php
session_start();  // Inicia a sessão no início do script

$servername = "localhost";
$username = "root";  // Seu usuário do banco de dados
$password = "";      // Sua senha do banco de dados
$dbname = "iteflix";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Validação básica
    if (empty($email) || empty($senha)) {
        echo "Email e senha são obrigatórios.";
        exit;
    }

    // Prepara a consulta
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se encontrou um usuário
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['usuarios'] = $user['id_usuarios'];  // Armazena o ID do usuário na sessão
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email ou senha inválidos.";
    }

    $stmt->close();
}

$conn->close();
?>





