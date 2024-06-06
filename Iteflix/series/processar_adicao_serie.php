<?php
include '../conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero = $_POST['genero'];
    $ano_inicio = $_POST['ano_inicio'];
    $ano_fim = $_POST['ano_fim'];
    $temporadas = $_POST['temporadas'];
    $episodios = $_POST['episodios'];
    $classificacao = $_POST['classificacao'];
    $sinopse = $_POST['sinopse'];

    // Prepara e executa a consulta SQL para inserir a nova série
    $sql = "INSERT INTO series (titulo, diretor, genero, ano_inicio, ano_fim, temporadas, episodios, classificacao, sinopse) 
            VALUES ('$titulo', '$diretor', '$genero', '$ano_inicio', '$ano_fim', '$temporadas', '$episodios', '$classificacao', '$sinopse')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página de séries após a adição bem-sucedida
        header("Location: series.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao adicionar nova série: " . $conn->error;
    }
}
?>

