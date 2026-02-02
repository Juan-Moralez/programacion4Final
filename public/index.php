<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

echo "Ta funcionando, soy una bestia";
?>

<h3>Bienvenido <?= htmlspecialchars($_SESSION['usuario']['nomusuarios']) ?></h3>
<a href="../controllers/logout.php">Cerrar sesión</a>
