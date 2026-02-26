<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];

if (isset($_POST['idmanga'])) {
    $idManga = $_POST['idmanga'];

    $stmt = $pdo->prepare("
        INSERT IGNORE INTO wishlist (id_usuario, id_manga)
        VALUES (?, ?)
    ");
    $stmt->execute([$idUsuario, $idManga]);
}

header("Location: ../views/wishlist.php");
exit;
