<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario']) || empty($_SESSION['carrito'])) {
    header("Location: ../public/index.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$total = 0;

foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Crear compra
$stmt = $pdo->prepare("INSERT INTO compras (id_usuario, total) VALUES (?, ?)");
$stmt->execute([$idUsuario, $total]);
$idCompra = $pdo->lastInsertId();

// Guardar detalle
$stmtDetalle = $pdo->prepare("
    INSERT INTO detalle_compra
    (id_compra, id_manga, nombre, precio, cantidad, volumen)
    VALUES (?, ?, ?, ?, ?, ?)
");

foreach ($_SESSION['carrito'] as $idManga => $item) {
    $stmtDetalle->execute([
        $idCompra,
        $idManga,
        $item['nombre'],
        $item['precio'],
        $item['cantidad'],
        $item['volumen'] ?? null
    ]);
}



// Vaciar carrito
unset($_SESSION['carrito']);
$_SESSION['compra_realizada'] = true;

header("Location: ../public/index.php");
exit;
