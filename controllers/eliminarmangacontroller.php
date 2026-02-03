<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: ../public/index.php");
    exit;
}

require_once __DIR__ . '/../config/bd.php';

$id = $_POST['idmangas'];

$sql = "DELETE FROM mangas WHERE idmangas = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../public/index.php");
exit;
