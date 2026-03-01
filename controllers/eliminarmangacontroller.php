<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../public/index.php");
    exit;
}

require_once __DIR__ . '/../config/bd.php';

if (!isset($_POST['idmangas']) || !is_numeric($_POST['idmangas'])) {
    die("ID inválido");
}

$id = $_POST['idmangas'];

try {
    $pdo->beginTransaction();

    // 1️⃣ borrar volúmenes
    $pdo->prepare("DELETE FROM volumenes_manga WHERE id_manga = ?")
        ->execute([$id]);

    // 2️⃣ borrar wishlist
    $pdo->prepare("DELETE FROM wishlist WHERE id_manga = ?")
        ->execute([$id]);

    // 3️⃣ borrar detalle de compras (clave foránea)
    $pdo->prepare("DELETE FROM detalle_compra WHERE id_manga = ?")
        ->execute([$id]);

    // 4️⃣ borrar manga
    $pdo->prepare("DELETE FROM mangas WHERE idmangas = ?")
        ->execute([$id]);

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
    die("Error al eliminar manga");
}

header("Location: ../public/index.php");
exit;
