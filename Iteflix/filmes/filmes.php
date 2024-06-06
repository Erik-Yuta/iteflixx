<?php
include '../conexao.php'; // Mudando para a conexão específica de filmes

// Definindo a consulta SQL inicial
$sql = "SELECT filmes.*, genero.nome as genero_nome FROM filmes 
        JOIN genero ON filmes.genero_id = genero.id_genero";

// Verifica se um gênero foi selecionado para filtragem
if (isset($_GET['genero']) && $_GET['genero'] !== 'todos') {
    $genero_id = $_GET['genero'];
    $sql .= " WHERE filmes.genero_id = $genero_id";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
        }

        a {
            color: #e50914;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
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

        .button-container {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .button-filtrar {
            padding: 5px 10px; /* Reduzindo o tamanho do botão pela metade */
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #141414;
            color: #ffffff;
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
        <h2>Filmes</h2>
        <form action="filmes.php" method="GET">
            <label for="genero">Filtrar por Gênero:</label>
            <select name="genero" id="genero">
                <option value="todos">Todos</option>
                <?php
                // Consulta SQL para obter os gêneros da tabela 'genero'
                $sql_genero = "SELECT * FROM genero";
                $result_genero = $conn->query($sql_genero);
                if ($result_genero->num_rows > 0) {
                    while ($row_genero = $result_genero->fetch_assoc()) {
                        $selected = (isset($_GET['genero']) && $_GET['genero'] == $row_genero['id_genero']) ? "selected" : "";
                        echo "<option value='" . $row_genero['id_genero'] . "' $selected>" . htmlspecialchars($row_genero['nome']) . "</option>";
                    }
                }
                ?>
            </select>
            <br></br>
            <button type="submit" class="button-filtrar">Filtrar</button>
            <br></br>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Diretor</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Duração</th>
                    <th>Classificação</th>
                    <th>Sinopse</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . ($row['titulo']) . "</td>";
                        echo "<td>" . ($row['diretor']) . "</td>";
                        echo "<td>" . ($row['genero_nome']) . "</td>";
                        echo "<td>" . ($row['ano']) . "</td>";
                        echo "<td>" . ($row['duracao']) . "</td>";
                        echo "<td>" . ($row['classificacao']) . "</td>";
                        echo "<td>" . ($row['sinopse']) . "</td>";
                        echo "<td><a href='editar_filme.php?id=" . $row['id_filmes'] . "'>Editar</a> | <a href='remover_filme.php?id=" . $row['id_filmes'] . "'>Remover</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum filme encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="adicionar_filme.php"><button>Adicionar Filme</button></a>
            <a href="adicionar_genero.php"><button>Adicionar Gênero</button></a>
            <a href="remover_genero.php"><button>Remover Gênero</button></a>
            <a href="../dashboard.php"><button>Voltar</button></a>
        </div>
    </section>
</body>
</html>
