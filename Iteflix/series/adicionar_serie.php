<?php include '../conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Nova Série</title>
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
        form input[type="number"],
        form textarea {
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
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">ITEFLIX</div>
            <nav>
                <ul>
                    <li><a href="../dashboard.php">Início</a></li>
                    <li><a href="series.php">Séries</a></li>
                    <li><a href="../filmes/filmes.php">Filmes</a></li>
                    <li><a href="../esportes/esportes.php">Esportes</a></li>
                    <li><a href="../seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <h2>Adicionar Nova Série</h2>
        <form action="processar_adicao_serie.php" method="POST">
            <label for="titulo"><strong>Título:</strong></label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="diretor"><strong>Diretor:</strong></label>
            <input type="text" id="diretor" name="diretor" required>

            <label for="genero"><strong>Gênero:</strong></label>
            <input type="text" id="genero" name="genero" required>

            <label for="ano_inicio"><strong>Ano de Início:</strong></label>
            <input type="number" id="ano_inicio" name="ano_inicio" required>

            <label for="ano_fim"><strong>Ano de Fim:</strong></label>
            <input type="number" id="ano_fim" name="ano_fim" required>

            <label for="temporadas"><strong>Temporadas:</strong></label>
            <input type="number" id="temporadas" name="temporadas" required>

            <label for="episodios"><strong>Episódios:</strong></label>
            <input type="number" id="episodios" name="episodios" required>

            <label for="classificacao"><strong>Classificação:</strong></label>
            <input type="text" id="classificacao" name="classificacao" required>

            <label for="sinopse"><strong>Sinopse:</strong></label>
            <textarea id="sinopse" name="sinopse" required></textarea>

            <div class="button-container">
                <button type="submit" name="submit">Adicionar Série</button>
                <a href="series.php"><button type="button">Voltar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
