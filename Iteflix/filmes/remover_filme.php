<?php
include '../conexao.php';

// Verifica se o parâmetro id foi enviado e se é um número inteiro
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Obtém o ID do filme da URL
    $filme_id = $_GET['id'];

    // Prepara e executa a consulta SQL para remover o filme usando declarações preparadas
    $stmt = $conn->prepare("DELETE FROM filmes WHERE id_filmes = ?");
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincula o parâmetro ao statement
        $stmt->bind_param("i", $filme_id);
        
        // Executa a consulta
        if ($stmt->execute()) {
            // Redireciona de volta para a página de filmes após a remoção bem-sucedida
            header("Location: filmes.php");
            exit();
        } else {
            // Se houver um erro na execução da consulta, exibe uma mensagem de erro
            echo "Erro ao remover filme: " . $stmt->error;
        }

        // Fecha a declaração preparada
        $stmt->close();
    } else {
        // Se houver um erro na preparação da consulta, exibe uma mensagem de erro
        echo "Erro na preparação da consulta: " . $conn->error;
    }
} else {
    // Se o ID não foi fornecido ou não é um número válido, redireciona de volta para a página de filmes
    header("Location: filmes.php");
    exit();
}
?>

