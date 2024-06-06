<?php
include '../conexao.php'; // Mudando para a conexão específica de esportes

// Definindo a consulta SQL inicial
$sql = "SELECT esportes.*, modalidade.nome AS modalidade_nome FROM esportes 
        JOIN modalidade ON esportes.modalidade_id = modalidade.id_modalidade";

// Verifica se uma modalidade foi selecionada para filtragem
if (isset($_GET['modalidade']) && $_GET['modalidade'] !== 'todos') {
    $modalidade_id = $_GET['modalidade'];
    $sql .= " WHERE esportes.modalidade_id = $modalidade_id";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esportes</title>
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
                    <li><a href="../filmes/filmes.php">Filmes</a></li>
                    <li><a href="../esportes/esportes.php">Esportes</a></li>
                    <li><a href="../seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">

    <section class="content">
        <h2>Esportes</h2>
        <form action="esportes.php" method="GET">
            <label for="modalidade">Filtrar por Modalidade:</label>
            <select name="modalidade" id="modalidade">
                <option value="todos">Todos</option>
                <?php
                // Consulta SQL para obter as modalidades da tabela 'modalidade'
                $sql_modalidade = "SELECT * FROM modalidade";
                $result_modalidade = $conn->query($sql_modalidade);
                if ($result_modalidade->num_rows > 0) {
                    while ($row_modalidade = $result_modalidade->fetch_assoc()) {
                        $selected = (isset($_GET['modalidade']) && $_GET['modalidade'] == $row_modalidade['id_modalidade']) ? "selected" : "";
                        echo "<option value='" . $row_modalidade['id_modalidade'] . "' $selected>" . htmlspecialchars($row_modalidade['nome']) . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" class="button-filtrar">Filtrar</button>
        </form>
        <form action="esportes.php" method="GET">
            <!-- Formulário de filtro conforme fornecido anteriormente -->
        </form>
        <table>
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Data da Transmissão</th>
                    <th>Horário</th>
                    <th>Modalidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_transmissao']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['horario']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['modalidade_nome']) . "</td>";
                        echo "<td><a href='editar_esporte.php?id=" . $row['id_esportes'] . "'>Editar</a> | <a href='remover_esporte.php?id=" . $row['id_esportes'] . "'>Remover</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum esporte encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="adicionar_esporte.php"><button>Adicionar Esporte</button></a>
            <a href="adicionar_modalidade.php"><button>Adicionar Modalidade</button></a>
            <a href="remover_modalidade.php"><button>Remover Modalidade</button></a>
            <a href="../dashboard.php"><button>Voltar</button></a>
        </div>
</body>
</html>
