<?php
include '../conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero = $_POST['genero'];
    $ano_inicio = $_POST['ano_inicio'];
    $ano_fim = $_POST['ano_fim'];
    $temporadas = $_POST['temporadas'];
    $episodios = $_POST['episodios'];
    $classificacao = $_POST['classificacao'];
    $sinopse = $_POST['sinopse'];

    // Prepara e executa a consulta SQL para atualizar os detalhes da série
    $sql = "UPDATE series SET titulo='$titulo', diretor='$diretor', genero='$genero', ano_inicio='$ano_inicio', ano_fim='$ano_fim', temporadas='$temporadas', episodios='$episodios', classificacao='$classificacao', sinopse='$sinopse' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página de séries após a atualização bem-sucedida
        header("Location: series.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao atualizar série: " . $conn->error;
    }
}
?>


