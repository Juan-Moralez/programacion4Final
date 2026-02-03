<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

$id = $_POST['idmanga'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$id])) {

    if ($_SESSION['carrito'][$id]['cantidad'] < $stock) {
        $_SESSION['carrito'][$id]['cantidad']++;
    }

} else {
    $_SESSION['carrito'][$id] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => 1,
        'stock' => $stock
    ];
}

header("Location: ../public/index.php");
exit;
