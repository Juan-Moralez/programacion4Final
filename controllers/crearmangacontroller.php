<?php
session_start();
require_once __DIR__ . '/../config/bd.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../public/index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../views/crearmanga.php");
    exit;
}

$nom = trim((string)($_POST['nommangas'] ?? ''));
$autor = trim((string)($_POST['autormangas'] ?? ''));
$genero = trim((string)($_POST['generosmangas'] ?? ''));
$capitulos = (int)($_POST['cantcapitulosmangas'] ?? 0);
$volumenes = (int)($_POST['cantvolmangas'] ?? 0);
$stock = (int)($_POST['stockmangas'] ?? 0);
$precio = (float)($_POST['preciomangas'] ?? 0);
$descripcion = trim((string)($_POST['descripcionmangas'] ?? ''));

if ($nom === '' || $volumenes < 1 || $stock < 0 || $precio < 0) {
    die("Datos inválidos.");
}

$imagenRuta = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    $nombreArchivo = time() . "_" . basename($_FILES['imagen']['name']);
    $rutaServidor = __DIR__ . "/../public/img/portadas/" . $nombreArchivo;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaServidor)) {
        $imagenRuta = "img/portadas/" . $nombreArchivo;
    }
}

$sql = "INSERT INTO mangas
(nommangas, autormangas, generosmangas, cantcapitulosmangas, cantvolmangas, stockmangas, preciomangas, descripcionmangas, imagen_url)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $nom,
    $autor,
    $genero,
    $capitulos,
    $volumenes,
    $stock,
    $precio,
    $descripcion,
    $imagenRuta
]);

$idManga = $pdo->lastInsertId();

for ($i = 1; $i <= $volumenes; $i++) {
    if (!empty($_FILES["portada_volumen_$i"]['name'])) {
        $nombreArchivo = time() . "_vol$i_" . $_FILES["portada_volumen_$i"]['name'];
        $rutaServidor = __DIR__ . "/../public/img/portadas/" . $nombreArchivo;

        if (move_uploaded_file($_FILES["portada_volumen_$i"]['tmp_name'], $rutaServidor)) {
            $rutaBD = "img/portadas/" . $nombreArchivo;
            $stmtVol = $pdo->prepare("
                INSERT INTO volumenes_manga (id_manga, nro_volumen, portada_url)
                VALUES (?, ?, ?)
            ");
            $stmtVol->execute([$idManga, $i, $rutaBD]);
        }
    }
}

header("Location: ../public/index.php");
exit;
