<?php
include '../conexao.php'; 

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];

    $sql = "UPDATE genero_serie SET nome = ? WHERE id_genero_serie = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nome, $id);

    if ($stmt->execute()) {
        header('Location: generos.php');
    } else {
        echo "Erro ao atualizar gênero: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM genero_serie WHERE id_genero_serie = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $genero = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Gênero</title>
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

        form input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            background-color: #333;
            color: #ffffff;
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
                    <li><a href="../filmes/filmes.php">Filmes</a></li>
                    <li><a href="../esportes/esportes.php">Esportes</a></li>
                    <li><a href="../seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <h2>Editar Gênero</h2>
        <form action="editar_genero.php?id=<?php echo $id; ?>" method="POST">
            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($genero['nome']); ?>" required>
            <div class="button-container">
                <button type="submit">Atualizar</button>
                <a href="generos.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
