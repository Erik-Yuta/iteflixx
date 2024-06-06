<?php
session_start();  // Inicia a sessão no início do script

if (!isset($_SESSION['usuarios'])) {
    header('Location: index.php?erro=true');
    exit;
}
?>
