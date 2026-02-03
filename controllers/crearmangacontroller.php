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

$sql = "INSERT INTO mangas 
(nommangas, autormangas, generosmangas, cantcapitulosmangas, cantvolmangas, stockmangas, preciomangas, descripcionmangas)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $autor, $genero, $capitulos, $volumenes, $stock, $precio, $descripcion]);

header("Location: ../public/index.php");
exit;
