<?php
require_once __DIR__ . '/../config/bd.php';

$nom = $_POST['nommangas'];
$autor = $_POST['autormangas'];
$genero = $_POST['generosmangas'];
$capitulos = $_POST['cantcapitulosmangas'];
$volumenes = $_POST['cantvolmangas'];
$stock = $_POST['stockmangas'];
$precio = $_POST['preciomangas'];
$descripcion = $_POST['descripcionmangas'];

/* ===== SUBIDA DE IMAGEN ===== */
$imagenRuta = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {

    $nombreArchivo = time() . "_" . basename($_FILES['imagen']['name']);

    $rutaServidor = __DIR__ . "/../public/img/portadas/" . $nombreArchivo;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaServidor)) {
        $imagenRuta = "img/portadas/" . $nombreArchivo;
    }
}

/* ===== INSERT ===== */
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

/* ===== GUARDAR VOLUMENES ===== */
$cantidadVolumenes = $_POST['cantvolmangas'];

for ($i = 1; $i <= $cantidadVolumenes; $i++) {

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
