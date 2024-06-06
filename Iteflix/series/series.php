<?php
include '../conexao.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];

    $sql = "INSERT INTO genero (nome) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);

    if ($stmt->execute()) {
        // Redireciona para 'serie.php' com o novo gênero adicionado como parâmetro GET
        header('Location: serie.php?genero=' . urlencode($nome));
        exit(); // Termina o script após o redirecionamento
    } else {
        echo "Erro ao adicionar gênero: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #141414;
            color: #ffffff;
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
            margin: 0 auto;
        }

        .series-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .series-item {
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            flex: 1 1 calc(33.33% - 20px);
            max-width: calc(33.33% - 20px);
            box-sizing: border-box;
        }

        .series-item h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .series-item p {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .series-item a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }

        .series-item a:hover {
            color: #e50914;
        }

        button {
            background-color: #e50914;
            border: none;
            padding: 5px 10px;
            color: #ffffff;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #f40612;
        }

        form {
            margin-bottom: 20px;
        }

        select {
            padding: 10px;
            margin-right: 10px;
            font-size: 16px;
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
        <h2>Séries</h2>
        
        <form method="GET" action="series.php">
            <label for="genero">Filtrar por Gênero:</label>
            <select name="genero" id="genero">
                <option value="">Todos</option>
                <?php
                // Consultar os gêneros disponíveis no banco de dados
                $sql = "SELECT DISTINCT nome FROM genero_serie";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['nome']) . "'>" . htmlspecialchars($row['nome']) . "</option>";
                    }
                }
                ?>
            </select>
            <br>
            <button type="submit">Filtrar</button>
        </form>

        <div class="series-list">
            <?php
            // Obter o gênero selecionado, se houver
            $genero = isset($_GET['genero']) ? $_GET['genero'] : '';

            // Construir a consulta SQL com base no gênero selecionado
            if ($genero != '') {
                $sql = "SELECT * FROM series WHERE genero=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $genero);
            } else {
                $sql = "SELECT * FROM series";
                $stmt = $conn->prepare($sql);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Exibir cada série como um item da lista
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='series-item'>";
                    echo "<h3>" . htmlspecialchars($row["titulo"]) . "</h3>";
                    echo "<p><strong>Diretor:</strong> " . htmlspecialchars($row["diretor"]) . "</p>";
                    echo "<p><strong>Gênero:</strong> " . htmlspecialchars($row["genero"]) . "</p>";
                    echo "<p><strong>Ano de Início:</strong> " . htmlspecialchars($row["ano_inicio"]) . "</p>";
                    echo "<p><strong>Ano de Fim:</strong> " . htmlspecialchars($row["ano_fim"]) . "</p>";
                    echo "<p><strong>Temporadas:</strong> " . htmlspecialchars($row["temporadas"]) . "</p>";
                    echo "<p><strong>Episódios:</strong> " . htmlspecialchars($row["episodios"]) . "</p>";
                    echo "<p><strong>Classificação:</strong> " . htmlspecialchars($row["classificacao"]) . "</p>";
                    echo "<p><strong>Sinopse:</strong> " . htmlspecialchars($row["sinopse"]) . "</p>";
                    echo "<a href='editar_serie.php?id=" . htmlspecialchars($row["id"]) . "'>Editar</a> | ";
                    echo "<a href='remover_serie.php?id=" . htmlspecialchars($row["id"]) . "'>Excluir</a>";
                    echo "</div>";  
                }
            } else {
                echo "Nenhuma série adicionada ainda.";
            }

            $stmt->close();
            ?>
        </div>
        <button onclick="window.location.href='adicionar_serie.php'">Adicionar Nova Série</button>
        <button onclick="window.location.href='../dashboard.php'">Voltar</button> <!-- Botão Voltar -->
        <button onclick="window.location.href='adicionar_genero.php'">Criar ou Remover gênero </button>
    </section>
</body>
</html>
