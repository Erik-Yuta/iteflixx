<?php
include '../conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero_id = $_POST['genero_id'];
    $ano = $_POST['ano'];
    $duracao = $_POST['duracao'];
    $classificacao = $_POST['classificacao'];
    $sinopse = $_POST['sinopse'];

    // Prepara e executa a consulta SQL para inserir um novo filme
    $stmt = $conn->prepare("INSERT INTO filmes (titulo, diretor, genero_id, ano, duracao, classificacao, sinopse) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiisss", $titulo, $diretor, $genero_id, $ano, $duracao, $classificacao, $sinopse);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de filmes após a inserção bem-sucedida
        header("Location: filmes.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao adicionar filme: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #ffffff;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #141414;
            padding: 20px;
            width: 100%;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        nav ul {
            display: flex;
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

        .content {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #1c1c1c;
            border-radius: 10px;
        }

        .content h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form label {
            font-size: 18px;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form textarea,
        form input[type="number"],
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #333;
            color: #ffffff;
        }

        form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        button {
            background-color: #e50914;
            border: none;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #f40612;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #141414;
            color: #ffffff;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">ITEFLIX</div>
            <nav>
                <ul>
                    <li><a href="../dashboard.php">Início</a></li>
                    <li><a href="../series/series.php">Séries</a></li>
                    <li><a href="filmes.php">Filmes</a></li>
                    <li><a href="../esportes/esportes.php">Esportes</a></li>
                    <li><a href="../seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <h2>Adicionar Filme</h2>
        <form action="adicionar_filme.php" method="POST">
            <label for="titulo"><strong>Título:</strong></label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="diretor"><strong>Diretor:</strong></label>
            <input type="text" id="diretor" name="diretor" required>

            <label for="genero_id"><strong>Gênero:</strong></label>
            <select id="genero_id" name="genero_id" required>
                <option value="">Selecione um gênero</option>
                <?php
                $sql_genero = "SELECT id_genero, nome FROM genero";
                $result_genero = $conn->query($sql_genero);
                if ($result_genero->num_rows > 0) {
                    while ($row_genero = $result_genero->fetch_assoc()) {
                        echo "<option value='" . $row_genero['id_genero'] . "'>" . $row_genero['nome'] . "</option>";
                    }
                }
                ?>
            </select>

            <label for="ano"><strong>Ano:</strong></label>
            <input type="number" id="ano" name="ano" required>

            <label for="duracao"><strong>Duração (minutos):</strong></label>
            <input type="number" id="duracao" name="duracao" required>

            <label for="classificacao"><strong>Classificação:</strong></label>
            <input type="text" id="classificacao" name="classificacao" required>

            <label for="sinopse"><strong>Sinopse:</strong></label>
            <textarea id="sinopse" name="sinopse" required></textarea>

            <div class="button-container">
                <button type="submit" name="submit">Adicionar Filme</button>
                <a href="filmes.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
