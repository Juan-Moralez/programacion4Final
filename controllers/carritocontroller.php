<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['idmanga']) || !is_numeric($_POST['idmanga'])) {
    header("Location: ../public/index.php");
    exit;
}

$idManga = (int)$_POST['idmanga'];
$volumen = trim((string)($_POST['volumen'] ?? 'General'));
if ($volumen === '') {
    $volumen = 'General';
}

$stmt = $pdo->prepare("SELECT idmangas, nommangas, preciomangas, stockmangas FROM mangas WHERE idmangas = ?");
$stmt->execute([$idManga]);
$manga = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$manga) {
    header("Location: ../public/index.php");
    exit;
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$clave = $idManga . "_vol" . $volumen;
$stock = (int)$manga['stockmangas'];

if (isset($_SESSION['carrito'][$clave])) {
    if ((int)$_SESSION['carrito'][$clave]['cantidad'] < $stock) {
        $_SESSION['carrito'][$clave]['cantidad']++;
    }
} else {
    $_SESSION['carrito'][$clave] = [
        'id_manga' => $idManga,
        'nombre' => $manga['nommangas'],
        'precio' => (float)$manga['preciomangas'],
        'cantidad' => 1,
        'stock' => $stock,
        'volumen' => $volumen
    ];
}

header("Location: ../public/index.php");
exit;
