<?php
include '../conexao.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID do esporte foi enviado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $esporte_id = $_GET['id'];

    // Prepara e executa a consulta SQL para remover o esporte
    $sql = "DELETE FROM esportes WHERE id_esportes = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $esporte_id);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de esportes após a remoção bem-sucedida
        header("Location: esportes.php");
        exit();
    } else {
        echo "Erro ao remover esporte: " . $stmt->error;
    }
} else {
    header("Location: esportes.php");
    exit();
}
?>
