<?php
include '../conexao.php';

// Verifica se o parâmetro id_filme foi enviado
if (isset($_GET['id_filme']) && !empty($_GET['id_filme'])) {
    // Obtém o ID do filme da URL
    $filme_id = $_GET['id_filme'];

    // Prepara a consulta SQL usando um prepared statement
    $sql = "SELECT * FROM filmes WHERE id_filme = ?";
    
    // Prepara e executa o statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $filme_id); // "i" indica que o parâmetro é um inteiro
    $stmt->execute();
    
    // Verifica se a consulta foi bem-sucedida
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Exibe o formulário de edição com os detalhes do filme preenchidos
        $row = $result->fetch_assoc();
        $titulo = htmlspecialchars($row['titulo']);
        $diretor = htmlspecialchars($row['diretor']);
        $genero_id = $row['genero_id'];
        $ano = $row['ano'];
        $duracao = $row['duracao'];
        $classificacao = htmlspecialchars($row['classificacao']);
        $sinopse = htmlspecialchars($row['sinopse']);
    } else {
        // Se o filme com o ID fornecido não for encontrado, redireciona de volta para a página de filmes
        header("Location: filmes.php");
        exit();
    }
    // Fecha o statement e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Se o ID não foi fornecido, redireciona de volta para a página de filmes
    header("Location: filmes.php");
    exit();
}
?>



