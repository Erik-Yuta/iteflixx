<?php
include '../conexao.php'; // Conexão com o banco de dados

$id = $_GET['id'];

$sql = "DELETE FROM genero WHERE id_genero = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: genero.php');
} else {
    echo "Erro ao remover gênero: " . $conn->error;
}
?>
