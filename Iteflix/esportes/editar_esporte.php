<?php
include '../conexao.php'; // Inclui a conexão com o banco de dados

// Verifica se o ID do esporte foi enviado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $esporte_id = $_GET['id'];

    // Consulta SQL para obter os dados do esporte a ser editado
    $sql = "SELECT * FROM esportes WHERE id_esportes = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $esporte_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $esporte = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $descricao = $_POST['descricao'];
        $modalidade_id = $_POST['modalidade_id'];
        $data_transmissao = $_POST['data_transmissao'];
        $horario = $_POST['horario'];

        // Prepara e executa a consulta SQL para atualizar o esporte
        $sql_update = "UPDATE esportes SET descricao = ?, modalidade_id = ?, data_transmissao = ?, horario = ? WHERE id_esportes = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sissi", $descricao, $modalidade_id, $data_transmissao, $horario, $esporte_id);

        if ($stmt_update->execute()) {
            // Redireciona de volta para a página de esportes após a edição bem-sucedida
            header("Location: esportes.php");
            exit();
        } else {
            echo "Erro ao atualizar esporte: " . $stmt_update->error;
        }
    }
} else {
    header("Location: esportes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Esporte</title>
    <style>
        /* CSS mantido conforme fornecido anteriormente */
        body { font-family: Arial, sans-serif; background-color: #141414; color: #ffffff; margin: 0; padding: 0; overflow-x: hidden; }
        header { background-color: #141414; padding: 20px; width: 100%; z-index: 1000; }
        .navbar { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; }
        .logo { font-size: 24px; font-weight: bold; }
        nav ul { display: flex; list-style: none; padding: 0; }
        nav ul li { margin: 0 10px; }
        nav ul li a { text-decoration: none; color: #ffffff; font-weight: bold; }
        .content { padding: 20px; max-width: 1200px; margin: 20px auto; background-color: #1c1c1c; border-radius: 10px; }
        .content h2 { font-size: 28px; margin-bottom: 20px; }
        form { display: flex; flex-direction: column; }
        form label { font-size: 18px; margin-bottom: 5px; }
        form input[type="text"], form textarea, form input[type="date"], form input[type="time"], select { padding: 10px; margin-bottom: 15px; border: none; border-radius: 5px; font-size: 16px; background-color: #333; color: #ffffff; }
        form textarea { resize: vertical; min-height: 100px; }
        .button-container { display: flex; gap: 10px; }
        button { background-color: #e50914; border: none; padding: 10px 20px; color: #ffffff; font-size: 16px; cursor: pointer; border-radius: 5px; }
        button:hover { background-color: #f40612; }
        footer { text-align: center; padding: 20px; background-color: #141414; color: #ffffff; position: absolute; bottom: 0; width: 100%; }
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
        <h2>Editar Esporte</h2>
        <form action="editar_esporte.php?id=<?php echo $esporte_id; ?>" method="POST">
            <label for="descricao"><strong>Descrição:</strong></label>
            <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($esporte['descricao']); ?></textarea>

            <label for="modalidade_id"><strong>Modalidade:</strong></label>
            <select id="modalidade_id" name="modalidade_id" required>
                <option value="">Selecione uma modalidade</option>
                <?php
                $sql_modalidade = "SELECT id_modalidade, nome FROM modalidade";
                $result_modalidade = $conn->query($sql_modalidade);
                if ($result_modalidade->num_rows > 0) {
                    while ($row_modalidade = $result_modalidade->fetch_assoc()) {
                        $selected = ($esporte['modalidade_id'] == $row_modalidade['id_modalidade']) ? "selected" : "";
                        echo "<option value='" . $row_modalidade['id_modalidade'] . "' $selected>" . htmlspecialchars($row_modalidade['nome']) . "</option>";
                    }
                }
                ?>
            </select>

            <label for="data_transmissao"><strong>Data da Transmissão:</strong></label>
            <input type="date" id="data_transmissao" name="data_transmissao" value="<?php echo $esporte['data_transmissao']; ?>" required>

            <label for="horario"><strong>Horário:</strong></label>
            <input type="time" id="horario" name="horario" value="<?php echo $esporte['horario']; ?>" required>

            <div class="button-container">
                <button type="submit" name="submit">Salvar Alterações</button>
                <a href="esportes.php"><button type="button">Cancelar</button></a>
            </div>
        </form>
    </section>
</body>
</html>
