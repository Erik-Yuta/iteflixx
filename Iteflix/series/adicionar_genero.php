<?php
include '../conexao.php'; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    // Verifica se o nome do gênero não está vazio
    if (!empty($nome)) {
        // Insere o novo gênero na tabela 'genero_serie'
        $sql = "INSERT INTO genero_serie (nome) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $nome);

        if ($stmt->execute()) {
            header('Location: generos.php'); // Redireciona para a página de gêneros após adicionar com sucesso
        } else {
            echo "Erro ao adicionar gênero: " . $conn->error;
        }
    } else {
        echo "Por favor, preencha o nome do gênero.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Gênero</title>
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
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        input[type="submit"], button {
            background-color: #e50914;
            border: none;
            padding: 10px 20px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover, button:hover {
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
        <h2>Adicionar Gênero</h2>
        <form action="adicionar_genero.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <div class="button-container">
                <input type="submit" value="Enviar">
                <a href="generos.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
