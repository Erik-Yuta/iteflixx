<?php
include '../conexao.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome_modalidade = $_POST['nome_modalidade'];

    // Prepara e executa a consulta SQL para inserir uma nova modalidade usando declarações preparadas
    $stmt = $conn->prepare("INSERT INTO modalidade (nome) VALUES (?)");
    $stmt->bind_param("s", $nome_modalidade);
    
    if ($stmt->execute()) {
        // Redireciona de volta para a página de esportes após a adição bem-sucedida
        header("Location: esportes.php");
        exit();
    } else {
        // Se houver um erro, exibe uma mensagem de erro
        echo "Erro ao adicionar modalidade: " . $stmt->error;
    }

    // Fecha a declaração preparada
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Modalidade</title>
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
                    <li><a href="../filmes/filmes.php">Filmes</a></li>
                    <li><a href="../esportes/esportes.php">Esportes</a></li>
                    <li><a href="../seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <h2>Adicionar Modalidade</h2>
        <form action="adicionar_modalidade.php" method="POST">
            <label for="nome_modalidade"><strong>Nome da Modalidade:</strong></label>
            <input type="text" id="nome_modalidade" name="nome_modalidade" required>

            <div class="button-container">
                <button type="submit" name="submit">Adicionar Modalidade</button>
                <a href="esportes.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
