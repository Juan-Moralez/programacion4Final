<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario']) || empty($_SESSION['carrito'])) {
    header("Location: ../public/index.php");
    exit;
}

$idUsuario = (int)$_SESSION['usuario']['id'];
$itemsCompra = [];
$total = 0.0;

$stmtManga = $pdo->prepare("SELECT idmangas, nommangas, preciomangas, stockmangas FROM mangas WHERE idmangas = ?");

foreach ($_SESSION['carrito'] as $item) {
    if (!isset($item['id_manga'])) {
        continue;
    }

    $idManga = (int)$item['id_manga'];
    $cantidad = (int)($item['cantidad'] ?? 0);
    if ($idManga <= 0 || $cantidad <= 0) {
        continue;
    }

    $stmtManga->execute([$idManga]);
    $manga = $stmtManga->fetch(PDO::FETCH_ASSOC);
    if (!$manga) {
        continue;
    }

    $stockActual = (int)$manga['stockmangas'];
    if ($stockActual <= 0) {
        continue;
    }

    if ($cantidad > $stockActual) {
        $cantidad = $stockActual;
    }

    $precio = (float)$manga['preciomangas'];
    $total += $precio * $cantidad;
    $itemsCompra[] = [
        'id_manga' => (int)$manga['idmangas'],
        'nombre' => $manga['nommangas'],
        'precio' => $precio,
        'cantidad' => $cantidad,
        'volumen' => $item['volumen'] ?? null
    ];
}

if (empty($itemsCompra)) {
    header("Location: ../views/carritovista.php");
    exit;
}

try {
    $pdo->beginTransaction();

    $stmtCompra = $pdo->prepare("INSERT INTO compras (id_usuario, total) VALUES (?, ?)");
    $stmtCompra->execute([$idUsuario, $total]);
    $idCompra = $pdo->lastInsertId();

    $stmtDetalle = $pdo->prepare("
        INSERT INTO detalle_compra
        (id_compra, id_manga, nombre, precio, cantidad, volumen)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmtStock = $pdo->prepare("UPDATE mangas SET stockmangas = stockmangas - ? WHERE idmangas = ?");

    foreach ($itemsCompra as $item) {
        $stmtDetalle->execute([
            $idCompra,
            $item['id_manga'],
            $item['nombre'],
            $item['precio'],
            $item['cantidad'],
            $item['volumen']
        ]);

        $stmtStock->execute([$item['cantidad'], $item['id_manga']]);
    }

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    die("No se pudo procesar la compra.");
}

unset($_SESSION['carrito']);
$_SESSION['compra_realizada'] = true;

header("Location: ../public/index.php");
exit;
