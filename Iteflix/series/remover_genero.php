<?php
include '../conexao.php'; 

$id = $_GET['id'];

$sql = "DELETE FROM genero_serie WHERE id_genero_serie = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: generos.php');
} else {
    echo "Erro ao remover gênero: " . $conn->error;
}
?>
