<?php
include '../conexao.php';

// Verifica se o parâmetro id foi enviado
if (isset($_GET['id'])) {
    // Obtém o ID da série da URL
    $serie_id = $_GET['id'];

    // Prepara e executa a consulta SQL para remover a série
    $sql = "DELETE FROM series WHERE id='$serie_id'";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página de séries após a remoção bem-sucedida
        header("Location: series.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao remover série: " . $conn->error;
    }
} else {
    // Se o ID não foi fornecido, redireciona de volta para a página de séries
    header("Location: series.php");
    exit();
}
?>
