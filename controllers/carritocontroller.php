<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

$id = $_POST['idmanga'];
$nombre = $_POST['nommangas'];
$precio = $_POST['preciomangas'];
$stock = $_POST['stockmangas'];
$volumen = $_POST['volumen'] ?? "General";


if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_SESSION['carrito'][$id])) {

    if ($_SESSION['carrito'][$id]['cantidad'] < $stock) {
        $_SESSION['carrito'][$id]['cantidad']++;
    }

} else {
  $clave = $id . "_vol" . $volumen;

$_SESSION['carrito'][$clave] = [
    'nombre' => $nombre,
    'precio' => $precio,
    'cantidad' => 1,
    'stock' => $stock,
    'volumen' => $volumen
];

}

header("Location: ../public/index.php");
exit;
