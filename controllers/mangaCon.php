<?php
require_once __DIR__ . '/../config/bd.php';
require_once __DIR__ . '/../models/Mangas.php';

$mangaModel = new Mangas($pdo);
$mangas = $mangaModel->listar();
