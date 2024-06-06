<?php
include '../conexao.php'; // Incluindo o arquivo de conexão com o banco de dados

// Verifica se o ID do filme foi passado como parâmetro
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_filme = $_GET['id'];

    // Consulta SQL para obter os dados do filme
    $sql = "SELECT * FROM filmes WHERE id_filmes = $id_filme";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $filme = $result->fetch_assoc();
    } else {
        echo "Filme não encontrado.";
        exit;
    }
} else {
    echo "ID do filme não especificado.";
    exit;
}

// Atualização dos dados do filme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $diretor = $_POST['diretor'];
    $genero_id = $_POST['genero'];
    $ano = $_POST['ano'];
    $duracao = $_POST['duracao'];
    $classificacao = $_POST['classificacao'];
    $sinopse = $_POST['sinopse'];

    $sql_update = "UPDATE filmes SET titulo='$titulo', diretor='$diretor', genero_id='$genero_id', ano='$ano', duracao='$duracao', classificacao='$classificacao', sinopse='$sinopse' WHERE id_filmes=$id_filme";

    if ($conn->query($sql_update) === TRUE) {
        echo "Filme atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o filme: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, select, textarea, button {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
        }

        input, select, textarea {
            background-color: #333;
            color: #ffffff;
        }

        .button-container {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }

        button {
            background-color: #e50914;
            color: #ffffff;
            cursor: pointer;
        }

        button:hover {
            background-color: #f40612;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
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
        <h2>Editar Filme</h2>
        <form action="editar_filme.php?id=<?php echo $id_filme; ?>" method="POST">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($filme['titulo']); ?>" required>

            <label for="diretor">Diretor:</label>
            <input type="text" name="diretor" value="<?php echo htmlspecialchars($filme['diretor']); ?>" required>

            <label for="genero">Gênero:</label>
            <select name="genero" required>
                <?php
                $sql_genero = "SELECT * FROM genero";
                $result_genero = $conn->query($sql_genero);
                if ($result_genero->num_rows > 0) {
                    while ($row_genero = $result_genero->fetch_assoc()) {
                        $selected = ($filme['genero_id'] == $row_genero['id_genero']) ? "selected" : "";
                        echo "<option value='" . $row_genero['id_genero'] . "' $selected>" . htmlspecialchars($row_genero['nome']) . "</option>";
                    }
                }
                ?>
            </select>

            <label for="ano">Ano:</label>
            <input type="number" name="ano" value="<?php echo htmlspecialchars($filme['ano']); ?>" required>

            <label for="duracao">Duração:</label>
            <input type="text" name="duracao" value="<?php echo htmlspecialchars($filme['duracao']); ?>" required>

            <label for="classificacao">Classificação:</label>
            <input type="text" name="classificacao" value="<?php echo htmlspecialchars($filme['classificacao']); ?>" required>

            <label for="sinopse">Sinopse:</label>
            <textarea name="sinopse" required><?php echo htmlspecialchars($filme['sinopse']); ?></textarea>

            <div class="button-container">
                <button type="submit">Salvar Alterações</button>
                <a href="filmes.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
