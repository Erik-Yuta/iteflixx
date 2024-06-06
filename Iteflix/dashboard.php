<?php 
include('seguranca/bloqueio.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iteflix</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">ITEFLIX</div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Início</a></li>
                    <li><a href="series/series.php">Séries</a></li>
                    <li><a href="filmes/filmes.php">Filmes</a></li>
                    <li><a href="esportes/esportes.php">Esportes</a></li>
                    <li><a href="seguranca/sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>SCOOBY! O Filme</h1>
            <p>O filme conta a história inédita da origem do Scooby-Doo e o maior mistério na carreira da Mistério S/A.</p>
            <button>Assistir</button>
            <button>Minha Lista</button>
        </div>
    </section>

    <section class="gallery">
        <h2>Populares</h2>
        <div class="movie-grid">
            <div class="movie-item">
                <a href="populares/tartaruga.html">
                    <img src="populares/imagens/Tartaruga.jpg" alt="Tartaruga">
                    <div class="movie-title">Tartaruga</div>
                </a>
            </div>
            <div class="movie-item">
                <a href="populares/transformers.html">
                    <img src="populares/imagens/Transformers.jpg" alt="Transformers">
                    <div class="movie-title">Transformers</div>
                </a>
            </div>
            <div class="movie-item">
                <a href="populares/rambo.html">
                    <img src="populares/imagens/Rambo.jpg" alt="Rambo">
                    <div class="movie-title">Rambo</div>
                </a>
            </div>
            <div class="movie-item">
                <a href="populares/mercenarios.html">
                    <img src="populares/imagens/Mercenarios.jpg" alt="Mercenários">
                    <div class="movie-title">Mercenários</div>
                </a>
            </div>
            <div class="movie-item">
                <a href="populares/toy.html">
                    <img src="populares/imagens/Toy.jpg" alt="Toy Story">
                    <div class="movie-title">Toy Story</div>
                </a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Iteflix. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
