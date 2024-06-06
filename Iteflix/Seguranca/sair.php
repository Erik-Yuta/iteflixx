<?php
session_start(); // Inicia a sessão

// Destroi a sessão
session_destroy();

// Redireciona de volta para a página de login
header("Location: ../index.php");

?>