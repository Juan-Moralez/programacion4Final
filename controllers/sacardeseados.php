<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id']; // ← mismo nombre en todo el sistema

if (!empty($_POST['idmanga'])) {
    $idManga = $_POST['idmanga'];

    $stmt = $pdo->prepare("
        DELETE FROM wishlist
        WHERE id_usuario = ? AND id_manga = ?
    ");
    $stmt->execute([$idUsuario, $idManga]);
}

header("Location: ../views/wishlist.php");
exit;
