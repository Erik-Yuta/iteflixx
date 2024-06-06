<?php
include '../conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero_id = $_POST['genero'];
    $ano = $_POST['ano'];
    $duracao = $_POST['duracao'];
    $classificacao = $_POST['classificacao'];
    $sinopse = $_POST['sinopse'];

    // Prepara e executa a consulta SQL para inserir um novo filme usando declarações preparadas
    $stmt = $conn->prepare("INSERT INTO filmes (titulo, diretor, genero_id, ano, duracao, classificacao, sinopse) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiiss", $titulo, $diretor, $genero_id, $ano, $duracao, $classificacao, $sinopse);
    
    if ($stmt->execute()) {
        // Redireciona de volta para a página de filmes após a adição bem-sucedida
        header("Location: filmes.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao adicionar filme: " . $stmt->error;
    }

    // Fecha a declaração preparada
    $stmt->close();
}
?>

